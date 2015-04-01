<?php
/*
 * Registers, Renders and Validates all Options.
 */

function kebo_twitter_options_init() {

    register_setting(
            'kebo_twitter_options', // Options group
            'kebo_twitter_options', // Database option
            'kebo_twitter_options_validate' // The sanitization callback,
    );

    add_settings_section(
            'kebo_twitter_options_general', // Unique identifier for the settings section
            __('Twitter Connection', 'kebo_twitter'), // Section title
            'kebo_twitter_connection_render', // Section callback
            'kebo-twitter' // Menu slug
    );

    /*
     * Use Settings Section Callback to Display Custom Twitter Connection HTML.
     */
    function kebo_twitter_connection_render() {
        ?>

        <p><?php _e("To enable us to display your Tweets you must connect your Twitter account to our Twitter Application by clicking on the large 'Connect to Twitter' button below.", 'kebo_twitter'); ?></p>

        <?php
        $twitter_data = get_option( 'kebo_twitter_connection' );
        
        // Check if Connection exists
        if ( empty ( $twitter_data ) ) :
        ?>

            <a class="social-link twitter disabled" href="https://link.kebo.io/auth/?authclient=twitter-read&origin=<?php echo esc_url( admin_url('options-general.php?page=kebo-twitter') ); ?>"><?php _e('Connect to Twitter', 'kebo_twitter'); ?></a>

        <?php else : ?>
            
            <?php if ( strpos( $twitter_data['account_link'], 'http' ) === false ) { $account_link = 'http://' . $twitter_data['account_link']; } ?>

            <a class="social-link twitter" href="#"><?php _e('Connected to Twitter', 'kebo_twitter'); ?></a><br>
            <p>
                <?php _e('Connected as', 'kebo_twitter'); ?>
                <a class="account" href="<?php echo $account_link; ?>" target="_blank">@<?php echo $twitter_data['account']; ?></a>
                <a class="disconnect" title="<?php _e('Disconnect Service', 'kebo_twitter'); ?>" href="<?php echo admin_url('options-general.php?page=kebo-twitter&reset=true') ?>">&#10006;</a>
            </p>

        <?php endif; ?>
            
        <h3><?php _e('General Options', 'kebo_twitter'); ?></h3>

        <?php
    }

    add_settings_field(
        'kebo_twitter_cache_timer', // Unique identifier for the field for this section
        __('Feed Refresh Rate', 'kebo_twitter'), // Setting field label
        'kebo_twitter_cache_timer_render', // Function that renders the settings field
        'kebo-twitter', // Menu slug
        'kebo_twitter_options_general' // Settings section.
    );
    
    add_settings_field(
        'kebo_twitter_nofollow_links', // Unique identifier for the field for this section
        __('NoFollow Links', 'kebo_twitter'), // Setting field label
        'kebo_twitter_nofollow_links_render', // Function that renders the settings field
        'kebo-twitter', // Menu slug
        'kebo_twitter_options_general' // Settings section.
    );
    
    // Stores Error Log
    add_option(
        'kebo_twitter_errors', // name
        array(), // value
        null, // depreciated
        'no' // autoload
    );
    
    
    
}
add_action( 'admin_init', 'kebo_twitter_options_init' );

/**
 * Change the capability required to save the 'kebo_twitter_options' options group.
 */
function kebo_twitter_option_capability($capability) {

    return 'manage_options';
    
}
add_filter('option_page_capability_kebo_twitter_options', 'kebo_twitter_option_capability');

/**
 * Returns the options array for the 'kebo_twitter_options' option group.
 */
function kebo_get_twitter_options() {

    $saved = (array) get_option('kebo_twitter_options');

    $defaults = array(
        'kebo_twitter_cache_timer' => 15,
        'kebo_twitter_nofollow_links' => 'nofollow',
    );

    $defaults = apply_filters('kebo_get_twitter_options', $defaults);

    $options = wp_parse_args($saved, $defaults);
    $options = array_intersect_key($options, $defaults);

    return $options;
}

/**
 * Renders the Cache Timer input.
 */
function kebo_twitter_cache_timer_render() {

    $options = kebo_get_twitter_options();
    ?>
    <input style="width: 30px;" type="text" name="kebo_twitter_options[kebo_twitter_cache_timer]" id="kebo_twitter_cache_timer" value="<?php echo esc_attr($options['kebo_twitter_cache_timer']); ?>" />
    <label class="description" for="kebo_twitter_cache_timer"><?php _e('Minutes. Should be between 1 and 30.', 'kebo_twitter'); ?></label>
    <p><?php _e('This controls how frequently we update the stored list of Tweets for display on your website.', 'kebo_twitter'); ?></p>
    <?php
}

/**
 * Renders the Cache Timer input.
 */
function kebo_twitter_nofollow_links_render() {

    $options = kebo_get_twitter_options();
    ?>
    <input type="checkbox" name="kebo_twitter_options[kebo_twitter_nofollow_links]" id="kebo_twitter_nofollow_links" value="nofollow" <?php checked( 'nofollow', $options['kebo_twitter_nofollow_links'] ); ?> data-test="<?php echo $options['kebo_twitter_nofollow_links']; ?>" />
    <label class="description" for="kebo_twitter_nofollow_links"><?php _e('Toggle feature on/off.', 'kebo_twitter'); ?></label>
    <p><?php _e('Adds rel="nofollow" to all links inside Tweets. This is used to indicate links which might not be trustworthy/endorsed by you.', 'kebo_twitter'); ?></p>
    <?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 */
function kebo_twitter_options_validate( $input ) {

    $options = kebo_get_twitter_options();

    $output = array();
    
    // Purge currently cached data
    // A tool to allow users to forcefully reset the cache.
    delete_transient( 'kebo_twitter_feed_' . get_current_blog_id() );
    
    // Refresh Tweets when saving settings
    kebo_twitter_get_tweets();
    
    if ( isset( $input['kebo_twitter_cache_timer'] ) && !empty( $input['kebo_twitter_cache_timer'] ) ) {
        
        if ( is_numeric( $input['kebo_twitter_cache_timer'] ) ) {
            
            if ( 1 <= $input['kebo_twitter_cache_timer'] && 30 >= $input['kebo_twitter_cache_timer'] ) {
                
                $output['kebo_twitter_cache_timer'] = intval( $input['kebo_twitter_cache_timer'] );
                
            } else {
                
                add_settings_error(
                    'kebo_twitter_messages',
                    esc_attr('settings_updated'),
                    __( 'Value supplied is outside of acceptable range 1-30.', 'kebo_twitter' ),
                    'error'
                );
                
            }
            
        } else {
            
            add_settings_error(
                'kebo_twitter_messages',
                esc_attr('settings_updated'),
                __( 'Value supplied is not a valid number.', 'kebo_twitter' ),
                'error'
            );
            
        }
        
    }
    
    if ( isset( $input['kebo_twitter_nofollow_links'] ) && 'nofollow' == $input['kebo_twitter_nofollow_links'] ) {
        
        $output['kebo_twitter_nofollow_links'] = $input['kebo_twitter_nofollow_links'];
        
    } else {
        
        $output['kebo_twitter_nofollow_links'] = false;
        
    }

    return apply_filters('kebo_twitter_options_validate', $output, $options);
}