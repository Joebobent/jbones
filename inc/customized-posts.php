	// Set default embed width & height
	// add_filter( 'embed_defaults', 'default_embed_size' );
	// function default_embed_size() {
	// 	return array( 'width' => 600, 'height' => 600 );
	// }

	/**
	 * Filter the "read more" excerpt string link to the post.
	 *
	 * @param string $more "Read more" excerpt string.
	 * @return string (Maybe) modified "read more" excerpt string.
	 */
	function wpdocs_excerpt_more( $more ) {
	    return sprintf( '<a class="read-more" href="%1$s">%2$s</a>',
	        get_permalink( get_the_ID() ),
	        __( '...Get more!', 'textdomain' )
	    );
	}
	add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );
	/**
	 * Filter the except length to 100 characters.
	 *
	 * @param int $length Excerpt length.
	 * @return int (Maybe) modified excerpt length.
	 */
	function wpdocs_custom_excerpt_length( $length ) {
	    return 100;
	}
	add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );
