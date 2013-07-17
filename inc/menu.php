<?php
/*
 * Registers and Renders the Menu page.
 */

/*
 * Register Plugin Settings Page at far bottom of Menu list.
 */
function kebo_twitter_menu() {

    add_menu_page(
            __('Kebo Twitter', 'kebo_twitter'), // Page Title
            __('Kebo Twitter', 'kebo_twitter'), // Menu Title
            'manage_options', // Capability
            'kebo-twitter', // Menu Slug
            'kebo_twitter_menu_render', // Render Function
            null, // Icon URL will provide own using CSS and sprite image
            '99.000083849' // Menu Position (use decimals to ensure no conflicts)
    );

}
add_action('admin_menu', 'kebo_twitter_menu');

/**
 * Renders the Twitter Feed Options page.
 */
function kebo_twitter_menu_render() {
    
    if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
    
    // Collect returned OAuth2 credentials on callback and save in a transient.
    if (isset($_GET['service']) && isset($_GET['token'])) :

            $userid = $_GET['userid'];
            $account = $_GET['account'];
            $account_link = $_GET['account_link'];

            $data = array(
                'service' => $_GET['service'],
                'token' => $_GET['token'], // OAuth Token
                'secret' => $_GET['secret'], // OAuth Secret
                'account' => $account, // Screen Name
                'userid' => $userid, // Twitter User ID
                'account_link' => $account_link, // Twitter Account Link
            );
            
            // Store Website OAuth Credentials in transient, use extra long expiry as Twitter does not currently set an expiry time.
            set_transient('kebo_twitter_connection', $data, 10 * YEAR_IN_SECONDS);
            
            // Let user know we successfully received and stored their credentials.
            // TODO: Add error checking.
            add_settings_error(
                'kebo_twitter_connection',
                esc_attr('settings_updated'),
                __('Connection established with Twitter.', 'kebo_twitter'),
                'updated'
            );

        endif;

        // Check for reset request, if set delete transient which will break the connection to Twitter, so the credentials will be lost.
        if ( isset( $_GET['reset'] ) && 'true' == $_GET['reset'] ) :

            if ( 'true' == $_GET['reset'] ) :

                delete_transient( 'kebo_twitter_connection' );
            
                add_settings_error(
                    'kebo_twitter_connection_reset',
                    esc_attr('settings_updated'),
                    __( 'Connection reset to Twitter.', 'kebo_twitter' ),
                    'updated'
                );
                
            endif;

        endif;
        
    ?>
    <div class="wrap">
        
        <?php screen_icon('options-general'); ?>
        <h2><?php _e('Twitter Feed', 'kebo_twitter'); ?></h2>
            <?php settings_errors(); ?>

        <form method="post" action="options.php">
            <?php
            settings_fields('kebo_twitter_options');
            do_settings_sections('kebo-twitter');
            submit_button();
            ?>
        </form>
        
    </div>
    <?php
    
}