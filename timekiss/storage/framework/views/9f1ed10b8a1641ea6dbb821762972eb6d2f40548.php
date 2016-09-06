<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables/dataTables.bootstrap.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <?php echo Breadcrumbs::render('role_list'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="col-sm-6">
                    <h3 class="box-title">角色列表</h3>
                </div>
                <div class="col-sm-6">
                    <div class="dataTables_filter" id="example1_filter">
                        <a href="<?php echo e(route('role.create')); ?>" class="btn bg-olive">添加角色</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="role">
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">机器名</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">展示名</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($role_list as $role): ?>
                                    <tr role="row" class="odd">
                                        <td><?php echo e($role->name); ?></td>
                                        <td><?php echo e($role->display_name); ?></td>
                                        <td>
                                            <?php if($role->id >= 2): ?>
                                                <a href="<?php echo e(route('role.edit',$role->id)); ?>">编辑</a>
                                                <a href="<?php echo e(route('role.delete',$role->id)); ?>">删除</a>
                                                <a href="<?php echo e(route('role.permission',$role->id)); ?>">权限</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                <?php echo $role_list->render(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>