<?php
/**
 * Template part for displaying a message that posts cannot be found.
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
?>

<section class="no-results not-found">
	<header class="page-header <?php
		if ( $titleAlign ) { echo " align-$titleAlign"; } else { echo ' align-center'; }
		echo '"';
		if ( $headerBG ) {
			echo ' style="'; // Easily add inline styles
			if ( $headerBG ) { echo "background-image:url('$headerBG'); "; }
			echo '">';
		} else { echo '>'; }
	?>
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'jbn' ); ?></h1>
	</header><!-- .page-header -->
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'jbn' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'jbn' ); ?></p>
			<?php
				get_search_form();

		else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'jbn' ); ?></p>
			<?php
				get_search_form();

		endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
