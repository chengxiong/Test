<?php $__env->startSection('content'); ?>
<div class="col-md-10">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">用户修改</h3>
        </div>
        <form role="form" method="POST" action="<?php echo e(route('user.update',$user->id)); ?>">
            <?php echo e(csrf_field()); ?>

            <?php echo e(method_field('PUT')); ?>

            <div class="box-body">
                <div class="form-group">
                    <label>*用户名</label>
                    <input type="text" required="required" class="form-control" name="name" value="<?php echo e($user->name); ?>" placeholder="请输入用户名">
                </div>
                <div class="form-group">
                    <label>*用户email</label>
                    <input type="email" required="required" class="form-control" name="email" value="<?php echo e($user->email); ?>" placeholder="请输入用户邮箱">
                </div>
                <div class="form-group">
                    <label>密码*</label>
                    <input type="password" name="password" placeholder="请输入密码" class="form-control input-sm"/>

                </div>
                <div class="form-group">
                    <label>确认密码*</label>
                    <input type="password" name="password_confirmation" placeholder="确认密码" class="form-control input-sm"/>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>