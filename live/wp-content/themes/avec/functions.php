<?php
/**
 * avec functions and definitions
 *
 * @package WordPress
 * @subpackage avec
 * @since avec 14.0722
 */

$temp_version = 14.0725;
//$temp_version = rand();

//  ------------------------------------------------------- 
//  INITIALIZE 
//  ------------------------------------------------------- 

	function DEVONA_init() {
		// Localize Temp Version
		global $temp_version;

		// Register Fonts and Scripts
		wp_register_style( 'styles', get_template_directory_uri() . '/style.css', false, $temp_version );
		wp_register_script('scripts', get_template_directory_uri() . '/js/scripts-unmin.js', array('jquery'), $temp_version, true );
	
		// Add Projects Post Type
		$projects_args = array(
		    'labels' => array(
				'name' => 'Projects',
		    	'singular_name' => 'Project',
		    	'add_new' => 'Add New',
		    	'add_new_item' => 'Add New Project',
		    	'edit_item' => 'Edit Project',
		    	'new_item' => 'New Project',
		    	'all_items' => 'All Projects',
		    	'view_item' => 'View Project',
		    	'search_items' => 'Search Projects',
		    	'not_found' =>  'No Projects found',
		    	'not_found_in_trash' => 'No Projects found in Trash', 
		    	'parent_item_colon' => '',
		    	'menu_name' => 'Projects'
		  	),
		    'public' => true,
		    'publicly_queryable' => true,
		    'show_ui' => true, 
		    'show_in_menu' => true, 
		    'query_var' => true,
		    'rewrite' => array( 'slug' => 'project' ),
		    'capability_type' => 'post',
		    'has_archive' => true, 
		    'hierarchical' => false,
		    'menu_position' => 5,
		    'menu_icon' => 'dashicons-portfolio',
		    'taxonomies' => array('discipline', 'sector'),
		    'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' )
		); 
		register_post_type( 'project', $projects_args );
		
		// Add Discipline taxonomy
		$discipline_args = array(
			'labels'            => array(
				'name'              => _x( 'Disciplines', 'taxonomy general name' ),
				'singular_name'     => _x( 'Discipline', 'taxonomy singular name' ),
				'search_items'      => __( 'Search Disciplines' ),
				'all_items'         => __( 'All Disciplines' ),
				'parent_item'       => __( 'Parent Discipline' ),
				'parent_item_colon' => __( 'Parent Discipline:' ),
				'edit_item'         => __( 'Edit Discipline' ),
				'update_item'       => __( 'Update Discipline' ),
				'add_new_item'      => __( 'Add New Discipline' ),
				'new_item_name'     => __( 'New Discipline Name' ),
				'menu_name'         => __( 'Disciplines' ),
			),
			'hierarchical'      => true,
			'show_ui'           => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'discipline' ),
		);
		register_taxonomy( 'discipline', array( 'project' ), $discipline_args );
		
		// Add Sector taxonomy
		$sector_args = array(
			'labels'            => array(
				'name'              => _x( 'Sectors', 'taxonomy general name' ),
				'singular_name'     => _x( 'Sector', 'taxonomy singular name' ),
				'search_items'      => __( 'Search Sectors' ),
				'all_items'         => __( 'All Sectors' ),
				'parent_item'       => __( 'Parent Sector' ),
				'parent_item_colon' => __( 'Parent Sector:' ),
				'edit_item'         => __( 'Edit Sector' ),
				'update_item'       => __( 'Update Sector' ),
				'add_new_item'      => __( 'Add New Sector' ),
				'new_item_name'     => __( 'New Sector Name' ),
				'menu_name'         => __( 'Sectors' ),
			),
			'hierarchical'      => true,
			'show_ui'           => true,
			'query_var'         => false,
			'rewrite'           => array( 'slug' => 'sector' ),
		);
		register_taxonomy( 'sector', array( 'project' ), $sector_args );
		
		// Add Deliverable taxonomy
		$deliverable_args = array(
			'labels'            => array(
				'name'              => _x( 'Deliverables', 'taxonomy general name' ),
				'singular_name'     => _x( 'Deliverable', 'taxonomy singular name' ),
				'search_items'      => __( 'Search Deliverables' ),
				'all_items'         => __( 'All Deliverables' ),
				'parent_item'       => __( 'Parent Deliverable' ),
				'parent_item_colon' => __( 'Parent Deliverable:' ),
				'edit_item'         => __( 'Edit Deliverable' ),
				'update_item'       => __( 'Update Deliverable' ),
				'add_new_item'      => __( 'Add New Deliverable' ),
				'new_item_name'     => __( 'New Deliverable Name' ),
				'menu_name'         => __( 'Deliverables' ),
			),
			'hierarchical'      => true,
			'show_ui'           => true,
			'query_var'         => false,
			'rewrite'           => array( 'slug' => 'deliverable' ),
		);
		register_taxonomy( 'deliverable', array( 'project' ), $deliverable_args );
	
		// Add Capabilities Post Type
		$capability_page_args = array(
		    'labels' => array(
				'name' => 'Capability Pages',
		    	'singular_name' => 'Capability Page',
		    	'add_new' => 'Add New',
		    	'add_new_item' => 'Add Capability Page',
		    	'edit_item' => 'Edit Capability Page',
		    	'new_item' => 'New Capability Page',
		    	'all_items' => 'All Capability Pages',
		    	'view_item' => 'View Capability Page',
		    	'search_items' => 'Search Capability Pages',
		    	'not_found' =>  'No Capability Pages found',
		    	'not_found_in_trash' => 'No Capability Pages found in Trash', 
		    	'parent_item_colon' => '',
		    	'menu_name' => 'Capability Pages'
		  	),
		    'public' => true,
		    'publicly_queryable' => true,
		    'show_ui' => true, 
		    'show_in_menu' => true, 
		    'query_var' => true,
		    'rewrite' => array( 'slug' => 'capabilities' ),
		    'capability_type' => 'post',
		    'has_archive' => true, 
		    'hierarchical' => false,
		    'menu_position' => 20,
		    'menu_icon' => 'dashicons-media-spreadsheet',
		    'supports' => array(  'title', 'editor', 'page-attributes' )
		); 
		register_post_type( 'capability_page', $capability_page_args );
	
		// Add Landing Post Type
		$homepage_modules_args = array(
		    'labels' => array(
				'name' => 'Homepage Modules',
		    	'singular_name' => 'Homepage Module',
		    	'add_new' => 'Add New',
		    	'add_new_item' => 'Add Homepage Module',
		    	'edit_item' => 'Edit Homepage Module',
		    	'new_item' => 'New Homepage Module',
		    	'all_items' => 'All Homepage Modules',
		    	'view_item' => 'View Homepage Module',
		    	'search_items' => 'Search Homepage Modules',
		    	'not_found' =>  'No Homepage Modules found',
		    	'not_found_in_trash' => 'No Homepage Modules found in Trash', 
		    	'parent_item_colon' => '',
		    	'menu_name' => 'Homepage Modules'
		  	),
		    'public' => true,
		    'publicly_queryable' => true,
		    'show_ui' => true, 
		    'show_in_menu' => true, 
		    'query_var' => true,
		    'rewrite' => array( 'slug' => 'homepage_module' ),
		    'capability_type' => 'post',
		    'has_archive' => true, 
		    'hierarchical' => false,
		    'menu_position' => 21,
		    'menu_icon' => 'dashicons-tagcloud',
		    'supports' => array( 'page-attributes' )
		); 
		register_post_type( 'homepage_module', $homepage_modules_args );
	
		// Add Clients Post Type
		$clients_args = array(
		    'labels' => array(
				'name' => 'Clients',
		    	'singular_name' => 'Client',
		    	'add_new' => 'Add New',
		    	'add_new_item' => 'Add New Client',
		    	'edit_item' => 'Edit Client',
		    	'new_item' => 'New Client',
		    	'all_items' => 'All Clients',
		    	'view_item' => 'View Client',
		    	'search_items' => 'Search Clients',
		    	'not_found' =>  'No Clients found',
		    	'not_found_in_trash' => 'No Clients found in Trash', 
		    	'parent_item_colon' => '',
		    	'menu_name' => 'Clients'
		  	),
		    'public' => true,
		    'publicly_queryable' => false,
		    'exclude_from_search' => true,
		    'show_ui' => true, 
		    'show_in_menu' => true, 
		    'query_var' => true,
		    'rewrite' => array( 'slug' => 'client' ),
		    'capability_type' => 'post',
		    'has_archive' => true, 
		    'hierarchical' => false,
		    'menu_position' => 70,
		    'menu_icon' => 'dashicons-businessman',
		    'supports' => array( 'title', 'page-attributes' )
		); 
		register_post_type( 'client', $clients_args );
	
		// Add Services Post Type
		$services_args = array(
		    'labels' => array(
				'name' => 'Services',
		    	'singular_name' => 'Service',
		    	'add_new' => 'Add New',
		    	'add_new_item' => 'Add New Service',
		    	'edit_item' => 'Edit Service',
		    	'new_item' => 'New Service',
		    	'all_items' => 'All Services',
		    	'view_item' => 'View Service',
		    	'search_items' => 'Search Services',
		    	'not_found' =>  'No Services found',
		    	'not_found_in_trash' => 'No Services found in Trash', 
		    	'parent_item_colon' => '',
		    	'menu_name' => 'Services'
		  	),
		    'public' => true,
		    'publicly_queryable' => false,
		    'exclude_from_search' => true,
		    'show_ui' => true, 
		    'show_in_menu' => true, 
		    'query_var' => true,
		    'rewrite' => array( 'slug' => 'service' ),
		    'capability_type' => 'post',
		    'has_archive' => true, 
		    'hierarchical' => false,
		    'menu_position' => 70,
		    'menu_icon' => 'dashicons-hammer',
		    'supports' => array( 'title', 'page-attributes' )
		); 
		register_post_type( 'service', $services_args );
	
		// Add Process Post Type
		$process_args = array(
		    'labels' => array(
				'name' => 'Process Steps',
		    	'singular_name' => 'Process Step',
		    	'add_new' => 'Add New',
		    	'add_new_item' => 'Add New Process Step',
		    	'edit_item' => 'Edit Process Step',
		    	'new_item' => 'New Process Step',
		    	'all_items' => 'All Process Steps',
		    	'view_item' => 'View Process Step',
		    	'search_items' => 'Search Process Steps',
		    	'not_found' =>  'No Process Steps found',
		    	'not_found_in_trash' => 'No Process Steps found in Trash', 
		    	'parent_item_colon' => '',
		    	'menu_name' => 'Process'
		  	),
		    'public' => true,
		    'publicly_queryable' => false,
		    'exclude_from_search' => true,
		    'show_ui' => true, 
		    'show_in_menu' => true, 
		    'query_var' => true,
		    'rewrite' => array( 'slug' => 'process' ),
		    'capability_type' => 'post',
		    'has_archive' => true, 
		    'hierarchical' => false,
		    'menu_position' => 70,
		    'menu_icon' => 'dashicons-editor-ol',
		    'supports' => array(  'title', 'editor', 'thumbnail', 'page-attributes' )
		); 
		register_post_type( 'process', $process_args );
	
		// Add Translations Post Type
		$translation_args = array(
		    'labels' => array(
				'name' => 'Translations',
		    	'singular_name' => 'Translation',
		    	'add_new' => 'Add New',
		    	'add_new_item' => 'Add Translations Step',
		    	'edit_item' => 'Edit Translation',
		    	'new_item' => 'New Translation',
		    	'all_items' => 'All Translations',
		    	'view_item' => 'View Translation',
		    	'search_items' => 'Search Translations',
		    	'not_found' =>  'No Translations found',
		    	'not_found_in_trash' => 'No Translations found in Trash', 
		    	'parent_item_colon' => '',
		    	'menu_name' => 'Translations'
		  	),
		    'public' => true,
		    'publicly_queryable' => false,
		    'exclude_from_search' => true,
		    'show_ui' => true, 
		    'show_in_menu' => true, 
		    'query_var' => true,
		    'rewrite' => array( 'slug' => 'translation' ),
		    'capability_type' => 'post',
		    'has_archive' => true, 
		    'hierarchical' => false,
		    'menu_position' => 80,
		    'menu_icon' => 'dashicons-translation',
		    'supports' => array(  'title', 'editor' )
		); 
		register_post_type( 'translation', $translation_args );
	
		// Add Phrases Post Type
		$phrase_args = array(
		    'labels' => array(
				'name' => 'Phrases',
		    	'singular_name' => 'Phrase',
		    	'add_new' => 'Add New',
		    	'add_new_item' => 'Add Phrase',
		    	'edit_item' => 'Edit Phrase',
		    	'new_item' => 'New Phrase',
		    	'all_items' => 'All Phrases',
		    	'view_item' => 'View Phrase',
		    	'search_items' => 'Search Phrases',
		    	'not_found' =>  'No Phrases found',
		    	'not_found_in_trash' => 'No Phrases found in Trash', 
		    	'parent_item_colon' => '',
		    	'menu_name' => 'Phrases'
		  	),
		    'public' => true,
		    'publicly_queryable' => false,
		    'exclude_from_search' => true,
		    'show_ui' => true, 
		    'show_in_menu' => true, 
		    'query_var' => true,
		    'rewrite' => array( 'slug' => 'phrase' ),
		    'capability_type' => 'post',
		    'has_archive' => true, 
		    'hierarchical' => false,
		    'menu_position' => 80,
		    'menu_icon' => 'dashicons-format-quote',
		    'supports' => array(  'title', 'editor' )
		); 
		register_post_type( 'phrase', $phrase_args );
		
		// Add editor style sheet
    	add_editor_style( 'css/editor-style.css' );
    	
    	//flush_rewrite_rules();
		 
	}
	add_action( 'init', 'DEVONA_init', 10, $temp_version );
	


