<?php
/**
 * Post / Page Metabox Configurations
 *
 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
 * @tutorial https://www.smashingmagazine.com/2011/10/create-custom-post-meta-boxes-wordpress/
 *
 * @package J-Bones
 */

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'jbn_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'jbn_post_meta_boxes_setup' );

/* Meta box setup function. */
function jbn_post_meta_boxes_setup() {
	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'jbn_add_meta_boxes' );
	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'jbn_save_meta', 10, 2 );
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
function jbn_add_meta_boxes() {
	add_meta_box(
		'jbn-above-content',      // Unique ID
		esc_html__( 'Top Content', 'example' ),    // Title
		'jbn_above_content_meta_box',   // Callback function
		'page',         // Admin page (or post type)
		'normal',       // Context
		'high'       // Priority
    );
	add_meta_box(
		'jbn-post-class',      // Unique ID
		esc_html__( 'Page Class', 'example' ),    // Title
		'jbn_post_class_meta_box',   // Callback function
		'page',         // Admin page (or post type)
		'side',         // Context
		'default'       // Priority
    );
	add_meta_box(
		'jbn-post-class',      // Unique ID
		esc_html__( 'Post Class', 'example' ),    // Title
		'jbn_post_class_meta_box',   // Callback function
		'post',         // Admin page (or post type)
		'side',         // Context
		'default'       // Priority
    );
	add_meta_box(
		'jbn-sidebar',      // Unique ID
		esc_html__( 'Page Sidebar', 'example' ),    // Title
		'jbn_post_sidebar_meta_box',   // Callback function
		'page',         // Admin page (or post type)
		'side',         // Context
		'default'       // Priority
    );
	add_meta_box(
		'jbn-sidebar',      // Unique ID
		esc_html__( 'Post Sidebar', 'example' ),    // Title
		'jbn_post_sidebar_meta_box',   // Callback function
		'post',         // Admin page (or post type)
		'side',         // Context
		'default'       // Priority
    );
	add_meta_box(
		'jbn-header',      // Unique ID
		esc_html__( 'Page Header Settings', 'example' ),    // Title
		'jbn_header',   // Callback function
		'page',         // Admin page (or post type)
		'side',         // Context
		'default'       // Priority
	);
	add_meta_box(
		'jbn-header',      // Unique ID
		esc_html__( 'Post Header Settings', 'example' ),    // Title
		'jbn_header',   // Callback function
		'post',         // Admin page (or post type)
		'side',         // Context
		'default'       // Priority
	);
}

/*
 * --- Top Content ---
 * Content to display above content & sidebar
 */
function jbn_above_content_meta_box( $object, $box ) { ?>
	<?php
	wp_nonce_field( basename( __FILE__ ), 'jbn_above_content_nonce' );
	global $post;
	$values = get_post_custom( $post->ID );
	$check = isset( $values['jbn-top-page'] ) ? true : false;
	?>
	<div>
		<label for="jbn-above-content"><?php _e( "Content to be used above the content & sidebar.", 'example' ); ?></label><br>
		<label for="jbn-top-page" style="display:block;margin:5px 0;">
		<input id="jbn-top-page" type="checkbox" name="jbn-top-page" <?php checked( $check, true ); ?>><?php _e( "Go above site header.", 'example' ); ?></label>
		<?php
		$top_content = esc_attr( get_post_meta( $object->ID, 'jbn-above-content', true ) );
		$top_content_args = array(
			'textarea_rows' 	=> 5,
			'textarea_name' 	=> 'jbn-above-content',
			'drag_drop_upload' 	=> true,
			'quicktags'			=> false
			);
		wp_editor( $top_content, 'top-content-editor', $top_content_args );
		?>
	</div>
<?php }

/*
 * Sidebar Selection.
 */
