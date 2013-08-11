<?php

/*
 * Shortcode to display Twitter Feed
 */

class Kebo_Twitter_Shortcode {

    static function init() {

        add_shortcode('kebo_tweets', array(__CLASS__, 'handle_shortcode'));
    }

    static function handle_shortcode($atts) {

        // Sort Options
        extract(shortcode_atts(array(
            'title' => null,
            'style' => 1,
            'theme' => 'light',
            'count' => 5,
            'avatar' => 'off',
        ), $atts));
        
        // Enqueue Style Sheet
        wp_enqueue_style( 'kebo-twitter-plugin' );
        
        // Add defaults.
        $instance['count'] = $count;
        $instance['style'] = $style;
        $instance['theme'] = $theme;
        
        if ( 'on' == $avatar ) {
            
            $instance['avatar'] = 'avatar';
            
        } else {
            
            $instance['avatar'] = 'off';
            
        }
        
        if ( 'slider' == $style ) {
            
            $instance['style'] = 2;
            
        } else {
            
            $instance['style'] = 1;
            
        }

        // Shortcode Container
        echo '<div class="kcontainer">';
        
        if ( isset( $title ) ) {
            
            echo '<h2 class="ktweets-title">' . $title . '</h2>';
            
        }
        
        /*
         * Get tweets from transient and refresh if its expired.
         */
        if ( false === ( $tweets = kebo_twitter_get_tweets() ) )
            return;

        // Output Twitter Feed
        if ( 2 == $instance['style'] ) {

            require( KEBO_TWITTER_PLUGIN_PATH . 'views/slider.php' );
                
        } else {

            require( KEBO_TWITTER_PLUGIN_PATH . 'views/list.php' );
                
        }
        
        // End of Shortcode Container
        echo '</div><!-- .kcontainer -->';
        
    }

}

Kebo_Twitter_Shortcode::init();