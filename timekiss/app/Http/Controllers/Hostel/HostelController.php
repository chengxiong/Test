<?php

namespace App\Http\Controllers\Hostel;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Models\Bnb;
use App\Models\BnbContent;
use App\Models\Service;
use Illuminate\Support\Facades\Log;
use App\Models\BnbLayout;
use App\Models\LayoutImage;
use App\Models\Hoster;
use App\Models\BnbHoster;

class HostelController extends Controller {

    public function index() {
        $paginate = Config::get('system.paginate');
        $bnb_list = Bnb::orderBy('bid', 'desc')->orderBy('updateTime', 'desc')->paginate($paginate);

        return view('hostel.index')->with('bnb_list', $bnb_list)->with('bnb_name', '');
    }

    # 民宿搜索

    public function search(Request $request) {
        $paginate = Config::get('system.paginate');
        $bnb_name = $request->get('bnbName', '');
        $order_id = $request->get('orderId', '');
        $booking_person = $request->get('bookingPerson', '');

        $bnb_list = Bnb::where(function($query) use($bnb_name, $order_id, $booking_person) {
                    if (trim($bnb_name)) {
                        $query->where('name', 'like', '%' . $bnb_name . '%');
                    }
//            if(trim($order_id)){
//                $query->where('subTitle1','like','%'.$order_id.'%');
//            }
//            if(trim($booking_person)){
//                $query->where('subTitle2','like','%'.$booking_person.'%');
//            }
                })->orderBy('bid', 'desc')->orderBy('updateTime', 'desc')->paginate($paginate);

        # 日志
        Log::info('用户' . $this->logUser->id . ' 查询了民宿列表,通过条件(民宿名称:' . $bnb_name . ' 订单号:' . $order_id . ' 预订人:' . $booking_person . ')');

        return view('hostel.index')->with('bnb_list', $bnb_list)->with('bnb_name', $bnb_name);
    }

    public function create() {
        return view('hostel.create');
    }

    # 民宿基本信息处理方法
    public function store(Request $request) {
        $bnb_info = $request->all();
        $score1 = $request->get('score1');
        $score2 = $request->get('score2');
        $score3 = $request->get('score3');
        $bnb_info['score'] = ($score1 + $score2 + $score3) / 3;
        $bnb_info['createTime'] = date('Y-m-d H:i:s', time());
        $bnb_info['updateTime'] = date('Y-m-d H:i:s', time());

        $bnb = Bnb::create($bnb_info);
        if ($bnb) {
            Log::info('用户' . $this->logUser->id . ' 创建了民宿信息BID:' . $bnb->bid);
            return redirect('/bnb/' . $bnb->bid . '/content');
        }
        Log::notice('用户' . $this->logUser->id . ' 民宿信息创建失败');
        return Redirect::back()->withInput()->withErrors('民宿添加失败');
    }

    public function base($id) {
        $bnb = Bnb::findOrFail($id);

        return view('hostel.base')->with('bnb', $bnb);
    }

    # 补充民宿其他信息界面

    public function content($id) {
        $bnb = Bnb::findOrFail($id);

        return view('hostel.content')->with('bnb', $bnb);
    }

    # 补充民宿内容

    public function storeContent(Request $request, $id) {
        $bnb = Bnb::findOrFail($id);
        $content_info = $request->all();
        $content_info['bid'] = $id;

        # 删除原来的 添加新内容
        try {
            $content_tmp = $bnb->bnbContent()->count();
            if ($content_tmp > 0) {
                $content_id = $request->get('content_id');
                $content_omg = BnbContent::findOrFail($content_id);
                $content = $content_omg->update($content_info);
            } else {
                $content = BnbContent::create($content_info);
            }

            if ($content) {
                Log::info('用户' . $this->logUser->id . ' 修改了民宿内容'.$id);
                return redirect('/bnb/' . $bnb->bid . '/image')->with('bnb', $bnb)->with('step', 'image');
            }
        } catch (Exception $ex) {
            Log::error('用户' . $this->logUser->id . ' 修改了民宿内容失败bnb_content:' . $ex->getMessage());
            return Redirect::back()->withInput()->withErrors('民宿内容添加失败');
        }
    }

