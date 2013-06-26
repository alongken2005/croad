<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('admin/header');
?>
<h2>管理<div class="operate"><a href="<?=site_url('admin/subject/op')?>">添加</a></div></h2>
<form action="<?=site_url('admin/subject/lists')?>" method="get">
	<table cellspacing="0" cellpadding="0" border="0" class="condition">
		<tr>
			<th width="80">名师讲堂：</th>
			<td>
				<input type="checkbox" name="searchTop" value="1" <?=$this->input->get('searchTop') == 1 ? 'checked' : ''?>/>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" value="查 询" class="search" style="margin: 2px 5px"/>
			</td>
		</tr>
	</table>
</form>
<form action="<?=site_url('admin/subject/top')?>" method="post">
<table cellpadding="0" cellspacing="0" border="0" class="table2">
	<tr>
		<th width="70"><input type="submit" value="名师讲堂" style="padding:0 2px"/></th>
		<th>标题</th>
		<th width="150">发布日期</th>
		<th width="200">操作</th>
	</tr>
<?php if($lists): foreach($lists as $v):?>
	<tr>
		<td>
			<input type="hidden" name="ids[]" value="<?=$v['id']?>"/>
			<input type="checkbox" name="top[<?=$v['id']?>]" value="1" <?=$v['top'] == 1 ? 'checked' :''?>/>
		</td>
		<td style="text-align: left; padding-left: 10px"><?=$v['title']?></td>
		<td><?=date('Y-m-d H:i', $v['ctime'])?></td>
		<td>
			<a href="<?=site_url('admin/subject/attach_op?relaid='.$v['id'])?>">课件添加</a>&nbsp;
			<a href="<?=site_url('admin/subject/attach_lists?relaid='.$v['id'])?>">课件管理</a>&nbsp;
			<a href="<?=site_url('admin/subject/op?id='.$v['id'])?>">修改</a>&nbsp;
			<a href="<?=site_url('admin/subject/del?id='.$v['id'])?>" class="del">删除</a>
		</td>
	</tr>
<?php endforeach; endif;?>
</table>
</form>
<?=$pagination?>
<script type="text/javascript">
$(function() {
	$('.del').click(function() {
		if(confirm('确认删除？')){
			var po = $(this).parent().parent();
			$.get($(this).attr('href'), '', function(data) {
				if(data == 'ok'){
					po.hide();
				} else {
					alert('删除失败！');
				}
			})
		}
		return false;
	})
})
</script>
<?php $this->load->view('admin/footer');?>