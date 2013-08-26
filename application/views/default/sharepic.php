<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>分享</title>
	<link rel="stylesheet" type="text/css" href="<?=THEME_VIEW?>css/style.css"/>
</head>
<body>
	<div>标题：<?php echo $title?></div>
	<div>备注：<?php echo $content?></div>
	<div>url：<?php echo $url?></div>
	<div>图片:<img src="<?php echo $picName?>"/></div>
<!-- JiaThis Button BEGIN -->
<div class="jiathis_style">
<a class="jiathis_button_qzone"></a>
<a class="jiathis_button_tsina"></a>
<a class="jiathis_button_tqq"></a>
<a class="jiathis_button_weixin"></a>
</div>
<script type="text/javascript" >
var jiathis_config={
	//pic:"<?php echo $picName?>",
	pic:"http://www.sinaimg.cn/blog/qingzujian/00820tiantangaiqing.jpg",
	title:"<?php echo $title?>",
	summary:"<?php echo $content?>",
	url:"<?php echo $url?>",
	appkey:{
        "tsina":"1246290740",
        "tqq":"801176243"
    }
}
</script>
<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
<!-- JiaThis Button END -->

</body>
</html>