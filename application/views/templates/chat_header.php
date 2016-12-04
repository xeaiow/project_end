<!--
 ____       _
/ ___|  ___| | ___ _ __   ___
\___ \ / _ \ |/ _ \ '_ \ / _ \
 ___) |  __/ |  __/ | | |  __/
|____/ \___|_|\___|_| |_|\___|

-->
<!DOCTYPE html>
<html ng-app="selene">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title><?php echo (isset($page_title) ? $page_title." - " : ""); ?>Selene 創造精彩大學生活</title>

	<?php echo (isset($page_title) ? '<meta name="og:title" content="'.$page_title .'">' : ''); ?>

	<?php echo (isset($page_description) ? '<meta name="og:description" content="'.$page_description .'">' : ""); ?>

	<meta property="og:image" content="https://s3.amazonaws.com/static.selene.tw/assets/img/selene.og.image.png">
	<meta property="og:image:width" content="1440">
	<meta property="og:image:height" content="754">
	<meta property="article:author" content="https://www.facebook.com/selene.fans">
	<meta name="author" content="Selene 塞拉涅">

	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/semantic.min.css">

	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/style.css">
	<link href="https://s3.amazonaws.com/static.selene.tw/assets/messenger.css" rel="stylesheet" media="screen">
	<link href="https://s3.amazonaws.com/static.selene.tw/assets/messenger-theme-flat.css" rel="stylesheet" media="screen">
    <script src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<script src="https://s3.amazonaws.com/static.selene.tw/assets/jquery.min.js"></script>
	<script src="<?=base_url()?>assets/semantic.min.js"></script>
    <script src="<?=base_url()?>assets/fastclick.js"></script>
	<script src="https://s3.amazonaws.com/static.selene.tw/assets/moment.js"></script>
	<script src="https://s3.amazonaws.com/static.selene.tw/assets/messenger.min.js"></script>
	<script src="https://s3.amazonaws.com/static.selene.tw/assets/messenger-theme-flat.js"></script>

</head>
<body>