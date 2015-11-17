<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title>重置密码 | The Home of Class 8</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?php echo URL::to('/'); ?>/img/favicon.png" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo cdn('/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo cdn('/css/bootstrap-responsive.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo cdn('/css/accounts-reset.css'); ?>" />
    <!-- Java Script -->
    <script type="text/javascript" src="<?php echo cdn('/js/jquery-1.11.1.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo cdn('/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo cdn('/js/md5.js'); ?>"></script>
</head>
<body>
	<div id="wrapper" class="container">
        <div id="header">
            <div class="row-fluid">
                <div class="span4">
                    <img src="<?php echo cdn('/img/logo-light.png'); ?>" alt="The Home of Class8" />
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
                        <img src="<?php echo cdn('/img/logo-dark.png'); ?>" alt="The Home of Class8" />
                    </div> <!-- #logo -->
                </div> <!-- .span3 -->
                <div class="span8">
                    <div id="main-content">
                    <?php if ( !$isConfidentialSetted ): ?>
                        <form id="reset-form" method="post" onsubmit="onSubmit(); return false;">
                            <h2>忘记密码?</h2>
                            <p>请告诉我们您的用户名和电子邮件地址, 我们会将重设密码说明发送给您.</p>
                            <div class="alert alert-error hide">无效的用户信息. 请确认您的用户名和电子邮件是否正确.<a class="close" data-dismiss="alert" href="#">&times;</a></div>
                            <p>
                                <label for="username">用户名</label>
                                <input type="text" id="username" maxlength="16" />
                            </p>
                            <p>
                                <label for="email">电子邮件地址</label>
                                <input type="text" id="email" maxlength="64" />
                            </p>
                            <input type="hidden" id="csrf-token" value="<?php echo csrf_token(); ?>">
                            <button type="submit" class="btn btn-primary">重置密码</button>
                            <p class="tip">忘记了所使用的电子邮件地址, 请与<a href="mailto:zjhzxhz@gmail.com">网站管理员</a>联系.</p>
                        </form> <!-- #reset-form -->
                        <div id="email-sent" class="hide">
                            <h2>电子邮件已发出</h2>
                            <div class="alert alert-success">请查看收件箱, 我们已向您发出重设密码说明. 如果您未在两小时内收到此邮件, 请与网站管理员联系.</div>
                        </div> <!-- #email-sent -->
                    <?php else: ?>
                        <?php if ( !$isConfidentialValid ): ?>
                            <h2>重置密码</h2>
                            <div class="alert alert-error">无效用户信息. 请确保您输入的网址与重置通知电邮中的网址完全一致.</div>
                        <?php else: ?>
                            <form id="reset-form" method="post" onsubmit="onSubmit(); return false;">
                                <h2>重置密码</h2>
                                <div class="alert alert-error hide"></div> <!-- .alert-error -->
                                <p>
                                    <label for="new-password">新密码</label>
                                    <input type="password" id="new-password" maxlength="16" />
                                </p>
                                <p>
                                    <label for="confirm-password">确认新密码</label>
                                    <input type="password" id="confirm-password" maxlength="16" />
                                </p>
                                <input type="hidden" id="csrf-token" value="<?php echo csrf_token(); ?>">
                                <button type="submit" class="btn btn-primary">重置密码</button>
                            </form> <!-- #reset-form -->
                            <div id="password-resetted" class="hide">
                                <h2>密码已重置</h2>
                                <div class="alert alert-success">我们已重置您的密码. 单击<a href="<?php echo URL::to('/'); ?>">此处</a>登录您的账户.</div>
                            </div> <!-- #password-resetted -->
                        <?php endif; ?>
                    <?php endif; ?>
                    </div> <!-- #main-content -->
                </div> <!-- .span8 -->
            </div> <!-- .row-fluid -->  
        </div> <!-- #content -->   
    </div>
    <div id="footer" class="row-fluid container">
        <div class="span8">
            <p>Copyright&copy; 2005-<?php echo date('Y'); ?> <a href="http://www.zjhzxhz.com" target="_blank">Infinite Script</a>. All rights reserved.</p>
        </div> <!-- .span8 -->
        <div class="span4">
            <ul class="inline">
                <li><a href="http://zjhzxhz.github.io/class8" target="_blank">帮助中心</a></li>
                <li>|</li>
                <li><a href="http://www.zjhzxhz.com/about" target="_blank">关于我们</a></li>
            </ul>
        </div> <!-- .span4 -->
    </div> <!-- #footer -->
    <!-- Java Script -->
    <!-- Placed at the end of the document so the pages load faster -->
