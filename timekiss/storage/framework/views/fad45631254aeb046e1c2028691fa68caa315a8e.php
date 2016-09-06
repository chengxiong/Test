<?php if($breadcrumbs): ?>
    <ol class="breadcrumb">
        <?php foreach($breadcrumbs as $breadcrumb): ?>
            <?php if(!$breadcrumb->last): ?>
                <li><i class="fa fa-dashboard"></i> <?php echo e($breadcrumb->title); ?></li>
            <?php else: ?>
                <li class="active"><?php echo e($breadcrumb->title); ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ol>
<?php endif; ?>