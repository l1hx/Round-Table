<link href="<?php echo URL::to('/'); ?>/css/home-people.css" media="screen" rel="stylesheet" type="text/css" />
<h1>人脉圈</h1>
<p class="slogan">也许我们身处异处, 但我们紧紧相依.</p>
<ul id="people" class="thumbnails">
<?php foreach ( $people as $person ): ?>
	<li class="span2">
		<div class="thumbnail">
			<div class="avatar">
				<img src="http://www.gravatar.com/avatar/<?php echo md5(strtolower($person['user']['email'])); ?>?s=200&d=mm" alt="avatar">
			</div> <!-- .avatar -->
			<div class="introduction">
				<h3><?php echo $person['username']; ?></h3>
				<div class="location">
					<span class="country"><?php echo $person['country']; ?></span>
					<span class="city"><?php echo $person['city']; ?></span><br />
					<span class="company"><?php echo $person['company']; ?></span><br />
				</div> <!-- .location -->
				<div class="contact">
					<span class="email"><i class="icon-envelope"></i> <a href="mailto:<?php echo $person['user']['email']; ?>" title="<?php echo $person['user']['email']; ?>"><?php echo $person['user']['email']; ?></a></span><br />
					<span class="mobile"><i class="icon-phone"></i> <?php echo $person['mobile']; ?></a></span><br />
				</div> <!-- .contact -->
			</div> <!-- .introduction -->
		</div> <!-- .thumbnail -->
	</li>
<?php endforeach; ?>
</ul> <!-- #people -->