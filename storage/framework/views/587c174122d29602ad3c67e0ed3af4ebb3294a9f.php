<?php $__env->startSection('content'); ?>

    <section class="container">
        <div class="content-wrap article_content">
            <div class="content">
                <header class="article-header">
                    <h1 class="article-title"><?php echo e($data->name); ?></h1>
                    <div class="article-meta">
                        <span class="item"><i class="fa fa-clock-o"></i> <?php echo e(date('Y-m-d H:i:s', $data->publish_time)); ?></span>
                        <span class="item"><i class="fa fa-eye"></i> 浏览量：<?php echo e($data->view_count); ?></span>
                        <span class="item"><i class="fa fa-folder"></i> 分类：
                            <a href="<?php echo e(url('category/'.$data->category->id)); ?>" rel="category tag"><?php echo e($data->category->name); ?></a>
                        </span>
                        <span class="item"></span>
                    </div>
                </header>

                <!-- 文章 start -->
                <article class="article-content">
                    <?php echo $data->content; ?>


                </article>
                <!-- 文章 end -->

                <?php if(!$data->is_reprint): ?>
                    <div>
                        <p class="post-copyright">
                            本文章为本站原创，如转载请注明文章出处：<a href="<?php echo e($url); ?>"><?php echo e($url); ?></a>
                        </p>
                    </div>
                <?php endif; ?>

                <div>
                    <div class="ds-share" data-thread-key="<?php echo e($data->id); ?>" data-title="<?php echo e($data->name); ?>" data-content="<?php echo e($data->name); ?>" data-url="<?php echo e($url); ?>">
                        <div class="ds-share-inline">
                            <ul  class="ds-share-icons-16">
                                <li data-toggle="ds-share-icons-more"><a class="ds-more" href="javascript:void(0);">分享到：</a></li>
                                <li><a class="ds-weibo" href="javascript:void(0);" data-service="weibo">微博</a></li>
                                <li><a class="ds-qzone" href="javascript:void(0);" data-service="qzone">QQ空间</a></li>
                                <li><a class="ds-qqt" href="javascript:void(0);" data-service="qqt">腾讯微博</a></li>
                                <li><a class="ds-wechat" href="javascript:void(0);" data-service="wechat">微信</a></li>
                            </ul>
                            <div class="ds-share-icons-more">
                            </div>
                        </div>
                    </div>
                </div>

                <?php if($tags): ?>
                    <div class="article-tags"><i class="fa fa-tags"></i> 标签：
                        <?php foreach($tags as $k=>$v): ?>
                            <a href="<?php echo e(url('tag/'.$v['name'])); ?>" rel="tag"><?php echo e($v['name']); ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if($relevanceArticle): ?>
                    <div class="relates">
                        <div class="title">
                            <h3>相关文章</h3>
                        </div>
                        <ul>
                            <?php foreach($relevanceArticle as $k=>$v): ?>
                                <li><a href="<?php echo e(url('archives/'.$v['id'])); ?>"><?php echo e($v['name']); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- 多说评论框 start -->
                <div id="comments">
                    <div  class="ds-thread" data-thread-key="<?php echo e($data->id); ?>" data-title="<?php echo e($data->name); ?>" data-url="<?php echo e($url); ?>"></div>
                </div>
                <!-- 多说评论框 end -->
            </div>
        </div>

        <aside class="sidebar">
            <?php /*<div class="widget widget_ui_textasb" style="top: 0px;">
                <a class="style02" href="">
                    <strong>吐血推荐</strong>
                    <h2>DUX主题 新一代主题</h2>
                    <p>DUX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而成；更加扁平的风格和干净白色的架构会让网站显得内涵而出色...</p>
                </a>
            </div>*/ ?>

            <?php echo $__env->make('dux.public.right_recommend_article', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo $__env->make('dux.public.right_hot_article', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- 最新评论 start -->
            <div class="widget widget_ui_comments">
                <h3>最新评论</h3>
                <ul class="ds-recent-comments"  data-num-items="5" data-show-avatars="1" data-show-time="1" data-show-title="1" data-show-admin="1" data-excerpt-length="70"><ul></ul></ul>
            </div>
            <!-- 最新评论 end -->

            <?php if(isset($allTags) && $allTags): ?>
                <div class="widget widget_ui_tags">
                    <h3>标签云</h3>
                    <div class="items">
                        <?php foreach($allTags as $item): ?>
                            <a href="<?php echo e(url('tag/'.$item['name'])); ?>"><?php echo e($item['name']); ?> (<?php echo e($item['count']); ?>)</a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- 最近访客 start -->
            <div class="widget widget_ui_readers">
                <h3>最近访客</h3>
                <ul class="ds-recent-visitors" data-num-items="20" ></ul>
            </div>
            <!-- 最近访客 end -->

        </aside>
    </section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    @parent

<?php /*    <script type="text/javascript">
        var duoshuoQuery = {short_name:"sunwq"};
        (function() {
            var ds = document.createElement('script');
            ds.type = 'text/javascript';ds.async = true;
            ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
            ds.charset = 'UTF-8';
            (document.getElementsByTagName('head')[0]
            || document.getElementsByTagName('body')[0]).appendChild(ds);
        })();
    </script>*/ ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('dux.public.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>