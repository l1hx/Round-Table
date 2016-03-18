<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>首页 | 我们圆桌会</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="_token" content="<?php echo csrf_token(); ?>" />
    <link rel="shortcut icon" href="<?php echo cdn('/img/favicon.png'); ?>" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo cdn('/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo cdn('/css/bootstrap-responsive.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo cdn('/css/home-base.css'); ?>" />
    <!-- Java Script -->
    <script type="text/javascript" src="<?php echo cdn('/js/jquery-1.11.1.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo cdn('/js/bootstrap.min.js'); ?>"></script>
</head>
<body>
    <div id="header" class="row-fluid">
        <div id="logo" class="span3">
            <a href="<?php echo URL::to('/'); ?>/home">
                <img src="<?php echo cdn('/img/logo-dark.png'); ?>" alt="我们圆桌会" />
            </a>
        </div> <!-- #logo -->
        <div id="search" class="span5">
            <div class="input-append">
                <input type="search" placeholder="搜索您的嘉宾或节目" />
                <button class="btn btn-primary"><i class="icon icon-search"></i></button>
            </div> <!-- .input-append -->
        </div> <!-- #search -->
        <div id="notification" class="span4">
            <ul class="inline">
                <li>
                    <a href="javascript:void(0)"><i class="icon icon-grid"></i></a>
                </li>
                <li>
                    <a href="javascript:void(0)"><i class="icon icon-alert"></i></a>
                </li>
                <li><a href="#profile"><?php echo $username; ?></a></li>
                <li>
                    <a id="profile-trigger" href="javascript:void(0)">
                        <img src="<?php echo cdn('/img/avatar.jpg'); ?>" class="img-circle" alt="avatar" />
                        <img src="<?php echo cdn('/img/dropdown.png'); ?>" alt="dropdown" />
                    </a>
                    <div id="profile">
                        <div class="dropdown-shadow"></div> <!-- .dropdown-shadow -->
                        <div class="dropdown"></div> <!-- .dropdown -->
                        <div class="row-fluid">
                            <div class="span4">
                                <img src="<?php echo cdn('/img/avatar.jpg'); ?>" alt="avatar" />
                            </div> <!-- .span4 -->
                            <div class="span8">
                                <div id="user-info">
                                    <div class="profile-field"><?php echo $username; ?></div>
                                    <div class="profile-field"><?php echo $email; ?></div>
                                    <button class="btn btn-primary" onclick="window.location.href='<?php echo URL::to('/'); ?>/home#profile'">查看个人资料</button>
                                </div> <!-- #user-info -->
                            </div> <!-- .span8 -->
                        </div> <!-- .row-fluid -->
                        <div id="sign-out">
                            <button class="btn" onclick="window.location.href='<?php echo URL::to('/'); ?>/accounts/login?logout=true'">退出</button>
                        </div> <!-- #sign-out -->
                    </div> <!-- #profile -->
                </li>
            </ul>
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
            <div id="footer">
                <ul class="inline">
                    <li><a href="mailto:zjhzxhz@gmail.com">反馈</a></li>
                    <li><a href="http://zjhzxhz.github.io/class8" target="_blank">帮助</a></li>
                    <li><a href="http://www.zjhzxhz.com/about" target="_blank">关于</a></li>
                </ul>
                <div id="copyright">&copy; <?php echo date('Y'); ?> <a href="http://www.zjhzxhz.com" target="_blank">Infinite Script</a></div> <!-- #copyright -->
            </div> <!-- #footer -->
        </div> <!-- #navigation-sidebar -->
        <div id="notify-widget-panel" class="hide">
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
            var navbarPosition = $('#navigation-bar').position(),
                windowPosition = $(window).scrollTop();
            $('#notify-box').css('display', 'none');
            $('#profile').css('display', 'none');
            if (windowPosition > navbarPosition.top) {
                $('#navigation-bar').addClass('fixed');
                $('#icon').css('margin-left', 0);
                $('#position').css('background-color', '#f5f5f5');
                $('#position').css('margin-left', 12);
                $('#position .position-name').css('display', 'none');
                $('#navigation-sidebar').css('top', 0);
                $('#footer').css('margin-bottom', 0);
            } else {
                $('#navigation-bar').removeClass('fixed');
                $('#icon').css('margin-left', -44);
                $('#position').css('background-color', '#fff');
                $('#position').css('margin-left', 30);
                $('#position .position-name').css('display', 'inline-block');
                if ( $(window).width() >= 768 ) {
                    $('#navigation-sidebar').css('top', 68);
                } else {
                    $('#navigation-sidebar').css('top', 196);
                }
                $('#footer').css('margin-bottom', 72);
            }
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
            $('#notify-widget-panel').removeClass('hide');
            $.ajax({
                type: 'GET',
                url: '<?php echo URL::to('/'); ?>/home/getPageContentAction?pageName=' + pageName,
                success: function(pageContent) {
                    updateNavigation(pageName);
                    $('#content').html(pageContent);

                    $('#notify-widget-panel').addClass('hide');
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
            document.title = pageDisplayName + ' | 我们圆桌会';
        }
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

        $('#navigation-sidebar').click(function() {
            $('#navigation-sidebar').css('display', 'none');
        });
    </script>
</body>
</html>
