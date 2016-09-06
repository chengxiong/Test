<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class LandlordRoutes{

    public function map(Registrar $router){
        $router->group(['prefix' => 'bnb','namespace' => 'Hostel'],function($router){
            # tag      
            $router->get('/tag',[
                'middleware'=>['ability:administrators,hostel_tag_permission'],
                'uses' => 'TagController@index',
                'as' => 'tag.index'
            ]);
            $router->get('/tag/create',[
                'middleware'=>['ability:administrators,hostel_tag_permission'],
                'uses' => 'TagController@create',
                'as' => 'tag.create'
            ]);
            $router->post('/tag',[
                'middleware'=>['ability:administrators,hostel_tag_permission'],
                'uses' => 'TagController@store',
                'as' => 'tag.store'
            ]);
            $router->get('/tag/{id}/edit',[
                'middleware'=>['ability:administrators,hostel_tag_permission'],
                'uses' => 'TagController@edit',
                'as' => 'tag.edit'
            ]);
            $router->put('/tag/{id}/update',[
                'middleware'=>['ability:administrators,hostel_tag_permission'],
                'uses' => 'TagController@update',
                'as' => 'tag.update'
            ]);
            
            #tag 搜索
            $router->get('/tag/search',[
                'middleware'=>['ability:administrators,hostel_tag_permission'],
                'uses' => 'TagController@search',
                'as' => 'tag.search'
            ]);
            
            # tag与民宿关联
            $router->get('/{id}/tag',[
                'middleware'=>['ability:administrators,hostel_tag_permission'],
                'uses' => 'TagController@tag',
                'as' => 'tag.tag'
            ]);
            $router->get('/{id}/tagRelation',[
                'middleware'=>['ability:administrators,hostel_tag_permission'],
                'uses' => 'TagController@tagRelation',
                'as' => 'tag.tagRelation'
            ]);
            $router->put('/{id}/tagStore',[
                'middleware'=>['ability:administrators,hostel_tag_permission'],
                'uses' => 'TagController@tagStore',
                'as' => 'tag.tagStore'
            ]);
            $router->get('/{bid}/{tid}/delete',[
                'middleware'=>['ability:administrators,hostel_tag_permission'],
                'uses' => 'TagController@delete',
                'as' => 'tag.delete'
            ]);
            $router->delete('/{bid}/{tid}/deleteRelation',[
                'middleware'=>['ability:administrators,hostel_tag_permission'],
                'uses' => 'TagController@deleteRelation',
                'as' => 'tag.deleteRelation'
            ]);
            
            # 房东管家
            $router->get('/landlord',[
                'middleware'=>['ability:administrators,hostel_landlord_permission'],
                'uses' => 'LandlordController@index',
                'as' => 'landlord.index'
            ]);
            $router->get('/landlord/create',[
                'middleware'=>['ability:administrators,hostel_landlord_permission'],
                'uses' => 'LandlordController@create',
                'as' => 'landlord.create'
            ]);
            $router->get('/landlord/{id}/edit',[
                'middleware'=>['ability:administrators,hostel_landlord_permission'],
                'uses' => 'LandlordController@edit',
                'as' => 'landlord.edit'
            ]);
            //房价管理
            $router->get('/landlord/price',[
                'middleware'=>['ability:administrators,hostel_landlord_permission'],
                'uses' => 'LandlordController@price',
                'as' => 'landlord.price'
            ]);
            $router->post('/landlord/store',[
                'middleware'=>['ability:administrators,hostel_landlord_permission'],
                'uses' => 'LandlordController@store',
                'as' => 'landlord.store'
            ]);
             $router->put('/landlord/{id}/update',[
                'middleware'=>['ability:administrators,hostel_landlord_permission'],
                'uses' => 'LandlordController@update',
                'as' => 'landlord.update'
            ]);
        });
    }
}