//  ------------------------------------------------------- 
//  ENQUEUE SCRIPTS AND STYLES
//  ------------------------------------------------------- 
	
	// Enqueue Front-end Scripts
	function DEVONA_enqueue() {
		wp_enqueue_style( 'styles' );
		wp_enqueue_script( 'scripts');
	}
	add_action( 'wp_enqueue_scripts', 'DEVONA_enqueue' );
	
	// Enqueue Admin Scripts
	function DEVONA_enqueue_admin() {
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
	}
	add_action( 'admin_enqueue_scripts', 'DEVONA_enqueue_admin' );
	
	// Move scripts to footer
	function DEVONA_move_libraries() { 
		if ( !is_admin() ) {
			remove_action('wp_head', 'wp_print_scripts'); 
			remove_action('wp_head', 'wp_print_head_scripts', 9); 
			remove_action('wp_head', 'wp_enqueue_scripts', 1); 
		}
	} 
	add_action( 'wp_enqueue_scripts', 'DEVONA_move_libraries' );



//  ------------------------------------------------------- 
//  ADD CUSTOM IMAGE SIZES
//  ------------------------------------------------------- 
	
	add_theme_support( 'post-thumbnails' );

	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'xsmall', 200 ); 
		add_image_size( 'small', 500 ); 
		//add_image_size( 'medium', 700 ); 
		//add_image_size( 'large', 1000 ); 
		add_image_size( 'xlarge', 1400 ); 
	}



