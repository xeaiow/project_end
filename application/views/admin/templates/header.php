<!DOCTYPE html>
<html ng-app="admin">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title><?php echo (isset($page_title) ? $page_title." - " : ""); ?>Selene 後台管理</title>

	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/semantic.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="//static.selene.tw/assets/semantic.min.css"> -->

	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/style.css">
	<link href="//static.selene.tw/assets/messenger.css" rel="stylesheet" media="screen">
	<link href="//static.selene.tw/assets/messenger-theme-flat.css" rel="stylesheet" media="screen">

	<script src="<?=base_url()?>assets/jquery.min.js"></script>
	<script src="<?=base_url(); ?>assets/semantic.min.js"></script>
	<script src="<?=base_url()?>assets/moment.js"></script>
	<!-- <script src="//static.selene.tw/assets/jquery.min.js"></script>
    <script src="//static.selene.tw/assets/semantic.min.js"></script>
	<script src="//static.selene.tw/assets/moment.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular-sanitize.min.js"></script>

	<script src="//static.selene.tw/assets/messenger.min.js"></script>
	<script src="//static.selene.tw/assets/messenger-theme-flat.js"></script>

	<script src="<?=base_url()?>assets/admin.js"></script>
    <!-- ngclipboard -->
    <script src="//cdn.rawgit.com/zenorocha/clipboard.js/master/dist/clipboard.min.js"></script>
    <script src="<?=base_url()?>assets/ngclipboard.js"></script>
</head>
<body>
