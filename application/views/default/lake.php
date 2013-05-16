<?php $this->load->view(THEME.'/header');?>
<script type="text/javascript" src="<?=THEME_VIEW?>/js/slide.js"></script>
<link rel="stylesheet" type="text/css" href="<?=THEME_VIEW?>/css/lake.css"/>
<div class="box">
	<div class="iland" style="margin-top: 95px;"></div>
	<div class="lake_focus">
		<div class="lake_menu">
			<a href="#m1">文件通知</a>
			<a href="#m2">儿童阅读</a>
			<a href="#m2">班级读书会</a>
			<a href="#m4">故事妈妈</a>
			<a href="">新作文联盟</a>
			<a href="">国学经典</a>
		</div>
		<div class="focus clearfix">
			<div class="panel_box" >
				<ul>
					<?php foreach($piclist as $v):?>
					<li>
						<a href="">
							<img src="<?=get_thumb($v['filename'], false)?>" />
						</a>
					</li>
					<?php endforeach;?>
				</ul>
			</div>
			<div class="num">
				<span></span>
				<?php foreach($piclist as $k=>$v):?>
				<a href="javascript:void(0)"><img src="<?=get_thumb($v['filename'])?>"/></a>
				<?php endforeach;?>
			</div>
		</div>

<script type="text/javascript">
    slidshow($('.focus'), true);
