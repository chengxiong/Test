<?php

namespace App\Http\Controllers\Hostel;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Models\BnbLayout;
use Illuminate\Support\Facades\DB;
use App\Models\PriceTag;
use Log;

class RoomController extends Controller {

    public function index($id) {
        $layout = BnbLayout::findOrFail($id);

        $paginate = Config::get('system.paginate');
        $room_list = Room::where('tid', $id)->orderBy('id', 'desc')->orderBy('updated_at', 'desc')->paginate($paginate);

        return view('hostel.rooms.index')->with('room_list', $room_list)->with('layout', $layout);
    }

    public function create($id) {
        $layout = BnbLayout::findOrFail($id);

        return view('hostel.rooms.create')->with('layout', $layout);
    }

    /**
     * 添加房间处理
     * 1. 添加房间基本信息
     * 2. 上传房间图片
     * 3. 添加包房时间记录 
     * 
     * @param Request $request
     * @param type $id
     * @return type
     */
    public function store(Request $request, $id) {
        $rules = array(
            'name' => 'required|max:255',
            'price' => 'required',
            'number' => 'required|between:1,2'
        );
        $tkOwned = $request->get('tkOwned', 0);
        if ($tkOwned) {
            $rules['tkTime'] = 'required';
        }
        $this->validate($request, $rules);
        $layout = BnbLayout::findOrFail($id);
        $room_info = $request->all();
        $room_info['bid'] = $layout->bid;
        $room_info['tid'] = $id;

        DB::beginTransaction();
        try {
            $room = Room::create($room_info);
            if ($room) {
                # 添加房间图片
                $image_info = $this->uploadFile($request, $room->id);
                if ($image_info) {
                    DB::table('rooms_image')->insert($image_info);
                }
                # 添加包房时间记录
                if ($tkOwned) {
                    $result = array();
                    $tkTime = $request->get('tkTime');
                    $tkTime_arr = explode(',', $tkTime);
                    foreach (array_unique($tkTime_arr) as $time) {
                        $result[] = array(
                            'rid' => $room->id,
                            'price' => $room->price,
                            'priceDate' => $time,
                            'source' => 1,
                            'actionUserId' => $this->logUser->id,
                            'created_at' => date('Y-m-d H:i:s', time()),
                            'updated_at' => date('Y-m-d H:i:s', time())
                        );
                    }
                    if (!empty($result)) {
                        Log::info('用户'.$this->logUser->id.'添加了包房信息',$result);
                        DB::table('pricetag')->insert($result);
                    }
                }
            }
            DB::commit();
            Log::info('用户'.$this->logUser->id.'新增了房间信息',$room_info);
            return redirect('/bnb/layout/' . $id . '/rooms')->with('message', '房间添加成功');
        } catch (Exception $ex) {
            DB::rollBack();
            Log::info('用户'.$this->logUser->id.'新增了房间失败',$room_info);
            return Redirect::back()->withInput()->withErrors('房间添加失败');
        }
    }

    /**
     * 像七牛上传图片方法处理
     * 
     * @param type $request
     * @param type $id
     * @return type
     */
    private function uploadFile($request, $id) {
        $file_list = $request->file('file');
        $image_info = array();
        if (!empty($file_list) && is_array($file_list) && !empty($file_list[0])) {
            foreach ($file_list as $key => $file) {
                //判断文件上传过程中是否出错
                if (!$file->isValid()) {
                    return Redirect::back()->withInput()->withErrors('文件上传出错');
                }
                $newFileName = md5(time() . rand(0, 10000)) . '.' . $file->getClientOriginalExtension();
                $qiniu = Config::get('system.qiniu');
                $savePath = $qiniu . $newFileName;
                # 获取七牛驱动
                $disk = Storage::disk('qiniu');
                $bytes = $disk->put(
                        $savePath, file_get_contents($file->getRealPath())
                );
                # 获取上传图片反馈地址
                $url = $disk->imagePreviewUrl($savePath);
                if (!$disk->exists($savePath)) {
                    return Redirect::back()->withInput()->withErrors('保存文件失败');
                }
                $image_info[$key]['url'] = $url;
                $image_info[$key]['rid'] = $id;
            }
            unset($key, $file);
        }
        Log::info('用户'.$this->logUser->id.'上传了图片',$image_info);
        return $image_info;
    }

    public function edit($id) {
        $room = Room::findOrFail($id);

        return view('hostel.rooms.edit')->with('room', $room);
    }

