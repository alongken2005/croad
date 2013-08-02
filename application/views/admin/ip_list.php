<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('admin/header');
?>
<h2>管理<div class="operate"><a href="<?=site_url('admin/ip/op')?>">添加</a></div></h2>
<form action="<?=site_url('admin/ip/lists')?>" method="get">
<table cellspacing="0" cellpadding="0" border="0" class="condition">
	<tr>
		<th width="90">备注关键字：</th>
		<td width="173">
			<input type="text" name="keyword" class="input1"/>
		</td>
		<td>
			<input type="submit" value="查 询" class="search"/>
		</td>
	</tr>
</table>
</form>
<table cellpadding="0" cellspacing="0" border="0" class="table2">
	<tr>
		<th>ip</th>
		<th width="200">过期时间</th>
		<th width="300">备注</th>
		<th width="150">操作</th>
	</tr>
<?php if($lists): foreach($lists as $v):?>
	<tr>
		<td><?=$v['ip']?></td>
		<td><?=date('Y-m-d H:i', $v['date_expire'])?></td>
		<td><?=$v['remark']?></td>
		<td>
			<a href="<?=site_url('admin/ip/op?id='.$v['id'])?>">修改</a>
			<a href="<?=site_url('admin/ip/del?id='.$v['id'])?>" class="del">删除</a>
		</td>
	</tr>
<?php endforeach; endif;?>
</table>
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