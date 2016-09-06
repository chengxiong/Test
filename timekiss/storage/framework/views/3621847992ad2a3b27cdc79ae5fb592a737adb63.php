<?php foreach($items as $item): ?>
    <?php echo e($tmp = false); ?>

    <?php foreach($item->children() as $child): ?>
        <?php if($child->url() == Request::url() && $_SERVER['REQUEST_URI']!= '/'): ?>
            <input type="hidden" value="<?php echo e($tmp = true); ?>">
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if($item->url() == Request::url()): ?>
        <input type="hidden" value="<?php echo e($tmp = true); ?>">
    <?php endif; ?>
    <li class="treeview <?php if($tmp): ?> active <?php endif; ?>">
        <a href="<?php echo $item->url(); ?>">
            <i class="<?php echo $item->icon; ?>"></i>
            <span><?php echo $item->title; ?></span>
            <?php if($item->hasChildren()): ?>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            <?php endif; ?>
        </a>
        <?php if($item->hasChildren()): ?>
            <ul class="treeview-menu">
                <?php foreach($item->children() as $child): ?>
                    <?php if(Request::url() == $child->url() && $_SERVER['REQUEST_URI'] != '/'): ?>
                        <li class="active">
                            <a href="<?php echo $child->url(); ?>"><i class="fa fa-circle-o"></i> <?php echo $child->title; ?></a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="<?php echo $child->url(); ?>"><i class="fa fa-circle-o"></i> <?php echo $child->title; ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </li>
<?php endforeach; ?>