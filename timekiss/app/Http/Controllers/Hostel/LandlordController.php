<?php

namespace App\Http\Controllers\Hostel;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Hoster;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Log;
use Illuminate\Support\Facades\Storage;

class LandlordController extends Controller {

    public function index() {
        $paginate = Config::get('system.paginate');
        $hoster_list = Hoster::orderBy('hid', 'desc')->paginate($paginate);

        return view('hostel.landlord.index')->with('hoster_list', $hoster_list);
    }

    public function create() {
        return view('hostel.landlord.create');
    }

    public function store(Request $request) {
        $this->validate($request, array(
            'name' => 'required|max:255',
            'telephone' => 'required',
            'weixin' => 'required',
            'age' => 'required',
            'maritalStatuis' => 'required',
            'feature' => 'required',
            'description' => 'required',
        ));

        $url = $this->uploadFile($request);
        $hoster_info = $request->all();
        $hoster_info['image'] = $url;

        $hoster = Hoster::create($hoster_info);
        if ($hoster) {
            Log::info('用户' . $this->logUser->id . ' 创建了房东或者管家:' . $hoster->hid);
            return redirect('/bnb/landlord')->with('message', '房东或者管家添加成功');
        } else {
            Log::notice('用户' . $this->logUser->id . ' 创建了房东或者管家失败');
            return Redirect::back()->withInput()->withErrors('创建了房东或者管家失败');
        }
    }

    public function edit($id) {
        $hoster = Hoster::findOrFail($id);

        return view('hostel.landlord.edit')->with('hoster', $hoster);
    }

    public function update(Request $request, $id) {
        $hoster = Hoster::findOrFail($id);

        $this->validate($request, array(
            'name' => 'required|max:255',
            'telephone' => 'required',
            'weixin' => 'required',
            'age' => 'required',
            'maritalStatuis' => 'required',
            'feature' => 'required',
            'description' => 'required',
            'file' => 'mimes:jpeg,bmp,png,jpg',
        ));

        $url = $this->uploadFile($request);
        $hoster_info = $request->all();
        if(!empty($url)){
            $hoster_info['image'] = $url;   
        }else{
            unset($hoster_info['image']);   
        }

        if ($hoster->update($hoster_info)) {
            Log::info('用户' . $this->logUser->id . ' 修改了房东或者管家:' . $hoster->hid);
            return redirect('/bnb/landlord')->with('message', '房东或者管家修改成功');
        } else {
            Log::notice('用户' . $this->logUser->id . ' 修改了房东或者管家失败'. $hoster->hid);
            return Redirect::back()->withInput()->withErrors('修改了房东或者管家失败');
        }
    }

    private function uploadFile($request) {
        $file = $request->file('file');
        $url = '';
        if ($file) {
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
        }
        Log::info('用户' . $this->logUser->id . ' 像七牛上传了图片:',$url);
        return $url;
    }
    
}
