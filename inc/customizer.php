<?php
/**
 * J-Bones Theme Customizer.
 *
 * @package J-Bones
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function jbn_customize_register( $wp_customize ) {
/*
 * Custom Panels
 */
    $wp_customize->add_panel( 'page_conf_panel' , array(
        'title'         => __( 'Page / Blog Options', 'jbones' ),
        'description'   => __('Edit settings to the site pages.', jbones ),
        'priority'      => '40',
    ) );
    $wp_customize->add_panel( 'theme_conf_panel' , array(
        'title'         => __( 'Theme Options', 'jbones' ),
        'description'   => __('Edit settings to the theme options.', jbones ),
        'priority'      => '45',
    ) );

/*
 * Site Identity
 */
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage'; // Site Title
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage'; // Site Tagline

    $wp_customize->add_setting( 'jbones_phone'); // Phone Number
    $wp_customize->add_control( 'jbones_phone', array(
        'label'     => __( 'Phone Number', 'jbones' ),
        'type'      => 'tel',
        'section'   => 'title_tagline',
        'settings'  => 'jbones_phone',
    ) );
    $wp_customize->add_setting( 'jbones_address'); // Address Information
    $wp_customize->add_control( 'jbones_address', array(
        'label'     => __( 'Address', 'jbones' ),
        'type'      => 'textarea',
        'section'   => 'title_tagline',
        'settings'  => 'jbones_address',
    ) );
    $wp_customize->add_setting( 'jbones_copyright'); // Address Information
    $wp_customize->add_control( 'jbones_copyright', array(
        'label'     => __( 'Copyright', 'jbones' ),
        'section'   => 'title_tagline',
        'settings'  => 'jbones_copyright',
    ) );
    $wp_customize->add_setting( 'jbones_logo' ); // Site Logo
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'jbones_logo', array(
        'label'    => __( 'Upload Logo', 'jbones' ),
        'section'  => 'title_tagline',
        'settings' => 'jbones_logo',
    ) ) );

