<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('admin/header');
?>
<h2><?=intval($this->input->get('id')) ? '修改' : '添加'?><div class="operate"><a href="<?=site_url('admin/product/lists')?>">管理</a></div></h2>
<div class="slider3">
<?php if($kind == 'video'):?>
	<form action="<?=site_url('admin/stuff/op'.(intval($this->input->get('id')) ? '?id='.intval($this->input->get('id')) : ''))?>" method="POST" enctype="multipart/form-data">
	<table cellspacing="0" cellpadding="0" border="0" class="table1">
		<tr>
			<th><b>*</b> 标题：</th>
			<td>
				<input type="text" name="title" value="<?=set_value('title', isset($content['title']) ? $content['title'] : '')?>" class="input2"/>
				<?php if(form_error('title')) { echo form_error('title'); } ?>
			</td>
		</tr>
		<tr>
			<th>视频封面：</th>
			<td>
				<input type="file" name="userfile"/>
			</td>
		</tr>
	<?php if(isset($content['filepic']) && $content['filepic']):?>
		<tr class="tr_icon">
			<th></th>
			<td>
				<img src="<?=base_url('./data/uploads/stuff/'.$content['filepic'])?>"/><a href="<?=site_url('admin/stuff/file_del?type=img&id='.$content['id'])?>" class="del">删除</a>
			</td>
		</tr>
	<?php endif; ?>
	<?php
		$dir_arr = get_filenames('./data/tmp/');
		if(isset($content['filename']) && $content['filename']) :
	?>
		<tr class="tr_icon">
			<th>当前视频：</th>
			<td>
				/data/uploads/stuff/<?=$content['filename']?> (原文件名：<?=$content['realname']?>) <a href="<?=site_url('admin/stuff/file_del?type=video&id='.$content['id'])?>" class="del">删除</a>
			</td>
		</tr>
	<?php endif;?>
		<tr class="tr_icon">
			<th>可选视频：</th>
			<td>
				<div class="videoNameList" style="width:80px">
					<input type="radio" name="fname" value="" checked/> 不选
				</div>
				<?php foreach($dir_arr as $v):?>
				<div class="videoNameList">
					<input type="radio" name="fname" value="<?=$v?>" <?=isset($content['filename']) && $content['filename'] == $v ? 'checked' : ''?>/> <?=$v?>
				</div>
				<?php endforeach;?>
			</td>
		</tr>
		<tr>
			<th><b>*</b> 分类：</th>
			<td>
				<select name="type">
				<?php foreach($type_list as $v):?>
					<option value="<?=$v['id']?>" <?=(isset($content['typeid']) && $content['typeid'] == $v['id']) ? 'selected' : ''?>><?=$v['name']?></option>
				<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<th> 标签：</th>
			<td>
				<input type="text" name="tag" value="<?=set_value('tag', isset($tags) ? $tags : '')?>" class="input2"/>
			</td>
		</tr>
		<tr>
			<th><b>*</b> 创建时间：</th>
			<td>
				<input type="text" name="ctime" value="<?=set_value('ctime', isset($content['ctime']) ? date('Y-m-d H:i:s', $content['ctime']) : date('Y-m-d H:i:s', time()))?>" class="input1"/>
				<?php if(form_error('ctime')) { echo form_error('ctime'); } ?>
			</td>
		</tr>
		<tr>
			<th> 排序：</th>
			<td>
				<input type="text" name="sort" value="<?=set_value('sort', isset($content['sort']) ? $content['sort'] : 0)?>" class="input3"/>
			</td>
		</tr>
		<tr>
			<th><b>*</b> 作者：</th>
			<td>
				<select name="authorid">
				<?php foreach($authorlist as $v):?>
					<option value="<?=$v['id']?>" <?=(isset($content['authorid']) && $content['authorid'] == $v['id']) ? 'selected' : ''?>><?=$v['name']?></option>
				<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<th> 是否付费：</th>
			<td>
				<select name="is_free">
					<option value="0">免费</option>
					<option value="1">收费</option>
				</select>
			</td>
		</tr>
		<tr>
			<th></th>
			<td>
				<input type="hidden" name="kind" value="<?=$kind?>"/>
				<input type="submit" name="submit" value="提 交" class="but2"/>
			</td>
		</tr>
	</table>
	</form>