//  ------------------------------------------------------- 
//  ADD META FIELDS TO POSTS AND PAGES 
//  -------------------------------------------------------  

	function DEVONA_add_custom_meta_fields() {
	
		// Post Meta Fields
		add_meta_box('external_link_unique', 'External Link', 'create_external_link_box', 'post', "side", "core");
		
		// Projects Meta Fields
		add_meta_box('project_gallery_unique', 'Project Gallery', 'create_wp_editor_box', 'project', 'normal', 'high',  array( 'input_id' => 'project_gallery', 'input_rows' => 100, 'nonce' => true, 'tmce' => 'styleselect,bold,italic,underline', 'media_buttons' => true) );
		add_meta_box('project_options_unique', 'Recognition', 'create_wp_editor_box', 'project', 'normal', 'low',  array( 'input_id' => 'recognition', 'input_rows' => 1, 'nonce' => false) );
		add_meta_box('archive_unique', 'Archive This Project', 'create_archive_box', 'project', "side", "core");
		add_meta_box('between_project_slashes_unique', 'Entre les Slashes', 'create_between_slashes_box', 'project', "side", "core");
		add_meta_box('color_space_unique', 'Color Space', 'color_space_box', 'project', "side", "core");
		add_meta_box('project_services_unique', 'Services provided with this project', 'create_project_services_box', 'project', "normal", "low");
		add_meta_box('meta_sharing_unique', 'Meta and Social Sharing info', 'meta_sharing_box', 'project', 'normal', 'low');

		// Page Meta Fields
		if ( get_page_template_slug( $post->ID ) == 'page-templates/template-compost.php' ) {
			add_meta_box('compost_gallery_unique', 'Compost Gallery', 'create_wp_editor_box', 'page', 'normal', 'high',  array( 'input_id' => 'compost_gallery', 'input_rows' => 5, 'nonce' => true, 'tmce' => 'styleselect,bold,italic,underline', 'media_buttons' => true) );
		} 
		if ( get_page_template_slug( $post->ID ) == 'page-templates/template-archive.php'  ) {
			add_meta_box('work_color_space_unique', 'Color Space', 'color_space_box', 'page', "side", "core");
			add_meta_box('work_link_unique', 'Link Name', 'create_external_link_box', 'page', "side", "core");
		}
		add_meta_box('meta_sharing_unique', 'Meta info', 'meta_sharing_box', 'page', 'normal', 'low');
		add_meta_box('between_page_slashes_unique', 'Entre les Slashes', 'create_between_slashes_box', 'page', "side", "core");
		
		
		// Capability Page Meta Fields
		add_meta_box('capability_page_info_unique', 'Projects to display', 'create_capability_page_info_box', 'capability_page', "normal", "core");
		add_meta_box('between_capability_slashes_unique', 'Entre les Slashes', 'create_between_slashes_box', 'capability_page', "side", "core");
	
		// Homepage Module Meta Fields
		add_meta_box('homepage_module_info_unique', 'Settings', 'create_homepage_module_info_box', 'homepage_module', "normal", "core");
		
		// Client Meta Fields
		add_meta_box('client_info_unique', 'Projects done for this client', 'create_capability_page_info_box', 'client', "normal", "core");
		add_meta_box('client_link_unique', 'Link', 'create_external_link_box', 'client', "normal", "core");
		
		
		
	}
	add_action( 'add_meta_boxes', 'DEVONA_add_custom_meta_fields' );
	
	// Create custom wp_editors
	function create_wp_editor_box ( $post, $metabox ) {
		if ( isset($metabox['args']['nonce']) && $metabox['args']['nonce'] == true) wp_nonce_field( 'save_project_meta', 'save_project_meta_nonce' );
		$value = get_post_meta( $post->ID, $metabox['args']['input_id'], true );
		$args = array(
			'tinymce' => false,
			'quicktags' => true,
			'media_buttons' => $metabox['args']['media_buttons'],
			'textarea_rows' => $metabox['args']['input_rows'],
			'teeny' => true,
			'dfw' => true
    	);
    	if ($metabox['args']['tmce']) {
    		$args['tinymce'] = array( 
       			'toolbar1' => $metabox['args']['tmce'],
       			'toolbar2' => '',
       			'toolbar3' => ''
			);
		}
		wp_editor( $value, $metabox['args']['input_id'], $args );
	}
	
	// Create external link box
	function create_external_link_box( $post ) {
		wp_nonce_field( 'save_project_meta', 'save_project_meta_nonce' );
		echo '<input type="text" id="external_link" name="external_link" style="width: 100%;" placeholder="http://url" value="'.get_post_meta( $post->ID, 'external_link', true).'" /><br><br />';
	}
	
	// Create project archive box
	function create_archive_box( $post ) {
		echo '<input type="checkbox" id="project_archived" name="project_archived" value="1"'; if (get_post_meta( $post->ID, 'project_archived', true) == 1) echo ' checked'; echo ' />&nbsp;&nbsp;Move This Project to the Archives<br />';
	}
	
	// Create between the slashes box
	function create_between_slashes_box( $post ) {
		wp_nonce_field( 'save_project_meta', 'save_project_meta_nonce' );
		echo '<label for="between_slashes">Words to animate (seperated by commas)</label><br>';
		echo '<input type="text" id="between_slashes" name="between_slashes" style="width: 100%;" placeholder="example, example, example" value="'.get_post_meta( $post->ID, 'between_slashes', true).'" /><br><br />';
	}
	
	// Create project services box
	function create_project_services_box( $post ) {
		$value = get_post_meta( $post->ID, 'project_services', true);
		$services_list = get_posts( array(
			'posts_per_page' => -1,
			'post_type' => 'service',
			'post_status' => 'publish',
			'orderby' => 'title', 
			'order' => 'ASC'
		) );	
		echo '<div style="-webkit-column-count:2; -moz-column-count:2; column-count:2;">';
		foreach ($services_list as $key => $val) {
			echo '<input type="checkbox" id="project_services" name="project_services[]" value="' . $val->ID . '"'; if (is_array($value) && in_array($val->ID, $value)) echo ' checked'; echo ' />&nbsp;&nbsp;' . $val->post_title . '<br />';
		}
		echo '</div>';
		
	}
	
	// Create color space box
	function color_space_box( $post ) {
		wp_nonce_field( 'save_project_meta', 'save_project_meta_nonce' );
		echo '<label for="color_space">Hex color for this project</label><br>';
		echo '<input type="text" id="color_space" name="color_space" style="width: 100%;" placeholder="111011" value="'.get_post_meta( $post->ID, 'color_space', true).'" /><br><br />';
	}
	
	// Create color space box
	function meta_sharing_box( $post ) {
		wp_nonce_field( 'save_project_meta', 'save_project_meta_nonce' );
		echo '<label for="meta_desc">Description</label><br>';
		echo '<input type="text" id="meta_desc" name="meta_desc" style="width: 100%;" placeholder="short description for meta tags and social sharing" value="'.get_post_meta( $post->ID, 'meta_desc', true).'" /><br><br />';
		echo '<label for="meta_keys">Keywords</label><br>';
		echo '<input type="text" id="meta_keys" name="meta_keys" style="width: 100%;" placeholder="keywords, separated, by, commas" value="'.get_post_meta( $post->ID, 'meta_keys', true).'" /><br><br />';
	}
	
	// Create capability page info box
	function create_capability_page_info_box( $post ) {
		wp_nonce_field( 'save_project_meta', 'save_project_meta_nonce' );
		$value = get_post_meta( $post->ID, 'capability_projects', true);
		$projects_list = get_posts( array(
			'posts_per_page' => -1,
			'post_type' => 'project',
			'post_status' => 'publish',
			'orderby' => 'title', 
			'order' => 'ASC'
		) );	
		echo '<div style="-webkit-column-count:2; -moz-column-count:2; column-count:2;">';
		foreach ($projects_list as $key => $val) {
			echo '<input type="checkbox" id="capability_projects" name="capability_projects[]" value="' . $val->ID . '"'; if (is_array($value) && in_array($val->ID, $value)) echo ' checked'; echo ' />&nbsp;&nbsp;' . $val->post_title . '<br />';
		}
		echo '</div>';
		
	}
	
	// Create homepage module info box
	function create_homepage_module_info_box( $post ) {
		wp_nonce_field( 'save_project_meta', 'save_project_meta_nonce' );
		$value = get_post_meta( $post->ID, 'module_id', true);
		$project_options = get_posts( array(
			'posts_per_page' => -1,
			'post_type' => 'project',
			'post_status' => 'publish',
			'orderby' => 'title', 
			'order' => 'ASC'
		) );	
		$post_options = get_posts( array(
			'posts_per_page' => -1,
			'post_type' => 'post',
			'post_status' => 'publish',
			'orderby' => 'title', 
			'order' => 'ASC'
		) );	
		
		echo '<label for="module_id">Content</label><br>';
		echo '<select id="module_id" name="module_id" >'; 
  		echo '<optgroup label="Projects">';
		foreach ($project_options as $key => $val) {
			echo '<option type="checkbox" value="' . $val->ID . '"'; if ( get_post_meta( $post->ID, 'module_id', true) == $val->ID ) echo ' selected="selected"'; echo ' />' . $val->post_title . '</option>';
		} 
  		echo '</optgroup>'; 
  		echo '<optgroup label="Posts">';
		foreach ($post_options as $key => $val) {
			echo '<option type="checkbox" value="' . $val->ID . '"'; if ( get_post_meta( $post->ID, 'module_id', true)  == $val->ID ) echo ' selected="selected"'; echo ' />' . $val->post_title . '</option>';
		}
  		echo '</optgroup>';
		echo '</select><br /><br />'; 
		
		echo '<label for="module_size">Configuration</label><br>';
		echo '<select id="module_size" name="module_size" >'; 
  		echo '<optgroup label=" ">';
  		echo '<optgroup label="Small Modules">';
			echo '<option type="checkbox" value="post"'; if ( get_post_meta( $post->ID, 'module_size', true) == "post") echo ' selected="selected"'; echo ' />Small (Text Only)</option>';
			echo '<option type="checkbox" value="single-small"'; if ( get_post_meta( $post->ID, 'module_size', true) == "single-small") echo ' selected="selected"'; echo ' />Small (One Image)</option>';
  		echo '<optgroup label=" ">';
  		echo '<optgroup label="Medium Modules">';
			echo '<option type="checkbox" value="single-medium"'; if ( get_post_meta( $post->ID, 'module_size', true) == "single-medium") echo ' selected="selected"'; echo ' />Medium (One Image)</option>';
			echo '<option type="checkbox" value="dual-medium"'; if ( get_post_meta( $post->ID, 'module_size', true) == "dual-medium") echo ' selected="selected"'; echo ' />Medium (Two Images)</option>';
  		echo '<optgroup label=" ">';
  		echo '<optgroup label="Large Modules">';
			echo '<option type="checkbox" value="single-large"'; if ( get_post_meta( $post->ID, 'module_size', true) == "single-large") echo ' selected="selected"'; echo ' />Large (One Image)</option>';
			echo '<option type="checkbox" value="dual-large"'; if ( get_post_meta( $post->ID, 'module_size', true) == "dual-large") echo ' selected="selected"'; echo ' />Large (Two Images)</option>';
		echo '</select><br /><br />'; 
		
		
		echo '<label for="module_rollover">Layout</label><br>';
		echo '<select id="module_rollover" name="module_rollover" >'; 
			echo '<option type="checkbox" value="top_left"'; if ( get_post_meta( $post->ID, 'module_rollover', true) == "top_left") echo ' selected="selected"'; echo ' />Foreground Image in Top Left</option>';
			echo '<option type="checkbox" value="top_right"'; if ( get_post_meta( $post->ID, 'module_rollover', true) == "top_right") echo ' selected="selected"'; echo ' />Foreground Image in Top Right</option>';
			echo '<option type="checkbox" value="bottom_right"'; if ( get_post_meta( $post->ID, 'module_rollover', true) == "bottom_right") echo ' selected="selected"'; echo ' />Foreground Image in Bottom Right</option>';
			echo '<option type="checkbox" value="bottom_left"'; if ( get_post_meta( $post->ID, 'module_rollover', true) == "bottom_left") echo ' selected="selected"'; echo ' />Foreground Image in Bottom Left</option>';
		echo '</select>'; 
		
	}
	
	

