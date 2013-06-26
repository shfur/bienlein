// docked state
var docked = false;
// offset for scrollnav
var offset = 0;

/* Ready, Set, Go. */
$(document).ready(function() {
	
	/**
	 * Isotope on .tiles
	 */
	$(".tiles").isotope({
		itemSelector: ".tile"
	});
    
    /**
	 * @see http://stackoverflow.com/questions/9979827/change-active-menu-item-on-page-scroll and
	 */
    // Cache selectors
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
    
    // Bind to scroll
    $(window).scroll(function(){
       // Get container scroll position
       var fromTop = $(this).scrollTop()+topMenuHeight;

       // Get id of current scroll item
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
    });
    
    $(window).scroll(function() {
        if ( ! docked && ($(window).scrollTop() > 420)) {
    	    // if yes, add “fixed” class to the <nav>
       	    // add padding top to the #content  (value is same as the height of the nav)
       	    $('.navscroll').addClass('fixed');
    		docked = true;
    	} else if ($(window).scrollTop() < 420) {
    		$('.navscroll').removeClass('fixed');
    		docked = false;
    	}
    });
    
    $('.navscroll a').click(function (e) {
        $(window).scrollTo($(this).attr('href'), 800, { offset: {top: 0, left: 0} });
        //window.location = $(this).attr('href');
        //e.preventDefault();
    });
    
});