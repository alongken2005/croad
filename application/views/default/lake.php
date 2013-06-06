<?php $this->load->view(THEME.'/lake_header');?>
<script type="text/javascript" src="<?=THEME_VIEW?>/js/slide.js"></script>
<link rel="stylesheet" type="text/css" href="<?=THEME_VIEW?>/css/lake.css"/>

	<div class="lake_focus">
		<div class="lake_menu">
			<a href="<?=site_url('lake/notice_list')?>">文件通知</a>
			<a href="#m2" class="godown">儿童阅读</a>
			<a href="#m2" class="godown">班级读书会</a>
			<a href="#m2" class="godown">故事妈妈</a>
			<a href="#m2" class="godown">新作文联盟</a>
			<a href="#m2" class="godown">国学经典</a>
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
			<div class="content"><?=$intros[3]?></div>
		</div>
	</div>
	<div class="single_bottom2"></div>

	<div id="lake_tab_a">
		<div class="title clearfix" id="m1">
			<span class="current"><a href="javascript:void(0);">教学设计</a></span>
			<span><a href="javascript:void(0);">名师讲堂</a></span>
		</div>
		<div class="content0 clearfix contentbox">
			<div class="scrollable-panel">
				<div class="clearfix cn">
					<div class="screen">
				<?php
					$i=1;
					foreach($desglist as $v):
						if($i%7==0) echo '</div><div class="screen">';
				?>
					<div class="li">
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="img" target="_blank"><img src="<?=get_thumb($v['cover'])?>"/></a>
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="a1" target="_blank"><?=$v['title']?></a>
						<?php if($v['gname']):?><a href="<?=site_url('lake/grade?id='.$v['grade'])?>" target="blank" class="gname">[<?=$v['gname']?>]</a><?php endif;?>
						<div class="clear"></div>
						作者：<a href="<?=site_url('lake/author?id='.$v['authorid'])?>" class="author"><?=$v['name']?></a>&nbsp;&nbsp;&nbsp;浏览量：<?=$v['hits']?>
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
			<a href="<?=site_url('lake/search?type=lakeDesign')?>" class="more sp_index" target="_blank">更多内容 &raquo;</a>
		</div>
		<div class="content1 clearfix contentbox" style="display: none">
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
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="a1" target="_blank"><?=$v['title']?></a>
						<?php if($v['gname']):?>
							<a href="<?=site_url('lake/grade?id='.$v['grade'])?>" target="blank" class="gname">[<?=$v['gname']?>]</a>
						<?php endif;?>
						<div class="clear"></div>
						作者：<a href="<?=site_url('lake/author?id='.$v['authorid'])?>" class="author"><?=$v['name']?></a>&nbsp;&nbsp;&nbsp;浏览量：<?=$v['hits']?>
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
			<a href="<?=site_url('lake/search?type=top')?>" class="more sp_index" target="_blank">更多内容 &raquo;</a>
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
			<?php if($intros[4]):?>
			<div class="intros"><?=$intros[4]?></div>
			<?php endif;?>
			<div class="scrollable-panel">
				<div class="clearfix cn">
				<?php
					foreach($lakeCread as $v):
				?>
					<div class="li">
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="img" target="_blank"><img src="<?=get_thumb($v['cover'])?>"/></a>
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="a1" target="_blank"><?=$v['title']?></a>
						<?php if($v['gname']):?>
							<a href="<?=site_url('lake/grade?id='.$v['grade'])?>" target="blank" class="gname">[<?=$v['gname']?>]</a>
						<?php endif;?>
						<div class="clear"></div>
						作者：<a href="<?=site_url('lake/author?id='.$v['authorid'])?>" class="author"><?=$v['name']?></a>&nbsp;&nbsp;&nbsp;浏览量：<?=$v['hits']?>
					</div>
				<?php
					endforeach;
				?>
				</div>
			</div>
			<a href="<?=site_url('lake/search?type=lakeCread')?>" class="more sp_index" target="_blank">更多内容 &raquo;</a>
		</div>

		<div class="content1 clearfix contentbox" style="display: none">
			<?php if($intros[5]):?>
			<div class="intros"><?=$intros[5]?></div>
			<?php endif;?>
			<div class="scrollable-panel">
				<div class="clearfix cn">
				<?php
					foreach($lakeClass as $v):
				?>
					<div class="li">
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="img" target="_blank"><img src="<?=get_thumb($v['cover'])?>"/></a>
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="a1" target="_blank"><?=$v['title']?></a>
						<?php if($v['gname']):?>
							<a href="<?=site_url('lake/grade?id='.$v['grade'])?>" target="blank" class="gname">[<?=$v['gname']?>]</a>
						<?php endif;?>
						<div class="clear"></div>
						作者：<a href="<?=site_url('lake/author?id='.$v['authorid'])?>" class="author"><?=$v['name']?></a>&nbsp;&nbsp;&nbsp;浏览量：<?=$v['hits']?>
					</div>
				<?php
					endforeach;
				?>
				</div>
			</div>
			<a href="<?=site_url('lake/search?type=lakeClass')?>" class="more sp_index" target="_blank">更多内容 &raquo;</a>
		</div>

		<div class="content2 clearfix contentbox" style="display: none">
			<?php if($intros[6]):?>
			<div class="intros"><?=$intros[6]?></div>
			<?php endif;?>
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
						作者：<a href="<?=site_url('lake/author?id='.$v['authorid'])?>" class="author"><?=$v['name']?></a>&nbsp;&nbsp;&nbsp;浏览量：<?=$v['hits']?>
					</div>
				<?php
					endforeach;
				?>
				</div>
			</div>
			<a href="<?=site_url('lake/search?type=lakeStory')?>" class="more sp_index" target="_blank">更多内容 &raquo;</a>
		</div>
		<div class="content3 clearfix contentbox" style="display: none">
			<?php if($intros[7]):?>
			<div class="intros"><?=$intros[7]?></div>
			<?php endif;?>
			<div class="scrollable-panel">
				<div class="clearfix cn">
				<?php
					foreach($lakeStory as $v):
				?>
					<div class="li">
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="img" target="_blank"><img src="<?=get_thumb($v['cover'])?>"/></a>
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="a1" target="_blank"><?=$v['title']?></a>
						<?php if($v['gname']):?>
							<a href="<?=site_url('lake/grade?id='.$v['grade'])?>" target="blank" class="gname">[<?=$v['gname']?>]</a>
						<?php endif;?>
						<div class="clear"></div>
						作者：<a href="<?=site_url('lake/author?id='.$v['authorid'])?>" class="author"><?=$v['name']?></a>&nbsp;&nbsp;&nbsp;浏览量：<?=$v['hits']?>
					</div>
				<?php
					endforeach;
				?>
				</div>
			</div>
			<a href="<?=site_url('lake/search?type=lakeContent')?>" class="more sp_index" target="_blank">更多内容 &raquo;</a>
		</div>
		<div class="content4 clearfix contentbox" style="display: none">
			<?php if($intros[8]):?>
			<div class="intros"><?=$intros[8]?></div>
			<?php endif;?>
			<div class="scrollable-panel">
				<div class="clearfix cn">
				<?php
					foreach($lakeStory as $v):
				?>
					<div class="li">
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="img" target="_blank"><img src="<?=get_thumb($v['cover'])?>"/></a>
						<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="a1" target="_blank"><?=$v['title']?></a>
						<?php if($v['gname']):?>
							<a href="<?=site_url('lake/grade?id='.$v['grade'])?>" target="blank" class="gname">[<?=$v['gname']?>]</a>
						<?php endif;?>
						<div class="clear"></div>
						作者：<a href="<?=site_url('lake/author?id='.$v['authorid'])?>" class="author"><?=$v['name']?></a>&nbsp;&nbsp;&nbsp;浏览量：<?=$v['hits']?>
					</div>
				<?php
					endforeach;
				?>
				</div>
			</div>
			<a href="<?=site_url('lake/search?type=lakeState')?>" class="more sp_index" target="_blank">更多内容 &raquo;</a>
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

