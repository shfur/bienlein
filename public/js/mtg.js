// docked state
var docked = false;
// check for touch device
var is_touch_device = 'ontouchstart' in document.documentElement;
// offset for scrollnav
var offset = 150;

/* Ready, Set, Go. */
$(document).ready(function() {
    
    /**
	 * @see http://stackoverflow.com/questions/9979827/change-active-menu-item-on-page-scroll and
	 */
    // Cache selectors
	/*
    var lastId;
    var topMenu = $('.navscroll');
    var topMenuHeight = topMenu.outerHeight() + offset;
    // All list items
    var menuItems = topMenu.find("a");
    // Anchors corresponding to menu items
    var scrollItems = menuItems.map(function() {
        var item = $($(this).attr("href"));
        if (item.length) { return item; }
    });
	*/
	jQuery(function($) {
	    $('a[href$=".pdf"]').attr('target', '_blank');
	});
	
	$(".tips-avail").data('powertip', '<img src="/img/mtg/mtg-over-verfuegbarkeit.png" width="150" height="111" alt="" />');
	$(".tips-zub").data('powertip', '<img src="/img/mtg/mtg-over-zubereitung.png" width="200" height="203" alt="" />');
	$(".tips-avail, .tips-zub").powerTip({
		followMouse: true
	});
	
	$("a#scrolltop").click(function(e) {
		e.preventDefault();
		$(window).scrollTo('0px', 800);
	});
	
	$("div.cage").click(function(e) {
		//$(this).find("img.resizable").toggleClass("resize");
		var img = $(this).find("img.resizable");
		var big = $(img).attr("data-big");
		$(img).attr("data-big", $(img).attr("src"))
			  .attr("src", big)
			  .toggleClass("resize");
	});

	/**
	 * @see http://www.basic-slider.com
	 */
	$('#people-slider').bjqs({
	        'height' : 350,
	        'width' : 1000,
			'showcontrols': false,
			'showmarkers': false,
			'automatic': true,
			'animtype': 'slide',
			'animspeed': 4000
	});
	$('#home-slider').bjqs({
	        'height' : 860,
	        'width' : 700,
			'showcontrols': false,
			'showmarkers': false,
			'automatic': true,
			'animtype': 'fade',
			'animspeed': 4000,
			'animduration': 0
	});

    // Bind to scroll
    $(window).scroll(function(){
       // Get container scroll position
       //var fromTop = $(this).scrollTop()+topMenuHeight;

       // Get id of current scroll item
		/*
       var cur = scrollItems.map(function(){
         if ($(this).offset().top < fromTop)
           return this;
       });
       // Get the id of the current element
       cur = cur[cur.length-1];
       var id = cur && cur.length ? cur[0].id : "";

       menuItems
            .parent().removeClass("active")
            .end().filter("[href=#"+id+"]").parent().addClass("active");
		*/
    });
  	if ( ! is_touch_device) {
	    $(window).scroll(function() {
	        if ( ! docked && ($(window).scrollTop() > 420)) {
	    	    // if yes, add “fixed” class to the <nav>
	       	    // add padding top to the #content  (value is same as the height of the nav)
	       	    $('.navscroll').addClass('fixed');
				$("a#scrolltop").addClass('visible');
	    		docked = true;
	    	} else if ($(window).scrollTop() < 420) {
	    		$('.navscroll').removeClass('fixed');
				$("a#scrolltop").removeClass('visible');
	    		docked = false;
	    	}
	    });
	}
    
    $('.navscroll a').click(function (e) {
        $(window).scrollTo($(this).attr('href'), 800, { offset: {top: 0, left: 0} });
        //window.location = $(this).attr('href');
        e.preventDefault();
    });

	/**
	 * @see http://jsfiddle.net/aPLLF/2/
	 */
	$("#q").keyup(function(){
		// When value of the input is not blank
        var term=$(this).val();
		if( term != "")
		{
			// Show only matching TR, hide rest of them
			$("article.category tbody>tr").hide();
            $("article.category td").filter(function(){
                   return $(this).text().toLowerCase().indexOf(term.toLowerCase()) >-1
            }).parent("tr").show();
		}
		else
		{
			// When there is no input or clean again, show everything back
			$("article.category tbody>tr").show();
		}
	});
    
});