/*
 * Site Header / Footer Settings
*/
    // Site Header Section
    $wp_customize->add_section( 'site_header_conf' , array(
        'title'         => __( 'Site Header / Footer', 'jbones' ),
        'priority'      => '30',
    ) );

    $wp_customize->add_setting( 'site_top_bar' ); // Enable Top Bar
    $wp_customize->add_control( 'site_top_bar', array(
        'label'         => 'Top Bar',
        'section'       => 'site_header_conf',
        'settings'      => 'site_top_bar',
        'type'          => 'select',
        'default'       => '',
        'choices'       => array(
            ''              => 'Disabled',
            'top-bar'       => 'Top Bar',
            'top-overlap'   => 'Overlapping',
        ),

    ) );
    $wp_customize->add_setting( 'site_search_bar' ); // Enable Search Bar
    $wp_customize->add_control( 'site_search_bar', array(
        'label'         => 'Enable Search Bar',
        'section'       => 'site_header_conf',
        'settings'      => 'site_search_bar',
        'type'          => 'checkbox',
    ) );
    // $wp_customize->add_setting( 'sticky_header' ); // Disable Sticky Header
    // $wp_customize->add_control( 'sticky_header', array(
    //     'label'         => 'Disable Sticky Header',
    //     'section'       => 'site_header_conf',
    //     'settings'      => 'sticky_header',
    //     'type'          => 'checkbox',
    // ) );
    $wp_customize->add_setting( 'site_header_contrast', array(
        'default'       => 'light'
    ) ); // Header Contrast
    $wp_customize->add_control( 'site_header_contrast', array(
        'label'         => __( 'Site Header Contrast', 'jbones' ),
        'section'       => 'site_header_conf',
        'settings'      => 'site_header_contrast',
        'type'          => 'radio',
        'default'       => 'light',
        'choices'       => array(
            'light'     => 'Light',
            'dark'      => 'Dark',
        ),
    ) );
    $wp_customize->add_setting( 'site_header_layout', array(
        'default'       => 'compact'
    ) ); // Header Layout
    $wp_customize->add_control( 'site_header_layout', array(
        'label'         => __( 'Site Header Layout', 'jbones' ),
        'description'   => __( 'Define your header layout.', 'jbones' ),
        'section'       => 'site_header_conf',
        'settings'      => 'site_header_layout',
        'type'          => 'radio',
        'default'       => 'compact',
        'choices'       => array(
            'compact'       => 'Compact',
            'stacked'       => 'Center Stacked',
            // 'side-panel'    => 'Side Panel (Coming Soon)',
        ),
    ) );
    $wp_customize->add_setting( 'site_header_bgcolor' ); // Site Header BG Color
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,  'site_header_bgcolor', array(
        'label'         => __( 'Site Header Background Color', 'jbones' ),
        'section'       => 'site_header_conf',
        'setting'       => 'site_header_bgcolor',
        // 'transport'     => 'postMessage',
    ) ) );
    $wp_customize->add_setting( 'header_pattern' ); //Site Header Pattern Image
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_pattern', array(
        'label'         => __( 'Site Header Pattern Image', 'jbones' ),
        'section'       => 'site_header_conf',
        'settings'      => 'header_pattern',
    ) ) );
    $wp_customize->add_setting( 'center_logo' ); // Center Logo
    $wp_customize->add_control( 'center_logo', array(
        'label'         => __( 'Center Logo', 'jbones' ),
        'description'   => 'This will split the site title with the logo image.',
        'section'       => 'site_header_conf',
        'settings'      => 'center_logo',
        'type'          => 'checkbox',
        'active_callback' => 'site_header_stacked',
    ) );
    function site_header_stacked( $control ) {
        if ( $control->manager->get_setting('site_header_layout')->value() == 'stacked' ) :
            return true; else : return false; endif;
    } // site_header_stacked

    $wp_customize->add_setting( 'site_footer_contrast', array(
        'default'       => 'light'
    ) ); // Header Contrast
    $wp_customize->add_control( 'site_footer_contrast', array(
        'label'         => __( 'Site Footer Contrast', 'jbones' ),
        'section'       => 'site_header_conf',
        'settings'      => 'site_footer_contrast',
        'type'          => 'radio',
        'default'       => 'light',
        'choices'       => array(
            'light'     => 'Light',
            'dark'      => 'Dark',
        ),
    ) );

    $wp_customize->add_setting( 'footer_socials' ); // Enable Back To Top Button
    $wp_customize->add_control( 'footer_socials', array(
        'label'         => __( 'Enable Social Buttons in Footer', 'jbones' ),
        'section'       => 'site_header_conf',
        'settings'      => 'footer_socials',
        'type'          => 'checkbox',
    ) );
    $wp_customize->add_setting( 'footer_background' ); // Site Logo
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_background', array(
        'label'    => __( 'Footer Background', 'jbones' ),
        'section'  => 'site_header_conf',
        'settings' => 'footer_background',
    ) ) );


    // $wp_customize->add_setting( 'site_title_color' ); // Site Title Color
    // $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,  'site_title_color', array(
    //     'label'         => __( 'Site Title Color', 'jbones' ),
    //     'section'       => 'site_header_conf',
    //     'setting'       => 'site_title_color',
    //     // 'transport'     => 'postMessage',
    // ) ) );
    // $wp_customize->add_setting( 'site_tagline_color' ); // Site Tagline Color
    // $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,  'site_tagline_color', array(
    //     'label'         => __( 'Site Tagline Color', 'jbones' ),
    //     'section'       => 'site_header_conf',
    //     'setting'       => 'site_tagline_color',
    //     // 'transport'     => 'postMessage',
    // ) ) );
    // $wp_customize->add_setting( 'site_nav_type' ); // Site Nav Type
    // $wp_customize->add_control( 'site_nav_type', array(
    //     'label'         => __( 'Site Navigation Type', 'jbones' ),
    //     'description'   => __( 'Description', 'jbones' ),
    //     'section'       => 'site_header_conf',
    //     'settings'      => 'site_nav_type',
    //     'type'          => 'radio',
    //     'choices'       => array(
    //         ''              => 'Light',
    //         'stacked'       => 'Dark',
    //     ),
    // ) );