//  -------------------------------------------------------
//  SANITIZE AND SAVE META DATA FOR CUSTOM META FIELDS 
//  ------------------------------------------------------- 

	function save_project_meta( $post_id ) {
		// If this is an autosave, our form has not been submitted, do nothing.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;

		// If user does not have permissions, do nothing.
	    if ( ! current_user_can( 'edit_page', $post_id ) ) return $post_id;
	
		// If this is not the correct type of post, do nothing.
	    if ( 
	    	'post' != $_POST['post_type'] && 
	    	'project' != $_POST['post_type']  && 
	    	'page' != $_POST['post_type']   && 
	    	'capability_page' != $_POST['post_type']   && 
	    	'homepage_module' != $_POST['post_type']   && 
	    	'client' != $_POST['post_type']
	    ) return $post_id;

		// If nonce does not verify, do nothing.
		if ( !isset( $_POST['save_project_meta_nonce'] ) || !wp_verify_nonce( $_POST['save_project_meta_nonce'], 'save_project_meta' ) ) return $post_id;
	
		// Sanitize the values
	    if ( isset( $_REQUEST['external_link'] ) ) 																				{ $update_vals['external_link'] = sanitize_post_field( 'external_link', $_REQUEST['external_link'], $post_id, 'display' ); } 
	    else if ( 'post' == $_POST['post_type']  || 'client' == $_POST['post_type'] || 'page' == $_POST['post_type'] ) 			{ $update_vals['external_link'] = null; }
    
		if ( isset( $_REQUEST['project_archived'] ) ) 																			{ $update_vals['project_archived'] = sanitize_post_field( 'project_archived', $_REQUEST['project_archived'], $post_id, 'display' ); } 
	    else if ( 'project' == $_POST['post_type'] ) 																			{ $update_vals['project_archived'] = null; }
    
		if ( isset( $_REQUEST['project_gallery'] ) ) 																			{ $update_vals['project_gallery'] = sanitize_post_field( 'project_gallery', $_REQUEST['project_gallery'], $post_id, 'display' ); } 
	    else if ( 'project' == $_POST['post_type'] ) 																			{ $update_vals['project_gallery'] = null; }
    
		if ( isset( $_REQUEST['recognition'] ) ) 																				{ $update_vals['recognition'] = sanitize_post_field( 'recognition', $_REQUEST['recognition'], $post_id, 'display' ); } 
	    else if ( 'project' == $_POST['post_type'] ) 																			{ $update_vals['recognition'] = null; }
    
		if ( isset( $_REQUEST['between_slashes'] ) ) 																			{ $update_vals['between_slashes'] = sanitize_post_field( 'between_slashes', $_REQUEST['between_slashes'], $post_id, 'display' ); } 
		else if ( 
			'project' == $_POST['post_type'] || 
			'page' == $_POST['post_type'] || 
			'capability_page' == $_POST['post_type'] 
		) 																														{ $update_vals['between_slashes'] = null; }
    
		if ( isset( $_REQUEST['color_space'] ) ) 																				{ $update_vals['color_space'] = sanitize_post_field( 'color_space', $_REQUEST['color_space'], $post_id, 'display' ); } 
		else if ( 'project' == $_POST['post_type'] || 'page' == $_POST['post_type'] ) 											{ $update_vals['color_space'] = null; }
    
		if ( isset( $_REQUEST['meta_desc'] ) ) 																					{ $update_vals['meta_desc'] = sanitize_post_field( 'meta_desc', $_REQUEST['meta_desc'], $post_id, 'display' ); } 
		else if ( 'project' == $_POST['post_type'] || 'page' == $_POST['post_type'] ) 											{ $update_vals['meta_desc'] = null; }
    
		if ( isset( $_REQUEST['meta_keys'] ) ) 																					{ $update_vals['meta_keys'] = sanitize_post_field( 'meta_keys', $_REQUEST['meta_keys'], $post_id, 'display' ); } 
		else if ( 'project' == $_POST['post_type'] || 'page' == $_POST['post_type'] ) 											{ $update_vals['meta_keys'] = null; }
    
		if ( isset( $_REQUEST['project_services'] ) )																			{ foreach ( $_REQUEST['project_services'] as $ap_key => $ap_val )	{ $update_vals['project_services'][] = sanitize_text_field( $ap_val ); } } 
	    else if ( 'project' == $_POST['post_type'] )																			{ $update_vals['project_services'] = null; }
  		
  		if ( isset( $_REQUEST['compost_gallery'] ) ) 																			{ $update_vals['compost_gallery'] = sanitize_post_field( 'compost_gallery', $_REQUEST['compost_gallery'], $post_id, 'display' ); } 
	    else if ( 'page' == $_POST['post_type'] ) 																				{ $update_vals['compost_gallery'] = null; }
    
		if ( isset( $_REQUEST['capability_projects'] ) )																		{ foreach ( $_REQUEST['capability_projects'] as $ap_key => $ap_val )	{ $update_vals['capability_projects'][] = sanitize_text_field( $ap_val ); } } 
	    else if ( 'capability_page' == $_POST['post_type'] || 'client' == $_POST['post_type'] )									{ $update_vals['capability_projects'] = null; }
  	
  		if ( isset( $_REQUEST['module_id'] ) ) 																					{ $update_vals['module_id'] = sanitize_post_field( 'module_id', $_REQUEST['module_id'], $post_id, 'display' ); } 
	    else if ( 'homepage_module' == $_POST['post_type'] ) 																	{ $update_vals['module_id'] = null; }
    	
		if ( isset( $_REQUEST['module_size'] ) ) 																				{ $update_vals['module_size'] = sanitize_post_field( 'module_size', $_REQUEST['module_size'], $post_id, 'display' ); } 
	    else if ( 'homepage_module' == $_POST['post_type'] ) 																	{ $update_vals['module_size'] = null; }
    
		if ( isset( $_REQUEST['module_rollover'] ) ) 																			{ $update_vals['module_rollover'] = sanitize_post_field( 'module_rollover', $_REQUEST['module_rollover'], $post_id, 'display' ); } 
	    else if ( 'homepage_module' == $_POST['post_type'] ) 																	{ $update_vals['module_rollover'] = null; }
    
		
		//var_dump($update_vals);
		// Update the metadata
	    if ( isset($update_vals) ) {
	    	foreach ($update_vals as $uv_key => $uv_val ) {
	        	update_post_meta( $post_id, $uv_key, $uv_val );
	        }
	    }
    
	}
	add_action( 'save_post', 'save_project_meta');



