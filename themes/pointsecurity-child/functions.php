<?php 

// disable updates 
function remove_core_updates(){
	global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
//add_filter('pre_site_transient_update_core','remove_core_updates');
//add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');


add_action( 'admin_init', 'my_remove_menu_pages' );
function my_remove_menu_pages() {
	
	$user_id = get_current_user_id();
	if ($user_id == 5) {
    //remove_menu_page('plugins.php'); // Plugins
    //remove_menu_page('themes.php'); // Appearance
    //remove_menu_page('users.php'); // Users
    //remove_menu_page('options-general.php'); // Settings
    remove_submenu_page( 'index.php', 'update-core.php' );
    remove_submenu_page( 'index.php', 'simple_history_page' );
    remove_submenu_page( 'options-general.php', 'simple_history_settings_menu_slug' );
	}
	if ($user_id == 7) {
    //remove_menu_page('plugins.php'); // Plugins
    //remove_menu_page('themes.php'); // Appearance
    //remove_menu_page('users.php'); // Users
    //remove_menu_page('options-general.php'); // Settings
    remove_submenu_page( 'index.php', 'update-core.php' );
    remove_submenu_page( 'index.php', 'simple_history_page' );
    remove_submenu_page( 'options-general.php', 'simple_history_settings_menu_slug' );
	}
}



function salient_child_enqueue_styles() {
	
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array('font-awesome'));
    wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/custom.css', array());

    if ( is_rtl() ) 
   		wp_enqueue_style(  'salient-rtl',  get_template_directory_uri(). '/rtl.css', array(), '1', 'screen' );
}
add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles');



#-----------------------------------------------------------------#
# Custom menu
#-----------------------------------------------------------------#
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'top_nav' => 'Top Navigation Menu',
		  'footer_nav' => 'Footer Menu',
		  'secondary_nav' => 'Secondary Navigation Menu <br /> <small>Will only display if applicable header layout is selected <a href="'. admin_url('?page=redux_options&tab=4') .'">here</a>.</small>'
		)
	);
}



#-----------------------------------------------------------------#
# Gravity Forms Tab Index
#-----------------------------------------------------------------#
add_filter( 'gform_tabindex', 'gform_tabindexer', 10, 2 );
function gform_tabindexer( $tab_index, $form = false ) {
    $starting_index = 5000; // if you need a higher tabindex, update this number
    if( $form )
        add_filter( 'gform_tabindex_' . $form['id'], 'gform_tabindexer' );
    return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
}




#-----------------------------------------------------------------#
# Widget areas
#-----------------------------------------------------------------#
if(function_exists('register_sidebar')) {

	register_sidebar(array(
		'name' => 'Top Area', 
		'id' => 'top-area', 
		'before_widget' => 
		'<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>', 
		'before_title'  => '<h4>', 
		'after_title'   => '</h4>'
	));
	
	register_sidebar(array(
		'name' => 'Footer Top', 
		'id' => 'footer-top', 
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>', 
		'before_title'  => '<h4>', 
		'after_title'   => '</h4>'
	));	

}



?>