/*
 * Page Configurations
 */
    // Page Configurations Section
    $wp_customize->add_section( 'content_conf' , array( // General Settings
        'title'         => __( 'General Settings', 'jbones' ),
        'priority'      => '10',
        'panel'         => 'page_conf_panel',
    ) );

    $wp_customize->add_setting( 'back_to_top' ); // Enable Back To Top Button
    $wp_customize->add_control( 'back_to_top', array(
        'label'         => 'Enable Back To Top Button',
        'section'       => 'content_conf',
        'settings'      => 'back_to_top',
        'type'          => 'checkbox',
    ) );
    // $wp_customize->add_setting( 'page_type' ); // Page Width Type
    // $wp_customize->add_control( 'page_type', array(
    //     'label'         => __( 'Page Width Type', 'jbones' ),
    //     'description'   => __( 'Choose the type of page width.', 'jbones' ),
    //     'section'       => 'content_conf',
    //     'settings'      => 'page_type',
    //     'type'          => 'radio',
    //     'choices'       => array(
    //         ''              => 'Full Width',
    //         'boxed'         => 'Boxed Width',
    //     ),
    // ) );
    // $wp_customize->add_setting( 'page_sidebar' ); // Enable Page Sidebar
    // $wp_customize->add_control( 'page_sidebar', array(
    //     'label'         => 'Enable Page Sidebar',
    //     'section'       => 'content_conf',
    //     'settings'      => 'page_sidebar',
    //     'type'          => 'checkbox',
    // ) );
    $wp_customize->add_setting( 'blog_formats' ); // Enable Blog Formats
    $wp_customize->add_control( 'blog_formats', array(
        'label'             => 'Enable Formats',
        'section'           => 'content_conf',
        'settings'          => 'blog_formats',
        'type'              => 'checkbox',
    ) );
    $wp_customize->add_setting( 'blog_formats_icons' ); // Enable Blog Formats Icons
    $wp_customize->add_control( 'blog_formats_icons', array(
        'label'             => 'Enable Format Icons',
        'section'           => 'content_conf',
        'settings'          => 'blog_formats_icons',
        'type'              => 'checkbox',
        'active_callback'   => 'blog_formats_enabled',
    ) );
    function blog_formats_enabled( $control ) {
        if ( $control->manager->get_setting('blog_formats')->value() == true ) :
            return true; else : return false; endif;
    } // site_header_stacked




    $wp_customize->add_setting( 'blog_type' ); // Header layout
    $wp_customize->add_control( 'blog_type', array(
        'label'         => __( 'Blog Width Type', 'jbones' ),
        'description'   => __( 'Choose the type of page width.', 'jbones' ),
        'section'       => 'content_conf',
        'settings'      => 'blog_type',
        'type'          => 'radio',
        'choices'       => array(
            ''          => 'Full Width',
            'sections'  => 'Sections',
        ),
    ) );
    // $wp_customize->add_setting( 'blog_sidebar' ); // Enable Blog Sidebar
    // $wp_customize->add_control( 'blog_sidebar', array(
    //     'label'         => 'Enable Blog Sidebar',
    //     'section'       => 'content_conf',
    //     'settings'      => 'blog_sidebar',
    //     'type'          => 'checkbox',
    // ) );



    // Background Settings Section
    $wp_customize->add_section( 'background_image', array(
        'title'         => __( 'Background Settings', 'jbones' ),
        'panel'         => 'page_conf_panel',
        'priority'      => '20',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array( // Background Color
        'label'         => __( 'Background Color', jbones ),
        'section'       => 'background_image',
        'priority'      => '0',
    ) ) );


    /*
     * Header Settings Section
    */
    $wp_customize->add_section( 'header_image', array(
        'title'         => __( 'Header Settings', 'jbones' ),
        'panel'         => 'page_conf_panel',
        'priority'      => '30',
    ) );
    $wp_customize->add_setting( 'header_txtalign' ); // Header Text Align
    $wp_customize->add_control( 'header_txtalign', array(
        'label'         => __( 'Content Header Text Align', 'jbones' ),
        'description'   => __( 'Align content header text.', 'jbones' ),
        'section'       => 'header_image',
        'settings'      => 'header_txtalign',
        'priority'      => '4',
        'type'          => 'select',
        'choices'       => array(
            ''          => 'Default',
            'left'      => 'Left',
            'center'    => 'Center',
            'right'     => 'Right',
        ),
    ) );
    // Header Text Color
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_textcolor', array(
        'label'         => __( 'Header Text Color', jbones ),
        'section'       => 'header_image',
        'priority'      => '6',
    ) ) );