//  ------------------------------------------------------- 
//  EDIT HOMEPAGE MODULE LIST COLUMNS
//  ------------------------------------------------------- 

	function DEVONA_create_homepage_module_columns($columns) {
	    unset( $columns['date'] );
	    $columns['module_size'] = __( 'Module Size', 'your_text_domain' );
	    return $columns;
	}
	add_filter( 'manage_edit-homepage_module_columns', 'DEVONA_create_homepage_module_columns' );

	function DEVONA_set_homepage_module_columns( $column, $post_id ) {
	    switch ( $column ) {
	        case 'module_size' :
	            echo get_post_meta( $post_id, 'module_size', true); 
	            break;
	    }
	}
	add_action( 'manage_homepage_module_posts_custom_column' , 'DEVONA_set_homepage_module_columns', 10, 2 );



//  ------------------------------------------------------- 
//  EDIT HOMEPAGE MODULE TITLE ON SAVE
//  ------------------------------------------------------- 

	function DEVONA_modify_homepage_module_title( $data , $postarr ) { 
		if( $data['post_type'] == 'homepage_module' ) {
			$data['post_title'] = get_the_title(get_post_meta( $postarr['post_ID'], 'module_id', true));
		}
		return $data;
	}
	add_filter( 'wp_insert_post_data' , 'DEVONA_modify_homepage_module_title' , '99', 2 );



//  ------------------------------------------------------- 
//  ADD COMPANY ADDRESS AND PHONE OPTIONS TO SETTING PAGE
//  ------------------------------------------------------- 

	function DEVONA_admin_init() {
	 	// Register and add General settings
	 	register_setting('general','company_division');
	 	register_setting('general','company_address');
	 	register_setting('general','company_neighborhood');
	 	register_setting('general','company_city');
	 	register_setting('general','company_state');
	 	register_setting('general','company_zip');
	 	register_setting('general','company_phone');
	 	register_setting('general','company_email');
	 	register_setting('general','secondary_company_division');
	 	register_setting('general','secondary_company_address');
	 	register_setting('general','secondary_company_neighborhood');
	 	register_setting('general','secondary_company_city');
	 	register_setting('general','secondary_company_state');
	 	register_setting('general','secondary_company_zip');
	 	register_setting('general','secondary_company_phone');
	 	register_setting('general','secondary_company_email');
	 	register_setting('general','pinterest_url');
	 	register_setting('general','facebook_url');
	 	register_setting('general','tumblr_url');
	 	register_setting('general','twitter_url');
	 	register_setting('general','google_url');
	 	register_setting('general','hide_from_nav');
	 	register_setting('general','jobs_email');
	 	register_setting('general','min_width');
	 	register_setting('general','max_width');
	 	register_setting('general','blink_interval');
		add_settings_field( 'address_info_unique', 'Main Office Address Information', 'add_address_info', 'general', 'default' );
		add_settings_field( 'secondary_address_info_unique', 'Secondary Office Address Information', 'add_secondary_address_info', 'general', 'default' );
		add_settings_field( 'jobs_unique', 'Email For Job Inquiries', 'add_jobs_info', 'general', 'default' );
		add_settings_field( 'social_media_unique', 'Social Media Links', 'add_social_media_fields', 'general', 'default' );
		add_settings_field( 'display_unique', 'Display Preferences', 'add_display_info', 'general', 'default' );
		add_settings_field( 'hide_from_nav_unique', 'Hide Pages From Nav', 'add_page_hiding_options', 'general', 'default' );
	 	
	 	// Register and add Reading settings
	 	register_setting('reading','meta_description');
	 	register_setting('reading','meta_keywords');
		add_settings_field( 'meta_tags_unique', 'Site Wide Meta Tags', 'add_meta_tag_fields', 'reading', 'default' );
	}
	add_action('admin_init', 'DEVONA_admin_init');
	
	// Create custom social media fields
	function add_meta_tag_fields() {
		echo '<label for="meta_description">Description</label><br />';
		echo '<textarea class="regular-text code" id="meta_description" name="meta_description" rows="10" cols="50" placeholder="Description of the site">'.get_option('meta_description').'</textarea><br /><br />';
		echo '<label for="meta_keywords">Keywords</label><br />';
		echo '<textarea class="regular-text code" id="meta_keywords" name="meta_keywords" rows="10" cols="50" placeholder="Keywords seperated by commas">'.get_option('meta_keywords').'</textarea><br /><br />';
	}
	
	// Create custom address info fields
	function add_address_info() {
		echo '<label for="company_email">Email</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('company_email').'" id="company_email" name="company_email" placeholder="name@example.com"><br /><br />';
		echo '<label for="company_phone">Phone Number</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('company_phone').'" id="company_phone" name="company_phone" placeholder="1 234 567 8910"><br /><br />';
		echo '<label for="company_division">Name</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('company_division').'" id="company_division" name="company_division" placeholder="Company Name"><br /><br />';
		echo '<label for="company_address">Street Address</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('company_address').'" id="company_address" name="company_address" placeholder="Address"><br /><br />';
		echo '<label for="company_neighborhood">Neighborhood</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('company_neighborhood').'" id="company_neighborhood" name="company_neighborhood" placeholder="Neighborhood"><br /><br />';
		echo '<label for="company_city">City</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('company_city').'" id="company_city" name="company_city" placeholder="City"><br /><br />';
		echo '<label for="company_state">State</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('company_state').'" id="company_state" name="company_state" placeholder="ST"><br /><br />';
		echo '<label for="company_zip">Zip</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('company_zip').'" id="company_zip" name="company_zip" placeholder="000000"><br /><br />';
	}
	
	// Create custom secondary address info fields
	function add_secondary_address_info() {
		echo '<label for="secondary_company_email">Email</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('secondary_company_email').'" id="secondary_company_email" name="secondary_company_email" placeholder="name@example.com"><br /><br />';
		echo '<label for="secondary_company_phone">Phone Number</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('secondary_company_phone').'" id="secondary_company_phone" name="secondary_company_phone" placeholder="1 234 567 8910"><br /><br />';
		echo '<label for="secondary_company_division">Name</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('secondary_company_division').'" id="secondary_company_division" name="secondary_company_division" placeholder="Company Name"><br /><br />';
		echo '<label for="secondary_company_address">Street Address</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('secondary_company_address').'" id="secondary_company_address" name="secondary_company_address" placeholder="Address"><br /><br />';
		echo '<label for="secondary_company_neighborhood">Neighborhood</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('secondary_company_neighborhood').'" id="secondary_company_neighborhood" name="secondary_company_neighborhood" placeholder="Neighborhood"><br /><br />';
		echo '<label for="secondary_company_city">City</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('secondary_company_city').'" id="secondary_company_city" name="secondary_company_city" placeholder="City"><br /><br />';
		echo '<label for="secondary_company_state">State</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('secondary_company_state').'" id="secondary_company_state" name="secondary_company_state" placeholder="ST"><br /><br />';
		echo '<label for="secondary_company_zip">Zip</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('secondary_company_zip').'" id="secondary_company_zip" name="secondary_company_zip" placeholder="000000"><br /><br />';
	}
	
	// Create custom jobs email field
	function add_jobs_info() {
		echo '<label for="jobs_email">Email</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('jobs_email').'" id="jobs_email" name="jobs_email" placeholder="name@example.com"><br /><br />';
	}
	
	// Create custom social media fields
	function add_social_media_fields() {
		echo '<label for="pinterest_url">Pinterest</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('pinterest_url').'" id="pinterest_url" name="pinterest_url" placeholder="http://url.com"><br /><br />';
		
		echo '<label for="facebook_url">Facebook</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('facebook_url').'" id="facebook_url" name="facebook_url" placeholder="http://url.com"><br /><br />';
		
		echo '<label for="tumblr_url">Tumblr</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('tumblr_url').'" id="tumblr_url" name="tumblr_url" placeholder="http://url.com"><br /><br />';
		
		echo '<label for="twitter_url">Twitter</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('twitter_url').'" id="twitter_url" name="twitter_url" placeholder="http://url.com"><br /><br />';
		
		echo '<label for="google_url">Google+</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('google_url').'" id="google_url" name="google_url" placeholder="http://url.com">';
	}
	
	// Create custom jobs email field
	function add_display_info() {
		echo '<label for="min_width">Desktop Min Width</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('min_width').'" id="min_width" name="min_width" placeholder="1100"><br /><br />';
		echo '<label for="max_width">Desktop Max Width</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('max_width').'" id="max_width" name="max_width" placeholder="1600"><br /><br />';
		echo '<label for="blink_interval">Blinker Interval (ms)</label><br />';
		echo '<input type="text" class="regular-text code" value="'.get_option('blink_interval').'" id="blink_intervalh" name="blink_interval" placeholder="500"><br /><br />';
	}
	
	// Create custom address info fields
	function add_page_hiding_options() {
		$value = get_option('hide_from_nav');
		$available_pages = get_posts( array( 'posts_per_page' => -1, 'post_type' => 'page', 'orderby' => 'menu_order', 'order' => 'ASC' ) );
		foreach ($available_pages as $key => $val) {
			echo '<input type="checkbox" id="hide_from_nav" name="hide_from_nav[]" name="hide_from_nav" value="' . $val->ID . '"'; if (is_array($value) && in_array($val->ID, $value)) echo ' checked'; echo ' />&nbsp;&nbsp;' . $val->post_title . '<br />';
		}
	}
	
	
	
