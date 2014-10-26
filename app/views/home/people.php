<link href="<?php echo URL::to('/'); ?>/css/home-people.css" media="screen" rel="stylesheet" type="text/css" />
<div class="row-fluid">
    <div id="sidebar" class="span3">
        Search not Implemented
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
                    <span class="email"><i class="icon-envelope"></i> <a href="mailto:<?php echo $person['user']['email']; ?>" title="<?php echo $person['user']['email']; ?>"><?php echo $person['user']['email']; ?></a></span>
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
    });
</script>
