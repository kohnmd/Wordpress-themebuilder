// This is the main javascript/jquery file.
// It contains misc helper scripts specific to this theme.
//*********************************************************************************


//*********************************************************************************
// Stuff that doesn't need to be loaded in the document.ready section goes here.
// Let's start off with the ShareThis stuff.
//*********************************************************************************

stLight.options({
	publisher: "b751caf0-606d-4e9e-8f14-c82ff55c091c",
	onhover: false
});


//*********************************************************************************
// Now for the document.ready stuff
//*********************************************************************************

jQuery(document).ready(function($){
	
	//*********************************************************************************
	// First, set some variables that might be used a few times in this document.
	//*********************************************************************************
	main_menu = $('#header-menu > div.main_menu > ul, #header-menu ul.main_menu');
	sub_menus = $('ul.children, ul.subchildren', main_menu);
	footer_menu = $('#bottom #footer-menu ul.menu_footer');
	sidebar = $('#sidebar');
	breadcrumbs = $('#crumbs');
	blog_posts = $('#blog-list');
	blog_meta = $('.blog-meta ul');
	comment_links = $('.comment-links');
	
	//*********************************************************************************
	// A few menu changes:
	// - Add home link to main menu
	// - Add class to dropdown li's with flyout submenus
	//*********************************************************************************
	main_menu.prepend(
		'<li class="home"><a href="' + home_url + '">Home</a></li>'
	);
	$('ul.children, ul.sub-menu', sub_menus).parent('li').addClass('with-sub');
	
	
	//*********************************************************************************
	// INSTANTIATE COLORBOX
	//*********************************************************************************
	// This first line automatically adds rel=colorbox to anchors linking to images
	$('a[href$="jpg"], a[href$="jpeg"], a[href$="png"], a[href$="gif"]').attr('rel', 'colorbox');
	$('.bio-gallery a').attr('rel','colorbox-bio-gallery');
	$('.bio-gallery a').has('img').attr('rel','colorbox-bio-gallery2');
	$("a[rel=colorbox]").colorbox({
		maxWidth: "90%",
		maxHeight: "90%",
		opacity: 0.65,
		title: function(){ return jQuery(this).find('img').attr('alt');},
		current: "{current}/{total}"
	});
	$("a[rel=colorbox-bio-gallery]").colorbox({
		iframe: true,
		innerHeight: "337", // 300px image + 20px image margin + 12px plain-content padding
		innerWidth: "620",
		current: "{current}/{total}"
	});
	$("a[rel=colorbox-bio-gallery2]").colorbox({
		iframe: true,
		innerHeight: "337", // 300px image + 20px image margin + 12px plain-content padding
		innerWidth: "620",
		current: "{current}/{total}"
	});
	
	
	//*********************************************************************************
	// Add first & last classes to various items.
	//*********************************************************************************
	function add_first_last_classes(elem) {
		elem.children(':first-child').addClass('first');
		elem.children(':last-child').addClass('last');
	}
	add_first_last_classes( main_menu );
	add_first_last_classes( sub_menus );
	add_first_last_classes( footer_menu );
	add_first_last_classes( sidebar );
	add_first_last_classes( breadcrumbs );
	add_first_last_classes( blog_posts );
	add_first_last_classes( blog_meta );
	add_first_last_classes( comment_links );
	
	
	//*********************************************************************************
	// Misc
	//*********************************************************************************
	// Add your own jQuery stuff here.
	
});