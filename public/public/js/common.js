$(function(){
	//关闭按钮
	$('.close').click(function(){
		$(this).parent().fadeOut();
	});
	//左栏菜单
	$('.tit').click(function (){
			$(this).next("li").slideToggle(300);
	});

	

})