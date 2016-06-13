<!-- 推荐文章 start -->
<?php if($recommendArticle): ?>
    <div class="widget widget_ui_posts">
        <h3>置顶推荐</h3>
        <ul>
            <?php foreach($recommendArticle as $item): ?>
                <li>
                    <span class="thumbnail">
                        <a href="<?php echo e(url('archives/'.$item->id)); ?>">
                            <?php if($item->thumb): ?>
                                <img src="<?php echo e(asset($item->thumb)); ?>" class="thumb lazy transitionAll" alt="">
                            <?php elseif($item->category->thumb): ?>
                                <img src="<?php echo e(asset($item->category->thumb)); ?>" class="thumb lazy transitionAll" alt="">
                            <?php endif; ?>
                        </a>
                    </span>
                    <span class="text"><a href="<?php echo e(url('archives/'.$item->id)); ?>"><?php echo e($item->name); ?></a></span>
                    <span class="muted"><i class="fa fa-clock-o"></i> <?php echo e(date('Y-m-d', $item->publish_time)); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<!-- 推荐文章 end -->