<?php $__env->startSection('content'); ?>
    <div class="col-md-10">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">角色对应权限</h3>
            </div>
            <form role="form" method="POST" action="<?php echo e(route('role.perStore',$role->id)); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="box-body">
                    <div class="checkbox">
                        <?php foreach($permission_list as $permission): ?>
                            <?php if(in_array($permission->id,$has_permission)): ?>
                                <label>
                                    <input type="checkbox" name="permission[]" checked value="<?php echo e($permission->id); ?>"> <?php echo e($permission->display_name); ?>

                                </label>
                            <?php else: ?>
                                <label>
                                    <input type="checkbox" name="permission[]" value="<?php echo e($permission->id); ?>"> <?php echo e($permission->display_name); ?>

                                </label>
                            <?php endif; ?>
                            <p><?php echo e($permission->description); ?></p>
                        <?php endforeach; ?>
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