//  ------------------------------------------------------- 
//  REMOVE ADMIN MENU ITEMS 
//  ------------------------------------------------------- 
	function DEVONA_remove_menus(){
		//remove_menu_page( 'edit.php' );                   //Posts
		//remove_menu_page( 'upload.php' );                 //Media
		//remove_menu_page( 'edit-comments.php' );          //Comments
		remove_menu_page( 'themes.php' );                 //Appearance
		remove_menu_page( 'plugins.php' );                //Plugins
		remove_menu_page( 'tools.php' );                  //Tools
	}
	add_action( 'admin_menu', 'DEVONA_remove_menus' );
	
	
	
//  ------------------------------------------------------- 
//  ADD ORDER COLUMN TO ADMIN LISTS
//  ------------------------------------------------------- 
	
	// Add order column
	function DEVONA_add_header_column($columns) {
		$columns['menu_order'] = "Order";
		return $columns;
	}
	add_action('manage_edit-project_columns', 'DEVONA_add_header_column');
	add_action('manage_edit-homepage_module_columns', 'DEVONA_add_header_column');
	add_action('manage_edit-service_columns', 'DEVONA_add_header_column');
	add_action('manage_edit-process_columns', 'DEVONA_add_header_column');

	// Show order column values
	function DEVONA_show_order_column($name){
		global $post;

		switch ($name) {
			case 'menu_order':
				$order = $post->menu_order;
				echo $order;
				break;
			default:
				break;
		}
	}
	add_action('manage_project_posts_custom_column','DEVONA_show_order_column');
	add_action('manage_homepage_module_posts_custom_column','DEVONA_show_order_column');
	add_action('manage_service_posts_custom_column','DEVONA_show_order_column');
	add_action('manage_process_posts_custom_column','DEVONA_show_order_column');

	// Make order column sortable
	function DEVONA_register_order_column($columns){
		$columns['menu_order'] = 'menu_order';
		return $columns;
	}
	add_filter('manage_edit-project_sortable_columns','DEVONA_register_order_column');
	add_filter('manage_edit-homepage_module_sortable_columns','DEVONA_register_order_column');
	add_filter('manage_edit-service_sortable_columns','DEVONA_register_order_column');
	add_filter('manage_edit-process_sortable_columns','DEVONA_register_order_column');

	// Set order column as default sort option
	function DEVONA_orderby_column( $vars ) {
		if (  
				isset( $_GET['post_type'] ) && ( 
					$_GET['post_type'] == 'project'  ||
					$_GET['post_type'] == 'homepage_module'  ||
					$_GET['post_type'] == 'service'  ||
					$_GET['post_type'] == 'process'  
				)
			) {
			$vars['orderby'] = 'menu_order';
			$vars['order'] = 'asc';         
		}
		return $vars;
	}
	add_filter( 'request', 'DEVONA_orderby_column' );



//  ------------------------------------------------------- 
//  REMOVE EXCESS HEAD ITEMS
//  ------------------------------------------------------- 

	remove_action ('wp_head', 'rsd_link');
	remove_action( 'wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
	
	

//  ------------------------------------------------------- 
//  CUSTOMIZE USER PROFILES
//  ------------------------------------------------------- 
	
	// Remove admin color scheme picker
	function DEVONA_remove_admin_color_scheme() {
	   global $_wp_admin_css_colors;
	   $_wp_admin_css_colors = 0;
	}
	add_action('admin_head', 'DEVONA_remove_admin_color_scheme');
	
	// Customize contact fields
	function DEVONA_customize_contact_fields($profile_fields) {
		// Add fields
		$profile_fields['job_title'] = 'Job Title';
		$profile_fields['between_slashes'] = 'Between the Slashes';
		return $profile_fields;
	}
	add_filter('user_contactmethods', 'DEVONA_customize_contact_fields');

	// Add user profile image
	function DEVONA_customize_profile_fields( $user ) { 
	?>
		<table class="form-table fh-profile-upload-options">
			<tr>
				<th><label for="image">Main Image</label></th>
				<td>
				
				<img id="image-img"  class="user-preview-image" src="<?php echo esc_attr( get_the_author_meta( 'image', $user->ID ) ); ?>"><br />

				<input type="text" name="image" id="image" value="<?php echo esc_attr( get_the_author_meta( 'image', $user->ID ) ); ?>" class="regular-text" />
				<input type='button' class="button-primary" value="Upload Image" id="uploadimage" onclick="uploadImage('image');"/><br />
				</td>
			</tr>
			<tr>
				<th><label for="roll-image">Rollover Image</label></th>
				<td>
				
				<img id="roll-image-img" class="user-preview-image" src="<?php echo esc_attr( get_the_author_meta( 'roll-image', $user->ID ) ); ?>"><br />

				<input type="text" name="roll-image" id="roll-image" value="<?php echo esc_attr( get_the_author_meta( 'roll-image', $user->ID ) ); ?>" class="regular-text" />
				<input type='button' class="button-primary" value="Upload Image" id="uploadrollimage" onclick="uploadImage('roll-image');"/><br />
				</td>
			</tr>
			<tr>
				<th><label for="show_user"></label></th>
				<td>
					<input  type="checkbox" name="show_user" id="show_user" value="1" <?php if ( get_the_author_meta( 'show_user', $user->ID ) == 1 ) echo ' checked'; ?> />Show user in about us<br />
				</td>
			</tr>
			<tr>
				<th><label for="animate-from"></label></th>
				<td>
					<input  type="radio" name="animate-from" id="animate-from" value="top" <?php if ( get_the_author_meta( 'animate-from', $user->ID ) == 'top' ) echo ' checked'; ?> />Animate in from the top<br />
					<input  type="radio" name="animate-from" id="animate-from" value="bottom" <?php if ( get_the_author_meta( 'animate-from', $user->ID ) == 'bottom' ) echo ' checked'; ?> />Animate in from the bottom<br />
				</td>
			</tr>
		</table>
		<script type="text/javascript">
			function uploadImage( which_image ) {
				tb_show('test', 'media-upload.php?type=image&TB_iframe=1');
				window.send_to_editor = function( html ){
					imgurl = jQuery( 'img', html ).attr( 'src' );
					jQuery( '#' + which_image  ).val(imgurl);
					tb_remove();
				}
				return false;
			}
		</script>
	<?php 
	}
	add_action( 'show_user_profile', 'DEVONA_customize_profile_fields' );
	add_action( 'edit_user_profile', 'DEVONA_customize_profile_fields' );

	// Save user profile fields
	function my_save_extra_profile_fields( $user_id ) {
		if ( !current_user_can( 'edit_user', $user_id ) ) {
			return false;
		}
		update_user_meta( $user_id, 'image', $_POST[ 'image' ] );
		update_user_meta( $user_id, 'roll-image', $_POST[ 'roll-image' ] );
		update_user_meta( $user_id, 'show_user', $_POST[ 'show_user' ] );
		update_user_meta( $user_id, 'animate-from', $_POST[ 'animate-from' ] );
	}
	add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
	add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );
	
	// Remove 'Visual Editor', 'Keyboard Shortcuts' and 'Toolbar' options.
	if ( ! function_exists( 'cor_remove_personal_options' ) ) {
		function cor_remove_personal_options( $subject ) {
    		$subject = preg_replace( '#<h3>Personal Options</h3>.+?/table>#s', '', $subject, 1 );
    		return $subject;
		}
		function cor_profile_subject_start() {
			ob_start( 'cor_remove_personal_options' );
		}
		function cor_profile_subject_end() {
			ob_end_flush();
		}
	}
	add_action( 'admin_head-user-edit.php', 'cor_profile_subject_start' );
	add_action( 'admin_footer-user-edit.php', 'cor_profile_subject_end' );
    
    

