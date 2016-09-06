<?php

namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class AccountRoutes{
    public function map(Registrar $router){
        $router->group(['prefix' => 'account','namespace' => 'Account'],function($router){
            // 全部结款
            $router->get('/',[
                'middleware'=>['ability:administrators,account_list_permission'],
                'uses' => 'AccountController@index',
                'as' => 'account.index'
            ]);
            $router->get('/create',[
                'middleware'=>['ability:administrators,account_add_permission'],
                'uses' => 'AccountController@create',
                'as' => 'account.create'
            ]);
            $router->post('/store',[
                'middleware'=>['ability:administrators,account_add_permission'],
                'uses' => 'AccountController@store',
                'as' => 'account.store'
            ]);
            $router->get('/{id}/edit',[
                'middleware'=>['ability:administrators,account_edit_permission'],
                'uses' => 'AccountController@edit',
                'as' => 'account.edit'
            ]);
            $router->put('/{id}/update',[
                'middleware'=>['ability:administrators,account_edit_permission'],
                'uses' => 'AccountController@update',
                'as' => 'account.update'
            ]);
            $router->get('/{id}/status',[
                'middleware'=>['ability:administrators,account_change_permission'],
                'uses' => 'AccountController@status',
                'as' => 'account.status'
            ]);
            $router->put('/{id}/changeStatus',[
                'middleware'=>['ability:administrators,account_change_permission'],
                'uses' => 'AccountController@changeStatus',
                'as' => 'account.changeStatus'
            ]);
            
            # 关联账号与民宿
            $router->get('/{id}/bnbAccount',[
                'middleware'=>['ability:administrators,account_list_permission'],
                'uses' => 'AccountController@bnbAccount',
                'as' => 'bnb.account'
            ]);
            $router->put('/{id}bnbAccount',[
                'middleware'=>['ability:administrators,account_list_permission'],
                'uses' => 'AccountController@bnbAccountStore',
                'as' => 'bnb.bnbAccount'
            ]);
            
            #$router->get('/send/sms','AccountController@send');
        });
    }
}

