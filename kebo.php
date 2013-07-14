<?php
/*
 * Plugin Name: Kebo - Twitter Feed
 * Plugin URI: http://kebopowered.com/plugins/twitter-feed/
 * Description: Allows you to display your Twitter feed on your website, by connection your Twitter account to the Kebo Twitter App using oAuth2.
 * Version: 0.15
 * Author: Kebo
 * Author URI: http://kebopowered.com
 */

 // Exit if accessed directly
if ( !defined( 'ABSPATH' ) )
    exit;

if ( !defined('KEBO_TWITTER_PLUGIN_VERSION' ) )
    define( 'KEBO_TWITTER_PLUGIN_VERSION', '0.78' );
if ( !defined( 'KEBO_TWITTER_PLUGIN_URL' ) )
    define( 'KEBO_TWITTER_PLUGIN_URL', plugin_dir_url(__FILE__) );
if ( !defined( 'KEBO_TWITTER_PLUGIN_PATH' ))
    define( 'KEBO_TWITTER_PLUGIN_PATH', plugin_dir_path(__FILE__) );

$api_url = 'http://kebopowered.com/plugin-server/';
$plugin_slug = basename(dirname(__FILE__));

/**
 * Include Update Checking.
 */
require_once( KEBO_TWIITER_PLUGIN_PATH . '/inc/updater/plugin-update-checker.php');

$MyUpdateChecker = PucFactory::buildUpdateChecker(
'http://kebopowered.com/wp-update/?action=get_metadata&slug=kebo-twitter-feed', //Metadata URL.
__FILE__, //Full path to the main plugin file.
'kebo-twitter-feed' //Plugin slug.
);

function kebo_twitter_plugin_setup() {

/**
 * Include Plugin Options.
 */
require_once( KEBO_PLUGIN_PATH . 'inc/options.php' );

}
add_action( 'plugins_loaded', 'kebo_twitter_plugin_setup', 15 );

if (!function_exists('kebo_twitter_plugin_scripts')):

    /**
     * Enqueue plugin scripts and styles.
     */
    function kebo_plugin_scripts() {
            
        // Queues the main CSS file.
        wp_enqueue_style( 'kebo-twitter-plugin', KEBO_TWITTER_PLUGIN_URL . 'css/plugin.css', array(), KEBO_TWITTER_PLUGIN_VERSION, 'all' );
        
        
    }
    add_action('wp_enqueue_scripts', 'kebo_twitter_plugin_scripts');

endif;

/**
* ToDo List
*/

// @todo Add Uninstall Function to remove DB data, if any is added.
