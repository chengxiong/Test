<?php $__env->startSection('content-header'); ?>
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <?php echo Breadcrumbs::render('hostel_tag'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<p>
    <a href="<?php echo e(route('tag.create')); ?>" data-toggle="modal" data-target="#myModal"><button type="submit" class="btn btn-primary btn-flat" style="float:right; margin-right:30px;">添加TAG</button></a>
</p>
<div class="col-md-12">
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr class="table-color">
                        <th>TAG名称</th>
                        <th>TAG类型</th>
                        <th>操作</th>
                    </tr>
                    <?php foreach($tag_list as $tag): ?>
                    <tr>
                        <td class="cont_show"><?php echo e($tag->name); ?></td>
                        <td class="cont_show">
                            <?php if($tag->type == 1): ?>
                                民宿
                            <?php elseif($tag->type == 2): ?>
                                美学
                            <?php elseif($tag->type == 3): ?>
                                用户
                            <?php else: ?>
                                无分类
                            <?php endif; ?>
                        </td>
                        <td class="return-list"><a href="<?php echo e(route('tag.edit',$tag->tid)); ?>" data-toggle="modal" data-target="#myModal">编辑</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <?php echo $tag_list->render(); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>