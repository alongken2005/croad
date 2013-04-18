<?php $this->load->view(THEME.'/header');?>
<link rel="stylesheet" type="text/css" href="<?=THEME_VIEW?>/css/single.css"/>
<div class="box">
	<div class="iland" style="margin-top: 90px;"></div>
	<div class="single_top">
		<div class="single_t1"></div>
		<div class="single_intro">据美联社报道，一名执法官员说，波士顿地区手机服务已经被关闭，以防止任何潜在的远程引爆炸药。据美国媒体报道，当地时间15日下午，美国波士顿地区连续发生三起爆炸，目前至少已造成2人死亡据美联社报道，一名执法官员说，波士顿地区手机服务已经被关闭，以防止任何潜在的远程引爆炸药。据美国媒体报道，当地时间15日下午，美国波士顿地区连续发生三起爆炸，目前至少已造成2人死亡据美联社报道，一名执法官员说，波士顿地区手机服务已经被关闭，以防止任何潜在的远程引爆炸药。据美国媒体报道，当地时间15日下午，美国波士顿地区连续发生三起爆炸</div>
		<div class="clear"></div>
		<div class="right">
			<div class="price">
				<span>￥208.00</span><br>
				市场价:￥<b>300.00</b>
			</div>
			<a href="<?=site_url('single/check?id=1')?>" class="buy">节省￥92（7折）免费送货</a>
		</div>
	</div>
	<div class="single_bottom"></div>

	<div class="single_list png"></div>
	<div class="single_suit">
		<div class="corner"></div>
	<?php $count = count($lists); foreach($lists as $k=>$v) {?>
		<div class="li">
			<img src="<?=base_url(get_thumb($v['cover']))?>" class="img"/>
		</div>
		<div class="single_summary">
			<div class="word">
				<h2><?=$v['title']?></h2>
				<div class="author">
					<?php
					if($v['author1']) { echo "作者：".$v['author1'];}
					if($v['author2']) { echo "&nbsp;&nbsp;&nbsp;插图作者：".$v['author2'];}
					if($v['author3']) { echo "&nbsp;&nbsp;&nbsp;译者：".$v['author3'];}
					?>
				</div>
				<div class="intro"><?=$v['intro']?></div>
			</div>
			<div class="pic">
				<img src="<?=base_url(get_thumb($v['pic1']))?>"/>
				<img src="<?=base_url(get_thumb($v['pic2']))?>"/>
			</div>
		</div>
		<?php if(($k+1)%3 == 0 || ($k+1) == $count) {?>
		<div class="clear"></div>
		<div class="summary"></div>
	<?php }}?>
	</div>
</div>
<script type="text/javascript">

</script>
<table cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td class="bottom_left" width="50%"></td>
		<td class="bottom_center">
			<div class="box" style="text-align: center; font-family: '微软雅黑'; font-size: 20px; font-weight: 600; margin-top: 30px;"><a href="<?=base_url()?>" target="_blank" style="color: #3399CC;">成为儿童之路会员，有机会参加更多活动！ </a></div>
		</td>
		<td class="bottom_right" width="50%"></td>
	</tr>
</table>
<div class="scrollable-trigger"></div>

<!--[if IE 6]>
<script type="text/javascript" src="<?=base_url('./common/js/fixpng-min.js')?>"></script>
<script type="text/javascript">
DD_belatedPNG.fix('.png, .browse');
</script>
<![endif]-->

<script type="text/javascript">

	$(function() {
		$('.single_suit .li').click(function() {
			$('.single_summary').slideUp('fast');
			var obj = $(this).nextAll('.summary').first();
			obj.html($(this).next('.single_summary').clone());
			var li = $(this);
			obj.find('.single_summary').slideDown('fast', function() {
				var offset = li.offset();
				$('.single_suit .corner').offset({top: offset.top+300, left: offset.left+130});
			});
		})
	})

	$(window).load(function() {
		$('.single_suit .li').first().click();
	})

	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-26645818-3']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>
<?php $this->load->view(THEME.'/footer');?>