<script type="text/javascript" src="<?=base_url('./common/js/jquery.switchable.js')?>"></script>
<script type="text/javascript">
$(function(){
	$("#lake_tab_a .title span").click(function() {
		$("#lake_tab_a .title span").removeClass('current');
		$(this).addClass('current');
		var tabindex = $("#lake_tab_a .title span").index($(this));
		$("#lake_tab_a .contentbox").hide();
		$("#lake_tab_a .content"+tabindex).show();
	});

	var taba0 = $("#lake_tab_a .content0 .scrollable-trigger").switchable("#lake_tab_a .content0 .scrollable-panel .screen", {
		triggerType: "click",
		effect: "scroll",
		steps: 1,
		visible: 1,
		api: true
	});
	$("#lake_tab_a .content0 .next").click(function(){
		taba0.next();
	});
	$("#lake_tab_a .content0 .prev").click(function(){
		taba0.prev();
	});
	var taba1 = $("#lake_tab_a .content1 .scrollable-trigger").switchable("#lake_tab_a .content1 .scrollable-panel .screen", {
		triggerType: "click",
		effect: "scroll",
		steps: 1,
		visible: 1,
		api: true
	});
	$("#lake_tab_a .content1 .next").click(function(){
		taba1.next();
	});
	$("#lake_tab_a .content1 .prev").click(function(){
		taba1.prev();
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

	$('.godown').click(function() {
		var index = $('.lake_menu a').index($(this))-1;
		$("#lake_tab_b .tab span:eq("+index+")").click();
	})
});
</script>
<!--[if IE 6]>
<script type="text/javascript" src="<?=base_url('./common/js/fixpng-min.js')?>"></script>
<script type="text/javascript">
DD_belatedPNG.fix('.png, .browse');
</script>
<![endif]-->
<?php $this->load->view(THEME.'/lake_footer');?>