//焦点图封装
function slidshow(contain) {
	var sw = 0;
	var count = contain.find('.num a').length;
	contain.find('ul li').eq(0).show();
	contain.find('.num a').eq(0).addClass("cur");

	function myShow(i){
		contain.find('.num a').eq(i).addClass("cur").siblings("a").removeClass("cur");
		contain.find('ul li').eq(i).stop(true,true).fadeIn(600).siblings("li").fadeOut(600);
	}

	function timer() {
		return setInterval(function() {
			myShow(sw);
			sw++;
			if(sw == count) {sw=0;}
		}, 3000);
	}

	//自动开始
	var myTime = timer();

	contain.find('.num a').mouseover(function() {
		sw = contain.find('.num a').index(this);
		myShow(sw);
	});

	//滑入停止动画，滑出开始动画
	contain.hover(function() {
		if(myTime){
		   clearInterval(myTime);
		}
	}, function() {
		myTime = timer();
	});
}