    /**
     * 更新房间信息方法处理
     * 
     * @param Request $request
     * @param type $id
     * @chreturn type
     */
    public function update(Request $request, $id) {
        $rules = array(
            'name' => 'required|max:255',
            'price' => 'required',
            'number' => 'required|between:1,2'
        );
        $tkOwned = $request->get('tkOwned', 0);
        if ($tkOwned) {
            $rules['tkTime'] = 'required';
        }

        # 重构包房数据标识
        $restructure = $request->get('restructure', 0);

        $delete_img = $request->get('img_id');
        $delete_list = explode(',', $delete_img);
        $delete_list = array_unique($delete_list);

        $room = Room::findOrFail($id);
        DB::beginTransaction();
        try {
            # 添加房间图片
            $image_info = $this->uploadFile($request, $id);
            # 删除需要删除的图片
            if (!empty($delete_list)) {
                # 删除取消的图片
                DB::table('rooms_image')->whereIn('id', $delete_list)->delete();
            }
            if ($image_info) {
                DB::table('rooms_image')->insert($image_info);
            }
            if ($room->update($request->all())) {
                if ($restructure) {
                    # 先删除原来包房时间
                    $has_own = $room->tkTimeList();
                    if ($has_own) {
                        DB::table('pricetag')->whereIn('id', $has_own)->delete();
                    }
                    # 包房的重新添加时间
                    if ($tkOwned) {
                        $tkTime = $request->get('tkTime');
                        $tkTime_arr = explode(',', $tkTime);
                        foreach (array_unique($tkTime_arr) as $time) {
                            $result[] = array(
                                'rid' => $room->id,
                                'price' => $room->price,
                                'priceDate' => $time,
                                'source' => 1,
                                'actionUserId' => $this->logUser->id,
                                'created_at' => date('Y-m-d H:i:s', time()),
                                'updated_at' => date('Y-m-d H:i:s', time())
                            );
                        }
                        if (!empty($result)) {
                            Log::info('重新定义了包房的时间'.$this->logUser->id,$result);
                            DB::table('pricetag')->insert($result);
                        }                        
                    }
                }
            }
            DB::commit();
            Log::info('用户'.$this->logUser->id.'成功修改了房间基本信息',['info'=>$request->all()]);
            return redirect('/bnb/layout/' . $room->tid . '/rooms')->with('message', '房间修改成功');
        } catch (Exception $ex) {
            DB::rollBack();
            Log::info('用户'.$this->logUser->id.'房间基本信息修改失败',['info'=>$request->all()]);
            return Redirect::back()->withInput()->withErrors('房间修改失败');
        }
    }

    public function status($id) {
        $room = Room::findOrFail($id);

        return view('hostel.rooms.status')->with('room', $room);
    }

    /**
     * 商品上下架状态修改
     * @param Request $request
     * @param type $id
     * @return type
     */
    public function updateStatus(Request $request, $id) {
        $room = Room::findOrFail($id);

        $room->status = $request->get('status');
        if ($room->save()) {
            Log::info('用户'.$this->logUser->id.'成功修改了房间状态',['status'=>$request->get('status')]);
            return redirect('/bnb/layout/' . $room->tid . '/rooms')->with('message', '房间上架成功');
        } else {
            Log::info('用户'.$this->logUser->id.'房间状态修改失败',['status'=>$request->get('status')]);
            return Redirect::back()->withInput()->withErrors('房间上架失败');
        }
    }

    public function price($id) {
        $room = Room::findOrFail($id);

        return view('hostel.rooms.price')->with('room', $room);
    }

    public function updatePrice(Request $request) {
        $price_id = $request->get('price_id');
        $price = $request->get('price');
        $priceMOdel = PriceTag::findOrFail($price_id);
        $priceMOdel->price = $price;

        if ($priceMOdel->save()) {
            Log::info('用户'.$this->logUser->id.'成功修改了价格',['id'=>$price_id,'price'=>$price]);
            return redirect('/bnb/room/' . $priceMOdel->rid . '/price')->with('message', '房间' . $priceMOdel->priceDate . '价格修改成功');
        } else {
            Log::info('用户'.$this->logUser->id.'价格修改失败',['id'=>$price_id,'price'=>$price]);
            return Redirect::back()->withInput()->withErrors('房间' . $priceMOdel->priceDate . '价格修改失败');
        }
    }

}
