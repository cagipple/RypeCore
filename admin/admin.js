jQuery(document).ready(function($){

	/********************************************/
	/* AJAX SAVE FORM */
	/********************************************/
	$(document).ready(function() {
	   $('#theme-options-form').submit(function() { 
	      $(this).ajaxSubmit({
	      	 onLoading: $('.loader').show(),
	         success: function(){
	         	$('.loader').hide();
	            $('#save-result').fadeIn();
	            setTimeout(function() {
				    $('#save-result').fadeOut('fast');
				}, 2000);
	         }, 
	         timeout: 5000
	      }); 
	      return false; 
	   });
	});

	/********************************************/
	/* COLOR PICKER */
	/********************************************/
    $(function() {
        $('.color-field').wpColorPicker();
    });

	/********************************************/
	/* MEDIA UPLOAD */
	/********************************************/
	var mediaUploader;

	$('.upload_image_button').click(function(e) {
	    e.preventDefault();
	    formfield = jQuery(this).prev('input');

	    // If the uploader object has already been created, reopen the dialog
	    if (mediaUploader) {
	      mediaUploader.open();
	      return;
	    }
	    // Extend the wp.media object
	    mediaUploader = wp.media.frames.file_frame = wp.media({
	      title: 'Choose Image',
	      button: {
	      text: 'Choose Image'
	    }, multiple: false });

	    // When a file is selected, grab the URL and set it as the text field's value
	    mediaUploader.on('select', function() {
	      attachment = mediaUploader.state().get('selection').first().toJSON();
	      $(formfield).val(attachment.url);
	    });
	    // Open the uploader dialog
	    mediaUploader.open();
	});

	/********************************************/
	/* MEDIA REMOVE */
	/********************************************/
	$('.remove').click(function() {
		$(this).parent().find('input[type="text"]').removeAttr('value');
		$(this).parent().find('.option-preview').hide();
	});
	
	/********************************************/
	/* ACCORDIONS */
	/********************************************/
	$(function() {
		$( ".accordion" ).accordion({
			collapsible: true,
			active: false,
			autoHeight: true,
			heightStyle: "content"
		});
		$('.accordion-tab').click(function() {
			var icon = $(this).find('.icon');
			if (icon.hasClass('fa-chevron-right')) {
				$(this).find('.icon').removeClass('fa-chevron-right');
				$(this).find('.icon').addClass('fa-chevron-down');
			} else {
				$(this).find('.icon').removeClass('fa-chevron-down');
				$(this).find('.icon').addClass('fa-chevron-right');
			}
			
			
		});
	});

	/********************************************/
	/* TABS */
	/********************************************/
	$(function() {
		$( "#tabs" ).tabs();
		$(".tab-loader").hide();
	});

	/********************************************/
	/* MORE INFO */
	/********************************************/
	$( ".more-info" ).hover(
	  function() {
	    $( this ).find('.more-info-content').stop(true, true).fadeIn();
	  }, function() {
	    $( this ).find('.more-info-content').stop(true, true).fadeOut();
	  }
	);

});