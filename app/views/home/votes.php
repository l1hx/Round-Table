<link href="<?php echo Helper::cdn('/css/home-votes.css'); ?>" media="screen" rel="stylesheet" type="text/css" />
<link href="<?php echo Helper::cdn('/css/bootstrap.datetimepicker.min.css'); ?>" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo Helper::cdn('/js/raphael-2.1.2.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Helper::cdn('/js/raphael-pie-chart.js'); ?>"></script>
<div class="section-header row-fluid">
    <div class="span8">
        <h1>正在进行的投票</h1>
    </div> <!-- .span8 -->
    <div class="span4">
        <button id="create-vote" class="btn btn-primary">发起新投票</button>
    </div> <!-- .span4 -->
</div> <!-- .row-fluid -->
<div class="row-fluid">
	<div class="span6">
		<div class="vote">
			<h2>投票UI测试#1</h2>
			<ul class="options">
				<li class="option"><input name="vote-1" value="option-1" type="radio" /> 选项A</li>
				<li class="option"><input name="vote-1" value="option-2" type="radio" /> 选项B</li>
				<li class="option"><input name="vote-1" value="option-3" type="radio" /> 选项C</li>
				<li class="option"><input name="vote-1" value="option-4" type="radio" /> 选项D</li>
			</ul>
			<p class="tip">
				<span>(投票后查看结果)</span>
				<button class="btn btn-primary">投票</button>
			</p>
		</div> <!-- .vote -->
	</div> <!-- .span6 -->
	<div class="span6">
		<div class="vote">
			<h2>投票UI测试#2</h2>
			<div id="result" class="vote-result"></div>
			<script type="text/javascript">
				$(function() {
					var values = [10, 20, 30, 40],
				        labels = ['A', 'B', 'C', 'D'];
				    
				    Raphael("result", 200, 200).pieChart(100, 100, 50, values, labels, "#fff");
				});
			</script>
		</div> <!-- .vote -->
	</div> <!-- .span6 -->
</div> <!-- .row-fluid -->

<div class="section-header row-fluid">
    <div class="span8">
        <h1>已经结束的投票</h1>
    </div> <!-- .span8 -->
</div> <!-- .row-fluid -->