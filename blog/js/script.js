(function($){
	"use strict";

	$(function(){

		/* ---------------------------------------------------- */
		/*	Revolution slider									*/
		/* ---------------------------------------------------- */

		if ($('#slider1').length) {
			jQuery("#slider1").revolution({
	           sliderType:"standard",
	           sliderLayout:"auto",
	           delay:9000,
	           navigation: {
	               arrows:{enable:true} 
	           }, 
	           gridwidth:1170,
	           gridheight:965
	        });
	    }

		/* ---------------------------------------------------- */
        /*	Gallery carousel									*/
        /* ---------------------------------------------------- */

	  	$.mad_global.mad_init_carousel();

		/* ---------------------------------------------------- */
        /*	Tabs												*/
        /* ---------------------------------------------------- */

		var tabs = $('.tabs-section');
		if(tabs.length){
			tabs.tabs({
				beforeActivate: function(event, ui) {
			        var hash = ui.newTab.children("li a").attr("href");
			   	},
				hide : {
					effect : "fadeOut",
					duration : 450
				},
				show : {
					effect : "fadeIn",
					duration : 450
				},
				updateHash : false
			});
		}

		if($('ul.smooth_tabs').length){
			$('ul.smooth_tabs li:first').addClass('ui-tabs-active');

			$('ul.smooth_tabs li a').on("click", function(){
			   $('ul.smooth_tabs').find('li').removeClass('ui-tabs-active');
			   $(this).parent('li').addClass("ui-tabs-active");
			  
			   var x = $(this).attr('href');
			   $(".smooth_item").removeClass('current_catalog_item');
			   $(".tabs_content ").children('h3').removeClass('current_catalog_item');
			   $(x).addClass('current_catalog_item');
			});
		}

		/* ---------------------------------------------------- */
        /*	Newsletter											*/
        /* ---------------------------------------------------- */

	    var subscribe = $('[id^="newsletter"]');
	      subscribe.append('<div class="message-container-subscribe"></div>');
	      var message = $('.message-container-subscribe'),text;

	      subscribe.on('submit',function(e){
	        var self = $(this);
	        
	        if(self.find('input[type="email"]').val() == ''){
	          text = "Please enter your e-mail!";
	          message.html('<div class="alert-box warning"><p>'+text+'</p></div>')
	            .slideDown()
	            .delay(4000)
	            .slideUp(function(){
	              $(this).html("");
	            });

	        }else{
	          self.find('span.error').hide();
	          $.ajax({
	            type: "POST",
	            url: "bat/newsletter.php",
	            data: self.serialize(), 
	            success: function(data){
	              if(data == '1'){
	                text = "Your email has been sent successfully!";
	                message.html('<div class="alert-box success"><p>'+text+'</p></div>')
	                  .slideDown()
	                  .delay(4000)
	                  .slideUp(function(){
	                    $(this).html("");
	                  })
	                  .prevAll('input[type="email"]').val("");
	              }else{
	                text = "Invalid email address!";
	                message.html('<div class="alert-box error"></i><p>'+text+'</p></div>')
	                  .slideDown()
	                  .delay(4000)
	                  .slideUp(function(){
	                    $(this).html("");
	                  });
	              }
	            }
	          });
	        }
	        e.preventDefault();
	    });

		/* ---------------------------------------------------- */
        /*	Loader												*/
        /* ---------------------------------------------------- */

		$("body").queryLoader2({
	        backgroundColor: '#fff',
	        barColor : '#ffa687',
	        barHeight: 4,
	        deepSearch:true,
	        minimumTime:1000,
	        onComplete: function(){
	        	$(".loader").fadeOut('200');
	        }
      	});

		/* ---------------------------------------------------- */
        /*	Sticky menu											*/
        /* ---------------------------------------------------- */

		$('body').Temp({
			sticky: true
		});

		/* ---------------------------------------------------- */
        /*	SmoothScroll										*/
        /* ---------------------------------------------------- */

		try {
			$.browserSelector();
			var $html = $('html');
			if ( $html.hasClass('chrome') || $html.hasClass('ie11') || $html.hasClass('ie10') ) {
				$.smoothScroll();
			}
		} catch(err) {}

		// fancybox

		if ($('a.gallery').length) {
			$('a.gallery').fancybox();
		}

		if ($('a.video').length) {
			$("a.video").on("click", function(){
		        $.fancybox({
		          href: this.href,
		          type: $(this).data("type")
		        }); // fancybox
		        return false;
		    }); // on
		}

	    /* ---------------------------------------------------- */
        /*	Custom Select										*/
        /* ---------------------------------------------------- */

		if ($('.custom-select').length) {
			$('.custom-select').mad_custom_select();
		}

		/* ---------------------------------------------------- */
        /*	Accordion & Toggle									*/
        /* ---------------------------------------------------- */

		var aItem = $('.accordion:not(.toggle) .accordion-item'),
			link = aItem.find('.a-title'),
			$label = aItem.find('label'),
			aToggleItem = $('.accordion.toggle .accordion-item'),
			tLink = aToggleItem.find('.a-title');

			aItem.add(aToggleItem).children('.a-title').not('.active').next().hide();

		function triggerAccordeon($item) {
			$item
			.addClass('active')
			.next().stop().slideDown()
			.parent().siblings()
			.children('.a-title')
			.removeClass('active')
			.next().stop().slideUp();
		}


		if ($label.length) {
			$label.on('click',function(){
				triggerAccordeon($(this).closest('.a-title'))
			});
		} else {
			link.on('click',function(){
				triggerAccordeon($(this))
			});
		}

		tLink.on('click',function(){
			$(this).toggleClass('active')
			.next().stop().slideToggle();

		})

		/* ---------------------------------------------------- */
        /*	Contact Form										*/
        /* ---------------------------------------------------- */

		if ($('#contact-form').length){

			var cf = $('#contact-form');
			cf.append('<div class="message-container"></div>');

			cf.on("submit",function(event){

				var self = $(this),text;

				var request = $.ajax({
					url:"bat/mail.php",
					type : "post",
					data : self.serialize()
				});

				request.then(function(data){
					if(data == "1"){

						text = "Your message has been sent successfully!";

						cf.find('input:not([type="submit"]),textarea').val('');

						$('.message-container').html('<div class="alert-box success"><i class="icon-smile"></i><p>'+text+'</p></div>')
							.delay(150)
							.slideDown(300)
							.delay(4000)
							.slideUp(300,function(){
								$(this).html("");
							});

					}
					else{
						if(cf.find('textarea').val().length < 20){
							text = "Message must contain at least 20 characters!"
						}
						if(cf.find('input').val() == ""){
							text = "All required fields must be filled!";
						}
						$('.message-container').html('<div class="alert-box error"><i class="icon-warning"></i><p>'+text+'</p></div>')
							.delay(150)
							.slideDown(300)
							.delay(4000)
							.slideUp(300,function(){
								$(this).html("");
							});
					}
				},function(){
					$('.message-container').html('<div class="alert-box error"><i class="icon-warning"></i><p>Connection to server failed!</p></div>')
							.delay(150)
							.slideDown(300)
							.delay(4000)
							.slideUp(300,function(){
								$(this).html("");
							});
				});

				event.preventDefault();

			});

		}
    
		/* ---------------------------------------------------- */
		/*	Main elements run									*/
		/* ---------------------------------------------------- */

		$.mad_core.run();
    
	});

})(jQuery);