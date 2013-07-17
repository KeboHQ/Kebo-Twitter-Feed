<?php
/*
 * Requests Twitter Feed and Updates Transient
 */

/*
 * Requests the Twitter Feed via Kebo Server using OAuth data stored.
 */
function kebo_twitter_get_tweets() {

    if ( false !== ( $twitter_data = get_transient('kebo_twitter_connection') ) ) {
    
    // URL to Kebo OAuth Request App
    $request_url = 'http://auth.kebopowered.com/request/index.php';
    
    // Setup arguments for OAuth request.
    $data = array(
        'service' => 'twitter',
        'account' => $twitter_data['account'], // Screen Name
        'token' => $twitter_data['token'], // OAuth Token
        'secret' => $twitter_data['secret'], // OAuth Secret
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
    $request = wp_remote_post( $request_url, $args );
    
    // Response is in JSON format, so decode it.
    $response = json_decode( $request['body'] );
    
    // Grab the Plugin Options.
    $options = kebo_get_twitter_options();
    
    // Check for Error or Success Response.
    if ( isset( $response->errors )) {
        
        /*
         * On error use data from cache file.
         */
        $tweets = json_decode( file_get_contents( KEBO_TWITTER_PLUGIN_PATH . 'data/cache.json' ) );
        
        // Set low refresh time on failed request
        set_transient( 'kebo_twitter_feed', $tweets, 60 );
    
    } else {
        
        // We now have an object of tweets.
        $tweets = $response;
        
        /*
         * On successful request do some resource heavy regex, to avoid performing it on every page render.
         */
        foreach ($tweets as $tweet) :
            
            // Turn all text URLs into HTML links.
            $tweet->text = preg_replace( '/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>', $tweet->text );
            
        endforeach;
        
        /*
         * Then save to cache file in JSON format.
         */
        $file = fopen( KEBO_TWITTER_PLUGIN_PATH . 'data/cache.json', 'w' );
        fwrite( $file, json_encode( $tweets ) );
        fclose( $file );
        
        // Update Transient with new data.
        set_transient( 'kebo_twitter_feed', $tweets, $options['kebo_twitter_cache_timer'] * MINUTE_IN_SECONDS );
        
    }
    
    unset($options);
    
    // Return Tweets Object.
    return $tweets;
        
    }
    
}

/*
 * Alias function for 'kebo_twitter_get_tweets'.
 */
if ( !function_exists( 'get_tweets' ) ) :
    
    function get_tweets() {
        
        kebo_twitter_get_tweets();
    
    }
    
endif;

/*
 * Hooks Output Function to 'wp_footer'.
 */
function kebo_twitter_print_js() {
    
    // Add javascript output script to 'wp_footer' hook with low priority so that jQuery loads before.
    add_action( 'wp_footer', 'kebo_twitter_slider_script', 99 );
    
}

/*
 * Outputs Slider Javascript
 * Shows a single tweet at a time, fading between them.
 */
function kebo_twitter_slider_script() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {

            jQuery('#kebo-tweet-slider .tweet').eq(0).fadeToggle('1000').delay(10500).fadeToggle('1000');
            var tcount = 1;
            var limit = jQuery("#kebo-tweet-slider .tweet").size();
            var theight = jQuery('#kebo-tweet-slider .tweet').eq(0).outerHeight();
            jQuery('#kebo-tweet-slider').css({ minHeight : theight, })
            var initTweets = setInterval(fadeTweets, 11500);

            function fadeTweets() {
                
                if (tcount == limit) {
                    tcount = 0;
                }
                //theight = jQuery('#kebo-tweet-slider .tweet').eq(tcount).outerHeight();
                //jQuery('#kebo-tweet-slider').height(theight);
                jQuery('#kebo-tweet-slider .tweet').eq(tcount).fadeToggle('1000').delay(10500).fadeToggle('1000');

                ++tcount;

            }

        });
    </script>
    <?php
}