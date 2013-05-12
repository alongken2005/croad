<?php $this->load->view(THEME.'/header');?>
<link rel="stylesheet" type="text/css" href="<?=THEME_VIEW?>/css/lake.css"/>
<div class="box search">
	<div class="iland2" style="margin-top: 95px;"></div>

	<form action="<?=site_url('lake/search')?>" method="get" class="search_box">
		<input type="text" name="keyword" class="keyword"/>
		<input type="submit" value="搜&nbsp;&nbsp;索" class="search_btn"/>
	</form>

	<div class="ge"></div>

	<?php
	if($stype == 'subject'):
		$url = '';
		if($this->input->get('keyword')) $url .= '&keyword='.$this->input->get('keyword');
	?>
	<div class="tab clearfix">
		<a href="<?=site_url('lake/search?stype=subject'.$url)?>" <?=$type==0 ? 'class="current"' : ''?>>全部课件</a>
		<a href="<?=site_url('lake/search?stype=subject&type=1'.$url)?>" <?=$type==1 ? 'class="current"' : ''?>>名师谈阅读</a>
		<a href="<?=site_url('lake/search?stype=subject&type=2'.$url)?>" <?=$type==2 ? 'class="current"' : ''?>>阅读研习营</a>
		<a href="<?=site_url('lake/search?stype=subject&type=3'.$url)?>" <?=$type==3 ? 'class="current"' : ''?>>班级读书会</a>
	</div>
	<div class="subject_li clearfix">
	<?php foreach($lists as $v):?>
		<div class="li">
			<a href="<?=site_url('lake/subject?id='.$v['id'])?>" class="img" target="_blank"><img src="<?=get_thumb($v['cover'])?>"/></a>
			<div class="title">
				<b><?=$v['title']?></b><br>
				作者：<?=$v['name']?>&nbsp;&nbsp;浏览量：<?=$v['hits']?>
			</div>
		</div>
	<?php endforeach;?>
	</div>
	<?php endif;?>
</div>
<?php $this->load->view(THEME.'/lake_footer');?>
<?php $this->load->view(THEME.'/footer');?>