<?php

namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class RbacRoutes{

    public function map(Registrar $router){
        $router->auth();

        $router->get('/', 'HomeController@index');

        $router->group(['namespace' => 'RBAC'],function($router){
            # 用户管理
            $router->get('/user',[
                'middleware'=>['ability:administrators,user_list_permission'],
                'uses' => 'UserController@index',
                'as' => 'user.index'
            ]);
            $router->get('/user/create',[
                'middleware'=>['ability:administrators,user_add_permission'],
                'uses' => 'UserController@create',
                'as' => 'user.create'
            ]);
            $router->post('/user',[
                'middleware'=>['ability:administrators,user_add_permission'],
                'uses' => 'UserController@store',
                'as' => 'user.store'
            ]);
            $router->get('/user/{id}/edit',[
                'middleware'=>['ability:administrators,user_add_permission'],
                'uses' => 'UserController@edit',
                'as' => 'user.edit'
            ]);
            $router->put('/user/{id}/edit',[
                'middleware'=>['ability:administrators,user_add_permission'],
                'uses' => 'UserController@update',
                'as' => 'user.update'
            ]);
            $router->get('/user/{id}/role',[
                'middleware'=>['ability:administrators,user_add_permission'],
                'uses' => 'UserController@role',
                'as' => 'user.role'
            ]);
            $router->post('/user/{id}/role',[
                'middleware'=>['ability:administrators,user_add_permission'],
                'uses' => 'UserController@storeRole',
                'as' => 'user.storeRole'
            ]);
            
            $router->get('/permission',[
                'middleware'=>['ability:administrators,permission_list_permission'],
                'uses' => 'PermissionController@index',
                'as' => 'permission.index'
            ]);
            $router->post('/permission',[
                'middleware'=>['ability:administrators,permission_add_permission'],
                'uses' => 'PermissionController@store',
                'as' => 'permission.store'
            ]);
            # 角色管理
            $router->group(['prefix' => 'role','middleware'=>['role:administrators']],function($router){
                $router->get('/',['as'=>'role.index','uses'=>'RoleController@index']);
                $router->get('/create',['as'=>'role.create','uses'=>'RoleController@create']);
                $router->post('/',['as'=>'role.store','uses'=>'RoleController@store']);
                $router->get('/{id}/edit',['as'=>'role.edit','uses'=>'RoleController@edit']);
                $router->put('/{id}',['as'=>'role.update','uses'=>'RoleController@update']);
                $router->get('/{id}/destroy',['as'=>'role.delete','uses'=>'RoleController@delete']);
                $router->delete('/{id}',['as'=>'role.destroy','uses'=>'RoleController@destroy']);
                $router->get('/{id}/permission',['as'=>'role.permission','uses'=>'RoleController@permission']);
                $router->post('/{id}/perStore',['as'=>'role.perStore','uses'=>'RoleController@perStore']);
            });
        });
    }
}