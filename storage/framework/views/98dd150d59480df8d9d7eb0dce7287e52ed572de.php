<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=11,IE=10,IE=9,IE=8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-title" content="龙卷风">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <title><?php $__env->startSection('title'); ?><?php if(isset($title) && $title): ?> <?php echo e($title); ?> - <?php endif; ?><?php echo e($web_title); ?><?php echo $__env->yieldSection(); ?></title>
    <meta name="keywords" content="<?php $__env->startSection('keywords'); ?><?php if(isset($keywords) && $keywords): ?><?php echo e($keywords); ?><?php else: ?><?php echo e($web_keywords); ?><?php endif; ?> <?php echo $__env->yieldSection(); ?>">
    <meta name="description" content="<?php $__env->startSection('description'); ?><?php if(isset($description) && $description): ?><?php echo e($description); ?><?php else: ?><?php echo e($web_description); ?><?php endif; ?> <?php echo $__env->yieldSection(); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('favicon.ico')); ?>">

    <?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('static/bootstrap-3.3.5/css/bootstrap.min.css')); ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('static/css/font-awesome/css/font-awesome.min.css')); ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('static/css/main.css')); ?>" type="text/css" media="all">
    <?php echo $__env->yieldSection(); ?>

</head>

<body class="nav_fixed">

<?php echo $__env->make('dux.public.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php echo $__env->yieldContent('content'); ?>

<footer class="footer">
    <div class="container">
        <div class="fcode">
            <div class="friend_link">
                <ul>
                    <li><span>友情链接：</span></li>
                    <?php foreach($friendLink as $item): ?>
                        <li><a href="<?php echo e($item['url']); ?>" target="_blank" title="<?php echo e($item['description']); ?>"><?php echo e($item['name']); ?></a> </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <p>Copyright © 2016 龙卷风 All Rights Reserved</p>
        <div class="hide">网站统计代码可以放在这</div>
    </div>
</footer>

<?php $__env->startSection('js'); ?>
<script>
    window.jsui={
        uri: '/static/',
        ver:'1.0',
        roll: ["1","2"]
    };

</script>
<script type="text/javascript" src="<?php echo e(asset('static/js/jquery.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('static/bootstrap-3.3.5/js/bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('static/js/loader.js')); ?>"></script>
<?php echo $__env->yieldSection(); ?>

<div class="m-mask"></div>
<div class="rollbar" style="display: none;">
    <ul>
        <li>
            <a href="javascript:(scrollTo());"><i class="fa fa-angle-up"></i></a>
            <h6>去顶部<i></i></h6>
        </li>
    </ul>
</div>
</body>
</html>