</script>
		<div class="intro">
			<div class="title sp_index"></div>
			<div class="content">
				运河儿童电影院是由浙江省杭州市拱墅区文化广电新闻出版局与中国儿童少年电影学会、浙江儿童阅读推广研究中心、中国儿童之路数字图书馆共同合作，是一个专门为青少年儿童而设的，以儿童电影和儿童剧为主的电影院。运河儿童电影院将通过观赏影片与开展形式多样的鉴赏、影评、摄影、导演等知识讲座相结合的活动模式，培养少年儿童的审美情趣和鉴赏能力，提高少年儿童的文化艺术修养。旨在为广大的青少年儿童提供一个休闲娱乐与学习研究于一体的场所。
			</div>
		</div>
	</div>
	<div class="single_bottom2"></div>

	<div id="lake_tab_a">
		<div class="title clearfix" id="m1">
			<span><a href="">教学设计</a></span>
			<span><a href="">名师讲堂</a></span>
		</div>
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
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="img" target="_blank"><img src="<?=get_thumb($v['cover'])?>"/></a>
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="a1" target="_blank"><?=$v['title']?>
							<?php if($v['gname']):?><b>[<?=$v['gname']?>]</b><?php endif;?>
						</a>
						作者：<?=$v['name']?>&nbsp;&nbsp;&nbsp;浏览量：<?=$v['hits']?>
					</div>
				<?php
					$i++;
					endforeach;
				?>
					</div>
				</div>
			</div>
			<div class="trigger-bar">
				<a href="javascript:void(0);" title="上翻" class="prev"></a>
				<div class="scrollable-trigger"></div>
				<a href="javascript:void(0);" title="下翻" class="next"></a>
			</div>
			<a href="<?=site_url('lake/search?type=1')?>" class="more sp_index" target="_blank">更多内容 &raquo;</a>
		</div>
		<div class="single_bottom3"></div>
	</div>

	<div id="lake_tab_b">
		<div class="tab clearfix" id="m2">
			<span class="current"><a href="javascript:void(0)">儿童阅读</a></span>
			<span><a href="javascript:void(0)">班级读书会</a></span>
			<span><a href="javascript:void(0)">故事妈妈</a></span>
			<span><a href="javascript:void(0)">新作文联盟</a></span>
			<span><a href="javascript:void(0)">国学经典</a></span>
		</div>
		<div class="content0 clearfix contentbox" >
			<div class="scrollable-panel">
				<div class="clearfix cn">
				<?php
					foreach($lakeCread as $v):
				?>
					<div class="li">
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="img" target="_blank"><img src="<?=get_thumb($v['cover'])?>"/></a>
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="a1" target="_blank"><?=$v['title']?>
							<?php if($v['gname']):?><b>[<?=$v['gname']?>]</b><?php endif;?>
						</a>
						作者：<?=$v['name']?>&nbsp;&nbsp;&nbsp;浏览量：<?=$v['hits']?>
					</div>
				<?php
					endforeach;
				?>
				</div>
			</div>
			<a href="<?=site_url('lake/search?type=2')?>" class="more sp_index" target="_blank">更多内容 &raquo;</a>
		</div>

		<div class="content1 clearfix contentbox" style="display: none">
			<div class="scrollable-panel">
				<div class="clearfix cn">
				<?php
					foreach($lakeClass as $v):
				?>
					<div class="li">
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="img" target="_blank"><img src="<?=get_thumb($v['cover'])?>"/></a>
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="a1" target="_blank"><?=$v['title']?>
							<?php if($v['gname']):?><b>[<?=$v['gname']?>]</b><?php endif;?>
						</a>
						作者：<?=$v['name']?>&nbsp;&nbsp;&nbsp;浏览量：<?=$v['hits']?>
					</div>
				<?php
					endforeach;
				?>
				</div>
			</div>
			<a href="<?=site_url('lake/search?type=3')?>" class="more sp_index" target="_blank">更多内容 &raquo;</a>
		</div>

		<div class="content2 clearfix contentbox" style="display: none">
			<div class="scrollable-panel">
				<div class="clearfix cn">
				<?php
					foreach($lakeStory as $v):
				?>
					<div class="li">
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="img" target="_blank"><img src="<?=get_thumb($v['cover'])?>"/></a>
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="a1" target="_blank"><?=$v['title']?>
							<?php if($v['gname']):?><b>[<?=$v['gname']?>]</b><?php endif;?>
						</a>
						作者：<?=$v['name']?>&nbsp;&nbsp;&nbsp;浏览量：<?=$v['hits']?>
					</div>
				<?php
					endforeach;
				?>
				</div>
			</div>
			<a href="<?=site_url('lake/search?type=3')?>" class="more sp_index" target="_blank">更多内容 &raquo;</a>
		</div>
		<div class="content3 clearfix contentbox" style="display: none">
			<div class="scrollable-panel">
				<div class="clearfix cn">
				<?php
					foreach($lakeStory as $v):
				?>
					<div class="li">
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="img" target="_blank"><img src="<?=get_thumb($v['cover'])?>"/></a>
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="a1" target="_blank"><?=$v['title']?>
							<?php if($v['gname']):?><b>[<?=$v['gname']?>]</b><?php endif;?>
						</a>
						作者：<?=$v['name']?>&nbsp;&nbsp;&nbsp;浏览量：<?=$v['hits']?>
					</div>
				<?php
					endforeach;
				?>
				</div>
			</div>
			<a href="<?=site_url('lake/search?type=3')?>" class="more sp_index" target="_blank">更多内容 &raquo;</a>
		</div>
		<div class="content4 clearfix contentbox" style="display: none">
			<div class="scrollable-panel">
				<div class="clearfix cn">
				<?php
					foreach($lakeStory as $v):
				?>
					<div class="li">
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="img" target="_blank"><img src="<?=get_thumb($v['cover'])?>"/></a>
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="a1" target="_blank"><?=$v['title']?>
							<?php if($v['gname']):?><b>[<?=$v['gname']?>]</b><?php endif;?>
						</a>
						作者：<?=$v['name']?>&nbsp;&nbsp;&nbsp;浏览量：<?=$v['hits']?>
					</div>
				<?php
					endforeach;
				?>
				</div>
			</div>
			<a href="<?=site_url('lake/search?type=3')?>" class="more sp_index" target="_blank">更多内容 &raquo;</a>
		</div>
		<div class="single_bottom3"></div>
	</div>

	<div id="lake_tab_c">
		<div class="title sp_index" id="m4"></div>
		<div class="content clearfix">
			<a href="javascript:void(0);" title="上翻" class="prev"></a>
			<div class="scrollable-panel">
				<div class="clearfix cb">
					<div class="screen">
				<?php
					$i=1;
					foreach($authorlist as $v):
						if($i%9==0) echo '</div><div class="screen">';
				?>
					<div class="li">
						<a href="<?=site_url('lake/author?id='.$v['id'])?>" class="img"><img src="<?=get_thumb($v['cover'])?>"/></a>
						<div class="name"><?=$v['name']?></div>
						<div class="zc"><?=$v['title']?></div>
					</div>
				<?php
					$i++;
					endforeach;
				?>
					</div>
				</div>
			</div>
			<a href="javascript:void(0);" title="下翻" class="next"></a>

			<div class="trigger-bar">
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
<script type="text/javascript" src="<?=base_url('./common/js/jquery.switchable.js')?>"></script>
<script type="text/javascript">
$(function(){
	var taba = $("#lake_tab_a .scrollable-trigger").switchable("#lake_tab_a .scrollable-panel .screen", {
		triggerType: "click",
		effect: "scroll",
		steps: 1,
		visible: 1,
		api: true
	});
	$("#lake_tab_a .next").click(function(){
		taba.next();
	});
	$("#lake_tab_a .prev").click(function(){
		taba.prev();
	});

	var tabc = $("#lake_tab_c .scrollable-trigger").switchable("#lake_tab_c .scrollable-panel .screen", {
		triggerType: "click",
		effect: "scroll",
		steps: 1,
		visible: 1,
		api: true
	});
	$("#lake_tab_c .next").click(function(){
		tabc.next();
	});
	$("#lake_tab_c .prev").click(function(){
		tabc.prev();
	});

	$("#lake_tab_b .tab span").click(function() {
		$("#lake_tab_b .tab span").removeClass('current');
		$(this).addClass('current');
		var tabindex = $("#lake_tab_b .tab span").index($(this));
		if(tabindex !== 0) {
			$("#lake_tab_b .content"+tabindex+" .cn").css("left","0px");
		}
		$("#lake_tab_b .contentbox").hide();
		$("#lake_tab_b .content"+tabindex).show();
	});
/*
	var tabb0 = $("#lake_tab_b .content0 .scrollable-trigger").switchable("#lake_tab_b .content0 .scrollable-panel .li", {
		triggerType: "click",
		effect: "scroll",
		steps: 3,
		visible: 3,
		api: true
	});
	$("#lake_tab_b .content0 .next").click(function(){
		tabb0.next();
	});
	$("#lake_tab_b .content0 .prev").click(function(){
		tabb0.prev();
	});
	var tabb1 = $("#lake_tab_b .content1 .scrollable-trigger").switchable("#lake_tab_b .content1 .scrollable-panel .li", {
		triggerType: "click",
		effect: "scroll",
		steps: 3,
		visible: 3,
		api: true
	});
	$("#lake_tab_b .content1 .next").click(function(){
		tabb1.next();
	});
	$("#lake_tab_b .content1 .prev").click(function(){
		tabb1.prev();
	});
	var tabb2 = $("#lake_tab_b .content2 .scrollable-trigger").switchable("#lake_tab_b .content2 .scrollable-panel .li", {
		triggerType: "click",
		effect: "scroll",
		steps: 3,
		visible: 3,
		api: true
	});
	$("#lake_tab_b .content2 .next").click(function(){
		tabb2.next();
	});
	$("#lake_tab_b .content2 .prev").click(function(){
		tabb2.prev();
	});
	var tabb3 = $("#lake_tab_b .content3 .scrollable-trigger").switchable("#lake_tab_b .content3 .scrollable-panel .li", {
		triggerType: "click",
		effect: "scroll",
		steps: 3,
		visible: 3,
		api: true
	});
	$("#lake_tab_b .content3 .next").click(function(){
		tabb3.next();
	});
	$("#lake_tab_b .content3 .prev").click(function(){
		tabb3.prev();
	});
	vartabb4 = $("#lake_tab_b .content4 .scrollable-trigger").switchable("#lake_tab_b .content4 .scrollable-panel .li", {
		triggerType: "click",
		effect: "scroll",
		steps: 3,
		visible: 3,
		api: true
	});
	$("#lake_tab_b .content4 .next").click(function(){
		tabb4.next();
	});
	$("#lake_tab_b .content4 .prev").click(function(){
		tabb4.prev();
	});
*/
});
</script>
<!--[if IE 6]>
<script type="text/javascript" src="<?=base_url('./common/js/fixpng-min.js')?>"></script>
<script type="text/javascript">
DD_belatedPNG.fix('.png, .browse');
</script>
<![endif]-->
<?php $this->load->view(THEME.'/footer');?>