<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package J-Bones
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( "It seems we've reached an impasse.", 'jbn' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<div class="wrap">

						<blockquote><?php esc_html_e( "Pink one is right. Tell you what. You give me back the sock, and I'll give you... three wishes.", 'jbn' ); ?></blockquote>
						<blockquote><?php esc_html_e( "Make it five.", 'jbn' ); ?></blockquote>
						<blockquote><?php esc_html_e( "Four.", 'jbn' ); ?></blockquote>
						<blockquote><?php esc_html_e( "Three, take it or leave it!", 'jbn' ); ?></blockquote>
						<blockquote><?php esc_html_e( "Ookay, uh three, you get three wishes.", 'jbn' ); ?></blockquote>


					</div>



				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
