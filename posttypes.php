<?php
 /*
 -- Add new post types
 */


 	// Site Updates
	
	// add_action('init', 'updates_post_type');
	// function updates_post_type() 
	// {
	// 	$updates_labels = array(
	// 		'name' => _x('Site Updates', 'post type general name'),
	// 		'singular_name' => _x('Update', 'post type singular name'),
	// 		'all_items' => __('All Updates'),
	// 		'add_new' => _x('Add New Update', 'post'),
	// 		'add_new_item' => __('Add New Update'),
	// 		'edit_item' => __('Edit Updates'),
	// 		'new_item' => __('New Update'),
	// 		'view_item' => __('View Updates'),
	// 		'search_items' => __('Search in Updates'),
	// 		'not_found' =>  __('No Updates found'),
	// 		'not_found_in_trash' => __('No Updates found in trash'), 
	// 		'parent_item_colon' => ''
	// 	);
	// 	$args = array(
	// 		'labels' => $updates_labels,
	// 		'public' => true,
	// 		'publicly_queryable' => true,
	// 		'show_ui' => true, 
	// 		'query_var' => true,
	// 		'rewrite' => true,
	// 		'capability_type' => 'post',
	// 		'hierarchical' => false,
	// 		'menu_position' => 5,
	// 		'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields', 'post-formats'),
	// 		'has_archive' => true,
	// 	); 
	// 	register_post_type('updates',$args);
	// }

	// // Add custom taxonomies
	// add_action( 'init', 'updates_taxonomies', 0 );
	// function updates_taxonomies() 
	// {
	// 	// Corresponding Project
	// 	$updates_labels = array(
	// 		'name' => _x( 'Corresponding Project', 'taxonomy general name' ),
	// 		'singular_name' => _x( 'Corresponding Project', 'taxonomy singular name' ),
	// 		'search_items' =>  __( 'Search in Corresponding Project' ),
	// 		'all_items' => __( 'All Corresponding Project' ),
	// 		'most_used_items' => null,
	// 		'parent_item' => null,
	// 		'parent_item_colon' => null,
	// 		'edit_item' => __( 'Edit Corresponding Project' ), 
	// 		'update_item' => __( 'Change Corresponding Project' ),
	// 		'add_new_item' => __( 'Add new Corresponding Project' ),
	// 		'new_item_name' => __( 'New Corresponding Project' ),
	// 		'menu_name' => __( 'Corresponding Project' ),
	// 	);
	// 	register_taxonomy('corresponding-project',array('updates'),array(
	// 		'hierarchical' => true,
	// 		'labels' => $updates_labels,
	// 		'show_ui' => true,
	// 		'query_var' => true,
	// 		'rewrite' => array('slug' => 'corresponding-project' )
	// 	));
	// }


	// Portfolio
	
	add_action('init', 'portfolio_post_type');
	function portfolio_post_type() 
	{
		$projects_labels = array(
			'name' => _x('Portfolio', 'post type general name'),
			'singular_name' => _x('Portfolio', 'post type singular name'),
			'all_items' => __('All Projects'),
			'add_new' => _x('Add New Project', 'post'),
			'add_new_item' => __('Add New Project'),
			'edit_item' => __('Edit Project'),
			'new_item' => __('New Project'),
			'view_item' => __('View Project'),
			'search_items' => __('Search all projects'),
			'not_found' =>  __('No projects found'),
			'not_found_in_trash' => __('No projects found in trash'), 
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $projects_labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 6,
			'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields', 'post-formats'),
			'has_archive' => true,
		); 
		register_post_type('portfolio',$args);
	}

	// Add custom taxonomies
	add_action( 'init', 'portfolio_taxonomies', 0 );
	function portfolio_taxonomies() 
	{
		// Project Work
		$projects_labels = array(
			'name' => _x( 'Type of Work', 'taxonomy general name' ),
			'singular_name' => _x( 'Work Type', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search in Portfolio Works' ),
			'all_items' => __( 'All Works of Art' ),
			'most_used_items' => null,
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Type of Work' ), 
			'update_item' => __( 'Change Work Type' ),
			'add_new_item' => __( 'Add new Work Type' ),
			'new_item_name' => __( 'New Work Type' ),
			'menu_name' => __( 'Type of Work' ),
		);
		register_taxonomy('portfolio-Work',array('portfolio'),array(
			'hierarchical' => true,
			'labels' => $projects_labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'portfolio-Work' )
		));	
	}


	// Bag Of Tricks
	
	add_action('init', 'education_post_type');
	function education_post_type() 
	{
		$tricks_labels = array(
			'name' => _x('Bag of Tricks', 'post type general name'),
			'singular_name' => _x('Bag of Tricks', 'post type singular name'),
			'all_items' => __('All Tricks'),
			'add_new' => _x('Add New Trick', 'post'),
			'add_new_item' => __('Add New Trick'),
			'edit_item' => __('Edit Trick'),
			'new_item' => __('New Trick'),
			'view_item' => __('View Trick'),
			'search_items' => __('Search in Bag of Tricks'),
			'not_found' =>  __('No tricks found'),
			'not_found_in_trash' => __('No tricks found in trash'), 
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $tricks_labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 6,
			'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields', 'post-formats'),
			'has_archive' => true,
		); 
		register_post_type('education',$args);
	}

	// Add custom taxonomies
	add_action( 'init', 'education_taxonomies', 0 );
	function education_taxonomies() 
	{
		// Trick Industry
		$tricks_labels = array(
			'name' => _x( 'Type of Industry', 'taxonomy general name' ),
			'singular_name' => _x( 'Industry', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search in Industry Tricks' ),
			'all_items' => __( 'All Industry Tricks' ),
			'most_used_items' => null,
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Industry' ), 
			'update_item' => __( 'Change Industry' ),
			'add_new_item' => __( 'Add new Industry' ),
			'new_item_name' => __( 'New Industry' ),
			'menu_name' => __( 'Type of Industry' ),
		);
		register_taxonomy('education-industry',array('education'),array(
			'hierarchical' => true,
			'labels' => $tricks_labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'education-industry' )
		));	
	}


	// Add new Custom Post Type icons
	add_action( 'admin_head', 'updates_icons' );
	function updates_icons() {
		?>
			<style type="text/css" media="screen">
				#menu-posts-updates .menu-icon-updates div.wp-menu-image:before {
					content: '\f321';
				}
				#menu-posts-education .menu-icon-education div.wp-menu-image:before {
					content: '\f118';
				}
				#menu-posts-portfolio .menu-icon-portfolio div.wp-menu-image:before {
					content: '\f309';
				}
		    </style>
		<?php 
	} 

?>