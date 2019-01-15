jQuery(document).ready(function($) {
	var $loader = $('.mft_load_more_ajax');
	var cat = $loader.data('category');
	var ppp = 10;
	var offset = $('.reviews-holder').find('.review-single').length + 1;
	
	$('button.load-more-posts').click(function(e) {
		//Prevent button action
		e.preventDefault();
		
		var button = $(this);
		var currentCount = $('.reviews-holder').find('.review-single').length;
		var totalCount = currentCount + ppp;
		
		// Disable button
		button.prop( "disabled" , true );
		
		// Record Nonce
		var nonce = $(this).data("nonce");
		
		// Set AJAX parameters
		data = {
			action: 'mft_load_more_ajax',
			nonce: nonce,
			cat: cat,
			ppp: ppp,
			
			offset: offset,
		};
	
		$.post(mft_load_more_ajax.ajaxurl, data, function(response) {
			// Set Container Name
			var response = JSON.parse(response);
			
			// Run through JSON
			$.each( response, function( key, value ) {
				// Set Value
				var val = $(value);
				
				$('.reviews-holder').append(val)
				// add and lay out newly appended items
        .isotope( 'appended', val ); 			
    });
			
			var intervalID = setInterval(function() {   
			    var itemCount = $('.reviews-holder').find('.review-single').length;
			    
			    if (itemCount == totalCount) {
				    var lastElement = $('.reviews-holder').find('.review-single i').length;
				    
				    if ($(lastElement).length) {
						$('.case-study-content').matchHeight();
						$('.case-study-item.equalizeme').matchHeight();
						$('.post-item.equalizeme').matchHeight();
						$('.post-item h3.post-title').matchHeight();
						$('.post-item .post-image').matchHeight();
						$('.archive.category .tmb').matchHeight();
						$('.archive.category .tmb .t-inside').matchHeight();
						$('.archive.category .tmb .t-entry-visual').matchHeight();		
						$('.archive.category .tmb .t-entry-title').matchHeight();
						$('.archive.category .tmb .t-entry p').matchHeight(); 	
						$('.post-item .post-content-block').matchHeight();
						$('.reviews-holder').isotope( 'layout' )
						clearInterval(intervalID);
					}
				 }
		
		    }, 7);
		    
		    setTimeout(function() {
		        clearInterval(intervalID);
		    }, 750);
			    
			// Undo Button Disable
			button.prop( "disabled" , false );
			
			// Set Offest
			offset += ppp;
			
			return false;
		});
	});
});