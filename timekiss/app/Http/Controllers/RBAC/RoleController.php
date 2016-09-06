<?php

namespace App\Http\Controllers\RBAC;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    # 角色列表
    public function index(){
        $paginate = Config::get('system.paginate');
        $role_list = Role::paginate($paginate);

        return view('rbac.role.index')->with('role_list',$role_list);
    }

    public function create(){
        return view('rbac.role.create');
    }

    public function store(Request $request){
        $this->validate($request,array(
            'name' => 'required|max:255|alpha|unique:roles',
            'display_name' => 'required|max:255',
        ));

        $role = array(
            'name' => $request->get('name'),
            'display_name' => $request->get('display_name'),
            'description' => $request->get('description')
        );

        if(Role::create($role)){
            Log::info('用户'.$this->logUser->id.'添加了角色',$role);
            return redirect('/role')->with('message','角色添加成功');
        }else{
            Log::info('用户'.$this->logUser->id.'添加了角色失败');
            return Redirect::back()->withInput()->withErrors('角色添加失败');
        }

    }

    public function edit($id){
        if($id < 2){
            abort(404);
        }
        $role = Role::findOrFail($id);

        return view('rbac.role.edit')->with('role',$role);
    }

    public function update(Request $request,$id){
        $this->validate($request,array(
            'display_name' => 'required|max:255',
        ));
        $role = Role::findOrFail($id);
        $role->display_name = $request->get('display_name');
        $role->description = $request->get('description');

        if($role->save()){
            Log::info('用户'.$this->logUser->id.'修改了角色',$role);
            return redirect('/role')->with('message','角色修改成功');
        }else{
            Log::info('用户'.$this->logUser->id.'修改角色失败',$role);
            return Redirect::back()->withInput()->withErrors('角色修改失败');
        }
    }

    public function delete($id){
        if($id < 2){
            abort(404);
        }
        $role = Role::findOrFail($id);

        return view('rbac.role.delete')->with('role',$role);
    }

    # 删除角色
    public function destroy(Request $request,$id){
        if($id < 2){
            abort(404);
        }
        $role = Role::findOrFail($id);
        # 删除角色 删除角色对应权限
        DB::beginTransaction();
        try{
            if($role){
                $para = $role->perms()->get();
                if($para){
                    $role->detachPermissions($para);
                }
            }
            Role::where('id',$id)->delete();
            DB::commit();
            Log::info('用户'.$this->logUser->id.'删除了角色',$role);
            return redirect('/role')->with('message',$role->dispaly_name.'角色删除成功');
        }catch (Exception $e){
            DB::rollBack();
            Log::info('用户'.$this->logUser->id.'删除角色失败',$role);
            return Redirect::back()->withInput()->withErrors($role->dispaly_name.'角色删除失败');
        }
    }

    # 角色对应权限
    public function permission($id){
        $role = Role::findOrFail($id);
        # 获取角色对应的权限
        $has_permission = $role->permissions();
        # 获取所有的权限
        $permission_list = Permission::all();

        return view('rbac.role.permission')->with('permission_list',$permission_list)
            ->with('has_permission',$has_permission)
            ->with('role',$role);
    }

    public function perStore(Request $request,$id){
        $this->validate($request,array(
            'permission' => 'required'
        ));

        $role = Role::findOrFail($id);
        $role_perms = $request->get('permission',array());
        DB::beginTransaction();
        try{
            if($role){
                $para = $role->perms()->get();
                if($para){
                    $role->detachPermissions($para);
                }
            }

            if(!empty($role_perms)){
                foreach($role_perms as $perm_id){
                    $role->perms()->attach($perm_id);
                }
            }
            DB::commit();
            Log::info('用户'.$this->logUser->id.'角色与权限绑定',['role'=>$id,'permission'=>$perm_id]);
            return redirect('/role')->with('message',$role->dispaly_name.'角色权限添加成功');
        }catch (Exception $e){
            DB::rollBack();
            Log::info('用户'.$this->logUser->id.'角色与权限绑定失败',['role'=>$id,'permission'=>$perm_id]);
            return Redirect::back()->withInput()->withErrors($role->dispaly_name.'角色权限添加失败');
        }
    }
}
