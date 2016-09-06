<?php if(count($errors) > 0): ?>
<?php foreach($errors->all() as $error): ?>
<div class="col-md-12">
    <div class="col-md-6 alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> 警告!</h4>
        <?php echo e($error); ?>

    </div>
</div>
<?php endforeach; ?>
<?php elseif(session('message')!=null): ?>
<div class="col-md-12">
    <div class="col-md-6 alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> 成功!</h4>
        <?php echo e(session('message')); ?>

    </div>
</div>
<?php endif; ?>
