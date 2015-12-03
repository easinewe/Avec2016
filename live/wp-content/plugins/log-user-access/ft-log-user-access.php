<?php
/*
Plugin Name: Log User Access
Plugin URI: http://fullthrottledevelopment.com/log-user-access/
Description: This plugin logs the username and the date/time of every WordPress login. Records are displayed in the 'Users' menu item.
Version: 0.1
Author: FullThrottle Development
Author URI: http://fullthrottledevelopment.com/
*/

//Primary Developer : Glenn Ansley (http://glennansley.com)

/*Copyright 2009 Glenn Ansley

/* Release History
 0.1 - Initial Release
*/

define( 'FT_LUA_Version' , '0.1' );

// Define plugin path
if ( !defined('WP_CONTENT_DIR') ) {
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content');
}
define('FT_LUA_PATH' , WP_CONTENT_DIR.'/plugins/'.plugin_basename(dirname(__FILE__)) );

// Define plugin URL
if ( !defined('WP_CONTENT_URL') ) {
	define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content' );
}
define( 'FT_LUA_URL' , WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)) );


// Setup form security
if ( !function_exists('wp_nonce_field') ) {
    function ft_lua_nonce_field($action = -1) { return; }
    $ft_lua_nonce = -1;
} else {
	if( !function_exists( 'ft_lua_nonce_field' ) ) {
	function ft_lua_nonce_field($action = -1,$name = 'ft_lua-update-checkers') { return wp_nonce_field($action,$name); }
	define('FT_LUA_NONCE' , 'ft_lua-update-checkers');
	}
}

if ( is_admin() ) :
	//This function sets up my tables
	if ( !function_exists('ft_lua_plugin_activation') ){
		function ft_lua_plugin_activation() {
			global $wpdb;
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			
			$table_name = 'ft_lua_userlogins';
			$table_name = $wpdb->prefix.$table_name;
		
			$sql = "CREATE TABLE " . $table_name . " (
			  login_ID bigint(20) NOT NULL AUTO_INCREMENT,
			  login_username tinytext NOT NULL,
			  login_date timestamp NOT NULL,
			  login_status bigint(20) NOT NULL DEFAULT 1,
			  UNIQUE KEY login_ID (login_ID)
			);";

			dbDelta($sql);
		}
	}
	
	register_activation_hook( __FILE__, 'ft_lua_plugin_activation' );
	
	
	// This function adds my admin page link to the menu
	if ( !function_exists( 'ft_lua_page_link' ) ){
		function ft_lua_page_link(){
			$userlogins_page = add_submenu_page( 'users.php', 'User Access Log' , 'User Access Log' , 2 , __FILE__ , 'ft_lua_page');
			add_action('admin_head-'.$userlogins_page , 'ft_lua_admin_head');	
		}
	}
	
	add_action( 'admin_menu' , 'ft_lua_page_link' );
	
	// This function prints my admin page
	if ( !function_exists('ft_lua_page') ){
		function ft_lua_page(){
			?>
			<div class="wrap">
				<h2>User Access Log</h2>
				<?php if ( $logins = ft_lua_get_userlogins() ){
					?>
					<table class='widefat'>
						<tr><td><form action='' method='post'><input type='submit' class='button-secondary delete' name='ft_lua_delete_logins' value='Delete All Logins' /><?php ft_lua_nonce_field('$ft_lua_nonce', FT_LUA_NONCE);?></form></td><td></td></tr>
					</table>
					<table class='widefat'>
						<tr><td><strong>Username</strong></td><td><strong>Date / Time</strong></td></tr>
					<?php
					foreach ( $logins as $key => $value ){
						?><tr><td><?php echo $value->login_username;?></td><td><?php echo mysql2date( 'r' , $value->login_date );?></td></tr><?php
					}
					?></table><?php
				}else{
					?><p>There are currently no user logins recorded.</p><?php
				}
			?>
			</div>
			<?php
		}
	}
	
	// This function is for adding non-scripted contenent to the head of the page
	if ( !function_exists('ft_lua_admin_head') ){
		function ft_lua_admin_head(){
			
			if ( isset($_POST['ft_lua_delete_logins'] ) ){
				check_admin_referer( '$ft_lua_nonce', FT_LUA_NONCE );
				ft_lua_hide_userlogins();
			}
		}
	}
	
	// This function grabs all the logins from the DB
	if ( !function_exists('ft_lua_get_userlogins' ) ){
		function ft_lua_get_userlogins(){
			global $wpdb;
			$sql  = "SELECT * FROM `".$wpdb->prefix."ft_lua_userlogins` ";
			$sql .= "WHERE login_status = 1 ";
			$sql .= "ORDER BY login_date DESC";
			
			if ( $results = $wpdb->get_results( $sql , OBJECT ) ){
				return $results;
			}
			
			return false;
		}
	}
	
	// This function "deletes" (hides) all userlogins
	if ( !function_exists('ft_lua_hide_userlogins' ) ){
		function ft_lua_hide_userlogins(){
			global $wpdb;
			$sql  = "UPDATE `".$wpdb->prefix."ft_lua_userlogins` ";
			$sql .= "SET login_status = 2 ";
			$sql .= "WHERE login_status = 1";
			
			if ( $results = $wpdb->query( $sql ) ){
				return true;
			}
			
			return false;
		}
	}

endif;


// This function adds the login to the DB
if ( !function_exists( 'ft_lua_log_access' ) ){
	function ft_lua_log_access( $username ){
		global $wpdb;
		$sql  = "INSERT INTO `".$wpdb->prefix."ft_lua_userlogins` ";
		$sql .= "(login_username) ";
		$sql .= "VALUES ( '".$wpdb->prepare($username)."' )";
	
		$wpdb->query($sql);
	}
}



add_action( 'wp_login' , 'ft_lua_log_access' );
?>