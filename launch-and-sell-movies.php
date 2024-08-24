<?php
/**
 * Plugin Name: Launch and Sell Movies
 * Plugin URI:  https://github.com/ihassanraza/launchandsellmovies
 * Description: A custom WordPress plugin that creates a "Movies" custom post type, accessible via a REST API, and a frontend React app that lets users save a list of movies to a list.
 * Version: 1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author: Hassan Raza
 * Author URI: https://www.linkedin.com/in/ihaxxanraza/
 * License:     GPL v2 or later
 * License URI:	https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: lsm
*/

/**
 * Exit if accessed directly.
 *
 * This is a security measure to prevent direct access to the plugin file.
 *
 * @since 1.0.0
*/
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define the plugin folder path constants.
 *
 * These constants are used to reference the plugin directory and URL.
 *
 * @since 1.0.0
*/
if ( ! defined( 'LSM_PLUGIN_DIR' ) || ! defined( 'LSM_PLUGIN_URL' ) ) {
	define( 'LSM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
	define( 'LSM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

/**
 * Require plugin files.
 *
 * These files contain the implementation of the plugin's features.
 *
 * @since 1.0.0
*/
require_once wp_normalize_path( LSM_PLUGIN_DIR . '/inc/movies-post-type.php' );
require_once wp_normalize_path( LSM_PLUGIN_DIR . '/inc/sample-movies-data.php' );
require_once wp_normalize_path( LSM_PLUGIN_DIR . '/inc/movies-api.php' );
require_once wp_normalize_path( LSM_PLUGIN_DIR . '/inc/app.php' );

/**
 * Add sample movies data.
 * 
 * This function adds sample data to the movies post type.
 * 
 * @since 1.0.0
*/
function lsm_plugin_activate() {
    lsm_add_sample_movies_data();
}
register_activation_hook( __FILE__, 'lsm_plugin_activate' );

/**
 * Initialize plugin components.
 *
 * This function initializes the plugin's components, including the movies post type, API, and frontend app.
 *
 * @since 1.0.0
*/
function lsm_init_loader() {
    MoviesPostType::get_instance();
    MoviesAPI::get_instance();
    MoviesApp::get_instance();
}
add_action( 'init', 'lsm_init_loader' );