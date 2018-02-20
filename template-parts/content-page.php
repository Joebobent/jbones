<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package J-Bones
 */

//Variables
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

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header<?php
		if ($titleHide) { echo " hidden"; }
		if ( $titleAlign ) { echo " align-$titleAlign"; } else { echo ' align-center'; }
		echo '"';
		if ( $headerBG ) {
			echo ' style="'; // Easily add inline styles
			if ( $headerBG ) { echo "background-image:url('$headerBG'); "; }
			echo '">';
		} else { echo '>'; }
		the_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jbn' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'jbn' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
