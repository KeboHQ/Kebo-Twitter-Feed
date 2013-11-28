<?php
/*
 * Plugin Name: Kebo - Twitter Feed
 * Plugin URI: http://wordpress.org/plugins/kebo-twitter-feed/
 * Description: Connect your site to your Twitter account and display your Twitter Feed on your website effortlessly with a custom widget. 
 * Version: 1.4.3
 * Author: Kebo
 * Author URI: http://kebopowered.com
 * Text Domain: kebo_twitter
 * Domain Path: /languages
 */

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

define('KEBO_TWITTER_PLUGIN_VERSION', '1.4.3');
define('KEBO_TWITTER_PLUGIN_URL', plugin_dir_url(__FILE__));
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
    load_plugin_textdomain( 'kebo_twitter', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    
}
add_action('plugins_loaded', 'kebo_twitter_plugin_setup', 15);

if ( ! function_exists('kebo_twitter_plugin_scripts') ):

    /**
     * Enqueue plugin scripts and styles.
     */
    function kebo_twitter_scripts() {

        // Queues the main CSS file.
        wp_register_style( 'kebo-twitter-plugin', KEBO_TWITTER_PLUGIN_URL . 'css/plugin.css', array(), KEBO_TWITTER_PLUGIN_VERSION, 'all' );
        
        wp_register_script( 'responsive-slides', KEBO_TWITTER_PLUGIN_URL . 'js/responsiveslides.min.js', array( 'jquery' ), KEBO_TWITTER_PLUGIN_VERSION, false );
        
        // Enqueue Stylesheet for Admin Pages
        if ( is_admin() ) {
            wp_enqueue_style('kebo-twitter-plugin');
        }
        
        // WP 3.2 compatibility (cannot enqueue after the header).
        global $wp_version;
        if ( version_compare( $wp_version, '3.3', '<' ) ) {
            wp_enqueue_style('kebo-twitter-plugin');
        }
        
    }
    add_action('wp_enqueue_scripts', 'kebo_twitter_scripts');
    add_action('admin_enqueue_scripts', 'kebo_twitter_scripts');

endif;

/**
 * Add a link to the plugin screen, to allow users to jump straight to the settings page.
 */
function kebo_twitter_plugin_meta( $links ) {
    
    $links[] = '<a href="' . admin_url( 'options-general.php?page=kebo-twitter' ) . '">' . __( 'Settings', 'kebo_twitter' ) . '</a>';
    return $links;
    
}
add_filter( 'plugin_action_links_kebo-twitter-feed/kebo-twitter-feed.php', 'kebo_twitter_plugin_meta' );

/**
 * Check we are on WordPress version 3.3 at least,
 * before trying to use the WP Pointer.
 */
global $wp_version;

