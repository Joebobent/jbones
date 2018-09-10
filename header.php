<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package J-Bones
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

<?php wp_head(); ?>
</head>

<body id="<?php global $post; $post_slug=$post->post_name; echo $post_slug; ?>" <?php body_class(); ?>>
<?php // Header variables
	$headerLayout 	= get_theme_mod( 'site_header_layout' );
	$headerContrast = get_theme_mod( 'site_header_contrast' );
	$siteLogo 		= get_theme_mod( 'jbones_logo' );
	$centerLogo 	= get_theme_mod( 'center_logo' );
	$siteTopBar 	= get_theme_mod( 'site_top_bar' );
	$bgImage 		= get_theme_mod( 'header_pattern' );
	$bgColor		= get_theme_mod( 'site_header_bgcolor' );
	$displayTitle 	= display_header_text();
?>
<div id="page" class="site<?php // Page classes for header
	if ( $headerLayout ) : echo " $headerLayout"; else : echo ' compact'; endif;
	if ( $centerLogo ) : echo ' center-logo'; endif; ?>">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'jbn' ); ?></a>

	<?php // Stores data for top page content option
	$topContent = get_post_meta( get_the_ID(), 'jbn-above-content', true);
    $topPage = get_post_meta( get_the_ID(), 'jbn-top-page', true );
	if ( !empty( $topContent ) && !empty( $topPage ) ) : ?>
		<div id="top-content">
			<?php echo do_shortcode($topContent); ?>
		</div>
	<?php endif; ?>

	<header id="masthead" role="banner" class="site-header<?php
		if( !empty( $topContent ) && !empty( $topPage ) ) : echo ' content-above'; endif;
		if ( !has_nav_menu( 'primary' ) ) : echo ' no-menu'; endif;
		if ( $headerLayout ) : echo " $headerLayout"; else : echo ' compact'; endif;
		if ( $headerContrast ) : echo " $headerContrast"; endif;
		if ( $headerLayout == 'stacked' && $centerLogo ) : echo ' center-logo'; endif;
		if ( $siteTopBar ) : echo " $siteTopBar"; endif;
		?>"<?php // end classes, start inline styles
		if ( !empty( $bgImage) || !empty( $bgColor ) ) : echo ' style="';
			if (!empty( $bgImage ) ) : echo "background-image: url( '$bgImage' ); "; endif;
			if (!empty( $bgColor ) ) : echo "background-color: $bgColor;"; endif;
		endif; ?>>
		<div class="header-wrapper">
			<?php if ( $headerLayout == 'compact' || empty($headerLayout) ) : ?><div class="wrap"><?php endif; ?>

				<div class="site-branding">
					<?php if ( $headerLayout == 'stacked' ) : ?><div class="wrap"><?php endif; ?>

					<?php if ( $siteLogo ) : ?>
						 <img class="logo" src="<?php echo $siteLogo; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					<?php endif;
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title<?php if (!$displayTitle) { echo ' hidden'; }; ?>">
							<a class="title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php
								$siteTitle = get_bloginfo('name');
								if ( $centerLogo ) : echo preg_replace('([a-zA-Z.,!?0-9]+(?![^<]*>))', '<span>$0</span>', $siteTitle ); else : bloginfo( 'name' ); endif;  ?>
							</a>
						</h1>
					<?php else : ?>
						<p class="site-title<?php if (!$displayTitle) { echo ' hidden'; }; ?>">
							<a class="title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php
								$siteTitle = get_bloginfo('name');
								if ( $centerLogo ) : echo preg_replace('([a-zA-Z.,!?0-9]+(?![^<]*>))', '<span>$0</span>', $siteTitle ); else : bloginfo( 'name' ); endif;  ?>
							</a>
						</p>
					<?php
					endif;
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description<?php if (!$displayTitle) { echo ' hidden'; }; ?>"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
					<?php if ( $headerLayout == 'stacked' ) : ?></div><?php endif; ?>
				</div><!-- .site-branding -->

				<?php if ( has_nav_menu( 'primary' ) ) { ?>
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<?php if ( $headerLayout == 'stacked' ) : ?><div class="wrap"><?php endif; ?>
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'jbn' ); ?></button>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
						<?php if ( get_theme_mod( 'site_search_bar' ) ) : ?>
							<div class="search">
								<button class="search-toggle">Search Site</button>
								<?php get_search_form(); ?>
							</div>
						<?php endif; ?>
						<?php if ( $headerLayout == 'stacked' ) : ?></div><?php endif; ?>
					</nav><!-- #site-navigation -->
				<?php } ?>

			<?php if ( $headerLayout == 'compact' || empty( $headerLayout ) ) : ?></div><?php endif; ?>

			<?php if ( $siteTopBar ) : ?>
				<footer class="top-bar">
					<div class="wrap">
						<?php if ( get_theme_mod( 'jbones_social' ) ) : include( get_template_directory() . '/inc/social-media.php' ); endif; ?>

						<?php if ( has_nav_menu( 'top-menu' ) ) { ?>
							<nav id="top-navigation" class="topbar-nav" role="navigation">
								<?php wp_nav_menu( array( 'theme_location' => 'top-menu', 'menu_id' => 'top-menu' ) ); ?>
							</nav>
						<?php } ?>
						<?php // Contact variables
						$contactPhone 	= get_theme_mod( 'jbones_phone' );
						$contactAddress = get_theme_mod( 'jbones_address' );

						if ( $contactPhone || $contactAddress ) : ?>
							<div class="contact <?php if ( $contactAddress ) : echo 'address'; endif;?>">
								<?php if ( $contactPhone ) : ?>
									<p class="phone"><a href="tel:<?php echo preg_replace("/[^0-9]/","", $contactPhone ); ?>"><?php echo $contactPhone; ?></a></p>
								<?php endif;
								if ( $contactAddress ) : ?>
									 <p class="address"><?php echo $contactAddress; ?></p>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</footer>
			<?php endif; ?>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
