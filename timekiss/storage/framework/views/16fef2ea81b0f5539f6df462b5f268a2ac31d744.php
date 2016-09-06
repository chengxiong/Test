<?php $__env->startSection('content-header'); ?>
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <?php echo Breadcrumbs::render('hostel_landlord'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<p>
    <a href="<?php echo e(route('account.create')); ?>"><button type="submit" class="btn btn-primary btn-flat" style="float:right; margin-right:30px;">添加账号</button></a>
</p>
<div class="col-md-12">
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr class="table-color">
                        <th>姓名</th>
                        <th>电话</th>
                        <th>uuid</th>
                        <th>注册时间</th>
                        <th>上次登录时间</th>
                        <th>生日</th>
                        <th>星座</th>
                        <th>职业</th>
                        <th>邮箱</th>
                        <th>头像</th>
                        <th>性别</th>
                        <th>操作</th>
                    </tr>
                    <?php foreach($account_list as $account): ?>
                    <tr>
                        <td><?php echo e($account->username); ?></td>
                        <td><?php echo e($account->telephone); ?></td>
                        <td><?php echo e($account->uuid); ?></td>
                        <td><?php echo e($account->registerTime); ?></td>
                        <td><?php echo e($account->lastLoginTime); ?></td>
                        <td><?php echo e($account->birthday); ?></td>
                        <td><?php echo e($account->starSigns); ?></td>
                        <td><?php echo e($account->profession); ?></td>
                        <td><?php echo e($account->email); ?></td>
                        <td><img style="width:100px" src="<?php echo e($account->avatar); ?>"/></td>                        
                        <td>
                            <?php if($account->gender == 1): ?>
                                男
                            <?php else: ?>
                                女
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('account.edit',$account->accountId)); ?>">编辑</a> <a href="<?php echo e(route('account.status',$account->accountId)); ?>" data-toggle="modal" data-target="#myModal">账号状态</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <?php echo $account_list->render(); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>