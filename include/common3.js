$(document).ready(function(){

	//$("#menu").attr("style","display:block");

	

	if(bodyc == "Main"){
		$(window).scroll(function(){			
			var bod_height2 = $(document).scrollTop() / 2+"px";
			$(".wrap5").stop();
			$(".wrap5").animate( { "top":  bod_height2 }, 500 );
		});
	}else{
		$('.subs'+menu_num).show();


		$(".wrap5").animate( { "top":  "120px" }, 500 );
		$(window).scroll(function(){
		
		
			var bod_height2 = (($(document).height()-$('.wrap_pcsd3').outerHeight())/2+$(window).scrollTop())+"px";
			$(".wrap5").stop();
			$(".wrap5").animate( { "top":  bod_height2 }, 500 );
		});

	}







	




/*왼쪽메뉴*/
	 $("#menu").mmenu({
	   "offCanvas": {
		  "zposition": "front"
	   },
	   "classes": "mm-white",
	   "counters": false,
	 
	});
	$("#foo").mmenu();
		var $window = $(window);
		var scrollTop = 0;
		$("#foo").on( "opening.mm", function() {
		   scrollTop = $window.scrollTop();
		} );
		$window.on( "scroll", function() {
		   if ( $("html").hasClass( "mm-opened" ) )
		   {
			  window.scrollTo( 0, scrollTop );
		   }
	});	
	
	$("#my-button2").click(function() {
		$("#menu").trigger("close.mm");
		$('.mm-page').css('overflow','auto');
	});


	$('#cssmenu li.has-sub>a').on('click', function(){
		$(this).removeAttr('href');
		var element = $(this).parent('li');
		if (element.hasClass('open')) {
			element.removeClass('open');
			element.find('li').removeClass('open');
			element.find('ul').slideUp(100);
		}
		else {
			element.addClass('open');
			element.children('ul').slideDown(100);
			element.siblings('li').children('ul').slideUp(100);
			element.siblings('li').removeClass('open');
			element.siblings('li').find('li').removeClass('open');
			element.siblings('li').find('ul').slideUp();
		}
	});





	//메뉴
	//var onSub='menu1'; //현재 선택될 메뉴 
	$("#Gnb ul.menu>li").each(function(){
		var $menu=$(this);
		
		
		$menu.hover(function(){

			$('h2 a',$menu).addClass('on');
			var $showSub=$menu;
			showSubMenu($showSub);
		},function(){
			$('h2 a',$menu).removeClass('on');
		});
	});
	$("#Gnb").hover(function(){},function(){
		var $showSub;
		if(onSub){
			$("#Gnb ul.menu>li").each(function(){
				var $menu=$(this);
				if($menu.hasClass(onSub)){
					$showSub=$menu;
				}
			});
		}
		showSubMenu($showSub);
	});




	//var onSub='menu1'; //현재 선택될 메뉴 
	$("#Gnb2 ul.menu>li").each(function(){
		var $menu=$(this);
		$menu.bind('click',function(){
			var $showSub=$menu;
			showSubMenu($showSub);
		});


		$menu.hover(function(){

			$('h2 a',$menu).addClass('on');
			var $showSub=$menu;
			showSubMenu($showSub);
		},function(){
			$('h2 a',$menu).removeClass('on');
		});


	});
	$("#Gnb2").hover(function(){},function(){
		var $showSub;
		if(onSub){
			$("#Gnb2 ul.menu>li").each(function(){
				var $menu=$(this);
				if($menu.hasClass(onSub)){
					$showSub=$menu;
				}
			});
		}
		showSubMenu($showSub);
	});
	
});
function showSubMenu($showSub){

	$('ul.sub').hide();
	if($showSub){
		$('ul.sub',$showSub).show();
	}

}





function typetree(){
	$(".neleftmenu").toggle(50);
}