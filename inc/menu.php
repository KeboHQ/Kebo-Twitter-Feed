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
    
    if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
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
    
    // Enqueue Thickbox
    add_thickbox();
        
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
        
        <a href="#TB_inline?width=600&height=550&inlineId=kebo-debug-modal" class="thickbox kdebug-button"><?php _e( 'Debug Tweet Data', 'kebo_twitter' ); ?></a>

        <div id="kebo-debug-modal" style="display:none;">
            
            <h2><?php _e( 'Debug - Cached Tweet Data', 'kebo_twitter' ); ?> <a class="kselect" href="#"><?php _e( 'Select All', 'kebo_twitter' ); ?></a> </h2>
            
            <img class="kloading" src="<?php echo admin_url( 'images/wpspin_light.gif' ); ?>">
            
            <textarea class="kdebug-content" readonly="readonly">
                
            </textarea>
            
        </div>
        
        <script type="text/javascript">
            
            jQuery( document ).ready( function() {
                
                jQuery( '.kdebug-button' ).one( 'click', function() {
                    
                    var data = {
                        action: 'kebo_twitter_fetch_tweet_data',
                        nonce: '<?php echo wp_create_nonce( 'kebo_twitter_fetch_tweet_data' ); ?>'
                    };

                    // do AJAX request
                    jQuery.post( ajaxurl, data, function( response ) {

                        response = jQuery.parseJSON( response );

                        if ( true === response.success ) {

                            jQuery('#TB_ajaxContent .kloading').hide();
                            jQuery('.kdebug-content').text( response.data );

                        } else {

                            jQuery('#TB_ajaxContent .kloading').hide();
                            jQuery('.kdebug-content').text( 'Sorry, no Tweet data was found.' );

                        }

                    });
                    
                });
                
                jQuery( '.kselect' ).on( 'click', function(e) {
                    e.preventDefault();
                    jQuery('.kdebug-content').select();
                });
                
            });
        
        </script>
        
        <div class="kapi-status">
            
            <h4><?php _e( 'API Status', 'kebo_twitter' ); ?></h4>
            
            <div>
                <span title="auth.kebo.io">23.239.13.127</span>
                <img class="kloading" src="<?php echo admin_url( 'images/wpspin_light.gif' ); ?>" title="Testing API Connection">
                <span class="ksuccess" title="<?php _e( 'Your site can successfully connect to the Kebo API.', 'kebo_twitter' ); ?>"><?php _e( 'Success', 'kebo_twitter' ); ?></span>
                <span class="kerror" title="<?php _e( 'Your site failed to connect to the Kebo API.', 'kebo_twitter' ); ?>"><?php _e( 'Error', 'kebo_twitter' ); ?></span>
                <?php $url = 'http://wordpress.org/support/plugin/kebo-twitter-feed'; ?>
                <p class="kmessage"><?php printf( __( 'Your site cannot connect to the Kebo API, this will prevent the plugin from functioning as expected. You are welcome to ask for help on the <a href="%s" target="_blank">support forum</a>.', 'kebo_twitter' ), esc_url( $url ) ); ?></p>
            </div>
            
        </div>
        
        <script type="text/javascript">
            
            jQuery( document ).ready(function() {
                
                var data = {
                    action: 'kebo_twitter_api_status',
                    nonce: '<?php echo wp_create_nonce('kebo_twitter_api_status'); ?>'
                };

                // do AJAX request
                jQuery.post( ajaxurl, data, function( response ) {

                    response = jQuery.parseJSON( response );

                    if ( true === response.success ) {
                        
                        jQuery('.kapi-status').addClass( 'ksuccess' );
                        jQuery('.kapi-status .kloading').hide();
                        jQuery('.kapi-status .ksuccess').show();
                        jQuery('.kapi-status .kerror').hide();
                        
                    } else {
                        
                        jQuery('.kapi-status').addClass( 'kerror' );
                        jQuery('.kapi-status .kloading').hide();
                        jQuery('.kapi-status .kerror').show();
                        jQuery('.kapi-status .ksuccess').hide();
                        jQuery('.kapi-status .kmessage').show();
                        
                    }

                });
                
            });
            
        </script>
        
    </div><!-- .wrap -->

    <?php
    
}