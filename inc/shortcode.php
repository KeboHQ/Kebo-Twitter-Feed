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
            'style' => 'list',
            'theme' => 'light',
            'count' => 5,
            'avatar' => 'off',
            'offset' => false,
            'replies' => false,
        ), $atts));
        
        // Check if a connection to Twitter exists.
        $twitter_data = get_option( 'kebo_twitter_connection' );
        if ( empty ( $twitter_data ) )
            return false;
        
        // Enqueue Style Sheet
        wp_enqueue_style( 'kebo-twitter-plugin' );
        
        // Add defaults.
        $instance['count'] = $count;
        $instance['theme'] = $theme;
        $instance['replies'] = $replies;
        
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

        // Begin Output Buffering
        ob_start();
        
        // Shortcode Container
        echo '<div class="kcontainer">';
        
        if ( isset( $title ) ) {
            
            echo '<h2 class="ktweets-title">' . $title . '</h2>';
            
        }
        
        /*
         * Get tweets from transient and refresh if its expired.
         */
        if ( false === ( $tweets = kebo_twitter_get_tweets() ) )
            return false;

        // If an offset is set, slice early items off the array
        if ( ! false == $offset && is_numeric( $offset ) ) {
            
            $tweets = array_slice($tweets, $offset);
            
        }
        
        // Output Twitter Feed
        if ( 2 == $instance['style'] ) {

            require( KEBO_TWITTER_PLUGIN_PATH . 'views/slider.php' );
                
        } else {

            require( KEBO_TWITTER_PLUGIN_PATH . 'views/list.php' );
                
        }
        
        // End of Shortcode Container
        echo '</div><!-- .kcontainer -->';
        
        // End Output Buffering and Clear Buffer
        $output = ob_get_contents();
        ob_end_clean();
        
        return $output;
        
    }

}

Kebo_Twitter_Shortcode::init();