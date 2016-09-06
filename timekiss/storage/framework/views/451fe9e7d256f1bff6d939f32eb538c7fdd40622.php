<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables/dataTables.bootstrap.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <?php echo Breadcrumbs::render('permission_list'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="col-sm-6">
                    <h3 class="box-title">权限列表</h3>
                </div>
                <div class="col-sm-6">
                    <div class="dataTables_filter" id="example1_filter">
                        <form action="<?php echo e(route('permission.store')); ?>" method="post" class="form-horizontal " enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <input type="submit" class="btn bg-olive" value="重新构建权限" />
                        </form>
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
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">#</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">名字</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">描述</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($permission_list as $permission): ?>
                                    <tr class="odd">
                                        <td><?php echo e($permission->id); ?></td>
                                        <td>
                                            <?php echo e($permission->display_name); ?>

                                        </td>
                                        <td>
                                            <?php echo e($permission->description); ?>

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
                                <?php echo $permission_list->render(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>