<link href="<?php echo URL::to('/'); ?>/css/home-profile.css" media="screen" rel="stylesheet" type="text/css" />
<div id="hero">
    <div id="profile-card" class="pull-left">
        <img src="<?php echo URL::to('/'); ?>/img/avatar-large.png" class="img-circle" alt="avatar" />
        <h2><?php echo $profile['username']; ?></h2>
        <p class="live-in">现居<?php echo $profile['country']; ?>, <?php echo $profile['city']; ?></p>
        <p class="work-at">就读/就职于<?php echo $profile['company']; ?></p>
    </div> <!-- #profile-card -->
    <div id="cover" class="pull-right">
        <img src="<?php echo URL::to('/'); ?>/img/cover.jpg" alt="Cover">
    </div> <!-- #cover -->
</div> <!-- #hero -->
<div id="information">
    <div id="basic-block" class="block left">
        <h2>基本信息<span class="edit"><a href="javascript:editProfile();">编辑</a></span></h2>
        <div class="row-fluid">
            <div class="span4">姓名</div>
            <div class="span8"><?php echo $profile['username']; ?></div>
        </div> <!-- .row -->
        <div class="row-fluid">
            <div class="span4">生日</div>
            <div class="span8"><?php echo date('Y年m月d日', strtotime($profile['birthday'])); ?></div>
        </div> <!-- .row -->
        <div class="row-fluid">
            <div class="span4">所在国家</div>
            <div class="span8"><?php echo $profile['country']; ?></div>
        </div> <!-- .row -->
        <div class="row-fluid">
            <div class="span4">所在城市</div>
            <div class="span8"><?php echo $profile['city']; ?></div>
        </div> <!-- .row -->
        <div class="row-fluid">
            <div class="span4">所在学校/公司</div>
            <div class="span8"><?php echo $profile['company']; ?></div>
        </div> <!-- .row -->
    </div> <!-- .block -->
    <div id="tip-block" class="block right">
        <h4>及时更新个人信息</h4>
        <p>您上次更新的时间是: 未知</p>
    </div> <!-- .block -->
    <div id="security-block" class="block left">
        <h2>账户安全</h2>
        <a href="javascript:changePassword();">修改密码</a>
        <p class="tip">(您的密码会使用MD5加密存储)</p>
    </div> <!-- #security-block -->
    <div id="contact-block" class="block right">
        <h2>联系信息<span class="edit"><a href="javascript:editContact();">编辑</a></span></h2>
        <div class="row-fluid">
            <div class="span4">电子邮件</div>
            <div class="span8"><?php echo $profile['email']; ?></div>
        </div> <!-- .row -->
        <div class="row-fluid">
            <div class="span4">移动电话</div>
            <div class="span8"><?php echo $profile['mobile']; ?></div>
        </div> <!-- .row -->
        <div class="row-fluid">
            <div class="span4">QQ</div>
            <div class="span8"><?php echo $profile['qq']; ?></div>
        </div> <!-- .row -->
    </div> <!-- .block -->
</div> <!-- #information -->