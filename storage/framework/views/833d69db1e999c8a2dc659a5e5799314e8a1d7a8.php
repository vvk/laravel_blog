<?php if($hotArticle): ?>
    <div class="widget widget_ui_posts">
        <h3>热门文章</h3>
        <ul>
            <?php foreach($hotArticle as $item): ?>
                <li>
                    <span class="thumbnail">
                        <a href="<?php echo e(url('archives/'.$item->id)); ?>" target="_blank">
                            <?php if($item->thumb): ?>
                                <img src="<?php echo e(asset($item->thumb)); ?>" alt="" class="thumb transitionAll">
                            <?php elseif($item->category->thumb): ?>
                                <img src="<?php echo e(asset($item->category->thumb)); ?>" alt="" class="thumb transitionAll">
                            <?php endif; ?>
                        </a>
                    </span>
                    <span class="text"><a target="_blank" href="<?php echo e(url('archives/'.$item->id)); ?>"><?php echo e($item->name); ?></a></span>
                    <span class="muted"><i class="fa fa-clock-o"></i> <?php echo e(date('Y-m-d', $item->publish_time)); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>