<?php if ( !$isConfidentialSetted ): ?>
    <script type="text/javascript">
        function onSubmit() {
            $('.alert-error').addClass('hide');

            $('button[type=submit]').attr('disabled', 'disabled');
            $('button[type=submit]').html('正在处理...');

            var username    = $('#username').val(),
                email       = $('#email').val(),
                csrfToken   = $('#csrf-token').val();

            doConfirmConfidentialAction(username, email, csrfToken);
        }
    </script>
    <script type="text/javascript">
        function doConfirmConfidentialAction(username, email, csrfToken) {
            var postData = {
                'username': username,
                'email': email,
                '_token': csrfToken
            };
            $.ajax({
                type: 'POST',
                url: '<?php echo URL::to('/'); ?>/accounts/confirmConfidentialAction',
                data: postData,
                dataType: 'JSON',
                success: function(result){
                    return processConfirmResult(result);
                }
            });
        }
    </script>
    <script type="text/javascript">
        function processConfirmResult(result) {
            if ( result['isSuccessful'] ) {
                $('#reset-form').addClass('hide');
                $('#email-sent').removeClass('hide');
            } else {
                $('.alert-error').removeClass('hide');
                $('button[type=submit]').removeAttr('disabled');
                $('button[type=submit]').html('重置密码');
            }
        }
    </script>
<?php elseif ( $isConfidentialValid ) : ?>
    <script type="text/javascript">
        function onSubmit() {
            $('.alert-error').addClass('hide');

            $('button[type=submit]').attr('disabled', 'disabled');
            $('button[type=submit]').html('正在处理...');

            var email           = '<?php echo Input::get('email'); ?>',
                keycode         = '<?php echo Input::get('keycode'); ?>',
                newPassword     = $('#new-password').val(),
                confirmPassword = $('#confirm-password').val(),
                csrfToken       = $('#csrf-token').val();

            doResetPasswordAction(email, keycode, newPassword, confirmPassword, csrfToken);
        }
    </script>
    <script type="text/javascript">
        function doResetPasswordAction(email, keycode, newPassword, confirmPassword, csrfToken) {
            var postData = {
                'email': email,
                'keycode': keycode,
                'newPassword': newPassword,
                'confirmPassword': confirmPassword,
                '_token': csrfToken
            };
            $.ajax({
                type: 'POST',
                url: '<?php echo URL::to('/'); ?>/accounts/resetPasswordAction',
                data: postData,
                dataType: 'JSON',
                success: function(result){
                    return processResetResult(result);
                }
            });
        }
    </script>
    <script type="text/javascript">
        function processResetResult(result) {
            if ( result['isSuccessful'] ) {
                $('#reset-form').addClass('hide');
                $('#password-resetted').removeClass('hide');
            } else {
                var errorMessage = '';
                if ( result['isPasswordEmpty'] ) {
                    errorMessage += '请输入新密码.<br />'
                }
                if ( !result['isPasswordLegal'] ) {
                    errorMessage += '新密码的长度必须在6~16个字符之间.<br />'
                }
                if ( !result['isPasswordMatched'] ) {
                    errorMessage += '新密码和确认新密码输入不匹配.<br />'
                }
                if ( !result['isKeyCodeValid'] ) {
                    errorMessage += '您无权修改该账户的密码.<br />'
                }
                $('.alert-error').removeClass('hide');
                $('.alert-error').html(errorMessage);
                $('button[type=submit]').removeAttr('disabled');
                $('button[type=submit]').html('重置密码');
            }
        }
    </script>
<?php endif; ?>
</body>
</html>