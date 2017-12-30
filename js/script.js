var ajaxTimeout = 5000;
var ajaxTimeoutMessage = 'The request is aborted due to timeout';

$(function() {

/********************************
  registration and authorization
*********************************/

	// Initialize Viewport
	function viewport() {
		var e = window, a = 'inner';
		if( !('innerWidth' in window )) {
			a = 'client';
			e = document.documentElement || document.body;
		}
		return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
	}

	// Validator plugin
	$('input').on('change', function() {
		$(this).closest('form').validator();
	});

	// Bootstrap modal events
	$('#upd_modal').on('show.bs.modal', function() {
		ClassicEditor
	    .create(document.querySelector('#upd_itemeditor'))
	    .then(editor => {
            updEditor = editor;
	   })
	    .catch(error => {
	        console.error(error);
	    });
	});
	$('.modal').on('shown.bs.modal', function() {
		$(this).find('form[data-toggle=validator]').validator();
	});
	$('#upd_modal').on('hidden.bs.modal', function() {
		updEditor.destroy();
	});
	$('.modal').on('hide.bs.modal', function() {
		resetSearch('.item_all_form', '.item_tab');
	});

	// AJAX events
	$(document).on('ajaxStart', function() {
		$('#preloader').show();
	});
	$(document).on('ajaxSuccess', function() {
		$('#preloader').hide();
	});

	// AJAX request to get forms into modal
	$('body').on('click', '.modal-ajax', function(e) {
		e.preventDefault();
		if($(this).is('a')) {
			url = $(this).attr('href');
		}
		else {
			url = $(this).attr('value');
		}
		$('#modal .modal-dialog').hide();
		$('#modal .error').hide();
		$.ajax({
			method: "POST",
			url: url,
			timeout: ajaxTimeout,
			complete: function() {
				$('#modal .modal-dialog').show();
			},
			error: function(jqXHR) {
				var message;
				if (jqXHR.status == 0) {
					message = ajaxTimeoutMessage;
				}
				else {
					message = jqXHR.responseText;
					return false;
				}
				$('#modal .alert-danger').text(message);
				$('#modal .error').show();
			},
			success: function(data) {
				$('#ajax-content').html(data);
				$('.ajax-form').validator();
			} 
		});
	});

	// Registration form. Additional validation by login
	$('body').on('blur', '#login', function() {
		var input = $(this);
		var form = $(this).closest('form');
		$.ajax({
			method: "POST",
			url: form.attr('action'),
			data: {
				login: input.val()
			},
			timeout: ajaxTimeout,
			error: function(jqXHR) {
				var message;
				if (jqXHR.status == 0) {
					message = ajaxTimeoutMessage;
				}
				else {
					message = jqXHR.responseText;
					return false;
				}
				$('#modal .alert-danger').text(message);
				$('#modal .error').show();
			},
			success: function(data) {
				if(data) {
					input.val(data);
					form.find('button[type=submit]').attr('disabled', false);
				}
				else {
					if(input.val() == 0) {
						return;
					}
					else {
						input.closest('.form-group').removeClass('has-success').addClass('has-error has-danger');
						input.closest('.input-group').next('.glyphicon').removeClass('glyphicon-ok').addClass('glyphicon-remove');
						input.closest('.input-group').siblings('.help-block').text('This login is already taken').show();
						form.find('button[type=submit]').attr('disabled', true);
						return;
					}
				}
			} 
		});
	});

	// Authorization form. Additional validation by login & pass
	$('body').on('change', '#signin input', function() {
		var form = $('#signin');
		var login_in = $('#login_in').val();
		var pass_in = $('#pass_in').val();
		var md5 = $.md5(pass_in);

		if(login_in != 0 && pass_in != 0) {
			$.ajax({
				method: "POST",
				url: form.attr('action'),
				data: {
					login_in: login_in,
					pass_in: md5
				},
				timeout: ajaxTimeout,
				error: function(jqXHR) {
					var message;
					if (jqXHR.status == 0) {
						message = ajaxTimeoutMessage;
					}
					else {
						message = jqXHR.responseText;
						return false;
					}
					$('#modal .alert-danger').text(message);
					$('#modal .error').show();
				},
				success: function(data) {
					if(data) {
						login_in;
						md5;

						form.find('.form-group').removeClass('has-error has-danger').addClass('has-success');
						form.find('.glyphicon').removeClass('glyphicon-remove').addClass('glyphicon-ok');
						form.find('.help-block:last').text('').hide();
						form.find('button[type=submit]').attr('disabled', false);
					}
					else {
						form.find('.form-group').removeClass('has-success').addClass('has-error has-danger');
						form.find('.glyphicon').removeClass('glyphicon-ok').addClass('glyphicon-remove');
						form.find('.help-block:last').text('Incorrect login or password').show();
						form.find('button[type=submit]').attr('disabled', true);
						return;
					}
				} 
			});
		}
		else {
			return;
		}
	});

	// forgot pass form. Additional validation for login
	$('body').on('blur', '#login_ch', function() {
		var input = $(this);
		var form = $(this).closest('form');
		$.ajax({
			method: "POST",
			url: form.attr('action'),
			data: {
				login_ch: input.val()
			},
			timeout: ajaxTimeout,
			error: function(jqXHR) {
				var message;
				if (jqXHR.status == 0) {
					message = ajaxTimeoutMessage;
				}
				else {
					message = jqXHR.responseText;
					return false;
				}
				$('#modal .alert-danger').text(message);
				$('#modal .error').show();
			},
			success: function(data) {
				if(data) {
					input.val(data);
					form.find('button[type=submit]').attr('disabled', false);
				}
				else {
					if(input.val() == 0) {
						return;
					}
					else {
						input.closest('.form-group').removeClass('has-success').addClass('has-error has-danger');
						input.closest('.input-group').next('.glyphicon').removeClass('glyphicon-ok').addClass('glyphicon-remove');
						input.closest('.input-group').siblings('.help-block').text('Invalid username').show();
						form.find('button[type=submit]').attr('disabled', true);
						return;
					}
				}
			} 
		});
	});


/********************************
  homepage
*********************************/

	// Home slider size
	function homeBannerSize() {
	//	if(viewport().width > 991) {
	//		bannerHeight = $(window).height();
	//	}
	//	else {
			bannerHeight = $(window).height() - $('header').innerHeight();
	//	}
		$('.home_banner').css('height', bannerHeight);
	}
	homeBannerSize();

	// Slick Slider
	$('.main_slider').slick({
		autoplay: true,
		autoplaySpeed: 6000,
		infinite: true,
		fade: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		dots: true,
		pauseOnHover: false,
		draggable: false,
		cssEase: 'linear'
	});


/********************************
  catalog page
*********************************/
	
	// UI slider
	function sliderRange() {
		$("#slider-range").slider({
			range: true,
			min: 0,
			max: 2000,
			values: [100, 500],
			slide: function(event, ui) {
				$("#range").val(ui.values[0]+ "-" + ui.values[1]);
			}
		});
		$("#range").val("$" + $( "#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));
	}
	sliderRange();

	// Get all items from each category
	$('#cat_catid').on('change', function() {
		var sel = $(this);
		var form = $(this).closest('form');
		$.ajax({
			url: form.attr('action'),
			method: "POST",
			dataType: "text",
			data: {cat_catid: sel.val()},
			timeout: ajaxTimeout,
			error: function(jqXHR, textStatus, errorThrown) {
				var message;
				if (jqXHR.status == 0) {
					message = ajaxTimeoutMessage;
				}
				else {
					message = jqXHR.responseText;
					return false;
				}
				form.find('.alert-danger').text(message);
				form.find('.error').show();
			},
			success: function(data) {
				$('#ajax-catalog').empty();
				$('#ajax-catalog').html(data);
				sliderRange();
			} 
		});
	});

	// Get all items from price range
	$(document).on('click', '.price_filter', function() {
		var range = $('#range').val();
		var sel = $('#cat_catid').val();
		var form = $(this).closest('form');
		$.ajax({
			url: form.attr('action'),
			method: "POST",
			data: {range: range, cat_catid: sel},
			timeout: ajaxTimeout,
			error: function(jqXHR) {
				var message;
				if (jqXHR.status == 0) {
					message = ajaxTimeoutMessage;
				}
				else {
					message = jqXHR.responseText;
					return false;
				}
				form.find('.alert-danger').text(message);
				form.find('.error').show();
			},
			success: function(data) {
				$('#ajax-catalog').empty();
				$('#ajax-catalog').html(data);
				sliderRange();
			} 
		});
	});

	// Add item to the cart
	$(document).on('click', '.to_cart', function() {
		var cartid = $(this).attr('id').slice(4);
		var sel = $('#cat_catid').val();
		var form = $(this).closest('form');
		$.ajax({
			url: "inc/cart_insert.php",
			method: "POST",
			data: {
				cartid: cartid,
				cat_catid: sel
			},
			timeout: ajaxTimeout,
			error: function(jqXHR) {
				var message;
				if (jqXHR.status == 0) {
					message = ajaxTimeoutMessage;
				}
				else {
					message = jqXHR.responseText;
					return false;
				}
				form.find('.alert-danger').text(message);
				form.find('.error').show();
			},
			success: function(data) {
				var clicked = $('.cart span').text();
				clicked++;
				$('.cart span').text(clicked);
				$('#ajax-catalog').empty();
				$('#ajax-catalog').html(data);
				sliderRange();
			} 
		});
	});


/********************************
  single item page
*********************************/

	// Slick Slider
	$('.item_slider').slick({
		autoplay: true,
		autoplaySpeed: 4000,
		infinite: true,
	  //fade: true,
		adaptiveHeight: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		dots: true,
		draggable: false,
		cssEase: 'linear'
	});

	// Raty plugin (for adding comments)
	$('#rating_in').raty({
		score: function() {
		    return $(this).attr('data-rating');
	  	},
		path: '../images/layout',
		width: 'auto',
		scoreName: 'ratingin'
	});

	// Raty plugin (for show comments)
	function ratingOut() {
		$('.rating_out').raty({
			path: '../images/layout',
			width: 'auto',
			hints: ['','','','',''],
			readOnly : true,
			score: function() {
				return $(this).attr('data-rating');
			}
		});
	}
	ratingOut();

	// Add comment
	$(document).on('click', '#add_comm', function(e) {
		e.preventDefault();
		var form = $(this).closest('form');
		$.ajax({
			url: form.attr('action'),
			method: "POST",
			data: form.serialize(),
			timeout: ajaxTimeout,
			error: function(jqXHR) {
				var message;
				if (jqXHR.status == 0) {
					message = ajaxTimeoutMessage;
				}
				else {
					message = jqXHR.responseText;
					return false;
				}
				console.log(message);
			},
			success: function(data) {
				form[0].reset();
				$('#rating_in').raty('reload'); 
				$('#add_comm').addClass('disabled');
				$('.comment_block.all').html(data);
				ratingOut();
			} 
		});
	});


/********************************
  cart page
*********************************/

	// Show & Hide order number form for unregister users
	$('#setorder').on('click', function() {
		$('.order_wrap + p').hide();
		$(this).hide();
		$(this).next('div').fadeIn();
	});
	$('.order_wrap .close').on('click', function() {
		$(this).closest('div').fadeOut();
		setTimeout(function() {
			$('#setorder').fadeIn();
		}, 290);
	});

	// Item action in the 'Cart' page
	function cartAction($buy) {
		if(!$buy) {
			var buy_id = item_id;
		}
		var form = $('.cart_form');
		$.ajax({
			url: form.attr('action'),
			method: "POST",
			data: {
				cart_id: cart_id,
				item_id: item_id,
				buy_id: buy_id
			},
			timeout: ajaxTimeout,
			error: function(jqXHR) {
				var message;
				if (jqXHR.status == 0) {
					message = ajaxTimeoutMessage;
				}
				else {
					message = jqXHR.responseText;
					return false;
				}
				console.log(message);
			},
			success: function(data) {
				var clicked = $('.cart span').text();
				clicked--;
				$('.cart span').text(clicked);
				form[0].reset();
				form.html(data);
			} 
		});
	}
	// Delete item from cart
	$(document).on('click', '.del_cart', function() {
		cart_id = $(this).attr('id').slice(7);
		item_id = $(this).attr('data-itemid');
		cartAction(true);
	});
	// Buy item
	$(document).on('click', '.buy_cart', function() {
		cart_id = $(this).prev('button').attr('id').slice(7);
		item_id = $(this).prev('button').attr('data-itemid');
		cartAction(false);
	});


/********************************
  archive page
*********************************/
	
	// Update item count
	$(document).on('click', '.upd_id', function() {
		var upd_id = $(this).attr('id').slice(3);
		var upd_count = $(this).prev('input[type=number]').val();
		var upd_itemid = $(this).siblings('.upd_itemid').val();
		var form = $(this).closest('form');
		$.ajax({
			method: "POST",
			url: form.attr('action'),
			data: {
				upd_id: upd_id,
				upd_itemid: upd_itemid,
				upd_count: upd_count
			},
			dataType: "json",
			timeout: ajaxTimeout,
			error: function(jqXHR) {
				var message;
				if (jqXHR.status == 0) {
					message = ajaxTimeoutMessage;
				}
				else {
					message = jqXHR.responseText;
					return false;
				}
				form.find('.alert-danger').text(message);
				form.find('.error').show();
			},
			success: function(data) {
				form.html(data);
			}
		});
	});

/********************************
  admin area
*********************************/
	
	// jQuery UI tabs
	$('#tabs').tabs({
		create: function(event, ui) {
			ClassicEditor
		    .create(document.querySelector('#itemeditor'))
		    .then(editor => {
		    	editor.document.on('change', (evt, data) => {
	                this.data = editor.getData();
	                insEditor = editor;
	            });
		    })
		    .catch(error => {
		        console.error(error);
		    });
		}
	});

	// Add Malihu custom scroll into tables
	function tableScroll() {
		$('.table_scrolling tbody').mCustomScrollbar({
			theme: "minimal-dark",
			scrollbarPosition: "outside",
			mouseWheelPixels: 250,
		});
		$('.response_table').mCustomScrollbar({
			theme: "minimal-dark",
			axis: "x",
			scrollbarPosition: "outside",
			mouseWheelPixels: 250,
		});
	}
	tableScroll();

	// Search
	$('.search_data').on('keyup', function() {
		$('#preloader').hide();
		var search = $(this).val();
		var url = $(this).attr('data-url');
		var form = $(this).next('form');
		$.ajax({
			url: url,
			method: "POST",
			data: {search: search},
			timeout: ajaxTimeout,
			beforeSend: function() {
				$('#preloader').hide();
			},
			error: function(jqXHR) {
				var message;
				if (jqXHR.status == 0) {
					message = ajaxTimeoutMessage;
				}
				else {
					message = jqXHR.responseText;
					return false;
				}
				form.find('.alert-danger').text(message);
				form.find('.error').show();
			},
			success: function(data) {
				form.html(data);
				tableScroll();
			}
		});
	});

	// Reset search value after ajax call
	function resetSearch(child, parent) {
		if($(child).closest(parent).find('.search_data').val() != 0) {
			$(child).closest(parent).find('.search_data').val('');
		}
	}

	// Add category
	$('.cat_form').on('submit', function(e) {
		e.preventDefault();
		var form = $(this);
		var input = $(this).find('input[type=text]');
		$.ajax({
			url: form.attr('action'),
			method: "POST",
			data: form.serialize(),
			timeout: ajaxTimeout,
			beforeSend: function() {
				$('#catid').append('<option value="'+input.attr("data-nextid")+'">'+input.val()+'</option>');
			},
			error: function(jqXHR) {
				var message;
				if (jqXHR.status == 0) {
					message = ajaxTimeoutMessage;
				}
				else {
					message = jqXHR.responseText;
					return false;
				}
				form.find('.alert-danger').text(message);
				form.find('.error').show();
			},
			success: function(data) {
				// add increment to data-nextid
				incnextid = input.attr("data-nextid");
				incnextid++;
				input.attr("data-nextid", incnextid);
				form[0].reset();
				$('.cat_all_form').html(data);
				resetSearch(form, '.cat_tab');
				tableScroll();
			} 
		});
	});

	// Delete category
	$(document).on('click', '.del_cat', function(){
		var cat_id = $(this).attr('id').slice(6);
		var form = $(this).closest('form');
		$.ajax({
			url: form.attr('action'),
			method: "POST",
			data: {cat_id:cat_id},
			dataType: "text",
			timeout: ajaxTimeout,
			error: function(jqXHR) {
				var message;
				if (jqXHR.status == 0) {
					message = ajaxTimeoutMessage;
				}
				else {
					message = jqXHR.responseText;
					return false;
				}
				form.find('.alert-danger').text(message);
				form.find('.error').show();
			},
			success: function(data){
				form[0].reset();
				form.html(data);
				$('#catid option[value="'+cat_id+'"]').remove();
				$('.item_all_form tr[data-catid="'+cat_id+'"]').remove();
				resetSearch(form, '.cat_tab');
				tableScroll();
			}
		});
	});

	// Get item data from DB
	$(document).on('click', '.edit_item', function(){
		var item_id = $(this).attr("id").slice(3);
		$.ajax({
			url:"inc/item_update.php",
			method:"POST",
			data:{item_id:item_id},
			dataType:"json",
			timeout: ajaxTimeout,
			error: function(jqXHR) {
				var message;
				if (jqXHR.status == 0) {
					message = ajaxTimeoutMessage;
				}
				else {
					message = jqXHR.responseText;
					return false;
				}
				alert(message);
			},
			success: function(data){
				$('#upd_name').val(data.item);
				$('#upd_count').val(data.count);
				$('#upd_pricein').val(data.pricein);
				$('#upd_pricesale').val(data.pricesale);
				$('#upd_itemeditor').val(data.info);
				$('#item_id').val(data.id);
				$('#upd_modal').modal('show');
				$('#upd_item span:first').text("Update Item");
			}
		});
	});

	// Delete item
	$(document).on('click', '.del_item', function(){
		var item_id = $(this).attr('id').slice(3);
		var form = $(this).closest('form');
		$.ajax({
			url: "inc/item_delete.php",
			method: "POST",
			data: {item_id:item_id},
			dataType: "text",
			timeout: ajaxTimeout,
			error: function(jqXHR) {
				var message;
				if (jqXHR.status == 0) {
					message = ajaxTimeoutMessage;
				}
				else {
					message = jqXHR.responseText;
					return false;
				}
				form.find('.alert-danger').text(message);
				form.find('.error').show();
			},
			success: function(data){
				form[0].reset();
				form.html(data);
				resetSearch(form, '.item_tab');
				tableScroll();
			}
		});
	});

	// Insert & Update item
	$('.item_form').on('submit', function(e) {
		e.preventDefault();
		var form = $(this);
		var container = ($(this).closest('#upd_modal').length > 0) ? '#upd_modal' : '#main';
		if(container == '#upd_modal') {
			updEditor.destroy();
		}
		$.ajax({
			url: "inc/item_insert.php",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			processData: false,
			timeout: ajaxTimeout,
			beforeSend: function() {
				$('#upd_item span:first').text("Inserting");
			},
			error: function(jqXHR) {
				var message;
				if (jqXHR.status == 0) {
					message = ajaxTimeoutMessage;
				}
				else {
					message = jqXHR.responseText;
					return false;
				}
				if(container == '#upd_modal') {
					$('#upd_modal .alert-danger').text(message);
					$('#upd_modal .error').show();
				}
				else {
					$('#main').find('form').find('.alert-danger').text(message);
					$('#main').find('form').find('.error').show();
				}
			},
			success: function(data)
			{
				if (container == '#upd_modal') {
					$(container).modal('hide');
	        		//$('#upd_modal').modal('hide');
				}
				else {
					insEditor.setData('');
				}
				form[0].reset();
				$('.item_all_form').html(data);
				resetSearch('.item_all_form', '.item_tab');
				tableScroll();
			}
		});
	});

	// Change user role & delete user
	$(document).on('click', '.user_action', function() {
		var user_id = $(this).attr('id').slice(2);
		var url = $(this).attr('value');
		var form = $(this).closest('form');
		$.ajax({
			url: url,
			method: "POST",
			data: {user_id: user_id},
			dataType: "text",
			timeout: ajaxTimeout,
			error: function(jqXHR) {
				var message;
				if (jqXHR.status == 0) {
					message = ajaxTimeoutMessage;
				}
				else {
					message = jqXHR.responseText;
					return false;
				}
				form.find('.alert-danger').text(message);
				form.find('.error').show();
			},
			success: function(data){
				form[0].reset();
				form.html(data);
				resetSearch(form, '.user_tab');
				tableScroll();
			}
		});
	});


/*****************************
  mobile navigation
*****************************/

	// Show & hide Mobile menu
	$('.mob_btn').on('click', function() {
		$('body').addClass('device');
		$('.navigation_wrap').animate({ width: '280px', right: 0 }, 500);
		return false;
	});
	$('.mob_close_btn').on('click', function() {
		$('body').removeClass('device');
		$('.navigation_wrap').animate({ width: 0, right: '-80px' }, 500);
		return false;
	});

	// Hide mobile menu on document click
	$(document).on('click', function(e) {
		if( $('body').hasClass('device') ) {
			var elem = $('.navigation_wrap, .mob_btn, .modal');
			if (!elem.is(e.target) && elem.has(e.target).length === 0) {
				$('body').removeClass('device');
				$('.navigation_wrap').animate({ width: 0, right: '-80px' }, 500);
			};
		}
	});

	// Remove mobile settings on window.resize
	function navResize() {
		if( viewport().width > 767 ) {
			$('.navigation_wrap').attr('style', '');
			$('body').removeClass('device');
		}
	}


/*****************************
  changes on window resize
*****************************/

	// Change avatar position
	function avatarPos() {
		if(viewport().width < 768) {
			if( $('.avatar + .mob_close_btn').length < 1 ) {
				$('.avatar').prependTo('.main_navigation');
			}
		} else {
			if( $('.profile .avatar').length < 1 ) {
				$('.avatar').prependTo('.profile');
			}
		}
	}
	avatarPos();

	// Change user menu position
	function userMenuPos() {
		if(viewport().width < 768) {
			if( $('.main_navigation li + .profile li').length < 1 ) {
				$('.profile li').addClass('user_menu_item').appendTo('.main_navigation ul');
			}
		} else {
			if( $('.profile .dropdown-menu li').length < 1 ) {
				$('.user_menu_item').prependTo('.profile .dropdown-menu').removeClass('user_menu_item');
			}
		}
	}
	userMenuPos();

	// Change registration menu position
	function regMenuPos() {
		if(viewport().width < 768) {
			if( $('.main_navigation li + .reg_box a').length < 1 ) {
				$('.reg_box a').prependTo('.main_navigation ul');
				if( !$('.main_navigation .modal-ajax').parent().is("li") ) {
					$('.main_navigation .modal-ajax').wrap("<li></li>")
				}
			}
		} else {
			if( $('.signin + .reg_box span').length < 1 ) {
				if( $('.signin').parent().is("li") ) {
					$('.signin').unwrap();
				}
				$('.signin').prependTo('.reg_box');
			}
			if( $('.reg_box span + .signup').length < 1 ) {
				if( $('.signup').parent().is("li") ) {
					$('.signup').unwrap();
				}
				$('.signup').appendTo('.reg_box');
			}
		}
	}
	regMenuPos();


	// On window.resize
	$(window).resize(function() {
		homeBannerSize();
		navResize();
		avatarPos();
		userMenuPos();
		regMenuPos();
	});

});