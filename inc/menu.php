<?php
/*
 * Registers and Renders the Menu page.
 */

/*
 * Register Plugin Settings Page at far bottom of Menu list.
 */
function kebo_twitter_menu() {

    add_submenu_page(
            'options-general.php', // Parent
            __('Kebo Twitter Feed', 'kebo_twitter'), // Page Title
            __('Kebo Twitter Feed', 'kebo_twitter'), // Menu Title
            'manage_options', // Capability
            'kebo-twitter', // Menu Slug
            'kebo_twitter_menu_render' // Render Function
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
    if ( isset( $_GET['service'] ) && isset( $_GET['token'] ) ) :

            $data = array(
                'service' => $_GET['service'],
                'token' => $_GET['token'], // OAuth Token
                'secret' => $_GET['secret'], // OAuth Secret
                'account' => $_GET['account'], // Screen Name
                'userid' => $_GET['userid'], // Twitter User ID
                'account_link' => $_GET['account_link'], // Twitter Account Link
            );
            
            // Store Website OAuth Credentials in transient, use extra long expiry as Twitter does not currently set an expiry time.
            update_option( 'kebo_twitter_connection', $data );
            
            // On Successful Connection, Fetch Tweets.
            kebo_twitter_get_tweets();
            
            // Let user know we successfully received and stored their credentials.
            // TODO: Add error checking.
            add_settings_error(
                'kebo-twitter',
                esc_attr('settings_updated'),
                sprintf( __('Connection established with Twitter. You can now display your Twitter Feed on your website using a <a href="%s">Widget</a>.', 'kebo_twitter'), admin_url('widgets.php') ),
                'updated'
            );

    endif;

        // Check for reset request, if set delete transient which will break the connection to Twitter, so the credentials will be lost.
        if ( isset( $_GET['reset'] ) && 'true' == $_GET['reset'] ) :

            if ( 'true' == $_GET['reset'] ) :

                update_option( 'kebo_twitter_connection', false );
            
                add_settings_error(
                    'kebo-twitter',
                    esc_attr('settings_updated'),
                    __( 'Connection reset to Twitter.', 'kebo_twitter' ),
                    'updated'
                );
                
            endif;

        endif;
        
    ?>
    <div class="wrap">
        
        <?php screen_icon('options-general'); ?>
        <h2><?php _e('Kebo Twitter Feed', 'kebo_twitter'); ?></h2>
            <?php settings_errors( 'kebo-twitter' ); ?>

        <form method="post" action="options.php">
            <?php
            settings_fields('kebo_twitter_options');
            do_settings_sections('kebo-twitter');
            submit_button();
            ?>
        </form>
        
        <?php $errors = get_option( 'kebo_twitter_errors' ); ?>
        <?php if ( ! empty( $errors ) ) : ?>
        
        <div class="box">
            
            <h3><?php _e( 'Twitter API - Error Log', 'kebo_twitter' ); ?></h3>
            
            <p><?php _e( 'Any errors received while connecting to Twitter will be displayed below.', 'kebo_twitter' ); ?></p>

            <ul class="error-log">

                <li class="header"><span class="date"><?php _e( 'Date', 'kebo_twitter' ); ?></span> <span class="ref"><?php _e( 'Code', 'kebo_twitter' ); ?></span> <span class="message"><?php _e( 'Message', 'kebo_twitter' ); ?></span></li>

                <?php foreach ( $errors as $error ) : ?>
                    <li><span class="date"><?php echo date( 'H:i:s', $error['date'] ); ?> - <?php echo date_i18n( get_option( 'date_format' ), $error['date'] ); ?></span> <span class="ref"><?php echo $error['code']; ?></span> <span class="message"><?php echo $error['message']; ?></span></li>
                <?php endforeach; ?>

            </ul>
        
        </div>
        
        <div class="box">
            
            <h3><?php _e( 'Twitter API - Error Key', 'kebo_twitter' ); ?></h3>
            
            <p><?php _e( 'Below is a key of the most common types of error returned by Twitter and a short description.', 'kebo_twitter' ); ?></p>

            <?php $options = kebo_get_twitter_options(); ?>
            <?php $requests = ( 60 / $options['kebo_twitter_cache_timer'] ); ?>

            <p><strong>Error 32: Could not authenticate you</strong> - <?php _e('There is a problem with your connection to Twitter, please disconnect and re-connect to the service.', 'kebo_twitter'); ?></p>
            <p><strong>Error 64: Your account is suspended and is not permitted to access this feature</strong> - <?php _e('Twitter has blocked our access to your account.', 'kebo_twitter'); ?></p>
            <p><strong>Error 88: Rate limit exceeded</strong> - <?php printf( __("Your account has hit Twitter's limit of 180 requests per hour, we are making %d of those requests. You can edit the 'Feed Refresh Rate' in the options above to change this.", 'kebo_twitter'), $requests ); ?></p>
            <p><strong>Error 89: Invalid or expired token</strong> - <?php _e('There is a problem with your connection to Twitter, please disconnect and re-connect to the service.', 'kebo_twitter'); ?></p>
            <p><strong>Error 130: Over capacity</strong> - <?php _e('Twitter is currently too busy to reply.', 'kebo_twitter'); ?></p>
        
        </div>
        
        <?php endif; ?>
        
    </div>

    <?php
    
}