function jbn_post_sidebar_meta_box( $object, $box ) { ?>
	<?php wp_nonce_field( basename( __FILE__ ), 'jbn_sidebar_nonce' ); // Security ?>
	<?php // Populate Sidebars
	$sidebar_options = array();
	$sidebars = $GLOBALS['wp_registered_sidebars'];
	foreach ( $sidebars as $sidebar ){
		$sidebar_options[] = array(
			'name'  => $sidebar['name'],
			'value' => $sidebar['id']
		);
	}
	$jbn_values = get_post_custom( $post->ID );
	$jbn_sidebar_selected = isset( $jbn_values['jbn_sidebar'] ) ? esc_attr( $jbn_values['jbn_sidebar'][0] ) : '';
	?>

	<p>
		<label for=""><?php echo $jbn_sidebar_check; ?></label>
		<label for="jbn_sidebar"><?php _e( "Choose a Sidebar:", 'example' ); ?></label>
		<br />
		<select name="jbn_sidebar">
			<option value="disable_sidebar" <?php selected( $jbn_sidebar_selected, $value ); ?>>Disable Sidebar</option>
			<?php foreach( $sidebar_options as $option ){ ?>
				<?php $value = $option['value']; ?>
				<option value="<?php echo $value; ?>"<?php selected( $jbn_sidebar_selected, $value ); ?>><?php echo $option['name']; ?></option>
			<?php } ?>
		</select>
		<br />
	</p><?php
}

/* Post / Page Class - Display the post meta box. */
function jbn_post_class_meta_box( $object, $box ) {
	wp_nonce_field( basename( __FILE__ ), 'jbn_post_class_nonce' ); ?>
	<p>
		<label for="jbn-post-class"><?php _e( "Add a custom CSS class to be applied to this post.", 'example' ); ?></label>
		<br />
		<input class="widefat" type="text" name="jbn-post-class" id="jbn-post-class" value="<?php echo esc_attr( get_post_meta( $object->ID, 'jbn_post_class', true ) ); ?>" size="30" />
	</p><?php
}

/* Post / Page Title */
function jbn_header( $post ) {
	// Variables
	$values = get_post_custom( $post->ID );
	$alignSelected = isset( $values[ 'jbn_title_align' ] ) ? esc_attr( $values['jbn_title_align'][0] ) : '';
	$hideChecked = isset( $values['jbn_hide_title'] ) ? esc_attr( $values['jbn_hide_title'][0] ) : '';

	// Header nonce
	wp_nonce_field( basename( __FILE__ ), 'jbn_header_nonce' );

	// Media Uploader
	global $content_width, $_wp_additional_image_sizes;
	$image_id = get_post_meta( $post->ID, '_header_background_id', true );
	$old_content_width = $content_width;
	$content_width = 254;
	if ( $image_id && get_post( $image_id ) ) {
		if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
			$thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
		} else {
			$thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
		}
		if ( ! empty( $thumbnail_html ) ) {
			$content = $thumbnail_html;
			$content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_header_background_button" >' . esc_html__( 'Remove header background image', 'text-domain' ) . '</a></p>';
			$content .= '<input type="hidden" id="upload_header_background" name="_haederbg_cover_img" value="' . esc_attr( $image_id ) . '" />';
		}
		$content_width = $old_content_width;
	} else {
		$content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
		$content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set header background image', 'text-domain' ) . '" href="javascript:;" id="upload_header_background_button" id="set-header-background" data-uploader_title="' . esc_attr__( 'Choose an image', 'text-domain' ) . '" data-uploader_button_text="' . esc_attr__( 'Set header background image', 'text-domain' ) . '">' . esc_html__( 'Set header background image', 'text-domain' ) . '</a></p>';
		$content .= '<input type="hidden" id="upload_header_background" name="_haederbg_cover_img" value="" />';
	}
	echo $content;

	// Text Align
	?>
 	<p>
		<label for="jbn_title_align"><?php _e( "Title Alignment:", 'example' ); ?></label>
		<select name="jbn_title_align" id="jbn_title_align">
			<option value="" <?php selected( $alignSelected, '' ) ?>>Default</option>
			<option value="left" <?php selected( $alignSelected, 'left' ) ?>>Left</option>
			<option value="center" <?php selected( $alignSelected, 'center' ) ?>>Center</option>
			<option value="right" <?php selected( $alignSelected, 'right' ) ?>>Right</option>
		</select>
	</p>
	<p>
		<label for="jbn_hide_title">Hide Title?</label>
		<input type="checkbox" name="jbn_hide_title" id="jbn_hide_title" <?php checked( $hideChecked, 'on' ); ?>>
	</p>
	<?php
}

function jbn_media_uploader($hook) {
	if( $hook != 'post.php' && $hook != 'post-new.php' ) {	return;	}
	wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/js/media-uploader.js' );
}
add_action('admin_enqueue_scripts', 'jbn_media_uploader');



