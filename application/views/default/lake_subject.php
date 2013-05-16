<?php $this->load->view(THEME.'/header');?>
<link rel="stylesheet" type="text/css" href="<?=THEME_VIEW?>/css/lake.css"/>
<div class="box subject">
	<div class="iland2" style="margin-top: 95px;"></div>
	<div class="overall clearfix">
		<img class="cover left" src="<?=get_thumb($subject['cover'])?>"/>
		<div class="right">
			<h2><?=$subject['title']?></h2>
			<div class="msg">时 长：</div>
			<div class="msg">阅 读：<?=$subject['hits']?></div>
			<div class="msg">作 者：<a href="<?=site_url('lake/author?id='.$author['id'])?>"><?=$author['name']?></a></div>
			<div class="info"><?=$subject['content']?></div>
		</div>
	</div>

	<div class="tab clearfix">
		<a href="javascript:void(0)" class="a1 current"></a>
		<a href="javascript:void(0)" class="a2"></a>
	</div>
	<div class="clearfix content0">
	<?php foreach($attachs as $v):?>
		<div class="li">
			<a href="333"><img src="<?=get_thumb($v['cover'])?>"/></a>
			<h3><?=$v['title']?><b><?=secfmt($v['filesize'])?></b></h3>
		</div>
	<?php endforeach;?>
	</div>
	<div class="content1 clearfix" style="display: none">
		<div class="author clearfix">
			<img src="<?=get_thumb($author['cover'])?>" class="left"/>
			<div class="right">
				<div class="title">
					<b><?=$author['name']?></b>
					<span><?=$author['title']?></span>
				</div>
				<div class="intro"><?=$author['content']?></div>
			</div>
		</div>

		<h3><?=$author['name']?>的作品</h3>
		<div class="attachs clearfix">
		<?php foreach($author_subject as $v):?>
			<div class="li">
				<a href="333"><img src="<?=get_thumb($v['cover'])?>"/></a>
				<div><?=$v['title']?><b>浏览量：<?=$v['hits']?></b></div>
			</div>
		<?php endforeach;?>
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
	$(".tab a").click(function() {
		$(".tab a").removeClass('current');
		$(this).addClass('current');
		var index = $(".tab a").index($(this));
		$(".subject .content0, .subject .content1").hide();
		$(".subject .content"+index).show();
	})
});
</script>
<!--[if IE 6]>
<script type="text/javascript" src="<?=base_url('./common/js/fixpng-min.js')?>"></script>
<script type="text/javascript">
DD_belatedPNG.fix('.png, .browse');
</script>
<![endif]-->
<?php $this->load->view(THEME.'/footer');?>