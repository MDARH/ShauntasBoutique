

$(document).ready(function(){
        
    $navOffest = $("nav.navBg").offset().top; 
	$(".row").height($("nav").outerHeight()); 
    $w = $(window).width();
	if( $w > 767){
        $(window).scroll(function(){
            $scrollPos  = $(window).scrollTop();
            if( $scrollPos >= $navOffest ){
                $("nav.navBg").addClass("navbar-fixed-top").css("margin-top","0");
                $(".navBg").css("background","rgba(0,0,0, 1)");
                $('.tp-bullets').css("display", "none");
            }
            else{
                $("nav.navBg").removeClass("navbar-fixed-top");
                $(".navBg").css("background","rgba(0,0,0, 0.6)");
                $('.tp-bullets').css("display", "block");
            }
        });
    }

	// Youtube Video
    
    $('a#video').click(function(e){
        e.preventDefault();
        $vId = $(this).data('src');
        $vLink = "https://www.youtube.com/embed/"+$vId+"?autoplay=1&&rel=0";
//        alert($vLink);
        $('div.modal').fadeIn(300);
        $('iframe#mVideo').attr('src', $vLink);
    });
    $('div.modal button.close').click(function(){
        $(this).parents('div.modal').fadeOut(300);
        $('iframe#mVideo').attr('src', '');
    });
    
});
$(window).load(function(){
	$("#loader").fadeOut();
//    $('#popup').delay(2000).fadeIn(500);
//
//    $('#popup .popupbox button').click(function(){
//        $(this).parents('#popup').fadeOut(300); 
//    });
});

new WOW().init();
$(document).ready(function () {
    $('.partners, .slick').slick({
		slidesToShow: 8,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 2000,
		responsive: [
		    {
		      breakpoint: 768,
		      settings: {
		        slidesToShow: 4,
		        slidesToScroll: 1
		      }
		    },
		    {
		      breakpoint: 520,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 1
		      }
		    },
		    {
		      breakpoint: 320,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 1
		      }
		    }
		]
	});
	$('#Container').mixItUp();
    $('#port, #port1').rebox({
        selector: 'a'
    });

});
$(function () {
	$('[data-toggle="tooltip"]').tooltip()
});
$(function () {
	$('.superbox').SuperBox();
});

//GOOGLE MAP CODES
$(function (){
    var myCenter=new google.maps.LatLng(23.7412777,90.3827105);
    var marker;

    function initialize()
    {
        var mapProp = {
            center:myCenter,
            zoom:15,
            scrollwheel: false,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };

        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

        var marker=new google.maps.Marker({
            position:myCenter
        });
//        var infowindow = new google.maps.InfoWindow({
//            position: myCenter,
//            content: '<img src="images/map-logo.png">'
//        });
//
//        infowindow.open(map,marker);

        marker.setMap(map);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
});

$(document).ready(function(){
   
    $('.tp-banner').revolution({
            delay: 7000,
            startwidth: 1170,
            startheight: 454,
            onHoverStop: "off",	
            touchenabled: "on",
            hideThumbs: 0,
            navigationType:"bullet",				// bullet, thumb, none
            navigationStyle: "round",				// round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom
            navigationHAlign: "center",				// Vertical Align top,center,bottom
            navigationVAlign: "bottom",					// Horizontal Align left,center,right
            navigationVOffset: 30
        });
    
});