/*
 * Save the metadata
 */
function jbn_save_meta( $post_id, $post ) {

	/*
	 * Header Options
	 * Verify the nonce before proceeding.
	 */
	if ( !isset( $_POST['jbn_header_nonce'] ) || !wp_verify_nonce( $_POST['jbn_header_nonce'], basename( __FILE__ ) ) ) return $post_id;
	/* Save Media Image */
	if( isset( $_POST['_haederbg_cover_img'] ) ) {
		$image_id = (int) $_POST['_haederbg_cover_img'];
		update_post_meta( $post_id, '_header_background_id', $image_id );
	}
	/* Save Title Alignment
	 * Make sure data is set before trying to save it */
	if ( isset( $_POST['jbn_title_align'] ) )
		update_post_meta( $post_id, 'jbn_title_align', esc_attr( $_POST['jbn_title_align'] ) );
	/* Save Title Hide */
	$titleHide = isset( $_POST['jbn_hide_title'] ) ? 'on' : '';
	   update_post_meta( $post_id, 'jbn_hide_title', $titleHide );
	/*
	 * Above Content
	 * Verify the nonce before proceeding.
	 */
	if ( !isset( $_POST['jbn_above_content_nonce'] ) || !wp_verify_nonce( $_POST['jbn_above_content_nonce'], basename( __FILE__ ) ) )
		return $post_id;
	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );
	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;
	/*  Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['jbn-above-content'] ) ? $_POST['jbn-above-content'] : '' );
	/* Get the meta key. */
	$meta_key = 'jbn-above-content';
	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );
	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
	/*
	 * Above Site Header
	 * Get the posted data and sanitize it for use as an HTML class.
	 */
	$new_meta_value = ( isset( $_POST['jbn-top-page'] ) ? $_POST['jbn-top-page'] : '' );
	/* Get the meta key. */
	$meta_key = 'jbn-top-page';
	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );
	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
	/*
	 * Save Sidebar Option
	 * Bail if we're doing an auto save
	 */
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['jbn_sidebar_nonce'] ) || !wp_verify_nonce( $_POST['jbn_sidebar_nonce'], basename( __FILE__ ) ) )
		return $post_id;
	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );
	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;
	/* Get the posted data. */
	$new_meta_value = ( isset( $_POST['jbn_sidebar'] ) ? $_POST['jbn_sidebar'] : '' );
	/* Get the meta key. */
	$meta_key = 'jbn_sidebar';
	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );
	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );

	/*
	 * Save Class Option
	 * Verify the nonce before proceeding.
	 */
	if ( !isset( $_POST['jbn_post_class_nonce'] ) || !wp_verify_nonce( $_POST['jbn_post_class_nonce'], basename( __FILE__ ) ) )
		return $post_id;
	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );
	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;
	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['jbn-post-class'] ) ? sanitize_html_class( $_POST['jbn-post-class'] ) : '' );
	/* Get the meta key. */
	$meta_key = 'jbn_post_class';
	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );
	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );

}

// Add class 'sidebar' to body tag if Disable Sidebar is NOT checked
add_filter( 'body_class', 'jbn_sidebar_class' );
function jbn_sidebar_class( $classes ) {
	/* Get the current post ID. */
	$post_id = get_the_ID();
	/* If we have a post ID, proceed. */
	if ( !empty( $post_id ) ) {
		/* Aquire sidebar type and apply class if not disable sidebar */
		$sidebar = get_post_meta( $post_id, 'jbn_sidebar', true );
		if ( $sidebar != 'disable_sidebar' && !empty( $sidebar ) ) :
			$classes[] = sanitize_html_class( 'sidebar' );
		endif;
	}
	return $classes;
}

/* Filter the post class hook with our custom post class function. */
add_filter( 'post_class', 'jbn_post_class' );
function jbn_post_class( $classes ) {
	/* Get the current post ID. */
	$post_id = get_the_ID();
	/* If we have a post ID, proceed. */
	if ( !empty( $post_id ) ) {
		/* Get the custom post class. */
		$post_class = get_post_meta( $post_id, 'jbn_post_class', true );
		/* If a post class was input, sanitize it and add it to the post class array. */
		if ( !empty( $post_class ) )
			$classes[] = sanitize_html_class( $post_class );
	}
	return $classes;
}
