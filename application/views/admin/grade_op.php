<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('admin/header');
?>
<h2><?=intval($this->input->get('id')) ? '修改' : '添加'?><div class="operate"><a href="<?=site_url('admin/grade/lists')?>">管理</a></div></h2>
<div class="slider3">
	<form action="<?=site_url('admin/grade/op'.(intval($this->input->get('id')) ? '?id='.intval($this->input->get('id')) : ''))?>" method="POST" enctype="multipart/form-data">
	<table cellspacing="0" cellpadding="0" border="0" class="table1">
		<tr>
			<th>名称：</th>
			<td><input type="text" name="title" class="input1" value="<?=isset($content['title']) ? $content['title'] : ''?>"/></td>
		</tr>
		<tr>
			<th></th>
			<td>
				<input type="submit" name="submit" value="提 交" class="but2"/>
			</td>
		</tr>
	</table>
	</form>
</div>
<?php $this->load->view('admin/footer');?>