<?php
/*
 * Plugin Name: Kebo Twitter Feed
 * Plugin URI: http://wordpress.org/plugins/kebo-twitter-feed/
 * Description: Connect your site to your Twitter account and display your Twitter Feed on your website effortlessly with a custom widget. 
 * Version: 0.5.4
 * Author: Kebo
 * Author URI: http://kebopowered.com
 */

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

if (!defined('KEBO_TWITTER_PLUGIN_VERSION'))
    define('KEBO_TWITTER_PLUGIN_VERSION', '0.5.4');
if (!defined('KEBO_TWITTER_PLUGIN_URL'))
    define('KEBO_TWITTER_PLUGIN_URL', plugin_dir_url(__FILE__));
if (!defined('KEBO_TWITTER_PLUGIN_PATH'))
    define('KEBO_TWITTER_PLUGIN_PATH', plugin_dir_path(__FILE__));

function kebo_twitter_plugin_setup() {

    /**
     * Include Plugin Options.
     */
    require_once( KEBO_TWITTER_PLUGIN_PATH . 'inc/options.php' );

    /**
     * Include Menu Page.
     */
    require_once( KEBO_TWITTER_PLUGIN_PATH . 'inc/menu.php' );

    /**
     * Include Custom Widget.
     */
    require_once( KEBO_TWITTER_PLUGIN_PATH . 'inc/widget.php' );

    /**
     * Include Request for the Twitter Feed.
     */
    require_once( KEBO_TWITTER_PLUGIN_PATH . 'inc/get_tweets.php' );
    
    /**
     * Include Shortcode.
     */
    require_once( KEBO_TWITTER_PLUGIN_PATH . 'inc/shortcode.php' );

    /**
     * Load Text Domain for Translations.
     */
    load_plugin_textdomain('kebo_twitter', false, KEBO_TWITTER_PLUGIN_PATH . 'languages/');
    
}
add_action('plugins_loaded', 'kebo_twitter_plugin_setup', 15);

if (!function_exists('kebo_twitter_plugin_scripts')):

    /**
     * Enqueue plugin scripts and styles.
     */
    function kebo_twitter_scripts() {

        // Queues the main CSS file.
        wp_register_style('kebo-twitter-plugin', KEBO_TWITTER_PLUGIN_URL . 'css/plugin.css', array(), KEBO_TWITTER_PLUGIN_VERSION, 'all');

        // Enqueue Stylesheet for Admin Pages
        if (is_admin())
            wp_enqueue_style('kebo-twitter-plugin');
    }
    add_action('wp_enqueue_scripts', 'kebo_twitter_scripts');
    add_action('admin_enqueue_scripts', 'kebo_twitter_scripts');

endif;

/**
 * Add a link to the plugin screen, to allow users to jump straight to the settings page.
 */
function kebo_twitter_plugin_meta($links, $file) {

    $plugin = plugin_basename(__FILE__);

    // Add our custom link to the defaults.
    if ($file == $plugin) {
        return array_merge(
                $links, array('<a href="' . admin_url('options-general.php?page=kebo-twitter') . '">' . __('Settings') . '</a>')
        );
    }

    return $links;
}
add_filter('plugin_row_meta', 'kebo_twitter_plugin_meta', 10, 2);

/**
 * Adds a WordPress pointer to Kebo Twitter settings page.
 */
function kebo_twitter_pointer_script_style($hook_suffix) {

    // Assume pointer shouldn't be shown
    $enqueue_pointer_script_style = false;

    // Get array list of dismissed pointers for current user and convert it to array
    $dismissed_pointers = explode(',', get_user_meta(get_current_user_id(), 'dismissed_wp_pointers', true));

    // Check if our pointer is not among dismissed ones
    if ( !in_array('kebo_twitter_settings_pointer', $dismissed_pointers) ) {
        $enqueue_pointer_script_style = true;

        // Add footer scripts using callback function
        add_action('admin_print_footer_scripts', 'kebo_twitter_pointer_print_scripts');
    }

    // Enqueue pointer CSS and JS files, if needed
    if ($enqueue_pointer_script_style) {
        wp_enqueue_style('wp-pointer');
        wp_enqueue_script('wp-pointer');
    }
}
add_action('admin_enqueue_scripts', 'kebo_twitter_pointer_script_style');

function kebo_twitter_pointer_print_scripts() {

    $pointer_content = '<h3>' . __('Connect to your Twitter Account', 'kebo_twitter') . '</h3>';
    $pointer_content .= '<p>' . __('In just a few clicks we can connect your website to your Twitter account and display your Latest Tweets.', 'kebo_twitter') . ' <a href="' . admin_url('options-general.php?page=kebo-twitter') . '">' . __('Get Started Now', 'kebo_twitter') . '</a></p>';
    ?>

    <script type="text/javascript">
        //<![CDATA[
        jQuery(document).ready(function($) {
            $('#menu-settings').pointer({
                content: '<?php echo $pointer_content; ?>',
                position: {
                    edge: 'left', // arrow direction
                    align: 'center' // vertical alignment
                },
                pointerWidth: 350,
                close: function() {
                    $.post(ajaxurl, {
                        pointer: 'kebo_twitter_settings_pointer', // pointer ID
                        action: 'dismiss-wp-pointer'
                    });
                }
            }).pointer('open');
        });
        //]]>
    </script>

    <?php
}

/*
 * Outputs Slider Javascript
 * Shows a single tweet at a time, fading between them.
 */
function kebo_twitter_slider_script() {
    
    ?>
    <script type="text/javascript">
        //<![CDATA[
        jQuery(document).ready(function() {
            
            var timer = jQuery( "#kebo-tweet-slider" ).data( "timer" );
            var transition = jQuery( "#kebo-tweet-slider" ).data( "transition" );
            var tcount = 1;
            var limit = jQuery("#kebo-tweet-slider .ktweet").size();
            var theight = jQuery('#kebo-tweet-slider .ktweet').eq(0).outerHeight();
            var initTweets = setInterval( fadeTweets, timer );
            
            jQuery('#kebo-tweet-slider .ktweet').eq(0).fadeToggle('1000').delay( timer - transition ).fadeToggle('1000');
            jQuery('#kebo-tweet-slider').height(theight);

            function fadeTweets() {

                if (tcount == limit) {
                    tcount = 0;
                }
                theight = jQuery('#kebo-tweet-slider .ktweet').eq(tcount).outerHeight();
                jQuery('#kebo-tweet-slider').height(theight);
                jQuery('#kebo-tweet-slider .ktweet').eq(tcount).fadeToggle('1000').delay( timer - transition ).fadeToggle('1000');

                ++tcount;

            }

        });
        //]]>
    </script>
    <?php

}

/*
 * Detects touch devices - saved for potential use
 */
function kebo_twitter_touch_script() {
    
    ?>
    <script type="text/javascript">
        //<![CDATA[
        jQuery(document).ready(function() {
            
            var is_touch_device = 'ontouchstart' in document.documentElement;
            
            if (is_touch_device) {
                jQuery(".kebo-tweets").each(function(index, element) {
                    jQuery(this).addClass( "touch" );
                });
            } else {
                jQuery(".kebo-tweets").each(function(index, element) {
                    jQuery(this).addClass( "notouch" );
                });
            }
            
        });
        //]]>
    </script>
    <?php

}

/**
 * ToDo List
 * 
 * 1. Re-write custom Slider/Fader javascript. Extending features e.g. pause on hover, speed, etc.
 * 
 */