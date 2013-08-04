<?php
/*
 * Shortcode to display Twitter Feed
 */

class Kebo_Twitter_Shortcode {

	static function init() {
            
            add_shortcode('kebo_twitter_feed', array(__CLASS__, 'handle_shortcode'));

	}

	static function handle_shortcode($atts) {

            // Sort Options
            extract(shortcode_atts(array(
                'title' => null,
                'style' => 'list',
                'theme' => 'light',
                'count' => 5,
                'timeago' => 0,
                'avatar' => 0,
            ), $atts));
            
            /*
             * Get tweets from transient and refresh if its expired.
             */
            if ( false === ( $tweets = get_transient( 'kebo_twitter_feed_' . get_current_blog_id() ) ) ) {

                $tweets = kebo_twitter_get_tweets();

            } else {
               
                // If custom cache time is expired, use old data and refresh cache after page render.
                if ( $tweets['expiry'] < time() ) {

                    add_action( 'shutdown', 'kebo_twitter_refresh_cache' );

                }

            }
            
            // Output Twitter Feed
            return '
            
                
            ';
            
	}

}

Kebo_Twitter_Shortcode::init();