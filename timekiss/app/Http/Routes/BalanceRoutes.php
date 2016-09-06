<?php

namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class BalanceRoutes{
    public function map(Registrar $router){
        $router->group(['prefix' => 'balance','namespace' => 'Balance'],function($router){
            // 全部结款
            $router->get('/',[
                'middleware'=>['ability:administrators,balance_list_permission'],
                'uses' => 'BalanceController@index',
                'as' => 'balance.index'
            ]);
            // 待确认结款
            $router->get('/pending',[
                'middleware'=>['ability:administrators,balance_pending_permission'],
                'uses' => 'BalanceController@pending',
                'as' => 'balance.pending'
            ]);
            // 已确认结款
            $router->get('/confirm',[
                'middleware'=>['ability:administrators,balance_confirm_permission'],
                'uses' => 'BalanceController@confirm',
                'as' => 'balance.confirm'
            ]);
            // 查询
            $router->get('/search',[
                'middleware'=>['ability:administrators,balance_search_permission'],
                'uses' => 'BalanceController@search',
                'as' => 'balance.search'
            ]);
        });
    }
}