//  ------------------------------------------------------- 
//  ADD FIELDS TO THE MEDIA GALLERY
//  ------------------------------------------------------- 

	// Create custom media library fields
	function DEVONA_edit_media_custom_field( $form_fields, $post ) {
	    
	    $form_fields['carousel_image_field'] = array( 'label' => 'Carousel', 'input' => 'html', 'value' => get_post_meta( $post->ID, '_carousel_image_field', true ) );
	    $form_fields['carousel_image_field']['html'] = '<input type="checkbox" value="1" name="attachments['.$post->ID.'][carousel_image_field]" id="attachments['.$post->ID.'][carousel_image_field]"';
	    $form_fields['carousel_image_field']['html'] .= ( $form_fields['carousel_image_field']['value'] == 1 )? ' checked /> ' : ' /><br />';
    	    
	    return $form_fields;
	}
	add_filter('attachment_fields_to_edit', 'DEVONA_edit_media_custom_field', 10, 2 );
	
	// Save custom media library fields
	function save_media_custom_field( $post, $attachment ) {
	    update_post_meta( $post['ID'], '_carousel_image_field', $attachment['carousel_image_field'] );
	    return $post;
	}
	add_filter('attachment_fields_to_save', 'save_media_custom_field', 11, 2 );
	
	

//  ------------------------------------------------------- 
//  ADD FEATURED IMAGES
//  ------------------------------------------------------- 
	
	// Primary Featured Image
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
	}
	
	// Secondary Featured Image
	if (class_exists('MultiPostThumbnails')) {
        new MultiPostThumbnails(
            array(
                'label' => 'Menu Image',
                'id' => 'menu-image',
                'post_type' => 'project'
            )
        );
        new MultiPostThumbnails(
            array(
                'label' => 'Foreground Rollover Image',
                'id' => 'foreground-rollover-image',
                'post_type' => 'project'
            )
        );
        new MultiPostThumbnails(
            array(
                'label' => 'Background Rollover Image',
                'id' => 'background-rollover-image',
                'post_type' => 'project'
            )
        );
        new MultiPostThumbnails(
            array(
                'label' => 'Rollover Image',
                'id' => 'rollover-image',
                'post_type' => 'post'
            )
        );
    }
	
	

//  ------------------------------------------------------- 
//  FORMAT WP_TITLE ELEMENT
//  ------------------------------------------------------- 

	function DEVONA_title( $title, $sep ) {
		if ( is_feed() ) return $title;
		$title .= get_bloginfo( 'name' );
		$site_description = get_bloginfo( 'description', 'display' );
		if (is_home() || is_front_page()) $title = "$title $sep $site_description";
		return $title;
	}
	add_filter( 'wp_title', 'DEVONA_title', 10, 2 );
	
	

//  ------------------------------------------------------- 
//  ADD FORMATS TO THE TINYMCE
//  ------------------------------------------------------- 

	// Insert formats menu into the tinyMCE
	function DEVONA_add_mce_buttons( $buttons ) {
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
	}
	//add_filter('mce_buttons_2', 'DEVONA_add_mce_buttons');

	// Add styles to the formats menu
	function DEVONA_insert_formats( $init_array ) {  
		$style_formats = array(  
			array(  
				'title' => 'large project image',  
				'selector' => 'img',  
				'classes' => 'large-project-image'
			),
			array(  
				'title' => 'medium project image',  
				'selector' => 'img',  
				'classes' => 'medium-project-image'
			),
			array(  
				'title' => 'small project image',  
				'selector' => 'img',  
				'classes' => 'small-project-image'
			),
			array(  
				'title' => 'project quote',  
				'block' => 'blockquote'
			)
		);  
		$init_array['style_formats'] = json_encode( $style_formats );  
		return $init_array;  
	} 
	add_filter( 'tiny_mce_before_init', 'DEVONA_insert_formats' );  
	
	

//  ------------------------------------------------------- 
//  REWRITE GALLERY CONTENT
//  ------------------------------------------------------- 

	function DEVONA_rewriteGallery($gallery_contents) {
		$instances = preg_split('/\n/', $gallery_contents);	
		$images_script = '<script type=\'text/javascript\'> var display_images_2 = {';
			
		//$carousel_count = 0;
		foreach($instances as $instance) {
			$instance_id = false; 
			$image = false; 
			$caption_text = false;
			$pulled_vars = false;
			
			preg_match('/class="(?:.*)wp-image-([\d]*)(?:.*)"/', $instance,  $instance_id);
			if ( !empty($instance_id) ) { $image = get_post( $instance_id[1] ); }
				
			if (strpos($instance,'blockquote') !== false) {
				preg_match('/<\/a> (.*)\[\/caption\]/', $instance,  $caption_text);
				preg_match('/<blockquote>\n*(.*?)<\/blockquote>/', $instance,  $pulled_vars);
				if ( $pulled_vars[1] ) {
				
					if ( $caption_text != false ) { 
						$replacement = '<blockquote class="small-project-quote masonry-block" href="'.$image->guid.'" title="'.$caption_text[1].'"><svg class="big-slash" x="0px" y="0px" viewBox="0 0 119.959 234.292" enable-background="new 0 0 119.959 234.292" xml:space="preserve"><polygon points="112.411,0 0,234.292 7.547,234.292 119.959,0 "/></svg><span class="caption-container">'.$caption_text[1].'</span></blockquote>';
					} elseif ( $image != false ) {
						$source = wp_get_attachment_image_src($image->ID, 'large');
						$replacement = '<blockquote class="small-project-quote masonry-block"><svg class="big-slash" x="0px" y="0px" viewBox="0 0 119.959 234.292" enable-background="new 0 0 119.959 234.292" xml:space="preserve"><polygon points="112.411,0 0,234.292 7.547,234.292 119.959,0 "/></svg><img src="'.$source[0].'" /></blockquote>';
					} else { 
						$replacement = '<blockquote class="small-project-quote masonry-block"><svg class="big-slash" x="0px" y="0px" viewBox="0 0 119.959 234.292" enable-background="new 0 0 119.959 234.292" xml:space="preserve"><polygon points="112.411,0 0,234.292 7.547,234.292 119.959,0 "/></svg>' . $pulled_vars[1] . '</blockquote>';
					} 
					
				} else {
					$replacement = '';
				}
				
			} else {
				$last_carousel_count = $GLOBALS['carousel_count'];
				if ( get_post_meta( $image->ID, '_carousel_image_field', true ) ) {
						if ( $GLOBALS['device_type'] == 'computer' ) {
							$display_size = 'xlarge';
						} else {
							$display_size = 'large';
						}
						$source = wp_get_attachment_image_src($image->ID, $display_size);
					$carousel_images .= '{"src":"' . $source[0] . '", "mtype":"'.$image->post_mime_type.'", "ptype":"'.$image->post_type.'", "caption":"'.$image->post_excerpt.'"},'; 
					$GLOBALS['carousel_count'] ++;
				}
				preg_match('/<a(?:.*)>(?:.*)<img(?:.*)class="([^"]*)"(?:.*)src="([^"]*)"(?:.*)>(?:.*)<\/a>/', $instance,  $pulled_vars);
				if ( $pulled_vars[1] ) {
					if ( $GLOBALS['device_type'] == 'mobile' ) {
							$display_size = 'large';
					} else {
						if ( strpos($pulled_vars[1], 'small-project-image' ) !== false) {
							$display_size = 'small';
						} else if (  strpos($pulled_vars[1], 'medium-project-image' ) !== false) {
							$display_size = 'medium';
						} else if (  strpos($pulled_vars[1], 'large-project-image' ) !== false) {
							$display_size = 'large';
						}
					}
					$source = wp_get_attachment_image_src($image->ID, $display_size);
					$thumb = wp_get_attachment_image_src($image->ID, 'xsmall');
					$replacement = '<div id="'. $instance_id[1] .'"';
					$replacement .= ($GLOBALS['carousel_count'] > $last_carousel_count)? ' class="' . $pulled_vars[1] . ' masonry-block hot" onclick="callCarousel(' . $GLOBALS['carousel_count'] .');" ><svg class="fullscreen" x="0px" y="0px" viewBox="0 0 21.142 21.143" enable-background="new 0 0 21.142 21.143" xml:space="preserve"><polygon points="21.142,0 21.141,0 21.141,0 17.956,0 17.956,0 0,0.001 0,3.186 17.956,3.185 17.958,21.143 21.142,21.143 21.141,3.184 21.142,3.184 "/></svg><img id="image-'. $instance_id[1] .'" class="scroll_load" src="' . $thumb[0] . '" /></div>': ' class="' . $pulled_vars[1] . ' masonry-block" ><img id="image-'. $instance_id[1] .'" class="scroll_load" src="' . $thumb[0] . '" /></div>';
					$images_script .= '"image-'. $instance_id[1] .'":"' . $source[0] . '", ';
					
				} else {
					$replacement = '';
				}
			} 
			$new_gallery_contents .= $replacement;
		}	
		$new_gallery_contents .= rtrim($images_script, ", ") . '}; for (var attrname in display_images_2) { display_images[attrname] = display_images_2[attrname]; }</script>';
		if (isset($carousel_images)) {
			$new_gallery_contents .= ' ' . "<script> carousel_images.push(". rtrim($carousel_images,',') ."); </script>";
		}
		return $new_gallery_contents;
	} 	
	
	
