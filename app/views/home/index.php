<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>首页 | The Home of Class8</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?php echo URL::to('/'); ?>/img/favicon.png" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/css/home-base.css" />
    <!-- Java Script -->
    <script type="text/javascript" src="<?php echo URL::to('/'); ?>/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo URL::to('/'); ?>/js/bootstrap.min.js"></script>
</head>
<body>
    <div id="header">
        <div id="logo"><img src="<?php echo URL::to('/'); ?>/img/logo-dark.png" alt="Product Logo" /></div> <!-- #logo -->
        <div id="search-box">
            <div id="search-box-core">
                <input id="search-input" type="search" placeholder="搜索您的同学和活动" />
                <table id="search-result" cellspacing="0" cellpadding="0"></table>
            </div> <!-- #search-box-core -->
            <div id="search-button">
                <button class="btn btn-primary"><span class="icon icon-search"></span></button>
            </div> <!-- #search-button -->
        </div> <!-- #search-box -->
        <div id="notification">
            <div id="app-box">
                <div id="app-box-trigger" class="icon"></div> <!-- #app-box -->
            </div> <!-- #app-box -->
            <div id="notify">
                <div id="notify-trigger" class="icon">
                    <div id="notify-counter">2</div> <!-- #notify-counter -->
                </div> <!-- #notify-trigger -->
                <div id="notify-box">
                    <span class="arrow"></span>
                    <span class="arrow-shadow"></span>
                    <div id="notify-box-title"><h2>消息</h2></div> <!-- #notify-box-title -->
                    <div id="notify-box-content">
                        <div id="loading-notify-message">
                            <img src="<?php echo URL::to('/'); ?>/img/loading-notify-message.gif" alt="Loading Message" />
                            <p>正在读取...</p>
                        </div> <!-- #loading-notify-message -->
                        <div id="no-notify-message">
                            <img src="<?php echo URL::to('/'); ?>/img/no-notify-message.png" alt="No Message" />
                            <p>暂无未处理的消息</p>
                        </div> <!-- #no-notify-message -->
                    </div> <!-- #notify-box-content -->
                </div> <!-- #notify-box -->
            </div> <!-- #notify -->
            <div id="avatar">
                <a id="profile-trigger" href="javascript:void(0)">
                    <ul class="inline">
                        <li><?php echo $username; ?></li>
                        <li>
                            <span><img id="avatar-small" class="img-circle" src="http://www.gravatar.com/avatar/<?php echo md5(strtolower($email)); ?>?s=200&d=mm" alt="avatar" /></span>
                            <span id="scroll-down-button"></span>
                        </li>
                    </ul>
                </a>
                <div id="profile">
                    <span class="arrow"></span>
                    <span class="arrow-shadow"></span>
                    <div id="brief-profile">
                        <div id="avatar-large">
                            <img src="http://www.gravatar.com/avatar/<?php echo md5(strtolower($email)); ?>?s=200&d=mm" alt="avatar" />
                        </div> <!-- #avatar-large -->
                        <div id="profile-info">
                            <div id="user-info">
                                <span id="display-name"><?php echo $username; ?></span>
                                <span id="username"><?php echo $email; ?></span>
                            </div>
                            <button class="btn btn-primary" onclick="window.location.href='<?php echo URL::to('/'); ?>/home#profile'">查看个人资料</button>
                        </div> <!-- #profile-info -->
                    </div> <!-- #brief-profile -->
                    <div id="sign-out">
                        <button class="btn" onclick="window.location.href='<?php echo URL::to('/'); ?>/accounts/login?logout=true'">退出</button>
                    </div> <!-- #sign-out -->
                </div> <!-- #profile -->
            </div> <!-- #avatar -->
        </div> <!-- #notification -->
    </div> <!-- #header -->
    <div id="container">
        <div id="navigation-bar">
            <div id="icon"></div> <!-- #icon -->
            <div id="position">
                <div class="position-icon icon-dashboard"></div> <!-- .position-icon -->
                <div class="position-name">首页</div> <!-- .position-name -->
                <div class="slide-down"></div> <!-- .slide-down -->
            </div> <!-- #position -->
            <div id="hangouts">
                <div id="hangouts-trigger">
                    <ul class="inline">
                        <li><div id="hangouts-icon" class="icon"></div></li>
                        <li>环聊</li>
                    </ul>
                </div> <!-- #hangouts-trigger -->
                <div id="hangouts-dialog">
                    <div id="hangouts-search">
                        <span><div id="icon-plus"></div></span>
                        <div id="hangouts-search-box">发起新环聊</div>
                    </div> <!-- #hangouts-search -->
                </div> <!-- #hangouts-dialog -->
            </div> <!-- #hangouts -->
        </div> <!-- #navigation-bar -->
        <div id="navigation-sidebar">
            <a href="#dashboard">
                <div class="nav-item border-bottom">
                    <div class="position-icon icon-dashboard"></div> <!-- .icon-dashboard -->
                    <div class="position-name">首页</div> <!-- .position-name -->
                </div> <!-- .nav-item -->
            </a>
            <a href="#profile">
                <div class="nav-item">
                    <div class="position-icon icon-profile"></div> <!-- .icon-profile -->
                    <div class="position-name">个人资料</div> <!-- .position-name -->
                </div> <!-- .nav-item -->
            </a>
            <a href="#people">
                <div class="nav-item">
                    <div class="position-icon icon-people"></div> <!-- .icon-people -->
                    <div class="position-name">人脉</div> <!-- .position-name -->
                </div> <!-- .nav-item -->
            </a>
            <a href="#photos">
                <div class="nav-item border-bottom">
                    <div class="position-icon icon-photos"></div> <!-- .icon-photos -->
                    <div class="position-name">照片</div> <!-- .position-name -->
                </div> <!-- .nav-item -->
            </a>
            <a href="#activity">
                <div class="nav-item">
                    <div class="position-icon icon-activity"></div> <!-- .icon-activity -->
                    <div class="position-name">活动</div> <!-- .position-name -->
                </div> <!-- .nav-item -->
            </a>
            <a href="#votes">
                <div class="nav-item">
                    <div class="position-icon icon-votes"></div> <!-- .icon-hangouts -->
                    <div class="position-name">投票</div> <!-- .position-name -->
                </div> <!-- .nav-item -->
            </a>
            <a href="#hangouts">
                <div class="nav-item">
                    <div class="position-icon icon-hangouts"></div> <!-- .icon-hangouts -->
                    <div class="position-name">环聊</div> <!-- .position-name -->
                </div> <!-- .nav-item -->
            </a>
            <div id="footer">
                <ul class="inline">
                    <li><a href="mailto:zjhzxhz@gmail.com">反馈</a></li>
                    <li><a href="http://zjhzxhz.github.io/class8" target="_blank">帮助</a></li>
                    <li><a href="http://www.zjhzxhz.com/about" target="_blank">关于</a></li>
                </ul>
                <div id="copyright">&copy; <?php echo date('Y'); ?> <a href="http://www.zjhzxhz.com" target="_blank">HApPy Studio</a></div> <!-- #copyright -->
            </div> <!-- #footer -->
        </div> <!-- #navigation-sidebar -->
        <div id="notify-widget-panel">
            <div id="message">正在加载...</div>
        </div> <!-- #notify-widget-panel -->
        <div id="content"></div> <!-- #content -->
    </div> <!-- #container -->
    <!-- Java Script -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript">
        function getPageName() {
            var pageNameMatcher = window.location.href.match(/#.*$/);
            if ( pageNameMatcher != null ) {
                return pageNameMatcher[0].substring(1);
            }
            return null;
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);

            var pageName = getPageName();
            if ( pageName == null ) {
                pageName = 'dashboard';
            }
            getPageContent(pageName);
        });
    </script>
    <script type="text/javascript">
        $(window).scroll(function() {
            var navbarPosition = $('#navigation-bar').position();
            $(window).scroll(function() {
                windowPosition = $(window).scrollTop();
                $('#notify-box').css('display', 'none');
                $('#profile').css('display', 'none');
                if (windowPosition > navbarPosition.top) {
                    $('#navigation-bar').addClass('fixed');
                    $('#icon').css('margin-left', 0);
                    $('#position').css('background-color', '#f5f5f5');
                    $('#position').css('margin-left', 12);
                    $('#position .position-name').css('display', 'none');
                    $('#hangouts-dialog').css('top', 44);
                    $('#navigation-sidebar').css('top', 0);
                    $('#footer').css('margin-bottom', 0);
                } else {
                    $('#navigation-bar').removeClass('fixed');
                    $('#icon').css('margin-left', -44);
                    $('#position').css('background-color', '#fff');
                    $('#position').css('margin-left', 30);
                    $('#position .position-name').css('display', 'inline-block');
                    $('#hangouts-dialog').css('top', 104);
                    $('#navigation-sidebar').css('top', 60);
                    $('#footer').css('margin-bottom', 60);
                }
            });
        });
    </script>
    <script type="text/javascript">
        if ( ("onhashchange"in window) && !navigator.userAgent.toLowerCase().match(/msie/) ) {
            $(window).on('hashchange', function() {
                var pageName = getPageName();
                getPageContent(pageName);
            });
        } else{
            var prevHash = window.location.hash;
            window.setInterval(function() {
                if ( window.location.hash != prevHash ) {
                    prevHash = window.location.hash;
                    var pageName = getPageName();
                    getPageContent(pageName);
                }
            }, 100);
        }
    </script>
    <script type="text/javascript">
        $('.nav-item').click(function() {
            var triggerObject = $(this).parent();
                pageName = $(triggerObject).attr('href').substring(1);
            return getPageContent(pageName);
        });
    </script>
    <script type="text/javascript">
        function getPageContent(pageName) {
            $.ajax({
                type: 'GET',
                url: '<?php echo URL::to('/'); ?>/home/getPageContentAction?pageName=' + pageName,
                success: function(pageContent) {
                    updateNavigation(pageName);
                    $('#content').html(pageContent);
                }
            });
        }
    </script>
    <script type="text/javascript">
        function updateNavigation(pageName) {
            var triggerObject   = $('a[href=#' + pageName + ']'),
                pageDisplayName = $('.position-name', triggerObject).html();
            
            $('#position > .position-icon').attr('class', function(i, c) {
                return c.replace(/(^|\s)icon-\S+/g, ' icon-' + pageName);
            });
            $('#position > .position-name').html(pageDisplayName);
            document.title = pageDisplayName + ' | The Home of Class8';
        }
    </script>
    <script type="text/javascript">
        $('#notify-trigger').click(function(event){
            if ($('#notify-box').is(':visible')) {
                $("#notify-box").slideUp(18);
            } else {
                $("#profile").slideUp(36);
                $("#notify-box").slideDown(18);
            }
            event.stopPropagation();
            
            $(document).click(function() {
                $("#notify-box").slideUp(18);
            });
        });
    </script>
    <script type="text/javascript">
        $('#profile-trigger').click(function(event){
            if ($('#profile').is(':visible')) {
                $("#profile").slideUp(36);
            } else {
                $("#notify-box").slideUp(18);
                $("#profile").slideDown(36);
            }
            event.stopPropagation();
            
            $(document).click(function() {
                $("#profile").slideUp(36);
            });
        });
    </script>
    <script type="text/javascript">
        var isIconHovered = false,
            isButtonHovered = false,
            isSidebarHovered = false;
        $('#icon').hover(function() {
            isIconHovered = true;
            $('#navigation-sidebar').css('display', 'block');
        }, function() {
            isIconHovered = false;
            if ( !isIconHovered && !isButtonHovered && !isSidebarHovered ) {
                $('#navigation-sidebar').css('display', 'none');
            }
        });

        $('#position').hover(function() {
            isButtonHovered = true;
            $('#navigation-sidebar').css('display', 'block');
        }, function() {
            isButtonHovered = false;
            if ( !isIconHovered && !isButtonHovered && !isSidebarHovered ) {
                $('#navigation-sidebar').css('display', 'none');
            }
        });

        $('#navigation-sidebar').hover(function() {
            isSidebarHovered = true;
            $('#navigation-sidebar').css('display', 'block');
        }, function() {
            isSidebarHovered = false;
            if ( !isIconHovered && !isButtonHovered && !isSidebarHovered ) {
                $('#navigation-sidebar').css('display', 'none');
            }
        });
    </script>
    <script type="text/javascript">
        $('#hangouts-trigger').click(function(){
            var isDialogShown = $('#hangouts-dialog').is(":visible");
            if ( !isDialogShown ) {
                $('#content').css('padding-right', 260);
                if ( $('navigation-bar').hasClass('fixed') ) {
                    $('#hangouts-dialog').css('top', 104);
                }
                $('#hangouts-trigger').css('margin-right', 160);
                $('#hangouts-dialog').css('display', 'block');
            } else {
                $('#content').css('padding-right', '');
                if ( $('navigation-bar').hasClass('fixed') ) {
                    $('#hangouts-dialog').css('top', 0);
                }
                $('#hangouts-trigger').css('margin-right', 0);
                $('#hangouts-dialog').css('display', 'none');
            }
        });
    </script>
</body>
</html>