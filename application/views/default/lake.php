<?php $this->load->view(THEME.'/header');?>
<div class="box">
	<div class="iland" style="margin-top: 95px;"></div>
	<div class="lake_focus">
		<div class="lake_menu">
			<a href="" class="sp_index lake_tab_a"></a>
			<a href="" class="sp_index lake_tab_b"></a>
			<a href="" class="sp_index lake_tab_c"></a>
			<a href="" class="sp_index lake_tab_d"></a>
			<a href="" class="sp_index lake_tab_e"></a>
			<a href="" class="sp_index lake_tab_f"></a>
		</div>
		<div class="focus"></div>
		<div class="intro">
			<div class="title sp_index"></div>
			<div class="content"></div>
		</div>
	</div>
	<div class="single_bottom2"></div>

	<div id="lake_tab_a">
		<div class="title"><span class="sp_index"></span></div>

		<div class="content clearfix">
			<div class="scrollable-panel">
				<div class="clearfix cn">
					<div class="screen">
				<?php
					$i=1;
					foreach($toplist as $v):
						if($i%7==0) echo '</div><div class="screen">';
				?>
					<div class="li">
						<img src="<?=base_url(get_thumb($v['cover']))?>"/>
						<div class="clearfix">
							<span class="a1"><?=$v['title']?></span>
							<span class="a2">时长：<?=$i?></span>
						</div>
						<div class="clearfix">
							<span class="a3">作者：</span>
							<span class="a4">浏览量：</span>
						</div>
					</div>
				<?php
					$i++;
					endforeach;
				?>
					</div>
				</div>
			</div>
			<div class="trigger-bar">
				<a href="javascript:void(0);" title="下翻" class="next"></a>
				<a href="javascript:void(0);" title="上翻" class="prev"></a>
				<div class="scrollable-trigger"></div>
			</div>
		</div>
	</div>
</div>
<table cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td class="bottom_left" width="50%"></td>
		<td class="bottom_center">
			<div class="box" style="text-align: center; font-family: '微软雅黑'; font-size: 20px; font-weight: 600; margin-top: 30px;"><a href="<?=base_url()?>" target="_blank" style="color: #3399CC;">成为儿童之路会员，有机会参加更多活动！ </a></div>
		</td>
		<td class="bottom_right" width="50%"></td>
	</tr>
</table>
<script type="text/javascript">
$(function(){
	window.api = $(".scrollable-trigger").switchable(".scrollable-panel .screen", {
		triggerType: "click",
		effect: "scroll",
		steps: 1,
		visible: 1,
		api: true
	});
	$(".next").click(function(){
		api.next();
	});
	$(".prev").click(function(){
		api.prev();
	});

});
</script>
<!--[if IE 6]>
<script type="text/javascript" src="<?=base_url('./common/js/fixpng-min.js')?>"></script>
<script type="text/javascript">
DD_belatedPNG.fix('.png, .browse');
</script>
<![endif]-->
<?php $this->load->view(THEME.'/footer');?>