<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title>页面未找到 | The Home of Class8</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?php echo Helper::cdn('/img/favicon.png'); ?>" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo Helper::cdn('/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo Helper::cdn('/css/bootstrap-responsive.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo Helper::cdn('/css/errors-404.css'); ?>" />
    <!-- Java Script -->
    <script type="text/javascript" src="<?php echo Helper::cdn('/js/jquery-1.11.1.min.js'); ?>"></script>
</head>
<body>
    <div id="wrapper" class="container">
        <div id="header">
            <img src="<?php echo Helper::cdn('/img/logo-dark.png'); ?>" alt="Logo" />
        </div> <!-- #header -->
        <div id="content" class="row-fluid">
            <div class="span6">
                <img src="<?php echo Helper::cdn('/img/404.png'); ?>" alt="404" />
            </div> <!-- .span6 -->
            <div id="error-message" class="span6">
                <h1>页面未找到</h1>
                <p>很抱歉, 我们无法为您加载您所请求的页面.</p>
                <button class="btn btn-info" onclick="history.go(-1);">返回</button>
            </div> <!-- .span6 -->
        </div> <!-- #content -->
        <div id="footer">
            <p>Copyright&copy; 2005-2014 <a href="http://www.zjhzxhz.com" target="_blank">Trunk Shell</a>. All rights reserved.</p>
        </div> <!-- #footer -->
    </div> <!-- #wrapper -->
</body>
</html>