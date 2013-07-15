<?php

/*
 * Requests Twitter Feed
 */

function kebo_twitter_get_tweets() {

    if ( false === ( $tweets = get_transient('kebo_twitter_connection') ) ) {
        
        
        
    }
    return $tweets;
    
}

if ( !function_exists( 'get_tweets' ) ) :
    
    function get_tweets() {
        
        kebo_twitter_get_tweets();
    
    }
    
endif;