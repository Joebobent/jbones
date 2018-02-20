<?php
/**
 * Template part for displaying posts.
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
$pageTitleAlign = get_post_meta( $post->ID, 'jbn_title_align', true );
$defaultTitleAlign = get_theme_mod( 'header_txtalign' );
if ( $pageTitleAlign || $defaultTitleAlign ) {
	if ( $pageTitleAlign ) { $titleAlign = $pageTitleAlign; }
	else { $titleAlign = $defaultTitleAlign; }
}
$titleHide = get_post_meta($post->ID, 'jbn_hide_title', true);
$blogFormatsIcons = get_theme_mod( 'blog_formats_icons' );
$featuredImage = get_the_post_thumbnail_url();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php ?>
	<header class="entry-header<?php
		if ( $blogFormatsIcons ) { echo " icon"; }
		if ( $titleAlign ) { echo " align-$titleAlign"; } else { echo ' align-center'; }
		echo '"';
		if ( is_single() && $headerBG ) {
			echo ' style="'; // Easily add inline styles
			if ( $headerBG ) { echo "background-image:url('$headerBG'); "; }
			echo '">';
		} else { echo '>'; }
	?>

		<?php
			// if ( has_post_thumbnail() ) { the_post_thumbnail(); };
			if ( is_single() ) {
				if ( $titleHide ) {
					the_title( '<h1 class="entry-title hidden">', '</h1>' );
				} else {
					the_title( '<h1 class="entry-title">', '</h1>' );
				}
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php jbn_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if ( is_home() ) {
				the_excerpt();
			} else {
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'jbn' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			}
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jbn' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php jbn_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