//  ------------------------------------------------------- 
//  REWRITE GALLERY CONTENT AS ARRAY
//  ------------------------------------------------------- 

	function DEVONA_rewriteArray($gallery_contents) {
		$instances = preg_split('/\n/', $gallery_contents);	
//		$images_script = '<script type=\'text/javascript\'> var display_images_2 = {';
			
		//$carousel_count = 0;
		foreach($instances as $instance) {
			$instance_id = false; 
			$image = false; 
			$caption_text = false;
			$pulled_vars = false;
			
			preg_match('/class="(?:.*)wp-image-([\d]*)(?:.*)"/', $instance,  $instance_id);
			if ( !empty($instance_id) ) { $image = get_post( $instance_id[1] ); }
				
			if (strpos($instance,'blockquote') !== false) {
				preg_match('/<\/a> (.*)\[\/caption\]/', $instance,  $caption_text);
				preg_match('/<blockquote>\n*(.*?)<\/blockquote>/', $instance,  $pulled_vars);
				if ( $pulled_vars[1] ) {
				$replacement = "'";
					if ( $caption_text != false ) { 
						$replacement .= '<blockquote class="small-project-quote masonry-block" href="'.$image->guid.'" title="'.$caption_text[1].'"><svg class="big-slash" x="0px" y="0px" viewBox="0 0 119.959 234.292" enable-background="new 0 0 119.959 234.292" xml:space="preserve"><polygon points="112.411,0 0,234.292 7.547,234.292 119.959,0 "/></svg><span class="caption-container">'.str_replace("'","&#39;",$caption_text[1]).'</span></blockquote>';
					} elseif ( $image != false ) {
						$source = wp_get_attachment_image_src($image->ID, 'large');
						$replacement .= '<blockquote class="small-project-quote masonry-block"><svg class="big-slash" x="0px" y="0px" viewBox="0 0 119.959 234.292" enable-background="new 0 0 119.959 234.292" xml:space="preserve"><polygon points="112.411,0 0,234.292 7.547,234.292 119.959,0 "/></svg><img src="'.$source[0].'" /></blockquote>';
					} else { 
						$replacement .= '<blockquote class="small-project-quote masonry-block"><svg class="big-slash" x="0px" y="0px" viewBox="0 0 119.959 234.292" enable-background="new 0 0 119.959 234.292" xml:space="preserve"><polygon points="112.411,0 0,234.292 7.547,234.292 119.959,0 "/></svg>' . str_replace("'","&#39;",$pulled_vars[1]) . '</blockquote>';
					} 
				$replacement .= "',";
					
				} else {
					$replacement = '';
				}
				
			} else {
				$last_carousel_count = $GLOBALS['carousel_count'];
				if ( get_post_meta( $image->ID, '_carousel_image_field', true ) ) {
						if ( $GLOBALS['device_type'] == 'computer' ) {
							$display_size = 'xlarge';
						} else {
							$display_size = 'large';
						}
						$source = wp_get_attachment_image_src($image->ID, $display_size);
					$carousel_images .= '{"src":"' . $source[0] . '", "mtype":"'.$image->post_mime_type.'", "ptype":"'.$image->post_type.'", "caption":"'.$image->post_excerpt.'"},'; 
					$GLOBALS['carousel_count'] ++;
				}
				preg_match('/<a(?:.*)>(?:.*)<img(?:.*)class="([^"]*)"(?:.*)src="([^"]*)"(?:.*)>(?:.*)<\/a>/', $instance,  $pulled_vars);
				if ( $pulled_vars[1] ) {
					if ( $GLOBALS['device_type'] == 'mobile' ) {
							$display_size = 'large';
					} else {
						if ( strpos($pulled_vars[1], 'small-project-image' ) !== false) {
							$display_size = 'small';
						} else if (  strpos($pulled_vars[1], 'medium-project-image' ) !== false) {
							$display_size = 'medium';
						} else if (  strpos($pulled_vars[1], 'large-project-image' ) !== false) {
							$display_size = 'large';
						}
					}
//					$source = wp_get_attachment_image_src($image->ID, $display_size);
//					$thumb = wp_get_attachment_image_src($image->ID, 'xsmall');
					$thumb = wp_get_attachment_image_src($image->ID, $display_size);
					$replacement = '\'<div id="'. $instance_id[1] .'"';
					$replacement .= ($GLOBALS['carousel_count'] > $last_carousel_count)? ' class="' . $pulled_vars[1] . ' masonry-block hot" onclick="callCarousel(' . $GLOBALS['carousel_count'] .');" ><svg class="fullscreen" x="0px" y="0px" viewBox="0 0 21.142 21.143" enable-background="new 0 0 21.142 21.143" xml:space="preserve"><polygon points="21.142,0 21.141,0 21.141,0 17.956,0 17.956,0 0,0.001 0,3.186 17.956,3.185 17.958,21.143 21.142,21.143 21.141,3.184 21.142,3.184 "/></svg><img id="image-'. $instance_id[1] .'" class="scroll_load" src="' . $thumb[0] . '" /></div>\',': ' class="' . $pulled_vars[1] . ' masonry-block" ><img id="image-'. $instance_id[1] .'" class="scroll_load" src="' . $thumb[0] . '" /></div>\',';
//					$images_script .= '"image-'. $instance_id[1] .'":"' . $source[0] . '", ';
					
				} else {
					$replacement = '';
				}
			} 
			$new_gallery_contents .= $replacement;
		}	
		$new_gallery_contents = '<script> var elements = [' . rtrim($new_gallery_contents,',') . '];</script>';
//		$new_gallery_contents .= rtrim($images_script, ", ") . '}; for (var attrname in display_images_2) { display_images[attrname] = display_images_2[attrname]; }</script>';
		if (isset($carousel_images)) {
			$new_gallery_contents .= ' ' . "<script> carousel_images.push(". rtrim($carousel_images,',') ."); </script>";
		}
		return $new_gallery_contents;
	} 	
	
	
	
//  ------------------------------------------------------- 
//  REMOVE IMAGE SIZING FROM CONTENT
//  ------------------------------------------------------- 

	function DEVONA_remove_image_sizing( $content ) { 
		$search = array('/<img([^>]*)width="([^"]*)"(?:.*)height="([^"]*)"([^>]*)>/');
		$replace = array('<img \1 \4 >');
		$content = preg_replace($search, $replace, $content);
		return $content;
	}
	add_filter( 'the_content', 'DEVONA_remove_image_sizing', 1 ); 
	


//  ------------------------------------------------------- 
//  TRANSLATE MOTS FRANÇAIS
//  ------------------------------------------------------- 

	function DEVONA_translate($content) {
		$translations = get_posts( array( 'showposts' => -1, 'post_type' => 'translation' ) );
		foreach ($translations as $translation) {
			$content = str_replace( $translation->post_title, '<u class="translate" title="' . $translation->post_content . '" onclick="javascript:translateFrench(this);" >' . $translation->post_title . '</u>', $content ); 
		}
		return $content;
	}
	
	
	
//  ------------------------------------------------------- 
//  ADD DATE TO POSTS
//  ------------------------------------------------------- 

	function DEVONA_addDateToPost($post_contents) {
		$with_date = get_the_date('m / d / y').'&nbsp;&nbsp;'. $post_contents;
		$with_date = str_replace(']]>', ']]&gt;', $with_date);
		$with_date = str_replace("\r\r", "</p><p>",$with_date);
		$with_date = str_replace("\r", "</p><p>",$with_date);
		$with_date = '<p>'.$with_date.'</p>';
		return $with_date;
	} 
	
	
?>