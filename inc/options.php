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
            __('Twitter Connection', 'kebo'), // Section title
            'kebo_twitter_connection_render', // Section callback
            'kebo-twitter' // Menu slug
    );

    /*
     * Use Settings Section Callback to Display Custom Twitter Connection HTML.
     */
    function kebo_twitter_connection_render() {
        ?>

        <p><?php _e("To enable us to display your Tweets you must connect your Twitter account to our Twitter Application by clicking on the large 'Connect to Twitter' button below.", 'kebo_twitter'); ?></p>

        <?php if (false === ( $twitter_data = get_transient( 'kebo_twitter_connection_' . get_current_blog_id() ) ) ) : ?>

            <a class="social-link twitter disabled" href="http://auth.kebopowered.com/twitterread/?origin=<?php echo admin_url('options-general.php?page=kebo-twitter') ?>"><?php _e('Connect to Twitter', 'kebo_twitter'); ?></a>

        <?php else : ?>

            <a class="social-link twitter" href="#"><?php _e('Connected to Twitter', 'kebo_twitter'); ?></a><br>
            <p><?php _e('Connected as', 'kebo_twitter'); ?> <a class="account" href="<?php echo $twitter_data['account_link']; ?>" target="_blank">@<?php echo $twitter_data['account']; ?></a> <a class="disconnect" title="<?php _e('Disconnect Service', 'kebo_twitter'); ?>" href="<?php echo admin_url('options-general.php?page=kebo-twitter&reset=true') ?>">&#10006;</a></p>

        <?php endif; ?>

        <h3>General Options</h3>

        <?php
    }

    add_settings_field(
            'kebo_twitter_cache_timer', // Unique identifier for the field for this section
            __('Feed Refresh Rate', 'kebo_twitter'), // Setting field label
            'kebo_twitter_cache_timer_render', // Function that renders the settings field
            'kebo-twitter', // Menu slug
            'kebo_twitter_options_general' // Settings section.
    );
    
    // Option to store the error log
    add_option(
            'kebo_twitter_errors', // name
            array(), // value
            null, // depreciated
            'no' // autoload
    ); 
    
}
add_action('admin_init', 'kebo_twitter_options_init');

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
        'kebo_twitter_cache_timer' => 5,
        'kebo_twitter_api_errors' => null,
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
    <input style="width: 26px;" type="text" name="kebo_twitter_options[kebo_twitter_cache_timer]" id="kebo_twitter_cache_timer" value="<?php echo esc_attr($options['kebo_twitter_cache_timer']); ?>" />
    <label class="description" for="kebo_twitter_cache_timer"><?php _e('Minutes. Should be between 1 and 30.', 'kebo_twitter'); ?></label>
    <p><?php _e('This controls how frequently we update the stored list of Tweets for display on your website.', 'kebo_twitter'); ?></p>
    <?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 */
function kebo_twitter_options_validate($input) {

    $options = kebo_get_twitter_options();

    $output = array();
    
    // Refresh Tweets when saving settings
    kebo_twitter_get_tweets();
    
    if ( isset( $input['kebo_twitter_cache_timer'] ) && !empty( $input['kebo_twitter_cache_timer'] ) ) {
        
        if ( is_numeric( $input['kebo_twitter_cache_timer'] ) ) {
            
            if ( 1 <= $input['kebo_twitter_cache_timer'] && 30 >= $input['kebo_twitter_cache_timer'] ) {
                
                $output['kebo_twitter_cache_timer'] = intval($input['kebo_twitter_cache_timer']);
                
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

    return apply_filters('kebo_twitter_options_validate', $output, $options);
}