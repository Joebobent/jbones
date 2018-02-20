<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package J-Bones
 */
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

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>


				<header class="page-header<?php
					if ( $titleAlign ) { echo " align-$titleAlign"; } else { echo ' align-center'; }
					echo '"';
					if ( $headerBG ) {
						echo ' style="'; // Easily add inline styles
						if ( $headerBG ) { echo "background-image:url('$headerBG'); "; }
						echo '">';
					} else { echo '>'; }

					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>

				</header><!-- .page-header -->

			<?php
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
