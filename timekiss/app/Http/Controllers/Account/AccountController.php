<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AccountModel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Bnb;
use PhpSms;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller {

    /**
     * 账号列表
     * @return type
     */
    public function index() {
        $paginate = Config::get('system.paginate');
        $account_list = AccountModel::orderBy('accountId', 'desc')->paginate($paginate);

        return view('account.index')->with('account_list', $account_list);
    }

    /**
     * 添加账号界面
     * @return type
     */
    public function create() {
        return view('account.create');
    }

    /**
     * 添加账号操作处理
     * @param Request $request
     * @return type
     */
    public function store(Request $request) {
        # todo:添加账号信息字段校验
        $this->validate($request, array(
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'telephone' => 'digits:11|unique:account'
        ));


        $uuid = DB::select('select uuid() as uuid');
        $uuid = $uuid[0]->uuid;

        $image = $this->uploadFile($request);

        $account_info = $request->all();
        $account_info['password'] = bcrypt($account_info['password']);
        $account_info['uuid'] = $uuid;
        $account_info['registerTime'] = date('Y-m-d H:i:s', time());
        $account_info['lastLoginTime'] = date('Y-m-d H:i:s');
        $account_info['token'] = sha1($uuid . 'TiMeKiSs');
        $account_info['status'] = '1';
        $account_info['timezone'] = Config::get('app.timezone');
        $account_info['avatar'] = $image;

        $account = AccountModel::create($account_info);

        if ($account) {
            Log::info('用户'.$this->logUser->id.'添加了账号',$account);
            return redirect('/account')->with('message', '账号添加成功');
        } else {
            Log::info('用户'.$this->logUser->id.'账号添加失败');
            return Redirect::back()->withInput()->withErrors('账号添加失败');
        }
    }

    /**
     * 上传文件
     * @param type $request
     * @return type
     */
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
        Log::info('用户'.$this->logUser->id.'像七牛上传图片',$url);
        return $url;
    }

    /**
     * 修改账号界面
     * @param type $id
     */
    public function edit($id) {
        $account = AccountModel::findOrFail($id);

        return view('account.edit')->with('account', $account);
    }

    /**
     * 修改账号操作处理
     * @param Request $request
     * @param type $id
     */
    public function update(Request $request, $id) {
        # todo: validate
        $this->validate($request, array(
            'password' => 'confirmed',
            'telephone' => 'digits:11|unique:account,telephone,' . $id
        ));

        $account = AccountModel::findOrFail($id);

        $account_info = $request->all();
        if (!empty($account_info['password'])) {
            $account_info['password'] = bcrypt($account_info['password']);
        }
        $image = $this->uploadFile($request);
        if ($image) {
            $account_info['avatar'] = $image;
        }

        if ($account->update($account_info)) {
            Log::info('用户'.$this->logUser->id.'修改了账号信息',$account_info);
            return redirect('/account')->with('message', '账号修改成功');
        } else {
            Log::info('用户'.$this->logUser->id.'账号信息修改失败');
            return Redirect::back()->withInput()->withErrors('账号修改失败');
        }
    }

    /**
     * 修改账号状态界面
     * @param type $id
     */
    public function status($id) {
        $account = AccountModel::findOrFail($id);

        return view('account.status')->with('account', $account);
    }

    /**
     * 修改账号状态操作处理
     * @param Request $request
     * @param type $id
     */
    public function changeStatus(Request $request, $id) {
        $account = AccountModel::findOrFail($id);
        $account->status = $request->get('status', '1');
        if ($account->save()) {
            Log::info('用户'.$this->logUser->id.'修改了账号状态',$account);
            return redirect('/account')->with('message', '账号修改成功');
        } else {
            Log::info('用户'.$this->logUser->id.'账号状态修改失败',$account);
            return Redirect::back()->withInput()->withErrors('账号修改失败');
        }
    }

    /**
     * 民宿关联账号界面
     * 
     * @param type $id
     * @return type
     */
    public function bnbAccount($id) {
        $bnb = Bnb::findOrFail($id);
        # 获取全部账号列表
        $account_list = AccountModel::all();
        # 获取对应账号列表
        $has_account = $bnb->accountList($id);
        return view('account.bnb')->with('bnb', $bnb)
                        ->with('account_list', $account_list)
                        ->with('has_account', $has_account);
    }

    /**
     * 民宿关联账号操作
     * 
     * @param Request $request
     * @param type $id
     * @return type
     */
    public function bnbAccountStore(Request $request, $id) {
        $bnb = Bnb::findOrFail($id);
        $account_list = array();
        foreach ($request->get('account') as $account) {
            $account_list[] = [
                'bnb_id' => $id,
                'account_id' => $account
            ];
        }
        DB::beginTransaction();
        try {
            #删除关系然后添加关系
            $has_account = $bnb->accountList($id);
            if (!empty($has_account)) {
                DB::table('bnb_account')->where('bnb_id', $id)->delete();
            }
            if (!empty($account_list)) {
                DB::table('bnb_account')->insert($account_list);
            }
            DB::commit();
            Log::info('用户'.$this->logUser->id.'民宿与账号关联',$account_list);
            return redirect('/bnb')->with('message', '民宿对应账号关联成功');
        } catch (Exception $ex) {
            DB::rollBack();
            Log::info('用户'.$this->logUser->id.'民宿与账号关联失败'.$ex->getMessage());
            return Redirect::back()->withInput()->withErrors('民宿对应账号关联失败');
        }
    }

//    public function send() {
//        // 接收人手机号
//        $to = 18779681854;
//        // 短信内容
//        $content = '【态客民宿App】注册验证码是 11111, 10分钟内有效。最好的作品是你度过的时光。';
//        // 只希望使用内容方式放送,可以不设置模板id和模板data(如:云片、luosimao)
//        $tmp =  PhpSms::make()->to($to)->content($content)->send();
//    }

}
