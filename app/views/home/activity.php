<link href="<?php echo URL::to('/'); ?>/css/home-activity.css" media="screen" rel="stylesheet" type="text/css" />
<!-- Upcoming Activities -->
<h1>即将开始的活动<button class="btn btn-primary pull-right">创建新活动</button></h1>
<?php if ( $activity['upcomingActivities']->count() ): ?>
    <?php 
        $counter = 0;
        foreach ( $activity['upcomingActivities'] as $upcomingActivity ): 
    ?>
    <?php if ( $counter % 2 == 0 ): ?>
        <div class="row-fluid">
    <?php endif; ?>
            <div class="span6 activity">
                <div class="image">
                    <img src="<?php echo URL::to('/') ;?>/img/activities/activity-<?php echo rand(1, 5); ?>.gif" alt="Activity Image" />
                </div> <!-- .activity-image -->
                <div class="detail">
                    <h2><?php echo $upcomingActivity->activity_name; ?><span class="detail pull-right"><a href="javascript:void(0)">详细信息</a></span></h2>
                    <div class="row-fluid">
                        <div class="span12">
                            <i class="icon-calendar"></i>
                            <span class="time"><?php echo date('Y年m月d日 H:i', strtotime($upcomingActivity->start_time)); ?>~<?php echo date('Y年m月d日 H:i', strtotime($upcomingActivity->end_time)); ?></span>
                        </div>
                    </div> <!-- .row-fluid -->
                    <div class="row-fluid">
                        <div class="span12">
                            <i class="icon-map-marker"></i>
                            <span class="place"><?php echo $upcomingActivity->place; ?></span>
                        </div>
                    </div> <!-- .row-fluid -->
                </div> <!-- .activity-detail -->
                <div class="attendance">
                    <h3>是否参加? <span class="pull-right">已有<?php echo $upcomingActivity->attendance()->count(); ?>人报名</span></h3>
                    <p>
                        <?php if ( $upcomingActivity->attendance()->where('username', '=', $activity['username'])->count() ): ?>
                            <span>您已报名参加本次活动.</span>
                        <?php else: ?>
                            
                        <?php endif; ?>
                    </p>
                </div> <!-- .attendance -->
            </div> <!-- .activity -->
    <?php if ( ++ $counter % 2 == 0 ): ?>
        </div> <!-- .row-fluid -->
    <?php endif; ?>
    <?php endforeach; ?>
    <?php if ( $counter % 2 != 0 ): ?>
        </div> <!-- .row-fluid -->
    <?php endif; ?>
<?php else: ?>
    <div class="alert alert-warning">暂时没有新的活动.</div> <!-- .alert-info -->
<?php endif; ?>

<!-- Past Activities -->
<?php if ( $activity['pastActivities']->count() ): ?>
    <h1>已经结束的活动</h1>
    <?php 
        $counter = 0;
        foreach ( $activity['pastActivities'] as $pastActivity ): 
    ?>
    <?php if ( $counter % 2 == 0 ): ?>
        <div class="row-fluid">
    <?php endif; ?>
            <div id="activity-<?php echo $pastActivity->activity_id;?>" class="span6 activity">
                <div class="image">
                    <img src="<?php echo URL::to('/') ;?>/img/activities/activity-<?php echo rand(1, 5); ?>.gif" alt="Activity Image" />
                </div> <!-- .activity-image -->
                <div class="detail">
                    <h2><?php echo $pastActivity->activity_name; ?><span class="detail pull-right"><a href="javascript:void(0)">详细信息</a></span></h2>
                    <div class="row-fluid">
                        <div class="span12">
                            <i class="icon-calendar"></i>
                            <span class="time"><?php echo date('Y年m月d日 H:i', strtotime($pastActivity->start_time)); ?>~<?php echo date('Y年m月d日 H:i', strtotime($pastActivity->end_time)); ?></span>
                        </div>
                    </div> <!-- .row-fluid -->
                    <div class="row-fluid">
                        <div class="span12">
                            <i class="icon-map-marker"></i>
                            <span class="place"><?php echo $pastActivity->place; ?></span>
                        </div>
                    </div> <!-- .row-fluid -->
                </div> <!-- .activity-detail -->
                <div class="attendance">
                    <p>
                    <?php if ( $pastActivity->attendance()->where('username', '=', $activity['username'])->count() ): ?>
                        <span>您参加了本次活动.</span>
                    <?php else: ?>
                        <span>您尚未参加本次活动.</span>
                    <?php endif; ?>
                        <span>总计有<?php echo $pastActivity->attendance()->count(); ?>人参加了本次活动.</span>
                    </p>
                </div> <!-- .attendance -->
            </div> <!-- .activity -->
    <?php if ( ++ $counter % 2 == 0 ): ?>
        </div> <!-- .row-fluid -->
    <?php endif; ?>
    <?php endforeach; ?>
    <?php if ( $counter % 2 != 0 ): ?>
        </div> <!-- .row-fluid -->
    <?php endif; ?>
<?php endif; ?>

<!-- Modals -->