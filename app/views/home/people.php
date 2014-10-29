<link href="<?php echo URL::to('/'); ?>/css/home-people.css" media="screen" rel="stylesheet" type="text/css" />
<div class="row-fluid">
    <div id="sidebar" class="span3">
        <div id="filter">
            <h2>快速筛选</h2>
            <div class="input-append row-fluid">
                <input type="text" />
                <button class="btn btn-primary" type="button"><i class="icon-white icon-search"></i></button>
            </div> <!-- .input-append -->
            <p>您可以输入任意关键字(包括所在地, 电子邮件, 移动电话等)进行搜索</p>
        </div> <!-- #filter -->
    </div> <!-- #sidebar -->
    <div id="main-content" class="span9">
        <h1>人脉</h1>
        <?php 
        $colors     = array('#427fed', '#f4b400', '#53a93f', '#e94d20');
        foreach ( $people as $person ): ?>
        <div class="profile">
            <div class="avatar" style="background: <?php echo $colors[rand(0, 3)]; ?>">
                <img src="<?php echo URL::to('/'); ?>/img/silhouette.png" alt="avatar">
            </div> <!-- .avatar -->
            <div class="introduction">
                <h2><?php echo $person['username']; ?></h2>
                <div class="location">
                    <span class="country"><?php echo $person['country']; ?></span>
                    <span class="city"><?php echo $person['city']; ?></span><br />
                    <span class="company"><?php echo $person['company']; ?></span>
                </div> <!-- .location -->
                <div class="contact">
                    <span class="email"><i class="icon-envelope"></i><a href="mailto:<?php echo $person['user']['email']; ?>" title="<?php echo $person['user']['email']; ?>"><?php echo $person['user']['email']; ?></a></span>
                    <span class="mobile"><i class="icon-phone"></i> <?php echo $person['mobile']; ?></a></span>
                </div> <!-- .contact -->
            </div> <!-- .introduction -->
        </div> <!-- .profile -->
        <?php endforeach; ?>
    </div> <!-- #main-content -->
</div> <!-- .row-fluid -->

<!-- Java Script -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/js/md5.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.profile').each(function() {
            var email       = $('.email > a', this).html(),
                hashCode    = md5(email),
                imageObject = $('img', this);
            $.ajax({
                type: 'GET',
                url: 'https://www.gravatar.com/' + hashCode + '.json',
                dataType: 'jsonp',
                success: function(result){
                    if ( result != null ) {
                        var imageUrl    = result['entry'][0]['thumbnailUrl'],
                            requrestUrl = imageUrl + '?s=200';
                        $(imageObject).attr('src', requrestUrl);
                    }
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(window).scroll(function() {
        if ( $(window).width() >= 768 ) {
            if ( $(window).scrollTop() >= 120 ) {
                var sidebarWidth   = parseInt($('#sidebar').css('width'));
                $('#sidebar').css('position', 'fixed');
                $('#sidebar').css('top', 60);
                $('#sidebar').css('width', sidebarWidth);
                $('#main-content').css('margin-left', $('#sidebar').width() + 20);
            } else {
                $('#sidebar').css('position', 'static');
                $('#main-content').css('margin-left', 20);
            }
        }
    });
</script>
<script type="text/javascript">
    $('button', '#filter').click(function() {
        var keyword = $('input', '#filter').val();
        return filterClassmates(keyword);
    });
</script>
<script type="text/javascript">
    function filterClassmates(keyword) {
        $('.profile').each(function() {
            var name        = ('h2', $(this)).html(),
                country     = ('.country', $(this)).html(),
                city        = ('.city', $(this)).html(),
                company     = ('.company', $(this)).html(),
                email       = ('.email', $(this)).html(),
                phone       = ('.phone', $(this)).html();

            if ( name.indexOf(keyword) == -1  && country.indexOf(keyword) == -1 &&
                 city.indexOf(keyword) == -1  && company.indexOf(keyword) == -1 && 
                 email.indexOf(keyword) == -1 && phone.indexOf(keyword) == -1 ) {
                $(this).addClass('hide');
            } else {
                $(this).removeClass('hide');
            }
        });
    }
</script>
