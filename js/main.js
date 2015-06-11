// read more https://developers.google.com/picasa-web/docs/2.0/reference#Parameters
// possible values 94, 110, 128, 200, 220, 288, 320, 400, 512, 576, 640, 720, 800, 912, 1024, 1152, 1280, 1440, 1600
var BIG_IMGMAX = 1024;
var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

//start. NoHoverOnScroll
// function disablehover() {
// var body = document.body,
//     timer;

// window.addEventListener('scroll', function() {
//   clearTimeout(timer);
//   if(!body.classList.contains('disable-hover')) {
//     body.classList.add('disable-hover')
//   }

//   timer = setTimeout(function(){
//     body.classList.remove('disable-hover')
//   },5000);
// }, false);
// }
//end. NoHoverOnScroll

var timer;
var scrolled = false;
$(document).scroll(function(){
    if(scrolled == false){
        scrolled = true;
        $("body").removeClass('allowHover');
    }
    
    clearTimeout(timer);
    timer = setTimeout(function(){
        $("body").addClass('allowHover');
        scrolled = false;
     },250);
});

function onAllPicturesLoad(callBack){
	var percentIndicator = $("#pageloading");
    var loaded = 0;
    $img = $("img");
    var onePercent = 100/$img.length;
    $img.one('load', function() {
    	loaded++;
       	console.log("Loaded pictures " + loaded + " out of " + $img.length);

		percentIndicator.html(parseInt(onePercent * loaded) + "%");
        
        if(loaded == $img.length){
            callBack();
        }
    }).each(function() {
        if(this.complete)$(this).load();
    });  
}

function fixWidthOfBareFaced(){
    if(isMobile){
        $(".barefaced").each(function(){
            var width = 0;
            $(this).find("div").each(function(){
                width +=$(this).width();
                console.log("el width " + $(this).width());
            });
            $(this).width(width);
            console.log(width);            
        });
    }
}
                
var screenHelper = { // bad js way
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
		if(isMobile ) { // this.isPOrtrat() || 
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
		$('body').scrollTop(0);

		$(".activeElement").removeClass("activeElement");
		$(this).addClass("activeElement");
		
		var current = $(".grid.active");

		if(isMobile == false){
			var animationTime = 500;
			grid.addClass("absolute").fadeIn(animationTime,function(){
				grid.addClass("active").removeClass("absolute").removeAttr("style");
				current.removeClass("active");
				clickIsProceeding = false;
			});
			current.fadeOut(animationTime);
		}else{
			grid.show().addClass("active");
			current.hide().removeClass("active");
			clickIsProceeding = false;
            fixWidthOfBareFaced();
		}
		return false;
	});


	if(isMobile == false){
		var oldPagePosition = 0;
		var colorBoxOptions = {
			fixed:true,
			height:"100%",
			onOpen:function(){
				oldPagePosition = $('body').scrollTop();
				$("body").addClass("noScroll");
			},
			onComplete:function(){

			},
			onCleanup:function(){
				$("body").removeClass("noScroll");
				$('body').scrollTop(oldPagePosition);
			},
			onClosed:function(){
								
			}
		};

		$(".makeMeScrollable").smoothDivScroll({
			hotSpotScrolling: false,
	      	touchScrolling: true,
	  		manualContinuousScrolling: false,
	  		mousewheelScrolling: false
	    });

	    $("[imagegroup]").each(function(){
			var groupClass = "." + $(this).attr("imagegroup");
			$(groupClass).each(function(){
				var src = $(this).attr("src");
				if(src){
					var newSrc = src.replace(/(.*\/s)([0-9]+)(.*)/,'$1' + BIG_IMGMAX + '$3');
					$(this).attr("href",newSrc);
				}
			});
			colorBoxOptions.rel = groupClass;
			$(groupClass).colorbox(colorBoxOptions);
		});

		$(".bottles").each(function(){$(this).attr("href",$(this).attr("src"));});
		colorBoxOptions.rel = ".bottles";
	    $(".bottles").colorbox(colorBoxOptions);

		$(".frames").each(function(){$(this).attr("href",$(this).attr("src"));});
		colorBoxOptions.rel = ".frames";
	    $(".frames").colorbox(colorBoxOptions);

	    $(".other").each(function(){$(this).attr("href",$(this).attr("src"));});
	    colorBoxOptions.rel = ".other";
	    $(".other").colorbox(colorBoxOptions);
	}

        onAllPicturesLoad(function(){
            fixWidthOfBareFaced();
            $("body").removeClass("noScroll");
            $("#loading").hide();
        });

});