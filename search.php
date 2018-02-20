<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package J-Bones
 */

// Variables
$pageHeaderBG_src = get_post_meta( $post->ID, '_header_background_id', true );
$pageHeaderBG = wp_get_attachment_image_src( $pageHeaderBG_src, '', '', array( "class" => "img-responsive" ) );
$defaultHeaderBG = get_header_image();
if ( $pageHeaderBG || $defaultHeaderBG ) {
	if ( $pageHeaderBG[0] ) { $headerBG = $pageHeaderBG[0]; }
	else { $headerBG = $defaultHeaderBG; }
}
$pageTitleAlign = get_post_meta( $post->ID, 'jbn_title_align', true );
$defaultTitleAlign = get_theme_mod( 'header_txtalign' );
if ( $pageTitleAlign || $defaultTitleAlign ) {
	if ( $pageTitleAlign ) { $titleAlign = $pageTitleAlign; }
	else { $titleAlign = $defaultTitleAlign; }
}
$titleHide = get_post_meta($post->ID, 'jbn_hide_title', true);
$featuredImage = get_the_post_thumbnail_url();



get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

	<header class="page-header<?php
		if ($titleHide) { echo " hidden"; }
		if ( $titleAlign ) { echo " align-$titleAlign"; } else { echo ' align-center'; }
		echo '"';
		if ( $headerBG ) {
			echo ' style="'; // Easily add inline styles
			if ( $headerBG ) { echo "background-image:url('$headerBG'); "; }
			echo '">';
		} else { echo '>'; }?>
		<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'jbn' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

	</header><!-- .entry-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
