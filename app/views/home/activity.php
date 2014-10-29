<link href="<?php echo URL::to('/'); ?>/css/home-activity.css" media="screen" rel="stylesheet" type="text/css" />
<link href="<?php echo URL::to('/'); ?>/css/bootstrap.datetimepicker.min.css" media="screen" rel="stylesheet" type="text/css">
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
<div id="new-activity" class="modal fade hide">
    <div class="modal-header">
        <h2>创建新活动</h2>
    </div> <!-- .modal-header -->
    <div class="modal-body">
        <div class="alert alert-error hide"></div> <!-- .alert-error -->
        <div class="row-fluid">
            <div class="span4">
                <label for="activity-name">活动名称</label>
            </div> <!-- .span4 -->
            <div class="span8">
                <input id="activity-name" class="span12" type="text" maxlength="32" />
            </div> <!-- .span8 -->
        </div> <!-- .row-fluid -->
        <div class="row-fluid">
            <div class="span4">
                <label for="start-time">活动开始时间</label>
            </div> <!-- .span4 -->
            <div class="span8">
                <div class="controls input-append date form_datetime" data-date-format="yyyy-mm-dd hh:ii">
                    <input id="start-time" class="span12" type="text" value="" readonly>
                    <span class="add-on"><i class="icon-th"></i></span>
                </div> <!-- .input-append -->
            </div> <!-- .span8 -->
        </div> <!-- .row-fluid -->
        <div class="row-fluid">
            <div class="span4">
                <label for="end-time">活动结束时间</label>
            </div> <!-- .span4 -->
            <div class="span8">
                <div class="controls input-append date form_datetime" data-date-format="yyyy-mm-dd hh:ii">
                    <input id="end-time" class="span12" type="text" value="" readonly>
                    <span class="add-on"><i class="icon-th"></i></span>
                </div> <!-- .input-append -->
            </div> <!-- .span8 -->
        </div> <!-- .row-fluid -->
        <div class="row-fluid">
            <div class="span4">
                <label for="place">活动地点</label>
            </div> <!-- .span4 -->
            <div class="span8">
                <input id="place" class="span12" type="text" maxlength="128" />
            </div> <!-- .span8 -->
        </div> <!-- .row-fluid -->
        <div class="row-fluid">
            <div class="span4">
                <label for="detail">详细说明</label>
            </div> <!-- .span4 -->
            <div class="span8">
                <textarea id="detail" class="span12" rows="5"></textarea>
            </div> <!-- .span8 -->
        </div> <!-- .row-fluid -->
    </div> <!-- .modal-body -->
    <div class="modal-footer">
        <button class="btn btn-primary">确认</button>
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
    </div> <!-- .modal-footer -->
</div> <!-- #new-activity -->
<div id="activity-detail" class="modal fade hide">
    <div class="modal-header">
        <h2>活动详细信息</h2>
    </div> <!-- .modal-header -->
    <div class="modal-body">
        <div class="row-fluid">
            <div id="amap" class="span12"></div> <!-- #amap -->
        </div> <!-- .row-fluid -->
        <div class="row-fluid">
            <div class="span8">
                <h3>活动概况</h3>
                <p><i class="icon-user"></i> <span class="sponsor"></span></p>
                <p><i class="icon-calendar"></i> <span class="time"></span></p>
                <p><i class="icon-map-marker"></i> <span class="place"></span></p>
                <h3>详细说明</h3>
                <p class="detail"></p>
            </div> <!-- .span8 -->
            <div class="span4">
                <h3>参与者名单</h3>
                <ul class="participants inline"></ul>
            </div> <!-- .span4 -->
        </div> <!-- .row-fluid -->
    </div> <!-- .modal-body -->
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
    </div> <!-- .modal-footer -->
</div> <!-- #activity-detail -->

<!-- JavaScript -->
<script type="text/javascript">
    $('button.pull-right').click(function() {
        $('#new-activity input').val('');
        $('#new-activity textarea').val('');

        $('#new-activity').modal({
            'backdrop': 'static'
        });
    });
