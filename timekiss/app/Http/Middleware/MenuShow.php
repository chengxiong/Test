<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Menu;

class MenuShow
{
    private $user;

    public function __construct(){
        $this->user = Auth::user();
    }

    public function handle($request, Closure $next, $guard = null)
    {
        if(isset($this->user)){
            Menu::make('MyNavBar', function($menu){
                $menu->add('Home',array('url'  => ''))
                    ->data('icon','fa fa-dashboard');
                if($this->user->hasRole('administrators')){
                    $menu->add('用户管理',array('route'  => 'user.index'))->data('icon','glyphicon glyphicon-user');
                    $menu->add('角色管理',array('route'  => 'role.index'))->data('icon','glyphicon glyphicon-user');
                    $menu->add('权限管理',array('route'  => 'permission.index'))->data('icon','glyphicon glyphicon-indent-right');
                }

                # 民宿
                if($this->user->ability('administrators','hostel_list_permission')){
                    $menu->add('民宿管理','#')->id('hostel')->data('icon','glyphicon glyphicon-th-list');
                    $menu->add('民宿列表',array('route'  => 'hostel.index','parent'=>'hostel'));
                    if($this->user->ability('administrators','hostel_tag_permission'))
                        $menu->add('民宿标签',array('route'  => 'tag.index','parent'=>'hostel'));
                    if($this->user->ability('administrators','hostel_landlord_permission'))
                        $menu->add('房东管理',array('route'  => 'landlord.index','parent'=>'hostel'));
                    if($this->user->ability('administrators','hostel_landlord_permission'))
                        $menu->add('房价管理',array('route'  => 'landlord.price','parent'=>'hostel'));
                    if($this->user->ability('administrators','account_list_permission'))
                        $menu->add('账号管理',array('route'  => 'account.index','parent'=>'hostel'));
                }

                # 订单
                if($this->user->ability('administrators','order_list_permission')){
                    $menu->add('订单管理','#')->id('order')->data('icon','glyphicon glyphicon-shopping-cart');
                    $menu->add('全部订单',array('route'  => 'order.index','parent'=>'order'));
                    if($this->user->ability('administrators','order_pending_permission'))
                        $menu->add('待确认订单',array('route'  => 'order.pending','parent'=>'order'));
                    if($this->user->ability('administrators','order_confirm_permission'))
                        $menu->add('已确认订单',array('route'  => 'order.confirm','parent'=>'order'));
                    if($this->user->ability('administrators','order_cancel_permission'))
                        $menu->add('已取消订单',array('route'  => 'order.cancel','parent'=>'order'));
                    if($this->user->ability('administrators','order_success_permission'))
                        $menu->add('已成功订单',array('route'  => 'order.success','parent'=>'order'));
                    if($this->user->ability('administrators','order_search_permission'))
                        $menu->add('查询订单',array('route'  => 'order.search','parent'=>'order'));
                }

                # 结款
                if($this->user->ability('administrators','balance_list_permission')){
                    $menu->add('结款','#')->id('balance')->data('icon','glyphicon glyphicon-jpy');
                    $menu->add('全部结款',array('route'  => 'balance.index','parent'=>'balance'));
                    if($this->user->ability('administrators','balance_pending_permission'))
                        $menu->add('待结款',array('route'  => 'balance.pending','parent'=>'balance'));
                    if($this->user->ability('administrators','balance_confirm_permission'))
                        $menu->add('已结款',array('route'  => 'balance.confirm','parent'=>'balance'));
                    if($this->user->ability('administrators','balance_search_permission'))
                        $menu->add('查询',array('route'  => 'balance.search','parent'=>'balance'));
                }
            });
        }

        return $next($request);
    }
}
