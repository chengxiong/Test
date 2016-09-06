<?php

namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class HostelRoutes{
    public function map(Registrar $router){
        $router->group(['prefix' => 'bnb','namespace' => 'Hostel'],function($router){
            // 民宿列表
            $router->get('/',[
                'middleware'=>['ability:administrators,hostel_list_permission'],
                'uses' => 'HostelController@index',
                'as' => 'hostel.index'
            ]);
            $router->get('/search',[
                'middleware'=>['ability:administrators,hostel_list_permission'],
                'uses' => 'HostelController@search',
                'as' => 'hostel.search'
            ]);
            $router->get('/create',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'HostelController@create',
                'as' => 'hostel.create'
            ]);
            $router->post('/store',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'HostelController@store',
                'as' => 'hostel.store'
            ]);
            $router->get('/{id}/base',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'HostelController@base',
                'as' => 'hostel.base'
            ]);
            # 民宿补充内容
            $router->get('/{id}/content',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'HostelController@content',
                'as' => 'hostel.content'
            ]);
            $router->post('/{id}/storeContent',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'HostelController@storeContent',
                'as' => 'hostel.storeContent'
            ]);
            $router->put('/{id}/updateContent',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'HostelController@updateContent',
                'as' => 'hostel.updateContent'
            ]);
            $router->get('/{id}/image',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'HostelController@image',
                'as' => 'hostel.image'
            ]);
            $router->post('/{id}/storeImage',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'HostelController@storeImage',
                'as' => 'hostel.storeImage'
            ]);
            $router->get('/{id}/service',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'HostelController@service',
                'as' => 'hostel.service'
            ]);
            $router->post('/{id}/storeService',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'HostelController@storeService',
                'as' => 'hostel.storeService'
            ]);
            
            # 房型管理
            $router->get('/{id}/layout',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'HostelController@layout',
                'as' => 'hostel.layout'
            ]);
            $router->get('/{id}/layoutCreate',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'HostelController@layoutCreate',
                'as' => 'hostel.layoutCreate'
            ]);
            $router->post('/{id}/layoutStore',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'HostelController@layoutStore',
                'as' => 'hostel.layoutStore'
            ]);
            $router->get('/{id}/layoutEdit',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'HostelController@layoutEdit',
                'as' => 'hostel.layoutEdit'
            ]);            
            $router->put('/{id}/layoutUpdate',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'HostelController@layoutUpdate',
                'as' => 'hostel.layoutUpdate'
            ]);
            
            #房间管理
            $router->get('/layout/{id}/rooms',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'RoomController@index',
                'as' => 'rooms.index'
            ]);
            $router->get('/room/{id}/create',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'RoomController@create',
                'as' => 'rooms.create'
            ]);
            $router->post('/room/{id}/store',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'RoomController@store',
                'as' => 'rooms.store'
            ]);
            $router->get('/room/{id}/edit',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'RoomController@edit',
                'as' => 'rooms.edit'
            ]);
            $router->put('/room/{id}/update',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'RoomController@update',
                'as' => 'rooms.update'
            ]);
            # 修改房间上下架状态
            $router->get('/room/{id}/status',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'RoomController@status',
                'as' => 'rooms.status'
            ]);
            $router->put('/room/{id}/status',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'RoomController@updateStatus',
                'as' => 'rooms.updateStatus'
            ]);
            # 房间包房价格设置
            $router->get('/room/{id}/price',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'RoomController@price',
                'as' => 'rooms.price'
            ]);
            $router->put('/room/price',[
                'middleware'=>['ability:administrators,hostel_add_permission'],
                'uses' => 'RoomController@updatePrice',
                'as' => 'rooms.updatePrice'
            ]);
            
            # 民宿对应房东和管家
            $router->get('/{id}/landlordRole',[
                'middleware'=>['ability:administrators,hostel_landlord_permission'],
                'uses' => 'HostelController@landlordRole',
                'as' => 'hostel.landlordRole'
            ]);
            $router->post('/{id}/landlordRoleStore',[
                'middleware'=>['ability:administrators,hostel_landlord_permission'],
                'uses' => 'HostelController@landlordRoleStore',
                'as' => 'hostel.landlordRoleStore'
            ]); 
        });
        
        $router->get('/bnb/implode',[
            'middleware'=>['ability:administrators,hostel_add_permission'],
            'uses' => 'Excel\ExcelController@implode',
            'as' => 'hostel.implode'
        ]);
        $router->post('/implodeBnb',[
            'middleware'=>['ability:administrators,hostel_add_permission'],
            'uses' => 'Excel\ExcelController@implodeBnb',
            'as' => 'hostel.implodeBnb'
        ]);
    }
}