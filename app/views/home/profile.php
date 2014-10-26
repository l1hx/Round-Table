<link href="<?php echo URL::to('/'); ?>/css/home-profile.css" media="screen" rel="stylesheet" type="text/css" />
<div id="hero" class="row-fluid">
    <div id="profile-card" class="span4">
        <a href="http://www.gravatar.com" target="_blank">
            <img src="http://www.gravatar.com/avatar/<?php echo md5(strtolower($profile['email'])); ?>?s=100&d=mm" class="img-circle" alt="avatar" />
        </a>
        <h2><?php echo $profile['username']; ?></h2>
        <p class="live-in">现居<?php echo $profile['country']; ?>, <?php echo $profile['city']; ?></p>
        <p class="work-at">就读/就职于<?php echo $profile['company']; ?></p>
    </div> <!-- #profile-card -->
    <div id="cover" class="span8">
        <img src="<?php echo URL::to('/'); ?>/img/cover.jpg" alt="Cover">
    </div> <!-- #cover -->
</div> <!-- #hero -->
<div id="information">
    <div id="basic-block" class="block left">
        <h2>基本信息<span class="edit"><a href="javascript:void(0);">编辑</a></span></h2>
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
        <a href="javascript:void();">修改密码</a>
        <p class="tip">(您的密码会使用MD5加密存储)</p>
    </div> <!-- #security-block -->
    <div id="contact-block" class="block right">
        <h2>联系信息<span class="edit"><a href="javascript:void(0);">编辑</a></span></h2>
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

<!-- JavaScript -->
<script type="text/javascript">
    $('#basic-block span.edit').click(function() {
        $('#profile-modal').modal({
            'backdrop': 'static'
        });
    });
</script>
<script type="text/javascript">
    $('#security-block a').click(function() {
        $('#password-modal').modal({
            'backdrop': 'static'
        });
    });
</script>
<script type="text/javascript">
    $('#contact-block span.edit').click(function() {
        $('#contact-modal').modal({
            'backdrop': 'static'
        });
    });
</script>

<!-- Modals Start -->
<div id="profile-modal" class="modal hide fade">
    <div class="modal-header">
        <h2>编辑个人资料</h2>
    </div> <!-- .modal-header -->
    <div class="modal-body">
        <div class="row-fluid">
            <div class="span4">所在国家</div>
            <div class="span8"><input id="country" type="text" maxlength="24" value="<?php echo $profile['country']; ?>" /></div>
        </div> <!-- .row-fluid -->
        <div class="row-fluid">
            <div class="span4">所在城市</div>
            <div class="span8"><input id="city" type="text" maxlength="24" value="<?php echo $profile['city']; ?>" /></div>
        </div> <!-- .row-fluid -->
        <div class="row-fluid">
            <div class="span4">所在学校/公司</div>
            <div class="span8"><input id="company" type="text" maxlength="64" value="<?php echo $profile['company']; ?>" /></div>
        </div> <!-- .row-fluid -->
    </div> <!-- .modal-body -->
    <div class="modal-footer">
        <button class="btn btn-primary">确认</button>
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
    </div> <!-- .modal-footer -->
</div> <!-- #profile-modal -->
<div id="password-modal" class="modal hide fade">
    <div class="modal-header">
        <h2>修改密码</h2>
    </div> <!-- .modal-header -->
    <div class="modal-body">
        <div class="row-fluid">
            <div class="span4">旧密码</div>
            <div class="span8"><input id="old-password" type="password" maxlength="16" /></div>
        </div> <!-- .row-fluid -->
        <div class="row-fluid">
            <div class="span4">新密码</div>
            <div class="span8"><input id="new-password" type="password" maxlength="16" /></div>
        </div> <!-- .row-fluid -->
        <div class="row-fluid">
            <div class="span4">确认新密码</div>
            <div class="span8"><input id="confirm-password" type="password" maxlength="16" /></div>
        </div> <!-- .row-fluid -->
    </div> <!-- .modal-body -->
    <div class="modal-footer">
        <button class="btn btn-primary">确认</button>
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
    </div> <!-- .modal-footer -->
</div> <!-- #password-modal -->
<div id="contact-modal" class="modal hide fade">
    <div class="modal-header">
        <h2>编辑联系信息</h2>
    </div> <!-- .modal-header -->
    <div class="modal-body">
        <div class="row-fluid">
            <div class="span4">电子邮件</div>
            <div class="span8"><input id="email" type="text" maxlength="64" value="<?php echo $profile['email']; ?>" /></div>
        </div> <!-- .row-fluid -->
        <div class="row-fluid">
            <div class="span4">移动电话</div>
            <div class="span8"><input id="mobile" type="text" maxlength="16" value="<?php echo $profile['mobile']; ?>" /></div>
        </div> <!-- .row-fluid -->
        <div class="row-fluid">
            <div class="span4">QQ</div>
            <div class="span8"><input id="qq" type="text" maxlength="12" value="<?php echo $profile['qq']; ?>" /></div>
        </div> <!-- .row-fluid -->
    </div> <!-- .modal-body -->
    <div class="modal-footer">
        <button class="btn btn-primary">确认</button>
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
    </div> <!-- .modal-footer -->
</div> <!-- #password-modal -->
<!-- Modals End -->