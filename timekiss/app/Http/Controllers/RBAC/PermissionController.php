<?php

namespace App\Http\Controllers\RBAC;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    public function index(){
        $paginate = Config::get('system.paginate');
        $permission_list = Permission::paginate($paginate);

        return view('rbac.permission.permission_list')->with('permission_list',$permission_list);
    }

    # 重新构建权限操作
    public function store(Request $request){
        $permission = Config::get('permission');
        DB::beginTransaction();
        try{
            # 获取对应权限（获取所有文件对应的类，以及所有类对应的方法）
            $record = array();
            foreach($permission as $key=>$perm){
                $record[] = array(
                    'name' => $key,
                    'display_name' => $perm['title'],
                    'description' => $perm['description'],
                    'created_at' => date("Y-m-d H:i:s",time()),
                    'updated_at' => date("Y-m-d H:i:s",time()),
                );
            }

            if($record){
                # 首先需要删除所有权限，以及角色与权限对应关系
                # 获取所有角色 删除角色与权限关联
                $role_list = Role::all();
                if($role_list->count() > 0){
                    foreach($role_list as $role){
                        $para = $role->perms()->get();
                        if($para){
                            $role->detachPermissions($para);
                        }
                    }
                }
                DB::table('permissions')->delete();

                # 建立权限
                Permission::insert($record);
            }


            DB::commit();
            Log::info('用户'.$this->logUser->id.'重修构建了权限',$record);
            return Redirect::back()->with('message','权限构建成功');
        }catch (Exception $e){
            DB::rollBack();
            Log::info('用户'.$this->logUser->id.'重修构建了权限失败');
            return Redirect::back()->withInput()->withErrors('权限构建失败');
        }
    }
}
