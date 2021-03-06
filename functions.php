<?php
/**
 * J-Bones functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package J-Bones
 */


if ( ! function_exists( 'jbn_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function jbn_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on J-Bones, use a find and replace
	 * to change 'jbn' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'jbn', get_template_directory() . '/languages' );

	/**
	 * Custom Post Types:
	 *  - Portfolio
	 *  - Bag of tricks
	 */
	// include_once(ABSPATH . 'wp-content/themes/jbones/posttypes.php');

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu()
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'jbn' ),
		'top-menu' => esc_html__( 'Top Menu', 'jbn' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'jbn' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	if ( get_theme_mod( 'blog_formats' ) ) :
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );
	endif;

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'jbn_custom_background_args', array(
		'default-color' => '',
		'default-image' => '',
	) ) );

}
endif;
add_action( 'after_setup_theme', 'jbn_setup' );



/**
  * Set default embed width & height.
  */
add_filter( 'embed_defaults', 'default_embed_size' );
function default_embed_size() {
	return array( 'width' => 600, 'height' => 600 );
}


/**
 * Filter the excerpt length to 75 characters.
 */
function jbn_excerpt_length( $length ) {
    return 75;
}
add_filter( 'excerpt_length', 'jbn_excerpt_length', 999 );

/**
 * Filter the "read more" excerpt string link to the post.
 */
function wpdocs_excerpt_more( $more ) {
    return sprintf( ' <a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( '..read on', 'textdomain' )
    );
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 * @global int $content_width
 */
function jbn_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'jbn_content_width', 720 );
}
add_action( 'after_setup_theme', 'jbn_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function jbn_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'jbn' ),
		'id'            => 'content-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'jbn' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'jbn' ),
		'id'            => 'footer-widgets',
		'description'   => esc_html__( 'Add widgets here.', 'jbn' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'jbn_widgets_init' );
/**
 * Allow widgets to use shortcodes.
 */
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );


/**
 * Load jQuery
 */
if (!is_admin()) add_action("wp_enqueue_scripts", "portolio_jquery_enqueue", 11);
function portolio_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}


/**
 * Enqueue scripts and styles.
 */
function jbn_scripts() {
	wp_enqueue_style( 'jbn-style', get_stylesheet_uri() );

	// Manually enqued into header.php to add integrety attributes
	// wp_enqueue_style( 'jbn-fontawesome', 'https://use.fontawesome.com/releases/v5.1.0/css/all.css' );

	wp_enqueue_script( 'waypt', get_template_directory_uri() . '/js/waypts.min.js', array(), '', true );

	wp_enqueue_script( 'custom-jquery', get_template_directory_uri() . '/js/custom.js', array(), '', true );

	wp_enqueue_script( 'jbn-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'jbn-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}




add_action( 'wp_enqueue_scripts', 'jbn_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Post / Page metabox data.
 */
require get_template_directory() . '/inc/metabox.php';




