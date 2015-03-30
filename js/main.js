var screenHelper = {
	mobileCssPath: 'mobile.css',
	uniqueMobileCSSID: 'qwerweqrqwefasdfwerfsarts',
	desktopMode: null,
	runDesktopMode: function(){
		if(this.desktopMode == null || this.desktopMode == false){
			this.desktopMode = true;
			var mobileCss = $("#"+this.uniqueMobileCSSID);
			if(mobileCss){
				mobileCss.remove();
			}
		}
	},
	runMobileMode: function (){
		if($(window).height() / $(window).width() < 1){
			$("body").addClass("landscape");
		}else{
			$("body").removeClass("landscape");
		}
		if(this.desktopMode == null || this.desktopMode == true){
			this.desktopMode = false;
			$('head').append('<link id="' + this.uniqueMobileCSSID + '" rel="stylesheet" href="' + this.mobileCssPath + '" type="text/css" >');
		}
	},
	isPOrtrat: function(){
		return ($(window).width() < $(window).height());
	},
	checkWindowResize: function(){
		if(this.isPOrtrat() || /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			this.runMobileMode();
		}else{
			this.runDesktopMode();
		}

	}
};


$(function(){
	$(window).resize(function() {
		screenHelper.checkWindowResize();
	});

	screenHelper.checkWindowResize();

	var clickIsProceeding = false;
	$("[targetGrid]").click(function(){
		var grid = $($(this).attr("targetGrid"));
		if(clickIsProceeding || !grid || grid.hasClass("active")){
			return;
		}

		clickIsProceeding = true;

		$(".activeElement").removeClass("activeElement");
		$(this).addClass("activeElement");

		var animationTime = 500;
		var current = $(".grid.active");

		grid.addClass("absolute").fadeIn(animationTime,function(){
			grid.addClass("active").removeClass("absolute").removeAttr("style");
			current.removeClass("active");
			clickIsProceeding = false;
		});

		current.fadeOut(animationTime);
	});

});






