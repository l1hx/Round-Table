<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8"/>
    <title>登录 | The Home of Class8</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
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
        <!--[if lte IE 8]>
        <div id="upgrade-browser">
            <div class="row-fluid container">
                <div class="span8">
                    <div class="notice">
                        <h3>您正在使用的浏览器已经不再被支持. 请升级您的浏览器!</h3>
                        <p>
                            我们推荐您使用最新版本的<a href="http://windows.microsoft.com/zh-cn/windows/upgrade-your-browser">Internet Explorer</a>, <a href="http://chrome.google.com">Google Chrome</a>或<a href="https://mozilla.org/firefox">Firefox</a>浏览器.<br />
                            如果您正在使用360或搜狗浏览器, 请切换至极速内核模式.
                        </p>
                    </div>
                </div>
                <div class="span4">
                    <button class="btn btn-primary">了解更多</button>
                    <button class="btn btn-danger">忽略</button>
                </div>
            </div>
        </div>
        <![endif]-->
        <div id="content" class="container">
            <div id="main-content" class="row-fluid">
                <div id="header" class="span6">
                    <img src="<?php echo URL::to('/'); ?>/img/logo-light.png" alt="The Home of Class8" />
                </div> <!-- #header -->
                <div class="span6">
                    <form id="signin-form" method="post" onsubmit="onSubmit(); return false;">
                        <h1>登录</h1>
                        <div id="signin-form-content">
                            <div class="alert alert-error hide"></div>
                        <?php if ( isset($isLoggout) && $isLoggout ): ?>
                            <div class="alert alert-success">您已登出.</div>
                        <?php endif; ?>
                            <p>
                                <label id="username-label" for="username">用户名</label>
                                <input id="username" name="username" class="span12" type="text" maxlength="16" />
                            </p>
                            <p>
                                <label id="password-label" for="password"><a class="pull-right" href="<?php echo URL::to('/'); ?>/accounts/resetPassword">忘记密码?</a>密码</label>
                                <input id="password" name="password" class="span12" type="password" maxlength="16" />
                            </p>
                            <p>
                                <button type="submit" class="btn btn-primary">登录</button>
                                <label id="remember">
                                    <input id="persistent-cookie" name="persistent-cookie" type="checkbox" /> 保持登录状态
                                </label>
                            </p>
                        </div> <!-- #signin-form-content -->
                    </form> <!-- #signin-form -->
                </div> <!-- .span6 -->
            </div> <!-- #main-content -->
        </div> <!-- #content -->
        <div id="footer">
            <div id="copyright">
                <p>Copyright&copy; 2005-<?php echo date('Y'); ?> <a href="http://www.zjhzxhz.com">HApPy Studio</a>. All rights reserved.</p>
            </div> <!-- #copyright -->
            <div id="help-and-support">
                <ul class="inline">
                    <li><a href="http://zjhzxhz.github.io/class8" target="_blank">帮助中心</a></li>
                    <li>|</li>
                    <li><a href="http://www.zjhzxhz.com/about" target="_blank">关于我们</a></li>
                </ul>
            </div> <!-- #help-and-support -->
        </div> <!-- #footer -->
    </div> <!-- #wrapper -->
    <!-- Java Script -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript">
        function getBackgroundImageUrl() {
            var imageNumber = Math.floor(Math.random() * 5);
            return 'url("<?php echo URL::to('/'); ?>/img/backgrounds/bg' + imageNumber + '.jpg")';
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
            setFooterPosition();
        });
    </script>
    <script type="text/javascript">
        $(window).resize(function() {
            setFooterPosition();
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

            $('input[name=password]').val(password);
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
                window.location.href="<?php echo URL::to('/'); ?>/home";
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
                $('button[type=submit]').html('登录');
                $('button[type=submit]').removeAttr('disabled');
            }
        }
    </script>
    <script type="text/javascript">
        function displayErrorMessage(message) {
            var errorMessageBox = $('.alert-error');
            errorMessageBox.html(message);
            errorMessageBox.removeClass('hide');
        }
    </script>
    <script type="text/javascript">
        $('.btn-danger', '#upgrade-browser').click(function() {
            $('#upgrade-browser').addClass('hide');
        });
    </script>
</body>
</html>