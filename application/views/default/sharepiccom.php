<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>分享</title>
</head>
<body style="background: #081F48 url(<?=THEME_VIEW?>/images/lake_bg.png) 0 -50px repeat-x;">
	<div style="border: 1px solid #999;border-radius: 5px;box-shadow: 0 0 5px rgba(198,198,198,1);width: 560px; margin: 0 auto;padding: 20px;margin-top:60px; background:#FFF;">
		<div style="overflow:hidden;zoom:1">
			<div class="jiathis_style">
			<b style="float:left">点击图标分享：</b>
			<a class="jiathis_button_fb"></a>
			<a class="jiathis_button_twitter"></a>
			</div>		
		</div>		
		<div style="width:540px;font-size:14px;margin-top: 10px;border: 1px solid #ccc; padding: 10px;"><?php echo $title."  ".$content?></div>
		<div><img width="100" style="border: 2px solid #ffb941;margin-top: 10px;" src="<?php echo $picName?>"/></div>
	</div>
	

<script type="text/javascript" >
var jiathis_config={
	pic:"<?php echo $picName?>",
	//pic:"http://www.sinaimg.cn/blog/qingzujian/00820tiantangaiqing.jpg",
	title:"<?php echo mysql_escape_string($title)?>",
	summary:"<?php echo mysql_escape_string($content)?>",
	url:"<?php echo $url?>",
	appkey:{
        "tsina":"1246290740",
        "tqq":"801176243"
    }
}
</script>
<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
</body>
</html>