if ( version_compare( $wp_version, '3.3', '>=' ) ) {
    
    /**
     * Adds a WordPress pointer to Kebo Twitter settings page.
     */
    function kebo_twitter_pointer_script_style( $hook_suffix ) {

        // Assume pointer shouldn't be shown
        $enqueue_pointer_script_style = false;

        // Get array list of dismissed pointers for current user and convert it to array
        $dismissed_pointers = explode( ',', get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );

        // Check if our pointer is not among dismissed ones
        if ( ! in_array( 'kebo_twitter_settings_pointer', $dismissed_pointers ) ) {
            $enqueue_pointer_script_style = true;

            // Add footer scripts using callback function
            add_action('admin_print_footer_scripts', 'kebo_twitter_pointer_print_scripts');
        }

        // Enqueue pointer CSS and JS files, if needed
        if ( $enqueue_pointer_script_style ) {
            wp_enqueue_style( 'wp-pointer' );
            wp_enqueue_script( 'wp-pointer' );
        }

    }
    add_action( 'admin_enqueue_scripts', 'kebo_twitter_pointer_script_style' );

    function kebo_twitter_pointer_print_scripts() {

        $pointer_content = '<h3>' . __('Connect to your Twitter Account', 'kebo_twitter') . '</h3>';
        $pointer_content .= '<p>' . __('In just a few clicks we can connect your website to your Twitter account and display your latest Tweets.', 'kebo_twitter') . ' <a href="' . admin_url('options-general.php?page=kebo-twitter') . '">' . __('Get Started Now', 'kebo_twitter') . '</a></p>';
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

}

/*
 * Outputs Slider Javascript
 * Shows a single tweet at a time, fading between them.
 */
function kebo_twitter_slider_script() {
    
    // Collect the IDs of all Widgets using the Slider display.
    $widget_ids = Kebo_Twitter_Feed_Widget::$slider_ids;
    
    foreach ( $widget_ids as $widget_id ) {
        
    ?>
    <script type="text/javascript">
        //<![CDATA[
        jQuery(document).ready(function() {
            
            ktimeout = jQuery( ".<?php echo $widget_id; ?>" ).data( "timeout" );
            kspeed = jQuery( ".<?php echo $widget_id; ?>" ).data( "speed" );
            
            jQuery( function() {
                jQuery( ".<?php echo $widget_id; ?>" ).responsiveSlides({
                    auto: true,           // Boolean: Animate automatically, true or false
                    speed: kspeed,        // Integer: Speed of the transition, in milliseconds
                    timeout: ktimeout,    // Integer: Time between slide transitions, in milliseconds
                    pager: false,         // Boolean: Show pager, true or false
                    nav: false,           // Boolean: Show navigation, true or false
                    random: false,        // Boolean: Randomize the order of the slides, true or false
                    pause: true           // Boolean: Pause on hover, true or false
                });
            });

        });
        //]]>
    </script>
    <?php
    
    }

}

/*
 * Print the Tweet Intent js
 */
function kebo_twitter_intent_script() {
    
    ?>
    <script type="text/javascript">
        
        //<![CDATA[
        jQuery(document).ready(function() {
            
            jQuery( '.ktweet .kfooter a:not(.ktogglemedia)' ).click(function(e) {

                // Prevent Click from Reloading page
                e.preventDefault();

                var khref = jQuery(this).attr('href');
                window.open( khref, 'twitter', 'width=600, height=400, top=0, left=0');

            });
            
        });
        //]]>
        
    </script>
    <?php

}

/*
 * Print the Tweet Media js
 */
function kebo_twitter_media_script() {
    
    ?>
    <script type="text/javascript">
        
        //<![CDATA[
        jQuery(document).ready(function() {
            
            jQuery( '.ktweet .ktogglemedia' ).click(function(e) {

                // Prevent Click from Reloading page
                e.preventDefault();

                var klink = jQuery(this);
                var kid = klink.data( 'id' );
                var kcontainer = jQuery( '#' + kid );

                if ( klink.hasClass('kclosed') && kcontainer.hasClass('kclosed') ) {

                    klink.removeClass('kclosed');
                    kcontainer.removeClass('kclosed');

                } else {

                    klink.addClass('kclosed');
                    kcontainer.addClass('kclosed');

                };

            });
            
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

/*
 * Check if the plugin has updated.
 * If so process any changes and update current version.
 */
function kebo_twitter_update_check() {
    
    $plugin_version = get_option( 'kebo_twitter_version' );
    
    /*
     * Runs if version check matches
     */
    if ( false == $plugin_version || empty( $plugin_version ) || ( ! empty( $plugin_version ) && KEBO_TWITTER_PLUGIN_VERSION > $plugin_version ) ) {

        //add_action( 'admin_notices', 'kebo_twitter_upgrade_notice' );

        // Delete currently cached data as format is changing in 0.9.0
        //delete_transient( 'kebo_twitter_feed_' . get_current_blog_id() );

        // Set silent cache to refresh after page load.
        add_action( 'shutdown', 'kebo_twitter_refresh_cache' );

        // Connection Migration Script
        add_action( 'after_setup_theme', 'kebo_twitter_activation_script' );

        // Update Plugin Version Option
        update_option( 'kebo_twitter_version', KEBO_TWITTER_PLUGIN_VERSION );

    }

}
add_action( 'admin_init', 'kebo_twitter_update_check' );

function kebo_twitter_activation_script() {
    
    if ( is_multisite() ) {

        global $wpdb;

        // Store Network Site ID so we can get back later.
        $current_blog = get_current_blog_id();

        // Get a list of all Blog IDs, ignore network admin with ID of 1.
        $blogs = $wpdb->get_results("
            SELECT blog_id
            FROM {$wpdb->blogs}
            WHERE site_id = '{$wpdb->siteid}'
            AND spam = '0'
            AND deleted = '0'
            AND archived = '0'
            AND blog_id != '{$current_blog}'
        ");

        foreach ( $blogs as $blog ) {

            switch_to_blog( $blog->blog_id );

            // Check if old format is used for storing connection info
            if ( false !== ( $twitter_data = get_transient( 'kebo_twitter_connection_' . $blog->blog_id ) ) ) {

                // Add connection data to new Option
                update_option( 'kebo_twitter_connection', $twitter_data );

                // Delete the now un-used Transient
                delete_transient( 'kebo_twitter_connection_' . $blog->blog_id );

            }

        }

        // Go back to Network Site
        switch_to_blog( $current_blog );
    
    } else {

        // Check if old format is used for storing connection info
        if ( false !== ( $twitter_data = get_transient( 'kebo_twitter_connection_1' ) ) ) {

            // Add connection data to new Option
            update_option( 'kebo_twitter_connection', $twitter_data );

            // Delete the now un-used Transient
            delete_transient( 'kebo_twitter_connection_1' );

        }

    }
    
}

/*
 * Use if needed
 */
function kebo_twitter_upgrade_notice() {
    ?>
    
    <div class="updated">
        <p><?php echo sprintf( __( 'This update changed the way your connection to Twitter was stored by WordPress, please check the plugin is still connected to your Twitter account, <a href="%s">here</a>.', 'kebo_twitter' ), admin_url( 'options-general.php?page=kebo-twitter' ) ); ?></p>
    </div>
    
    <?php
}

/*
 * Display an Admin Notice if plugin is active but no connection to Twitter is active.
 */

$twitter_data = get_option( 'kebo_twitter_connection' );

// Check if Connection data is being stored.
if ( empty ( $twitter_data ) ) {
    
    add_action( 'admin_notices', 'kebo_twitter_no_connection_notice' );
    
}

// Display Notice
function kebo_twitter_no_connection_notice() {
    
    global $current_screen;
    
    if ( 'settings_page_kebo-twitter' !== $current_screen->id ) {
        
    ?>
    
    <div class="updated">
        <p><?php echo sprintf( __( '<strong>Kebo Twitter Feed:</strong> No connection to Twitter found, to get started connect to your Twitter account from <a href="%s">this page</a>.', 'kebo_twitter' ), admin_url( 'options-general.php?page=kebo-twitter' ) ); ?></p>
    </div>
    
    <?php
    
    }
    
}

/**
 * ToDo List
 * 
 * 1. Include Re-Tweets in request to Twitter API and give users the option.
 * 2. 
 * 
 */