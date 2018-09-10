<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package J-Bones
 */

?>
	<?php if ( get_theme_mod( 'back_to_top' ) ) : ?>
		<a href="#page" id="backTop">Back To Top</a>
	<?php endif; ?>
	</div><!-- #content -->


	<footer id="colophon" class="site-footer" role="contentinfo"<?php if ( get_theme_mod( 'footer_background' ) ) : echo ' style="background-image: url(\'' . get_theme_mod( 'footer_background' ) . '\'"'; endif; ?>>
		<?php if ( get_theme_mod( 'footer_socials' ) ) : include( get_template_directory() . '/inc/social-media.php' ); endif; ?>
		<?php if ( is_active_sidebar( 'footer-widgets' ) ) : ?>
			<aside id="footer-widgets" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'footer-widgets' ); ?>
			</aside><!-- #secondary -->
		<?php endif; ?>
		<div class="site-info">
			<?php if ( get_theme_mod( 'jbones_copyright' ) ) : ?>
				<p><?php echo get_theme_mod( 'jbones_copyright' ); ?></p>
			<?php else : ?>
				<p><?php bloginfo( 'name' ); ?> &copy; <?php echo date("Y") ?></p>
			<?php endif; ?>
		</div><!-- .site-info -->
		<?php if ( has_nav_menu( 'footer-menu' ) ) { ?>
			<nav class="footer-nav">
				<h2 class="hidden">Footer Navigation</h2>
				<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', ) ); ?>
			</nav><!--  Footer Navigation -->
		<?php } ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
