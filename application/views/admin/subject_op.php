<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('admin/header');
?>
<h2><?=intval($this->input->get('id')) ? '修改' : '添加'?><div class="operate"><a href="<?=site_url('admin/subject/lists')?>">管理</a></div></h2>
<div class="slider3">
	<form action="<?=site_url('admin/subject/op'.(intval($this->input->get('id')) ? '?id='.intval($this->input->get('id')) : ''))?>" method="POST" enctype="multipart/form-data">
	<table cellspacing="0" cellpadding="0" border="0" class="table1">
		<tr>
			<th><b>*</b> 标题：</th>
			<td>
				<input type="text" name="title" value="<?=set_value('title', isset($row['title']) ? $row['title'] : '')?>" class="input2"/>
				<?php if(form_error('title')) { echo form_error('title'); } ?>
			</td>
		</tr>
		<tr>
			<th>封面：</th>
			<td>
				<input type="file" name="cover"/>
			</td>
		</tr>
	<?php if(isset($row['cover']) && $row['cover']):?>
		<tr class="tr_icon">
			<th></th>
			<td>
				<img src="<?=get_thumb($row['cover'])?>"/><a href="<?=site_url('admin/subject/file_del?type=img&id='.$row['id'])?>" class="del">删除</a>
			</td>
		</tr>
	<?php endif; ?>
		<tr>
			<th>视频类型：</th>
			<td>
				<input type="radio" class="filetype" name="filetype" value="online" checked/> 在线视频
				<input type="radio" class="filetype" name="filetype" value="local" <?=set_value('filetype', isset($row['filetype']) && $row['filetype'] == 'local' ? 'checked' : '')?>/> 本地视频
				<?php if(form_error('filetype')) { echo form_error('filetype'); } ?>
			</td>
		</tr>
		<tr class="filetab onlineTab">
			<th>flash地址：</th>
			<td><input type="text" name="online" class="input2" value="<?=isset($row['videoType']) && $row['videoType'] == 'online' ? $row['video'] : ''?>"/></td>
		</tr>
		<?php if(isset($row['videoType']) && $row['videoType'] == 'local'):?>
		<tr class="filetab localTab">
			<th>视频路径：</th>
			<td>
				data/uploads/attach/<?=$row['video']?>
			</td>
		</tr>
		<?php endif;?>
		<tr class="filetab localTab">
			<th>选择本地视频：</th>
			<td>
				<div class="videoNameList" style="width:80px">
					<input type="radio" name="local" value="" checked/> 不选
				</div>
				<?php $dir_arr = get_filenames('./data/tmp/'); if($dir_arr): foreach($dir_arr as $v):?>
				<div class="videoNameList">
					<input type="radio" name="local" value="<?=$v?>" /> <?=$v?>
				</div>
				<?php endforeach; endif;?>
			</td>
		</tr>
		<tr>
			<th><b>*</b> 教案类型：</th>
			<td>
				<select name="type">
				<?php foreach($kinds as $k=>$v): if($k != 'top'):?>
					<option value="<?=$k?>" <?=(isset($content['kind']) && $content['kind'] == $k) ? 'selected' : ''?>><?=$v?></option>
				<?php endif; endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<th><b>*</b> 界数：</th>
			<td>
				<select name="grade">
				<?php foreach($gradelist as $v):?>
					<option value="<?=$v['id']?>" <?=(isset($content['grade']) && $content['grade'] == $v['id']) ? 'selected' : ''?>><?=$v['title']?></option>
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
			<th>介绍：</th>
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
</div>


<script type="text/javascript" src="<?=base_url('./common/kindeditor/kindeditor.js')?>"></script>
<script type="text/javascript">
$(function() {
	fileChange();

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

	$('.filetype').change(function() {
		fileChange();
	})
})

function fileChange() {
	var val = $('.filetype:checked').val();
	$('.filetab').hide();
	$('.'+val+'Tab').show();
}
</script>

<?php $this->load->view('admin/footer');?>