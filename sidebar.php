<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package J-Bones
 */

$jbn_sidebar = get_post_meta($post->ID, 'jbn_sidebar', true);
if ( ! is_active_sidebar( $jbn_sidebar ) || $jbn_sidebar == 'disable_sidebar' ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( $jbn_sidebar ); ?>
</aside><!-- #secondary -->
