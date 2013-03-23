<!DOCTYPE html>
<html style="background: url(<?=THEME_VIEW?>/images/bg.jpg);">
<head>
	<meta charset="utf-8">
	<title>儿童之路-运河儿童电影赏析</title>
</head>
<body>
	<form action="<?=site_url('pay/figureUp')?>">
		<input type="text" name="pids" value="4" /><br>
		<input type="submit" value="提交" />
	</form>

	<form action="<?=site_url('pay/billover')?>" method="post">
		<input type="text" name="option" value="54" /><br>
		<input type="text" name="invoid_id" value="3011" /><br>
		<input type="submit" value="提交" />
	</form>
</body>
</html>