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
            <div id="activity-<?php echo $upcomingActivity->activity_id;?>" class="span6 activity">
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
                <?php 
                    $attendance = $upcomingActivity->attendance()->where('activity_attendance.username', '=', $activity['username'])->first();
                    if ( $attendance != null && $attendance->pivot->is_attend ): 
                ?>
                    <span>您已报名参加本次活动.</span>
                <?php elseif ( $attendance != null && !$attendance->pivot->is_attend ): ?>
                    <span>您已确认不参加本次活动.</span>
                <?php else: ?>
                    <ul class="inline">
                        <li class="accept"><a href="javascript:void(0);">参加</a></li>
                        <li class="reject"><a href="javascript:void(0);">不参加</a></li>
                    </ul>
                <?php endif; ?>
                    <span class="pull-right">已有<span class="participants"><?php echo $upcomingActivity->attendance()->where('is_attend', '=', 1)->count(); ?></span>人报名</span>
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
                    <?php if ( $pastActivity->attendance()->where('activity_attendance.username', '=', $activity['username'])->where('is_attend', '=', 1)->count() ): ?>
                        <span>您参加了本次活动.</span>
                    <?php else: ?>
                        <span>您尚未参加本次活动.</span>
                    <?php endif; ?>
                        <span>总计有<?php echo $pastActivity->attendance()->where('is_attend', '=', 1)->count(); ?>人参加了本次活动.</span>
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

<!-- JavaScript -->
<script type="text/javascript">
    $('a', '.activity .attendance').click(function() {
        var triggerObject   = $(this),
            isAttend        = ($(this).parent().attr('class') == 'accept' ? 1 : 0),
            activityObject  = $(this).parent().parent().parent().parent(),
            activityId      = activityObject.attr('id').substring(9)
            participants    = parseInt($('.participants', activityObject).html(), 10);

        $.ajax({
            type: 'GET',
            async: false,
            url: '<?php echo URL::to('/'); ?>/home/attendActivityAction?activityId=' + activityId + '&isAttend=' + isAttend,
            dataType: 'JSON',
            success: function(result){
                if ( result['isSuccessful'] ) {
                    if ( isAttend ) {
                        $('ul.inline', activityObject).html('<li>您已报名参加本次活动.</li>');
                        $('.participants', activityObject).html(participants + 1);
                    } else {
                        $('ul.inline', activityObject).html('<li>您已确认不参加本次活动.</li>');
                    }
                } else {
                    alert('发生了未知错误, 请重试.');
                }
            }
        });
    });
</script>