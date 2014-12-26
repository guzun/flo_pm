// add your custom scripts here
// as the page loads, call these scripts
jQuery(function($) {

});

// Modernizr.load loading the right scripts only if you need them
Modernizr.load([
	{
		// Let's see if we need to load selectivizr
		test : Modernizr.borderradius,
		// Modernizr.load loads selectivizr and Respond.js for IE6-8
		nope : [flo.template_dir + '/js/libs/selectivizr.js', flo.template_dir + '/js/libs/respond.js']
	},{
		test: Modernizr.touch,
		yep:flo.template_dir + '/css/touch.css'
	}
]);

jQuery(function($) {
	var is_single = $('#post').length;
	var posts = $('article.post');

    $.flo = {
        elements:{
            posts:$('article.post'),
            w:$(window),
            b:$('body'),
            h:$('#header-main'),
            l:$('#loading-main')
        },
        options:{
            slider:{
                animation: "slide",
                slideshow: false,
                controlNav: false
            },
            is_mobile:parseInt(flo.is_mobile, 10),
            is_single:$('#post').length
        },
        helpers:{
            place_entry_text:function(key, entry) {
                entry = $(entry);
                var title, wrap;
                wrap = entry.find('span.wrap');
                title = entry.find('span.title-wrap');
                wrap.css('padding-top', (wrap.height() - title.height()) / 2);
            },
            remove_entry_padding:function(key, entry) {
                $(entry).find('span.wrap').css('padding-top', 0);
            },
            goto:function(element) {
                $('body,html').animate({scrollTop: element.offset().top}, 750);
            },
            // reload pinterest script with ajax calls
            pin_load:function(){
                js = $('script[src*="assets.pinterest.com/js/pinit.js"]');
                js.remove();

                var s = document.createElement("script");
                s.type = "text/javascript";
                s.async = true;
                s.src = "http://assets.pinterest.com/js/pinit.js";
                var x = document.getElementsByTagName("script")[0];
                x.parentNode.insertBefore(s, x);
            }
        },
        lazy:function(entries, selector, parent) {
            entries.lazyloader('img', {
                duration: 500,
                before_show: function(img) {
                    $(img).closest(selector).removeClass('loading');
                },
                addScrollTo:parent
            });
        }
    };

    $.flo.ajax_complete = function() {
        try{
            if (!$.flo.elements.posts.length) {
                return;
            }
            FB.XFBML.parse();
            gapi.plusone.go();
            twttr.widgets.load();
            $.flo.helpers.pin_load();
        }catch(ex){}
    };

    $.flo.global_init = function() {
        // open external links in new window
        $("a[rel$=external]").each(function(){
            $(this).attr('target', '_blank');
        });
        $.flo.elements.w.load(function(){
            $.flo.elements.l.fadeOut(800);
        });
        $(document).ajaxComplete($.flo.ajax_complete);
    };




	$.fn.init_posts = function() {
		var init_post = function(data) {
            // close other posts
            data.post.siblings('.open-post').find('a.toggle').trigger('click', {
                hide:true
            });

			var loading = data.post.find('span.loading');

			if (data.more.is(':empty')) {
				data.post.addClass('post-loading');
				loading.css('visibility', 'visible');
                data.more.load(flo.ajax_load_url, {
                    'action':'flotheme_load_post',
                    'id':data.post.data('post-id')
                }, function(){
                    loading.remove();
                    data.more.slideDown(400, function(){
                        data.post.addClass('open-post');
                        data.toggler.text('Close Post');
						$('.video', data.more).fitVids();
                        if (data.scroll) {
                            data.scroll.scrollTo('fast');
                        }
                    });
                    data.post.init_jsscroll_pane();
					init_comments(data.post);
                });
            } else {
                data.more.slideDown(400, function(){
                    data.post.addClass('open-post');
                    data.toggler.text('Close Post');
                    if (data.scroll) {
                        data.scroll.scrollTo('fast');
                    }
                });
            }
		};

		var load_post = function(e, _opts) {
			e.preventDefault();
            var data  = {
                toggler:$(this),
                scroll:false
            };
            var opts = $.extend({
                comments:false,
                hide:false,
                add_comment:false
            }, _opts);
            data.post = data.toggler.parents('article.post');
            data.more = data.post.find('.full');

            if (data.more.is(':visible')) {
                if (opts.hide === true) {
					// quick hide for multiple posts
                    data.more.hide();
                } else {
                    data.more.slideUp(400);
                }
                data.toggler.text('Open Post');
                data.post.removeClass('open-post');
            } else {
                if (typeof(e.originalEvent) != 'undefined' ) {
                    data.scroll = data.post;
                }
                init_post(data);
            }
		};


        var init_comments = function(post) {
            var respond = $('section.respond', post);
            var respond_form = $('form', respond);
            var respond_form_error = $('p.error', respond_form);
            var respond_cancel = $('.cancel-comment-reply a', respond);
            var comments = $('section.comments', post);

            comments.find('.scroll-pane').jScrollPane({
                autoReinitialise: true,
                verticalDragMinHeight: 67,
                animateScroll: true
            });
            
            $('a.comment-reply-link', post).on('click', function(e){
                e.preventDefault();
                var comment = $(this).parents('li.comment');
                comment.find('>div').append(respond);
                respond_cancel.show();
                respond.find('input[name=comment_post_ID]').val(post.data('post-id'));
                respond.find('input[name=comment_parent]').val(comment.data('comment-id'));
                respond.find('input:first').focus();
            }).attr('onclick', '');
            
            respond_cancel.on('click', function(e){
                e.preventDefault();
                comments.after(respond);
                respond.find('input[name=comment_post_ID]').val(post.data('post-id'));
                respond.find('input[name=comment_parent]').val(0);
                $(this).hide();
            });
            
            respond.find('form').validate(); 
            respond.find('input, textarea').placeholder();

            respond_form.ajaxForm({
                'beforeSubmit':function(){
                    respond_form_error.text('').hide();
                },
                'success':function(_data){
                    var data = $.parseJSON(_data);
                    if (data.error) {
                        respond_form_error.html(data.msg).slideDown('fast');
                        return;
                    }
                    var comment_parent_id = respond.find('input[name=comment_parent]').val();
                    var _comment = $(jQuery.parseHTML(data.html));
                    var counter = post.find('.meta .comments'); 
                    var messages = post.find('div.messages');
                    var list;
                    _comment.hide();

                    if (comment_parent_id == 0) {
                        list = comments.find('ol');
                        if (!list.length) {
                            list = $('<ol class="commentlist"></ol>');
                            comments.append(list);
                        }
                    } else {
                        list = $('#comment-' + comment_parent_id).parent().find('ul');
                        if (!list.length) {
                            list = $('<ul class="children"></ul>');
                            $('#comment-' + comment_parent_id).parent().append(list);
                        }
                        respond_cancel.trigger('click');
                    }
                    list.append(_comment);
                    respond.find('textarea').clearFields();
                    counter.text(comments.find('ol li').length);

                    var api = comments.find('.scroll-pane').data('jsp');

                    _comment.show();
                    setTimeout(function() {
                        api.scrollTo(0,_comment.position().top);
                    },1000);

                    messages.hide().html('Thank you for submitting your comment!').slideDown('fast');
                    setTimeout(function(){
                        messages.slideUp('fast');
                    }, 10000);
                },
                error:function(response){
                    var error;
                    if (error = response.responseText.match(/<p\>(.*)<\/p\>/)) {
                        error = error[1];
                    }
                    if (typeof(error) == 'undefined') {
                        error = 'Something went wrong. Please reload the page and try again.';
                    }
                    respond_form_error.html(error).slideDown('fast');
                }
            });
        }
		$(this).each(function(){
			var post = $(this);
            // init lazyloader
            post.find('.full').lazyloader('img', {
                duration: 500
            });

			// init post galleries
			$.flo.elements.w.load(function(){
				$('.preview .flexslider', post).flexslider($.flo.options.slider);
			});
			// do not init ajax posts & comments for mobile
			if (!$.flo.options.is_mobile) {
				// ajax posts enabled
                if (flo.ajax_posts) {
                    $('a.toggle', post).click(load_post);
					$('.video', post).fitVids();
					$('.preview figure a', post).click(function(e){
						e.preventDefault();
						$(this).parents('article.post').find('a.toggle').trigger('click');
					});
                }
			}
		});
		// init ajax comments on a single post if ajax comments are enabled
		if ($.flo.options.is_single && parseInt(flo.ajax_comments, 10)) {
			init_comments($.flo.elements.posts);
		}
		// open single post on page
		if (parseInt(flo.ajax_open_single, 10) && !$.flo.options.is_single && $.flo.elements.posts.length === 1) {
			$.flo.elements.posts.find('a.toggle').trigger('click');
		}
	};
	$.flo.elements.posts.init_posts();

	$.fn.init_gallery = function() {
		$(this).each(function(){
			var gallery = $(this);
			$.flo.elements.w.load(function(){
				$('.flexslider', gallery).flexslider($.flo.options.slider);
			});
		});
	};
	$('#gallery').init_gallery();

    $.fn.init_archives = function() {
        $(this).each(function(){
            var archives = $(this);
            var year = $('#archives-active-year');
            var months = $('div.months div.year-months', archives);
            var arrows = $('a.up, a.down', archives);
            var activeMonth;
            var current, active;
            var animated = false;
			if (months.length == 1) {
				arrows.remove();
				activeMonth = months.filter(':first').addClass('year-active').show();
				year.text(activeMonth.attr('id').replace(/[^0-9]*/, ''));
				return;
			}
            arrows.click(function(e){
                e.preventDefault();
                if (animated) {
                    return;
                }
                var fn = $(this);
                animated = true;
                arrows.css('visibility', 'visible');
                var current = months.filter('.year-active');
                if (fn.hasClass('up')) {
                    active = current.prev();
                    if (!active.length) {
                        active = months.filter(':last');
                    }
                } else {
                    active = current.next();
                    if (!active.length) {
                        active = months.filter(':first');
                    }
                }
                current.removeClass('year-active').fadeOut(150, function(){
                    active.addClass('year-active').fadeIn(150, function(){
                        animated = false;
                    });
                    year.text(active.attr('id').replace(/[^0-9]*/, ''));

                    if (fn.hasClass('up')) {
                        if (!active.prev().length) {
                            arrows.filter('.up').css('visibility', 'hidden');
                        }
                    } else {
                        if (!active.next().length) {
                            arrows.filter('.down').css('visibility', 'hidden');
                        }
                    }
                });
            });
            activeMonth = months.filter(':first').addClass('year-active').show();
            year.text(activeMonth.attr('id').replace(/[^0-9]*/, ''));
            arrows.filter('.up').css('visibility', 'hidden');
        });
    };
    $('#archives .flo-archives').init_archives();
});