<?php else:?>
	<form action="<?=site_url('admin/stuff/op'.(intval($this->input->get('id')) ? '?id='.intval($this->input->get('id')) : ''))?>" method="POST" enctype="multipart/form-data">
	<table cellspacing="0" cellpadding="0" border="0" class="table1">
		<tr>
			<th><b>*</b> 标题：</th>
			<td>
				<input type="text" name="title" value="<?=set_value('title', isset($content['title']) ? $content['title'] : '')?>" class="input2"/>
				<?php if(form_error('title')) { echo form_error('title'); } ?>
			</td>
		</tr>
		<tr>
			<th>教案封面：</th>
			<td>
				<input type="file" name="userfile"/>
			</td>
		</tr>
	<?php if(isset($content['filepic']) && $content['filepic']):?>
		<tr class="tr_icon">
			<th></th>
			<td>
				<img src="<?=base_url('./data/uploads/stuff/'.$content['filepic'])?>"/><a href="<?=site_url('admin/stuff/file_del?type=img&id='.$content['id'])?>" class="del">删除</a>
			</td>
		</tr>
	<?php endif; ?>
	<?php
		$dir_arr = get_filenames('./data/tmp/');
	?>
		<tr>
			<th>当前附件：</th>
			<td>
				<?php foreach($dir_arr as $v):?>
				<div class="videoNameList"><input type="checkbox" name="attach[]" value="<?=$v?>" <?=isset($content['filename']) && $content['filename'] == $v ? 'checked' : ''?>/> <?=$v?></div>
				<?php endforeach;?>
			</td>
		</tr>
		<tr>
			<th>可选附件：</th>
			<td>
				<?php foreach($dir_arr as $v):?>
				<div class="videoNameList"><input type="checkbox" name="attach[]" value="<?=$v?>" <?=isset($content['filename']) && $content['filename'] == $v ? 'checked' : ''?>/> <?=$v?></div>
				<?php endforeach;?>
			</td>
		</tr>
		<tr>
			<th>分类：</th>
			<td>
				<select name="type">
				<?php foreach($type_list as $v):?>
					<option value="<?=$v['id']?>" <?=(isset($content['typeid']) && $content['typeid'] == $v['id']) ? 'selected' : ''?>><?=$v['name']?></option>
				<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<th><b>*</b> 创建时间：</th>
			<td>
				<input type="text" name="ctime" value="<?=set_value('ctime', isset($content['ctime']) ? date('Y-m-d H:i:s', $content['ctime']) : date('Y-m-d H:i:s', time()))?>" class="input1"/>
				<?php if(form_error('ctime')) { echo form_error('ctime'); } ?>
			</td>
		</tr>
		<tr>
			<th> 排序：</th>
			<td>
				<input type="text" name="sort" value="<?=set_value('sort', isset($content['sort']) ? $content['sort'] : 0)?>" class="input3"/>
			</td>
		</tr>
		<tr>
			<th><b>*</b> 作者：</th>
			<td>
				<select name="authorid">
				<?php foreach($authorlist as $v):?>
					<option value="<?=$v['id']?>" <?=(isset($content['authorid']) && $content['authorid'] == $v['id']) ? 'selected' : ''?>><?=$v['name']?></option>
				<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<th> 是否付费：</th>
			<td>
				<select name="is_free">
					<option value="0">免费</option>
					<option value="1">收费</option>
				</select>
			</td>
		</tr>
		<tr>
			<th> 介绍：</th>
			<td>
				<textarea name="content" id="content"><?=set_value('content', isset($content['content']) ? $content['content'] : '')?></textarea>
				<?php if(form_error('content')) { echo form_error('content'); } ?>
			</td>
		</tr>
		<tr>
			<th></th>
			<td>
				<input type="hidden" name="kind" value="<?=$kind?>"/>
				<input type="submit" name="submit" value="提 交" class="but2"/>
			</td>
		</tr>
	</table>
	</form>
<?php endif;?>
</div>


<script type="text/javascript" src="<?=base_url('./common/kindeditor/kindeditor.js')?>"></script>
<script type="text/javascript">
$(function() {
	KindEditor.ready(function(K) {
		K.create('#content', {width : '670', height: '500', newlineTag:'br', filterMode : true});
	});

	$('.del').click(function() {
		obj = $(this);
		if(confirm('确定删除？')) {
			$.get($('.del').attr('href'), '', function(data) {
				if(data == 'ok') {
					obj.parent().parent('.tr_icon').hide();
				} else {
					alert('删除失败');
				}
			})
		}
		return false;
	})
})
</script>

<?php $this->load->view('admin/footer');?>