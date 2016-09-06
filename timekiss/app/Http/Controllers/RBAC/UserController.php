<?php

namespace App\Http\Controllers\RBAC;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Log;
use App\Models\Role;

class UserController extends Controller
{
    /**
     * 用户列表
     * @return type
     */
    public function index(){
        
        $paginate = Config::get('system.paginate');
        $user_list = User::paginate($paginate);
        
        return view('rbac.user.index')->with('user_list',$user_list);
    }
    
    public function create(){
        return view('rbac.user.create');
    }
    
    public function store(Request $request){
        $this->validate($request, array(
            'name' => 'required|max:255',
            'email'=>'required|email|max:255|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation'=>'required',
        ));
        $user_info = $request->all();
        $user_info['password'] = bcrypt($user_info['password']);
        
        $user = User::create($user_info);
        if($user){
            Log::info('创建了新用户成功',['creator'=>  $this->logUser->id,'user'=>$user->id]);
            return redirect('user')->with('message','用户添加成功');
        }else{
            Log::info('创建了新用户失败',['creator'=>  $this->logUser->id,'user'=>$user->id]);
            return Redirect::back()->withInput()->withErrors('用户添加失败');
        }
    }
    
    public function edit($id){
        if($id < 2)
            abort (404);
        $user = User::findOrFail($id);
        
        return view('rbac.user.edit')->with('user',$user);
    }
    
    public function update(Request $request,$id){
        $this->validate($request, array(
            'name' => 'required|max:255',
            'email'=>'required|email|max:255|unique:users,email,'.$id,
            'password' => 'confirmed',
        ));
        if($id < 2)
            abort (404);
        $user = User::findOrFail($id);
        $user_info = $request->all();
        if(!empty($user_info['password'])){
            $user_info['password'] = bcrypt($user_info['password']);
        }
        if($user->update($user_info)){
            Log::info('修改了用户成功',['updator'=>  $this->logUser->id,'user'=>$id]);
            return redirect('user')->with('message','用户添加成功');
        }else{
            Log::info('修改了用户失败',['updator'=>  $this->logUser->id,'user'=>$id]);
            return Redirect::back()->withInput()->withErrors('用户添加失败');
        }
    }
    
    public function role($id){
        if($id < 2)
            abort (404);
        $user = User::findOrFail($id);
        $role_list = Role::all();
        $has_role = $user->roleList();
        
        return view('rbac.user.role')->with('user',$user)->with('role_list',$role_list)
                ->with('has_role',$has_role);
    }
    
    public function storeRole(Request $request,$id){
        if($id < 2)
            abort (404);
        # 先删除对应数据
        $user = User::findOrFail($id);
        $user->detachRoles();
        $role_info = $request->get('role');
        if(!empty($role_info)){
            $user->roles()->attach($role_info);
        }
        
        Log::info('为用户'.$this->logUser->id.'更改角色',['role_list'=>$role_info]);
        return redirect('user')->with('message','用户添加成功');
    }
}