</script>
<script type="text/javascript">
    $('.btn-primary', '#new-activity').click(function() {
        var buttonObject = $(this),
            modalObject  = $('#new-activity'),
            activityName = $('#activity-name', modalObject).val(),
            startTime    = $('#start-time', modalObject).val(),
            endTime      = $('#end-time', modalObject).val(),
            place        = $('#place', modalObject).val(),
            detail       = $('#detail', modalObject).val(),
            postData     = {
                'activityName': activityName,
                'startTime'   : startTime,
                'endTime'     : endTime,
                'place'       : place,
                'detail'      : detail
            };

        $(buttonObject).html('正在处理...');
        $(buttonObject).attr('disabled', 'disabled');

        $.ajax({
            type: 'POST',
            url: '<?php echo URL::to('/'); ?>/home/createActivityAction',
            data: postData,
            dataType: 'JSON',
            success: function(result){
                if ( result['isSuccessful'] ) {
                    getPageContent('activity');
                    $(modalObject).modal('hide');
                } else {
                    var errorMessage  = '';
                    if ( result['isActivityNameEmpty'] ) {
                        errorMessage += '请填写活动名称.<br />';
                    } else if ( !result['isActivityNameLegal'] ) {
                        errorMessage += '活动名称的长度不能超过32个字符.<br />';
                    }
                    if ( result['isStartTimeEmpty'] ) {
                        errorMessage += '请填写活动开始时间.<br />';
                    } else if ( !result['isStartTimeLegal'] ) {
                        errorMessage += '活动开始时间不得早于当前时间.<br />';
                    }
                    if ( result['isEndTimeEmpty'] ) {
                        errorMessage += '请填写活动结束时间.<br />';
                    } else if ( !result['isEndTimeLegal'] ) {
                        errorMessage += '活动结束时间不得早于活动开始时间.<br />';
                    }
                    if ( result['isPlaceEmpty'] ) {
                        errorMessage += '请填写活动地点.<br />';
                    } else if ( !result['isPlaceLegal'] ) {
                        errorMessage += '活动地点的长度不得超过128个字符.<br />';
                    }
                    if ( result['isDetailEmpty'] ) {
                        errorMessage += '请填写活动详细说明.<br />';
                    }
                    $('.alert-error', modalObject).html(errorMessage);
                    $('.alert-error', modalObject).removeClass('hide');
                }

                $(buttonObject).html('确认');
                $(buttonObject).removeAttr('disabled');
            }
        });
    });
