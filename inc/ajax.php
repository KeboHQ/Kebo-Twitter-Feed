<?php
/* 
 * AJAX Functions
 */

/*
 * Test connection to the Kebo API
 */
function kebo_twitter_api_status() {
    
    // Get the action
    $action = $_POST['action'];
    
    // Get nonce
    $nonce = $_POST['nonce'];
    
    /*
     * Check action
     */
    if ( 'kebo_twitter_api_status' !== $action ) {
        die();
    }
    
    /*
     * Check nonce
     */
    if ( ! wp_verify_nonce( $nonce, 'kebo_twitter_api_status' ) ) {
        die();
    }
    
    /**
     * Test the Kebo Twitter API
     */
    $request_url = 'http://auth.kebo.io/test.php';
    
    // Setup arguments for POST request.
    $args = array(
        'method' => 'POST',
        'timeout' => 10,
        'redirection' => 5,
        'httpversion' => '1.1',
        'blocking' => true,
        'headers' => array(),
        'body' => array(
            'data' => 'ping',
        ),
        'cookies' => array(),
        'sslverify' => false,
    );

    // Make POST request to Kebo OAuth App.
    $request = wp_remote_post( $request_url, $args );
    
    // Check for problem connecting to the API
    if ( is_wp_error( $request ) ) {
            
        // Failure
        $success = false;
            
    } else {
        
        $json = json_decode( $request['body'], true );
        
        if ( $json['success'] == 'true' ) {
            
            // Success
            $success = true;
        
        } else {
            
            // Failure
            $success = false;
            
        }
        
    }
    
    // Send successful response
    $response = array(
        'action' => 'api_status',
        'success' => $success,
    );
    
    // Clear and previous output, like errors.
    //ob_clean();
    
    // Output response
    print_r( json_encode( $response ) );
    
    // Send Output
    die();
    
}
add_action( 'wp_ajax_kebo_twitter_api_status', 'kebo_twitter_api_status' );

/*
 * Fetch Tweet Data
 */
function kebo_twitter_fetch_tweet_data() {
    
    // Get the action
    $action = $_POST['action'];
    
    // Get nonce
    $nonce = $_POST['nonce'];
    
    /*
     * Check action
     */
    if ( 'kebo_twitter_fetch_tweet_data' !== $action ) {
        die();
    }
    
    /*
     * Check nonce
     */
    if ( ! wp_verify_nonce( $nonce, 'kebo_twitter_fetch_tweet_data' ) ) {
        die();
    }
    
    /**
     * Get Cached Tweet Data
     */
    if ( false === ( $tweets = get_transient( 'kebo_twitter_feed_' . get_current_blog_id() ) ) ) {
        
        // Prepare Response
        $response = array(
            'action' => 'fetch_tweet_data',
            'success' => false,
        );
        
    } else {
        
        // Prepare Response
        $response = array(
            'action' => 'fetch_tweet_data',
            'success' => true,
            'data' => print_r( $tweets, true ),
        );
        
    }
    
    // Output response
    print_r( json_encode( $response ) );
    
    // Send Output
    die();
    
}
add_action( 'wp_ajax_kebo_twitter_fetch_tweet_data', 'kebo_twitter_fetch_tweet_data' );