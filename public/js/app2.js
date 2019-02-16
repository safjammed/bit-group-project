$(document).ready(function(){

	/* Content appear */
	if($('body').hasClass('content-appear')) {
		$('body').addClass('content-appearing')
		setTimeout(function() {
			$('body').removeClass('content-appear content-appearing');
		}, 800);
	}
	
	/* Preloader */
	setTimeout(function() {
		$('.preloader').fadeOut();
	}, 500);

	/* Scroll */
	if(jQuery.browser.mobile == false) {
		function initScroll(){
			$('.custom-scroll').jScrollPane({
				autoReinitialise: true,
				autoReinitialiseDelay: 100
			});
		}

		initScroll();

		$(window).resize(function() {
			initScroll();
		});
	}

	/* Sidebar - if mobile */
	if(jQuery.browser.mobile == true) {
		$('body').removeClass('fixed');
	}

    /* Sidebar - on click */
	$('.large-sidebar .site-sidebar li.with-sub').each(function() {
		var li = $(this),
			clickLink = li.find('>a'),
			subMenu = li.find('>ul');

		clickLink.click(function(){
			if (li.hasClass('active')) {
				li.removeClass('active');
				subMenu.slideUp();
			} else {
				if (!li.parent().closest('.with-sub').length) {
					$('.site-sidebar li.with-sub').removeClass('active').find('>ul').slideUp();
				}
				li.addClass('active');
				subMenu.slideDown();
			}
		});
	});

	/* Sidebar - if active */
	function sidebarIfActive(){
		$('.site-sidebar li.with-sub').removeClass('active').find('>ul').hide();
		var url = window.location;
	    var element = $('.site-sidebar ul li ul li a').filter(function () {
	        return this.href == url || url.href.indexOf(this.href) == 0;
	    });
		element.parent().addClass('active');
		element.parent().parent().parent().addClass('active');

	    if(!$('body').hasClass('compact-sidebar')) {
			element.parent().parent().slideDown();
	    }
	}

	sidebarIfActive();

	/* Sidebar - show and hide */
	$('.site-header .collapse-button').click(function() {
		if ($('body').hasClass('site-sidebar-opened')) {
			$(this).removeClass('active');
			$('body').removeClass('site-sidebar-opened');
			if(jQuery.browser.mobile == false){
				$('html').css('overflow','auto');
			}
		} else {
			$(this).addClass('active');
			$('body').addClass('site-sidebar-opened');
			if(jQuery.browser.mobile == false){
				$('html').css('overflow','hidden');
			}
		}
		if ($('body').hasClass('compact-sidebar')) {
			$('body').removeClass('compact-sidebar').addClass('large-sidebar');
			if(jQuery.browser.mobile == false) {
				$('body').addClass('fixed-sidebar');
				sidebarIfActive();
			}
		}
	});

	/* Sidebar - overlay */
	$('.site-sidebar-overlay').click(function() {
		$('.site-header .collapse-button').removeClass('active');
		$('body').removeClass('site-sidebar-opened');
		if(jQuery.browser.mobile == false){
			$('html').css('overflow','auto');
		}
	});

	/* Sidebar second - toggle */
	$('.site-sidebar-second-toggle').click(function() {
		$(this).toggleClass('active');
		$('.site-sidebar-second').toggleClass('opened');
		$('.template-options').toggle();
	});

	/* Template options */
	$('.template-options input:checkbox').change(function() {
		var setting = $(this).attr('name');

		if($('body').hasClass(setting)) {
			$('body').removeClass(setting);
			if(setting == 'compact-sidebar') {
				sidebarIfActive();
			}
		} else {
			$('body').addClass(setting);
			if(setting == 'compact-sidebar') {
				sidebarIfActive();
			}
		}
	});

	$('.template-options input:radio').change(function() {
		var setting = $(this).val();

		$('body').removeClass (function (index, css) {
			return (css.match (/(^|\s)skin-\S+/g) || []).join(' ');
		});

		$('body').addClass(setting);
		if(setting == 'skin-1' || setting == 'skin-4' || setting == 'skin-5') {
			$('.site-header .navbar').removeClass('navbar-light').addClass('navbar-dark');
			$('.site-sidebar .custom-scroll').removeClass('custom-scroll-light').addClass('custom-scroll-dark');
			$('.site-sidebar .chartist-animated').removeClass('chartist-light').addClass('chartist-dark');
		} else {
			$('.site-header .navbar').removeClass('navbar-dark').addClass('navbar-light');
			$('.site-sidebar .custom-scroll').removeClass('custom-scroll-dark').addClass('custom-scroll-light');
			$('.site-sidebar .chartist-animated').removeClass('chartist-dark').addClass('chartist-light');
		}
	});

	/* Template options - toggle */
	$('.template-options .to-toggle').click(function() {
		$('.template-options').toggleClass('opened');
	});

	/* Hide on outside click */
	$(document).mouseup(function (e) {
	    var container = $('.template-options, .site-sidebar-second, .site-sidebar-second-toggle');

	    if (!container.is(e.target) && container.has(e.target).length === 0) {
	        container.removeClass('opened');
			$('.template-options').show();
	    }
	});

	/* Chat */
	$('.sidebar-chat a, .sidebar-chat-window a').click(function() {
		$('.sidebar-chat').toggle();
		$('.sidebar-chat-window').toggle();
	});

	/* Switchery */
	$('.site-sidebar-second .js-switch').each(function() {
		new Switchery($(this)[0], $(this).data());
	});

});