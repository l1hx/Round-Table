<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8"/>
    <title>The Home of Class8</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?php echo URL::to('/'); ?>/img/favicon.png" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/css/accounts-login.css" />
    <!-- Java Script -->
    <script type="text/javascript" src="<?php echo URL::to('/'); ?>/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo URL::to('/'); ?>/js/md5.js"></script>
</head>
<body>
    <div id="wrapper">
        <div id="content">
            <div id="main-content">
                <div id="header">
                    <img src="<?php echo URL::to('/'); ?>/img/logo-light.png" alt="The Home of Class8" />
                </div> <!-- #header -->
                <form id="signin-form" method="post" onsubmit="onSubmit(); return false;">
                    <h1>登录</h1>
                    <div id="signin-form-content">
                        <div class="alert alert-error hide"></div>
                    <?php if ( isset($isLoggout) && $isLoggout ): ?>
                        <div class="alert alert-success">您已登出.</div>
                    <?php endif; ?>
                        <div id="username-controls" class="form-controls">
                            <label id="username-label" for="username">用户名</label>
                            <input id="username" name="username" type="text" maxlength="16" />
                        </div> <!-- #username-controls -->
                        <div id="password-controls" class="form-controls">
                            <label id="password-label" for="password">密码</label>
                            <label id="forget-password"><a href="#">忘记密码?</a></label>
                            <input id="password" name="password" type="password" maxlength="16" />
                        </div> <!-- #password-controls -->
                        <button id="submit" type="submit" class="btn btn-primary">登录</button>
                        <label id="remember">
                            <input id="persistent-cookie" name="persistent-cookie" type="checkbox">
                            <label id="remember-label">保持登录状态</label>
                        </label>
                    </div> <!-- #signin-form-content -->
                </form> <!-- #signin-form -->
            </div> <!-- #main-content -->
        </div> <!-- #content -->
        <div id="footer">
            <div id="copyright">
                <p>Copyright&copy; 2005-<?php echo date('Y'); ?> <a href="http://www.zjhzxhz.com">HApPy Studio</a>. All rights reserved.</p>
            </div> <!-- #copyright -->
            <div id="help-and-support">
                <ul class="inline">
                    <li>帮助中心</li>
                    <li>|</li>
                    <li>关于我们</li>
                </ul>
            </div> <!-- #help-and-support -->
        </div> <!-- #footer -->
    </div> <!-- #wrapper -->
    <!-- Java Script -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript">
        function getBackgroundImageUrl() {
            var image_number = Math.floor(Math.random() * 5);
            return 'url("<?php echo URL::to('/'); ?>/img/backgrounds/bg' + image_number + '.jpg")';
        }
    </script>
    <script type="text/javascript">
    function setFooterPosition() {
        $('#footer').show();
        if ( $('#signin-form').offset().top + $('#signin-form').height() >= $('#footer').offset().top ) {
            $('#footer').hide();
        }
    }
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#wrapper').css('background-image', getBackgroundImageUrl());
        $(window).resize(function() {
            setFooterPosition();
        });
    });
    </script>
    <script type="text/javascript">
        function onSubmit() {
            $('.alert-success').hide();
            
            $('button[type=submit]').attr('disabled', 'disabled');
            $('button[type=submit]').html('正在登录...');
            
            var username    = $('#username').val(),
                password    = md5($('input[name=password]').val()),
                rememberMe  = $('#remember-me').is(':checked');
            doLoginAction(username, password, rememberMe);
        };
    </script>
    <script type="text/javascript">
        function doLoginAction(username, password, rememberMe) {
            var postData = 'username=' + username + '&password=' + password +
                            '&isAllowAutoLogin=' + rememberMe;
            $.ajax({
                    type: 'POST',
                    url: '<?php echo URL::to('/'); ?>/accounts/loginAction',
                    data: postData,
                    dataType: 'JSON',
                    success: function(result){
                        return processLoginResult(result);
                }
            });
        }
    </script>
    <script type="text/javascript">
        function processLoginResult(result) {
            if ( result['isSuccessful'] ) {
                window.location.href="/home";
            } else {
                if ( result['isUsernameEmpty'] && result['isPasswordEmpty'] ) {
                    displayErrorMessage('请输入用户名和密码.');
                } else if ( result['isUsernameEmpty'] ) {
                    displayErrorMessage('请输入用户名.');
                } else if ( result['isPasswordEmpty'] ) {
                    displayErrorMessage('请输入密码.');
                } else if ( !result['isAccountValid'] ) {
                    displayErrorMessage('用户名或密码不正确.');
                }
                $('input[name=password]').val('');
            }
            $('button[type=submit]').html('登录');
            $('button[type=submit]').removeAttr('disabled');
        }
    </script>
    <script type="text/javascript">
        function displayErrorMessage(message) {
            var errorMessageBox = $('.alert-error');
            errorMessageBox.html(message);
            errorMessageBox.removeClass('hide');
        }
    </script>
</body>
</html>