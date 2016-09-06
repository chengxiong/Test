<?php
Breadcrumbs::setView('partial.breadcrumbs');

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', url('/'));
});

# user
Breadcrumbs::register('user_list', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('UserList', route('user.index'));
});

# permission
Breadcrumbs::register('permission_list', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('PermissionList', route('permission.index'));
});

# role
Breadcrumbs::register('role_list', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('RoleList', route('role.index'));
});

# 民宿管理
Breadcrumbs::register('hostel_list', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('HostelList', route('hostel.index'));
});
Breadcrumbs::register('hostel_create', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('HostelCreate', route('hostel.create'));
});
Breadcrumbs::register('hostel_tag', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('HostelTag', route('tag.index'));
});
Breadcrumbs::register('hostel_landlord', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('HostelLandlord', route('landlord.index'));
});

# 订单面包屑
Breadcrumbs::register('order_list', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('OrderList', route('order.index'));
});
Breadcrumbs::register('order_pending', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('OrderPending', route('order.pending'));
});
Breadcrumbs::register('order_confirm', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('OrderConfirm', route('order.confirm'));
});
Breadcrumbs::register('order_cancel', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('OrderCancel', route('order.cancel'));
});
Breadcrumbs::register('order_success', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('OrderSuccess', route('order.success'));
});
Breadcrumbs::register('order_search', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('OrderSearch', route('order.search'));
});

# 结款
Breadcrumbs::register('balance_list', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('BalanceList', route('balance.index'));
});
Breadcrumbs::register('balance_pending', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('BalancePending', route('balance.pending'));
});
Breadcrumbs::register('balance_confirm', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('BalanceConfirm', route('balance.confirm'));
});
Breadcrumbs::register('balance_search', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('BalanceSearch', route('balance.search'));
});
