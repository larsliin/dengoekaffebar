<?php
/* 
Plugin Name: Frontpage Section
Description: Insert sections as posts on frontpage
Version: 1.0
Author: Lars Liin
*/
function section_remove_meta_boxes() {	
	remove_meta_box('postexcerpt', 'section', 'normal');
	remove_meta_box('trackbacksdiv', 'section', 'normal');
	remove_meta_box('postcustom', 'section', 'normal');
	remove_meta_box('commentstatusdiv', 'section', 'normal');
	remove_meta_box('commentsdiv', 'section', 'normal');
	remove_meta_box('revisionsdiv', 'section', 'normal');
	remove_meta_box('authordiv', 'section', 'normal');
	remove_meta_box('sqpt-meta-tags', 'section', 'normal');
	remove_meta_box('pageparentdiv', 'section', 'normal');
	remove_meta_box('slugdiv', 'section', 'normal');
	
}
add_action( 'admin_menu', 'section_remove_meta_boxes' );

// add admin stylesheet
function section_admin_styles() {
    wp_register_style( 'section_admin_stylesheet', plugins_url( 'style.css', __FILE__ ) );
    wp_enqueue_style( 'section_admin_stylesheet' );
}
add_action( 'admin_enqueue_scripts', 'section_admin_styles' );

// admin js 
function section_admin_js() {
    wp_register_script( 'section_admin_js', plugins_url( 'script.js', __FILE__ ) );
    wp_enqueue_script( 'section_admin_js' );
}
add_action( 'admin_enqueue_scripts', 'section_admin_js' );

function register_cpt_section() { 
    $labels = array(
        'name' => _x( 'Sections', 'section' ),
        'singular_name' => _x( 'Section', 'section' ),
        'add_new' => _x( 'Add New', 'section' ),
        'add_new_item' => _x( 'Add New Section', 'section' ),
        'edit_item' => _x( 'Edit Section', 'section' ),
        'new_item' => _x( 'New Section', 'section' ),
        'view_item' => _x( 'View Section', 'section' ),
        'search_items' => _x( 'Search Sections', 'section' ),
        'not_found' => _x( 'No Sections found', 'section' ),
        'not_found_in_trash' => _x( 'No Sections found in Trash', 'section' ),
        'parent_item_colon' => _x( 'Parent Section:', 'section' ),
        'menu_name' => _x( 'Sections', 'section' ),
        'all_items' => _x( 'All Sections', 'section' )
    );
 
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Sections filterable by genre',
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
        'taxonomies' => array( 'genres' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-format-aside',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
 
    register_post_type( 'section', $args );
}
 
add_action( 'init', 'register_cpt_section' );

function create_section_pages()
  {
   //post status and options
    $post = array(
          'comment_status' => 'open',
          'ping_status' =>  'closed' ,
          'post_date' => date('Y-m-d H:i:s'),
          'post_name' => 'section',
          'post_status' => 'publish' ,
          'post_title' => 'Video Recipes',
          'post_type' => 'page',
    );
    //insert page and save the id
    $newvalue = wp_insert_post( $post, false );
    //save the id in the database
    update_option( 'mrpage', $newvalue );
  }
  
// // Activates function if plugin is activated
register_activation_hook( __FILE__, 'create_section_pages');

//////////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */

function section_add_meta_box() {
	$screens = array( 'section' );
	foreach ( $screens as $screen ) {
		add_meta_box(
			'section_sectionid',
			__( 'ShiftNav scroll to id', 'section_textdomain' ),
			'section_meta_box_id_callback',
			$screen,
            'side'
		);
        
        add_meta_box(
			'section_sectiontitle',
			__( 'Hide or show title', 'section_textdomain' ),
			'section_meta_box_showtitle_callback',
			$screen,
            'side'
		);
        
		add_meta_box(
			'section_sectionmargin',
			__( 'Section margin', 'section_textdomain' ),
			'section_meta_box_nomargin_callback',
			$screen,
            'side'
		);
	}
}
add_action( 'add_meta_boxes', 'section_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */

//////////////////////////////////////////////////////////////////////////
function section_meta_box_showtitle_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'section_meta_box', 'section_meta_box_class_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	
    $section_showtitle = get_post_meta( $post->ID, 'section_showtitle', true ) ? get_post_meta( $post->ID, 'section_showtitle', true ) : '';    
	$isChecked = $section_showtitle ? 'checked="checked"' : '';
    echo '<div class="post-section">';
	echo '<input class="" value="' . $section_showtitle . '" ' . $isChecked . ' type="checkbox" name="section_showtitle" id="section_showtitle" /><label for="section_showtitle">Show title</label>';
    echo '</div>';
}
function section_save_meta_box_showtitle_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['section_meta_box_class_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['section_meta_box_class_nonce'], 'section_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	//if ( ! isset( $_POST['section_video'] ) ) {
		//return;
	//}

	// Sanitize user input.	
	$id = sanitize_text_field( $_POST['section_showtitle'] );
	

	// Update the meta field in the database.
	//update_post_meta( $post_id, 'section_showtitle', $id );

	if( isset($_POST['section_showtitle']) ){
		update_post_meta($post_id, "section_showtitle", true );
	}else{
		update_post_meta($post_id, "section_showtitle", false );
	}
}
add_action( 'save_post', 'section_save_meta_box_showtitle_data' );

// SECTION MARGIN
//////////////////////////////////////////////////////////////////////////
function section_meta_box_nomargin_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'section_meta_box', 'section_meta_box_class_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	
    $section_nomargin = get_post_meta( $post->ID, 'section_nomargin', true ) ? get_post_meta( $post->ID, 'section_nomargin', true ) : '';    
	$isChecked = $section_nomargin ? 'checked="checked"' : '';
    echo '<div class="post-section">';
	echo '<input class="" value="' . $section_nomargin . '" ' . $isChecked . ' type="checkbox" name="section_nomargin" id="section_nomargin" /><label for="section_nomargin">No margin</label>';
    echo '</div>';
}
function section_save_meta_box_nomargin_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['section_meta_box_class_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['section_meta_box_class_nonce'], 'section_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	//if ( ! isset( $_POST['section_video'] ) ) {
		//return;
	//}

	// Sanitize user input.	
	$id = sanitize_text_field( $_POST['section_nomargin'] );
	

	// Update the meta field in the database.
	//update_post_meta( $post_id, 'section_nomargin', $id );

	if( isset($_POST['section_nomargin']) ){
		update_post_meta($post_id, "section_nomargin", true );
	}else{
		update_post_meta($post_id, "section_nomargin", false );
	}
}
add_action( 'save_post', 'section_save_meta_box_nomargin_data' );


//////////////////////////////////////////////////////////////////////////
function section_meta_box_id_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'section_meta_box', 'section_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	
    $section_id = get_post_meta( $post->ID, 'section_id', true ) ? get_post_meta( $post->ID, 'section_id', true ) : 'sid_' . time();    
    echo '<div class="post-section">';
	echo '<input value="' . $section_id . '" type="text" name="section_id" id="section_id" readonly="readonly" />';
    echo '</div>';
}
function section_save_meta_box_id_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['section_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['section_meta_box_nonce'], 'section_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	//if ( ! isset( $_POST['section_video'] ) ) {
		//return;
	//}

	// Sanitize user input.	
	$id = sanitize_text_field( $_POST['section_id'] );
	

	// Update the meta field in the database.
	update_post_meta( $post_id, 'section_id', $id );
}
add_action( 'save_post', 'section_save_meta_box_id_data' );
