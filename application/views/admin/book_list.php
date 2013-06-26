<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('admin/header');
?>
<h2>图书列表<div class="operate"><a href="<?=site_url('admin/book/op')?>">添加</a></div></h2>
<form action="<?=site_url('admin/books/lists')?>" method="get">
	<table cellspacing="0" cellpadding="0" border="0" class="condition">
		<tr>
			<th width="80">注册免费读：</th>
			<td>
				<input type="checkbox" name="searchLoginFree" value="1" <?=$this->input->get('searchLoginFree') == 1 ? 'checked' : ''?>/>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" value="查 询" class="search" style="margin: 2px 5px"/>
			</td>
		</tr>
	</table>
</form>
<form action="<?=site_url('admin/books/loginFree')?>" method="post">
<table cellpadding="0" cellspacing="0" border="0" class="table2">
	<tr>
		<th width="85"><input type="submit" value="注册免费读" style="padding:0 2px"/></th>
		<th width="60">ID</th>
		<th>标题</th>
		<th width="300">丛书标题</th>
		<th width="150">作者</th>
		<th width="100">操作</th>
	</tr>
<?php if($lists): foreach($lists as $v):?>
	<tr>
		<td>
			<input type="hidden" name="bookids[]" value="<?=$v['id']?>"/>
			<input type="checkbox" name="login_free[<?=$v['id']?>]" value="1" <?=$v['login_free'] == 1 ? 'checked' :''?>/>
		</td>
		<td><?=$v['id']?></td>
		<td style="text-align:left;padding-left:5px"><?=$v['title']?></td>
		<td style="text-align:left;padding-left:5px"><?=$v['series_title']?></td>
		<td><?=$v['author']?></td>
		<td>
		</td>
	</tr>
<?php endforeach; endif;?>
</table>
</form>
<?=$pagination?>
<script type="text/javascript">
$(function() {
	$('.del').click(function() {
		if(confirm('确认删除？')) {
			var po = $(this).parent().parent();
			$.get($(this).attr('href'), '', function(data) {
				if(data == 'ok') {
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