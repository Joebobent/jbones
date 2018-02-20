<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
$pageTitleAlign = get_post_meta( get_queried_object_id(), 'jbn_title_align', true );
$defaultTitleAlign = get_theme_mod( 'header_txtalign' );
if ( $pageTitleAlign || $defaultTitleAlign ) {
	if ( $pageTitleAlign ) { $titleAlign = $pageTitleAlign; }
	else { $titleAlign = $defaultTitleAlign; }
}
// Layout for blog page
$blogType = get_theme_mod( 'blog_type' );
// Need to use get_queried_object_id() to fetch metadata on blog page.
$titleHide = get_post_meta( get_queried_object_id(), 'jbn_hide_title', true );

get_header(); ?>

	<div id="primary" class="content-area<?php
		if ( $blogType ) { echo " $blogType"; }?>">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header class="page-header<?php
					if ( $blogFormatsIcons ) { echo " icon"; }
					if ( $titleAlign ) { echo " align-$titleAlign"; } else { echo ' align-center'; }
					echo '"';
					if ( $headerBG ) {
						echo ' style="'; // Easily add inline styles
						if ( $headerBG ) { echo "background-image:url('$headerBG'); "; }
						echo '">';
					} else { echo '>'; }
				?>
					<h1 class="page-title<?php if ( $titleHide ) { echo ' hidden'; }?>"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
