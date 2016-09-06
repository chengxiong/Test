<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::auth();

Route::get('/', 'HomeController@index');

Route::group(['namespace' => 'RBAC'],function(){
    Route::get('/permission',[
        'middleware'=>['ability:administrators,permission_list_permission'],
        'uses' => 'PermissionController@index',
        'as' => 'permission.index'
    ]);
    Route::post('/permission',[
        'middleware'=>['ability:administrators,permission_add_permission'],
        'uses' => 'PermissionController@store',
        'as' => 'permission.store'
    ]);
    # 角色管理
    Route::group(['prefix' => 'role','middleware'=>['role:administrators']],function(){
        Route::get('/',['as'=>'role.index','uses'=>'RoleController@index']);
        Route::get('/create',['as'=>'role.create','uses'=>'RoleController@create']);
        Route::post('/',['as'=>'role.store','uses'=>'RoleController@store']);
        Route::get('/{id}/edit',['as'=>'role.edit','uses'=>'RoleController@edit']);
        Route::put('/{id}',['as'=>'role.update','uses'=>'RoleController@update']);
        Route::get('/{id}/destroy',['as'=>'role.delete','uses'=>'RoleController@delete']);
        Route::delete('/{id}',['as'=>'role.destroy','uses'=>'RoleController@destroy']);
        Route::get('/{id}/permission',['as'=>'role.permission','uses'=>'RoleController@permission']);
        Route::post('/{id}/perStore',['as'=>'role.perStore','uses'=>'RoleController@perStore']);
    });
});