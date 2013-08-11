<?php
/*
 * Requests Twitter Feed and Updates Transient
 */

function kebo_twitter_get_tweets() {

    // If there is no social connection, we cannot get tweets, so return false
    if (false === ( $twitter_data = get_transient( 'kebo_twitter_connection_' . get_current_blog_id() ) ) )
        return false;

    // Grab the Plugin Options.
    $options = kebo_get_twitter_options();

    /*
     * Get transient and check if it has expired.
     */
    if ( false === ( $tweets = get_transient( 'kebo_twitter_feed_' . get_current_blog_id() ) ) ) {

        // Make POST request to Kebo OAuth App.
        $response = kebo_twitter_external_request();
        
        // If not WP Error response is in body
        if ( !is_wp_error($response) ) {
            
            // Response is in JSON format, so decode it.
            $response = json_decode($response['body']);
            
        }
        
        // Check for Error or Success Response.
        if (isset($response->errors) ) {
            
            // If error, add to error log.
            kebo_twitter_add_error( $response );
            
        } else {
            
            // We have Tweets, linkify the text
            $tweets = kebo_twitter_linkify( $response );

            // Add custom expiry time
            $tweets['expiry'] = time() + ( $options['kebo_twitter_cache_timer'] * MINUTE_IN_SECONDS );

            // No error, set transient with latest Tweets
            set_transient( 'kebo_twitter_feed_' . get_current_blog_id(), $tweets, 24 * HOUR_IN_SECONDS );
            
        }
        
    }

    /*
     * Check if Twwets have soft expired (user setting), if so run refresh after page load.
     */
    elseif ( $tweets['expiry'] < time() ) {

        // Add 10 seconds to soft expire, to stop other threads trying to update it at the same time.
        $tweets['expiry'] = ( time() + 60 );

        // Update soft expire time.
        set_transient( 'kebo_twitter_feed_' . get_current_blog_id(), $tweets, 24 * HOUR_IN_SECONDS );

        // Set silent cache to refresh after page load.
        add_action( 'shutdown', 'kebo_twitter_refresh_cache' );
        
    }
    
    unset( $tweets['expiry'] );
    
    return $tweets;
    
}

/*
 * Alias function for 'kebo_twitter_get_tweets'.
 */
if (!function_exists('get_tweets')) :

    function get_tweets() {

        $tweets = kebo_twitter_get_tweets();
        
        return $tweets;
        
    }

endif;

/*
 * Hooks Output Function to 'wp_footer'.
 */

function kebo_twitter_print_js() {

    // Add javascript output script to 'wp_footer' hook with low priority so that jQuery loads before.
    add_action('wp_footer', 'kebo_twitter_slider_script', 99);
}

/*
 * Make external request to Kebo auth script
 */

function kebo_twitter_external_request() {

    if (false !== ( $twitter_data = get_transient('kebo_twitter_connection_' . get_current_blog_id()) )) {

        // URL to Kebo OAuth Request App
        $request_url = 'http://auth.kebopowered.com/request/index.php';

        // Setup arguments for OAuth request.
        $data = array(
            'service' => 'twitter',
            'account' => $twitter_data['account'], // Screen Name
            'token' => $twitter_data['token'], // OAuth Token
            'secret' => $twitter_data['secret'], // OAuth Secret
            'userid' => $twitter_data['userid'], // User ID
        );

        // Setup arguments for POST request.
        $args = array(
            'method' => 'POST',
            'timeout' => 10,
            'redirection' => 5,
            'httpversion' => '1.1',
            'blocking' => true,
            'headers' => array(),
            'body' => array(
                'feed' => 'true',
                'data' => json_encode($data),
            ),
            'cookies' => array(),
            'sslverify' => false,
        );

        // Make POST request to Kebo OAuth App.
        $request = wp_remote_post($request_url, $args);

        return $request;
    }
}

/*
 * Silently refreshes the cache (transient) after page has rendered.
 */

function kebo_twitter_refresh_cache() {

    /*
     * If cache has already been updated, no need to refresh
     */
    if (false !== ( $tweets = get_transient('kebo_twitter_feed_' . get_current_blog_id()) )) {

        // Make POST request to Kebo OAuth App.
        $response = kebo_twitter_external_request();
        
        // If not WP Error response is in body
        if ( !is_wp_error($response) ) {
            
            // Response is in JSON format, so decode it.
            $response = json_decode($response['body']);
            
        }
        
        // Grab the Plugin Options.
        $options = kebo_get_twitter_options();

        // Check for Error or Success Response.
        if (isset($response->errors)) {
            
            // If error, add to error log.
            kebo_twitter_add_error( $response );
            
        } else {

            // We have Tweets, linkify the text
            $tweets = kebo_twitter_linkify( $response );

            // Add custom expiry time
            $tweets['expiry'] = time() + ( $options['kebo_twitter_cache_timer'] * MINUTE_IN_SECONDS );

            // No error, set transient with latest Tweets
            set_transient('kebo_twitter_feed_' . get_current_blog_id(), $tweets, 24 * HOUR_IN_SECONDS);
            
        }
        
    }
    
}

/*
 * Converts Tweet text urls, account names and hashtags into HTML links.
 */
function kebo_twitter_linkify($tweets) {

    foreach ($tweets as $tweet) {

        // Text URLs into HTML links
        $tweet->text = make_clickable($tweet->text);
        // Usernames into HTML links
        $tweet->text = preg_replace('#@([\\d\\w]+)#', '<a href="http://twitter.com/$1">$0</a>', $tweet->text);
        // Hashtags to HTML links
        $tweet->text = preg_replace('/#([\\d\\w]+)/', '<a href="http://twitter.com/#search?q=%23$1">$0</a>', $tweet->text);
        // Add target="_blank" to all links
        $tweet->text = links_add_target($tweet->text, '_blank', array('a'));
        
    }
    
    return $tweets;
}

/*
 * Adds an error from the Twitter API to the error log.
 */
function kebo_twitter_add_error( $response ) {
    
    if ( is_wp_error($response) ) {
        
        // Add details of current WP error
        $error[] = array(
            'date' => time(),
            'code' => 1,
            'message' => $response->errors['http_request_failed'][0],
        );
        
    } else {
        
        // Add details of current error
        $error[] = array(
            'date' => time(),
            'code' => $response->errors[0]->code,
            'message' => $response->errors[0]->message,
        );
        
    }
    
    // Get currently stored errors
    $log = get_option( 'kebo_twitter_errors' );
    
    if ($log[0]) {
        // Add new error to start of array
        $errors = array_merge( $error, $log );
    } else {
        $errors = $error;
    }
    
    // Limit array to the latest 10 errors
    $errors = array_slice( $errors, 0, 10, false );
        
    update_option( 'kebo_twitter_errors', $errors );
        
}