/**
 * Social Network Listings
**/
    // Social Networks Section
    $wp_customize->add_section( 'jbones_social_section' , array(
        'title'         => __( 'Social Networks', 'jbones' ),
        'description'   => __( 'Add the URL to your Social Networking pages.', 'jbones' ),
        'priority'      => '0',
        'panel'         => 'nav_menus',
    ) );
    $wp_customize->add_setting( 'jbones_social[facebook]' );
    $wp_customize->add_control( 'jbones_social[facebook]', array(
        'label'     => __( 'Facebook', 'jbones' ),
        'type'      => 'url',
        'section'   => 'jbones_social_section',
        'settings'  => 'jbones_social[facebook]',
    ) );
    $wp_customize->add_setting( 'jbones_social[twitter]' );
    $wp_customize->add_control( 'jbones_social[twitter]', array(
        'label'     => __( 'Twitter', 'jbones' ),
        'type'      => 'url',
        'section'   => 'jbones_social_section',
        'settings'  => 'jbones_social[twitter]',
    ) );
    $wp_customize->add_setting( 'jbones_social[googleplus]' );
    $wp_customize->add_control( 'jbones_social[googleplus]', array(
        'label'     => __( 'Google+', 'jbones' ),
        'type'      => 'url',
        'section'   => 'jbones_social_section',
        'settings'  => 'jbones_social[googleplus]',
    ) );
    $wp_customize->add_setting( 'jbones_social[linkedin]' );
    $wp_customize->add_control( 'jbones_social[linkedin]', array(
        'label'     => __( 'LinkedIn', 'jbones' ),
        'type'      => 'url',
        'section'   => 'jbones_social_section',
        'settings'  => 'jbones_social[linkedin]',
    ) );
    $wp_customize->add_setting( 'jbones_social[youtube]' );
    $wp_customize->add_control( 'jbones_social[youtube]', array(
        'label'     => __( 'YouTube', 'jbones' ),
        'type'      => 'url',
        'section'   => 'jbones_social_section',
        'settings'  => 'jbones_social[youtube]',
    ) );
    $wp_customize->add_setting( 'jbones_social[vimeo]' );
    $wp_customize->add_control( 'jbones_social[vimeo]', array(
        'label'     => __( 'Vimeo', 'jbones' ),
        'type'      => 'url',
        'section'   => 'jbones_social_section',
        'settings'  => 'jbones_social[vimeo]',
    ) );
    $wp_customize->add_setting( 'jbones_social[github]' );
    $wp_customize->add_control( 'jbones_social[github]', array(
        'label'     => __( 'Github', 'jbones' ),
        'type'      => 'url',
        'section'   => 'jbones_social_section',
        'settings'  => 'jbones_social[github]',
    ) );
    $wp_customize->add_setting( 'jbones_social[dribbble]' );
    $wp_customize->add_control( 'jbones_social[dribbble]', array(
        'label'     => __( 'Dribbble', 'jbones' ),
        'type'      => 'url',
        'section'   => 'jbones_social_section',
        'settings'  => 'jbones_social[dribbble]',
    ) );
    $wp_customize->add_setting( 'jbones_social[tumblr]' );
    $wp_customize->add_control( 'jbones_social[tumblr]', array(
        'label'     => __( 'Tumblr', 'jbones' ),
        'type'      => 'url',
        'section'   => 'jbones_social_section',
        'settings'  => 'jbones_social[tumblr]',
    ) );
    $wp_customize->add_setting( 'jbones_social[instagram]' );
    $wp_customize->add_control( 'jbones_social[instagram]', array(
        'label'     => __( 'Instagram', 'jbones' ),
        'type'      => 'url',
        'section'   => 'jbones_social_section',
        'settings'  => 'jbones_social[instagram]',
    ) );
    $wp_customize->add_setting( 'jbones_social[pinterest]' );
    $wp_customize->add_control( 'jbones_social[pinterest]', array(
        'label'     => __( 'Pinterest', 'jbones' ),
        'type'      => 'url',
        'section'   => 'jbones_social_section',
        'settings'  => 'jbones_social[pinterest]',
    ) );
    $wp_customize->add_setting( 'jbones_social[rss]' );
    $wp_customize->add_control( 'jbones_social[rss]', array(
        'label'     => __( 'RSS', 'jbones' ),
        'type'      => 'url',
        'section'   => 'jbones_social_section',
        'settings'  => 'jbones_social[rss]',
    ) );

}
add_action( 'customize_register', 'jbn_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function jbn_customize_preview_js() {
    wp_enqueue_script( 'jbn_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20161022', true );
}
add_action( 'customize_preview_init', 'jbn_customize_preview_js' );








/**
 * Adds variables to sass file after saving customizer options

add_action('customize_save_after', 'genSASS', 100);
function genSASS( $wp_customize ) {
    // Set SASS file to be updated
    $file = get_template_directory() . '/dev/components/sass/variables-site/_theme-generated.scss';
    if(file_exists($file)){
        $output = "";
        // Get settings (Must be an array)
        $settings = get_theme_mod( 'jbones_social' );
        foreach ( $settings as $variable => $vvalue ) {
            $output .= '$' . $variable . ': ' . $vvalue . ';' . PHP_EOL;
            //echo '@' . $variable . ':' . $value . ';';
        };
    }
    // Write changes to SASS file
    file_put_contents($file, $output, FILE_TEXT )or die('<br />Error writing to custom options CSS file');

    // Need to execute script here to process SASS with PHP
    // Resources:
    // http://wordpress.stackexchange.com/questions/190817/use-scssphp-to-compile-theme-customizer-values-into-scss-files-ready-to-compile
    // http://leafo.github.io/scssphp/
    // https://packagist.org/packages/richthegeek/phpsass
}
*/
