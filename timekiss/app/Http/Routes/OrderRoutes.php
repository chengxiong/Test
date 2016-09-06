<?php

namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class OrderRoutes{
    public function map(Registrar $router){
        $router->group(['prefix' => 'order','namespace' => 'Order'],function($router){
            // 全部订单
            $router->get('/',[
                'middleware'=>['ability:administrators,order_list_permission'],
                'uses' => 'OrderController@index',
                'as' => 'order.index'
            ]);
            # 取消订单 
            $router->get('/{id}/cancel',[
                'middleware'=>['ability:administrators,order_list_permission'],
                'uses' => 'OrderController@cancelShow',
                'as' => 'order.cancelShow'
            ]);
            // 待确认订单
            $router->get('/pending',[
                'middleware'=>['ability:administrators,order_pending_permission'],
                'uses' => 'OrderController@pending',
                'as' => 'order.pending'
            ]);
            // 已确认订单
            $router->get('/confirm',[
                'middleware'=>['ability:administrators,order_confirm_permission'],
                'uses' => 'OrderController@confirm',
                'as' => 'order.confirm'
            ]);
            // 已取消订单
            $router->get('/cancel',[
                'middleware'=>['ability:administrators,order_cancel_permission'],
                'uses' => 'OrderController@cancel',
                'as' => 'order.cancel'
            ]);
            // 已成功订单
            $router->get('/success',[
                'middleware'=>['ability:administrators,order_success_permission'],
                'uses' => 'OrderController@success',
                'as' => 'order.success'
            ]);
            // 查询订单
            $router->get('/search',[
                'middleware'=>['ability:administrators,order_search_permission'],
                'uses' => 'OrderController@search',
                'as' => 'order.search'
            ]);
        });
    }
}