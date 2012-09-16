// This is the main javascript/jquery file.
// It contains misc helper scripts specific to this theme.
//*********************************************************************************

jQuery(document).ready(function($){
	
	//*********************************************************************************
	// First, set some variables that might be used a few times in this document.
	//*********************************************************************************
	main_menu = $('#header-menu > div.main_menu > ul, #header-menu > ul.main_menu');
	sub_menus = $('ul.children, ul.subchildren', main_menu);
	sidebar = $('#sidebar');
	breadcrumbs = $('#crumbs');
	blog_posts = $('#blog-list');
	blog_meta = $('.blog-meta ul');
	comment_links = $('.comment-links');
	
	//*********************************************************************************
	// A few menu changes:
	// - Add home link
	// - Add class to dropdown li's with flyout submenus
	//*********************************************************************************
	main_menu.prepend(
		'<li class="home"><a href="' + home_url + '">Home</a></li>'
	);
	$('ul.children, ul.sub-menu', sub_menus).parent('li').addClass('with-sub');
	
	
	//*************************************************
	// INSTANTIATE COLORBOX
	//*************************************************
	// This first line automatically adds rel=colorbox to images inside of anchors
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
	
	
	//*************************************************
	// ADDS PLACEHOLDERS TO INPUTS FOR SHITTY BROWSERS
	//*************************************************

	$.placeholder = function() {
		// ALL NON-PASSWORD PLACEHOLDERS
		$('input[type!="password"]').focus(function() {
			var input = $(this);
			if (input.hasClass('placeholder')) {
				input.val('');
				input.removeClass('placeholder');
			}
		}).blur(function() {
			var input = $(this);
				if (input.val() === '') {
					input.addClass('placeholder');
					input.val(input.attr('placeholder'));
				}
		}).blur().parents('form').submit(function() {
			$(this).find('[placeholder]').each(function() {
				var input = $(this);
				if (input.hasClass('placeholder')) {
					input.val('');
				}
			});
		});
		
		// PASSWORD PLACEHOLDERS
		$('input[type="password"],').each(function() {
			var input = $(this);
			input.after('<input id="'+input.attr('id')+'-faux" style="display:none;" type="text" value="' + input.attr('placeholder') + '" />');
			var faux = $('#'+input.attr('id')+'-faux');
			
			faux.show().attr('class', input.attr('class')).attr('style', input.attr('style'));
			faux.addClass('placeholder');
			input.hide();
			
			faux.focus(function() {
				faux.hide();
				input.show().focus();
			});
			input.blur(function() {
				if(input.val() === '') {
					input.hide();
					faux.show();
				}
			});
		});

		// Clear input on refresh so that the placeholder class gets added back
		$(window).unload(function() {
			$('[placeholder]').val('');
		});
	};
	
	//*********************************************************************************
	// Add first & last classes to various items.
	//*********************************************************************************
	function add_first_last_classes(elem) {
		elem.children(':first-child').addClass('first');
		elem.children(':last-child').addClass('last');
	}
	add_first_last_classes( main_menu );
	add_first_last_classes( sub_menus );
	add_first_last_classes( sidebar );
	add_first_last_classes( breadcrumbs );
	add_first_last_classes( blog_posts );
	add_first_last_classes( blog_meta );
	add_first_last_classes( comment_links );
	
});