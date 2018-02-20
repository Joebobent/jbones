jQuery(document).ready(function($) {

	// Uploading files
	var file_frame;

	jQuery.fn.upload_header_background = function( button ) {
		var button_id = button.attr('id');
		var field_id = button_id.replace( '_button', '' );

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
		  file_frame.open();
		  return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		  title: jQuery( this ).data( 'uploader_title' ),
		  button: {
		    text: jQuery( this ).data( 'uploader_button_text' ),
		  },
		  multiple: false
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
		  var attachment = file_frame.state().get('selection').first().toJSON();
		  jQuery("#"+field_id).val(attachment.id);
		  jQuery("#jbn-header img").attr('src',attachment.url);
		  jQuery( '#jbn-header img' ).show();
		  jQuery( '#' + button_id ).attr( 'id', 'remove_header_background_button' );
		  jQuery( '#remove_header_background_button' ).text( 'Remove header background image' );
		});

		// Finally, open the modal
		file_frame.open();
	};

	jQuery('#jbn-header').on( 'click', '#upload_header_background_button', function( event ) {
		event.preventDefault();
		jQuery.fn.upload_header_background( jQuery(this) );
	});

	jQuery('#jbn-header').on( 'click', '#remove_header_background_button', function( event ) {
		event.preventDefault();
		jQuery( '#upload_header_background' ).val( '' );
		jQuery( '#jbn-header img' ).attr( 'src', '' );
		jQuery( '#jbn-header img' ).hide();
		jQuery( this ).attr( 'id', 'upload_header_background_button' );
		jQuery( '#upload_header_background_button' ).text( 'Set header background image' );
	});

});
