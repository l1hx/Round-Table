<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title>重置密码 | The Home of Class 8</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?php echo URL::to('/'); ?>/img/favicon.png" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/css/accounts-reset.css" />
    <!-- Java Script -->
    <script type="text/javascript" src="<?php echo URL::to('/'); ?>/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo URL::to('/'); ?>/js/md5.js"></script>
</head>
<body>
	<div id="wrapper" class="container">
        <div id="header">
            <div class="row-fluid">
                <div class="span4">
                    <img src="<?php echo URL::to('/'); ?>/img/logo-light.png" alt="Logo">
                </div> <!-- .span4 -->
                <div class="span8">
                    <button class="btn" onclick="window.location.href='<?php echo URL::to('/'); ?>'">登录</button>
                </div> <!-- .span8 -->
            </div> <!-- .row-fluid -->
        </div> <!-- #header -->
        <div id="content">
            <div class="row-fluid">
                <div class="offset1 span3">
                    <div id="logo">
                        <img src="<?php echo URL::to('/'); ?>/img/logo-dark.png" alt="Logo">
                    </div> <!-- #logo -->
                </div> <!-- .span3 -->
                <div class="span8">
                    <div id="main-content">
                        <h2>丢失了密码?</h2>
                        <p>请告诉我们您的用户名和电子邮件地址, 我们会将重设密码说明发送给您.</p>
                        <form id="reset-form" action="#" method="POST">
                            <p>
                                <label for="username">用户名</label>
                                <input type="text" id="username" maxlength="16" />
                            </p>
                            <p>
                                <label for="email">电子邮件地址</label>
                                <input type="text" id="email" maxlength="64" />
                            </p>
                            <button class="btn btn-primary">重置密码</button>
                        </form> <!-- #reset-form -->
                        <p class="tip">如果您忘记了所使用的电子邮件地址, 请与<a href="mailto:zjhzxhz@gmail.com">网站管理员</a>联系.</p>
                    </div> <!-- #main-content -->
                </div> <!-- .span8 -->
            </div> <!-- .row-fluid -->
        </div> <!-- #content -->   
    </div>
    <div id="footer" class="row-fluid container">
        <div class="span8">
            <p>Copyright&copy; 2005-<?php echo date('Y'); ?> <a href="http://www.zjhzxhz.com" target="_blank">HApPy Studio</a>. All rights reserved.</p>
        </div> <!-- .span8 -->
        <div class="span4">
            <ul class="inline">
                <li><a href="http://zjhzxhz.github.io/class8" target="_blank">帮助中心</a></li>
                <li>|</li>
                <li><a href="http://www.zjhzxhz.com/about" target="_blank">关于我们</a></li>
            </ul>
        </div> <!-- .span4 -->
    </div> <!-- #footer -->
</body>
</html>