</script>
<script type="text/javascript">
    $('a', '.activity .attendance').click(function() {
        var triggerObject   = $(this),
            isAttend        = ($(this).parent().attr('class') == 'accept' ? 1 : 0),
            activityObject  = $(this).parent().parent().parent().parent(),
            activityId      = activityObject.attr('id').substring(9),
            participants    = parseInt($('.participants', activityObject).html(), 10);

        $.ajax({
            type: 'GET',
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
<script type="text/javascript">
    $('.detail > a').click(function() {
        var activityObject  = $(this).parent().parent().parent().parent(),
            activityId      = activityObject.attr('id').substring(9)
        
        return getActivityDetail(activityId);
    });
</script>
<script type="text/javascript">
    function getActivityDetail(activityId) {
        $.ajax({
            type: 'GET',
            url: '<?php echo URL::to('/'); ?>/home/getActivityAction?activityId=' + activityId,
            dataType: 'JSON',
            success: function(result) {
                if ( result['isSuccessful'] ) {
                    displayActivityDetail(result);
                } else {
                    alert('发生了未知错误, 请重试.');
                }
            }
        });
    }
</script>
<script type="text/javascript">
    function displayActivityDetail(result) {
        $('.sponsor', '#activity-detail').html(result['activity']['sponsor']);
        $('.time', '#activity-detail').html(getDateTime(result['activity']['start_time']) + '~' + getDateTime(result['activity']['end_time']));
        $('.place', '#activity-detail').html(result['activity']['place']);
        
        if ( result['activity']['detail'] ) {
            $('.detail', '#activity-detail').html(result['activity']['detail']);
        } else {
            $('.detail', '#activity-detail').html('暂无对活动的详细说明.');
        }
        
        $('.participants', '#activity-detail').empty();
        var numberOfParticipants = result['activity']['attendance'].length;
        for ( var i = 0; i < numberOfParticipants; ++ i ) {
            $('.participants', '#activity-detail').append('<li>' + result['activity']['attendance'][i]['username'] + '</li>');
        }
        searchPlace(result['activity']['place']);
        $('#activity-detail').modal();
    }
</script>
<script type="text/javascript">
    function getDateTime(dateTimeString) {
        var year    = dateTimeString.substr(0, 4),
            month   = dateTimeString.substr(5, 2),
            day     = dateTimeString.substr(8, 2),
            hour    = dateTimeString.substr(11, 2),
            minute  = dateTimeString.substr(14, 2);
        return year + '年' + month + '月' + day + '日 ' + hour + ':' + minute;
    }
</script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/js/bootstrap.datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/js/bootstrap.datetimepicker.zh-CN.js"></script>
<script type="text/javascript">
    function initializeDateTimePicker() {
        $('.form_datetime').datetimepicker({
            language:  'zh-CN',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            startDate: '<?php echo date('Y-m-d H:i:s');?>',
            forceParse: 0,
            showMeridian: 1
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        initializeDateTimePicker();
    });
</script>
<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=c8217ee6277393d58ee271ca70288e66&callback=initializeMap"></script>
<script type="text/javascript">
    var mapObject   = null,
        markers     = new Array(),
        windows     = new Array();
    
    function initializeMap() {
        mapObject = new AMap.Map("amap");
    }

    function searchPlace(address) {
        var MSearch;

        mapObject.clearMap();
        mapObject.plugin(["AMap.PlaceSearch"], function() {       
            MSearch = new AMap.PlaceSearch({
                pageSize: 10,
                pageIndex: 1,
                city: "0571"
            });
            AMap.event.addListener(MSearch, "complete", searchByKeyword);
            MSearch.search(address);
        });
    }

    function addMarkers(i, d) {
        var lngX = d.location.getLng();
        var latY = d.location.getLat();
        var markerOption = {
            map: mapObject,
            icon: "http://webapi.amap.com/images/" + (i + 1) + ".png",
            position: new AMap.LngLat(lngX, latY),
            topWhenClick: true
        };
        var marker = new AMap.Marker(markerOption);
        markers.push(new AMap.LngLat(lngX, latY));
     
        var infoWindow = new AMap.InfoWindow({
            content: "<h3><font color=\"#00a6ac\">  " + (i + 1) + ". " + d.name + "</font></h3>" + getTipContents(d.type, d.address, d.tel),
            size: new AMap.Size(300, 0),
            autoMove: true, 
            offset: new AMap.Pixel(0,-20)
        });
        windows.push(infoWindow);
        var aa = function (e) { infoWindow.open(mapObject, marker.getPosition()); };
        AMap.event.addListener(marker, "click", aa);
    }

    function searchByKeyword(data) {
        var points      = data.poiList.pois,
            resultCount = points.length;
        for (var i = 0; i < resultCount; i++) {
            addMarkers(i, points[i]);
        }
        mapObject.setFitView();
    }

    function getTipContents(type, address, tel) {
        if (type == "" || type == "undefined" || type == null || type == " undefined" || typeof type == "undefined") {
            type = "暂无";
        }
        if (address == "" || address == "undefined" || address == null || address == " undefined" || typeof address == "undefined") {
            address = "暂无";
        }
        if (tel == "" || tel == "undefined" || tel == null || tel == " undefined" || typeof address == "tel") {
            tel = "暂无";
        }
        var str = "  地址：" + address + "<br />  电话：" + tel + " <br />  类型：" + type;
        return str;
    }
</script>