    # 修改民宿基本信息

    public function updateContent(Request $request, $id) {
        $bnb = Bnb::findOrFail($id);
        $bnb_info = $request->all();
        $score1 = $request->get('score1');
        $score2 = $request->get('score2');
        $score3 = $request->get('score3');
        $bnb_info['score'] = ($score1 + $score2 + $score3) / 3;
        $bnb_info['updateTime'] = date('Y-m-d H:i:s', time());
        $bnb_info['bid'] = $id;

        if ($bnb->update($bnb_info)) {
            Log::info('用户' . $this->logUser->id . ' 更新民宿基本信息bnb_base:' . $bnb->bid);
            return redirect('/bnb/' . $bnb->bid . '/content')->with('message', '民宿内容修改成功');
        } else {
            Log::info('用户' . $this->logUser->id . ' 更新民宿基本信息失败bnb_base:' . $bnb->bid);
            return Redirect::back()->withInput()->withErrors('民宿内容修改失败');
        }
    }

    # 补充民宿图片

    public function image($id) {
        $bnb = Bnb::findOrFail($id);

        return view('hostel.image')->with('bnb', $bnb);
    }

    # 向七牛上传图片

    public function storeImage(Request $request, $id) {
        $bnb = Bnb::findOrFail($id);       
        $image_info = $this->uploadFile($request, $id);
        $delete_img = $request->get('img_id');
        $delete_list = explode(',', $delete_img);
        $delete_list = array_unique($delete_list);
        
        # 批量插入数据
        # 获取要删除的图片
        DB::beginTransaction();
        try {
            if(!empty($delete_list)){
                # 删除取消的图片
                DB::table('bnb_image')->whereIn('id',$delete_list)->delete();
            }
            DB::table('bnb_image')->insert($image_info);
            DB::commit();
            Log::info('用户' . $this->logUser->id . ' 修改了民宿图片:' ,$image_info);
            return redirect('/bnb/' . $bnb->bid . '/service')->with('bnb', $bnb)->with('step', 'service');
        } catch (Exception $ex) {
            DB::rollBack();
            Log::info('用户' . $this->logUser->id . ' 修改了民宿图片失败');
            return Redirect::back()->withInput()->withErrors('民宿内容添加失败');
        }
    }

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
                $image_info[$key]['bid'] = $id;
                $image_info[$key]['type'] = 'album';
            }
            unset($key, $file);
        }
        Log::info('用户' . $this->logUser->id . '像七牛上传了图片',$image_info);
        return $image_info;
    }

    # 补充民宿服务

    public function service($id) {
        $bnb = Bnb::findOrFail($id);
        $service_list = Service::all();
        $has_service = $bnb->serviceList();


        return view('hostel.service')->with('bnb', $bnb)->with('service_list', $service_list)
                        ->with('has_service', $has_service);
    }

    # 补充民宿服务处理

    public function storeService(Request $request, $id) {
        $bnb = Bnb::findOrFail($id);

        $service_info = $request->get('services');

        DB::beginTransaction();
        try {
            #先删除原来的数据在添加新的数据
            $bnb->bnbService()->detach();
            if ($service_info) {
                $bnb->bnbService()->attach($service_info);
            }

            DB::commit();
            Log::info('用户' . $this->logUser->id . '修改了民宿service',$service_info);
            return redirect('/bnb')->with('message', '民宿添加成功');
        } catch (Exception $ex) {
            DB::rollBack();
            Log::info('用户' . $this->logUser->id . '修改了民宿service失败');
            return Redirect::back()->withInput()->withErrors('民宿服务添加失败');
        }
    }

    # 房型列表

    public function layout($id) {
        $bnb = Bnb::findOrFail($id);

        $paginate = Config::get('system.paginate');
        $layout_list = BnbLayout::where('bid', $id)->orderBy('id', 'desc')->orderBy('updated_at', 'desc')->paginate($paginate);

        return view('hostel.layout.index')->with('layout_list', $layout_list)->with('bnb', $bnb);
    }

    # 添加房型

    public function layoutCreate($id) {
        $bnb = Bnb::findOrFail($id);
        return view('hostel.layout.create')->with('bnb', $bnb);
    }

    # 添加房型处理方法

    public function layoutStore(Request $request, $id) {
        $rules = array(
            'name' => 'required|max:100',
            'introduction' => 'max:100',
        );
        
        $this->validate($request, $rules);

        $bnb = Bnb::findOrFail($id);

        $layout_info = $request->all();
        $layout_info['bid'] = $id;
        # 批量插入数据
        # 获取要删除的图片
        DB::beginTransaction();
        try {
            BnbLayout::create($layout_info);
         
            DB::commit();
            Log::info('用户' . $this->logUser->id . '添加了房型',$layout_info);
            return redirect('/bnb/' . $bnb->bid . '/layout')->with('message', '民宿房型添加成功');
        } catch (Exception $ex) {
            DB::rollBack();
            Log::info('用户' . $this->logUser->id . '添加房型失败');
            return Redirect::back()->withInput()->withErrors('民宿房型添加失败');
        }
    }
   
    # 编辑房型

    public function layoutEdit($id) {
        $layout = BnbLayout::findOrFail($id);

        return view('hostel.layout.edit')->with('layout', $layout);
    }

    # 编辑房型处理方法

    public function layoutUpdate(Request $request, $id) {
        $this->validate($request, array(
            'name' => 'required|max:100',
            'introduction' => 'max:100',
        ));

        $layout = BnbLayout::findOrFail($id);
        $update_info = $request->all();

        DB::beginTransaction();
        try {
            $layout->update($update_info);
            DB::commit();
            Log::info('用户' . $this->logUser->id . '成功修改房型信息',$layout);
            return redirect('/bnb/' . $layout->bid . '/layout')->with('message', '民宿房型修改成功');
        } catch (Exception $ex) {
            DB::rollBack();
            Log::info('用户' . $this->logUser->id . '修改房型信息失败',$layout);
            return Redirect::back()->withInput()->withErrors('民宿房型修改失败');
        }
    }

    # 民宿对应的房东或者管家

    public function landlordRole($id) {
        $bnb = Bnb::findOrFail($id);

        # 获取全部房东/管家列表
        $hostel_list = Hoster::all();
        $has_hostel = $bnb->bnbHosterList();

        return view('hostel.landlordRole')->with('bnb', $bnb)->with('hostel_list', $hostel_list)
                ->with('has_hostel',$has_hostel);
    }

    # 民宿与房东和管家方法处理

    public function landlordRoleStore(Request $request, $id) {
        $this->validate($request, array(
            'hoster' => 'required'
        ));
        $bnb = Bnb::findOrFail($id);

        $hoster = $request->get('hoster');
        $hoster_info = array(
            'bid' => $id,
            'hid' => $hoster,
            'role' => '1',
            'createTime' => date('Y-m-d H:i:s', time())
        );
        $manager = $request->get('manager');
        $manager_info = array();
        if (!empty($manager)) {
            foreach ($manager as $m) {
                $manager_info[] = array(
                    'bid' => $id,
                    'hid' => $m,
                    'role' => '2',
                    'createTime' => date('Y-m-d H:i:s', time())
                );
            }
        }

        # 先删除原来数据
        # 插入新的对应数据
        DB::beginTransaction();
        try {
            DB::table('bnb_hoster')->where('bid', $id)->delete();
            DB::table('bnb_hoster')->insert($hoster_info);
            if(!empty($manager_info)){
                DB::table('bnb_hoster')->insert($manager_info);                
            }
            DB::commit();
            Log::info('用户' . $this->logUser->id . '修改民宿对应的房东:'.$hoster.'和管家:' ,$manager);
            return redirect('/bnb')->with('message', '修改民宿对应的房东成功');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('用户' . $this->logUser->id . ' 修改民宿对应的房东失败');
            return Redirect::back()->withInput()->withErrors('修改民宿对应的房东');
        }
    }

}
