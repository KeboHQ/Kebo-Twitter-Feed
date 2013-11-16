<?php
/*
 * Shortcode to display Twitter Feed
 */

class Kebo_Twitter_Shortcode {
    
    static $shortcode_id = 1;
    
    static function init() {

        add_shortcode('kebo_tweets', array(__CLASS__, 'handle_shortcode'));
        
    }

    static function handle_shortcode( $atts ) {

        // Sort Options
        extract( shortcode_atts( array(
            'title' => null,
            'display' => 'tweets',
            'style' => 'list',
            'theme' => 'light',
            'count' => 5,
            'avatar' => 'off',
            'offset' => false,
            'conversations' => false,
            'media' => false,
        ), $atts ) );
        
        // Check if a connection to Twitter exists.
        $twitter_data = get_option( 'kebo_twitter_connection' );
        if ( empty ( $twitter_data ) )
            return false;
        
        // Enqueue Style Sheet
        wp_enqueue_style( 'kebo-twitter-plugin' );
        wp_enqueue_script( 'jquery' );
        
        $widget_id = 'kebo_twitter_feed_shortcode-' . self::$shortcode_id;
        
        self::$shortcode_id++;
        
        if ( ! true == Kebo_Twitter_Feed_Widget::$printed_intent_js ) {
            
            Kebo_Twitter_Feed_Widget::$printed_intent_js = true;
            add_action( 'wp_footer', 'kebo_twitter_intent_script', 90 );
            
        }
        
        if ( 'slider' == $style ) {
            
            Kebo_Twitter_Feed_Widget::$slider_ids[] = $widget_id;
            wp_enqueue_script( 'responsive-slides' );
            add_action( 'wp_footer', 'kebo_twitter_slider_script', 90 );

        }
        
        // Add defaults.
        $instance['title'] = $title;
        $instance['count'] = $count;
        $instance['theme'] = $theme;
        $instance['conversations'] = $conversations;
        $instance['media'] = $media;
        $instance['display'] = $display;
        
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
        echo '<div id="' . $widget_id . '" class="kcontainer">';
        
        if ( isset( $instance['title'] ) ) {
            
            echo '<h2 class="ktweets-title">' . esc_html( $instance['title'] ) . '</h2>';
            
        }
        
        /*
         * Get tweets from transient and refresh if its expired.
         */
        if ( false === ( $tweets = kebo_twitter_get_tweets() ) ) {
            return false;
        }
        
        // If an offset is set, slice early items off the array
        if ( ! false == $offset && is_numeric( $offset ) ) {
            
            $tweets = array_slice($tweets, $offset);
            
        }
        
        /*
         * Check which Style (Slider/List) has been chosen and use correct view file, default List.
         */
        if ( 2 == $instance['style'] ) {
            
            if ( '' != locate_template( 'views/kebo-twitter-slider.php' ) ) {
                
                // yep, load the page template
                get_template_part( 'views/kebo-twitter-slider' );
                    
            } else {
                
                require( KEBO_TWITTER_PLUGIN_PATH . 'views/slider.php' );
                
            }
            
        } else {
            
            if ( '' != locate_template( 'views/kebo-twitter-list.php' ) ) {
                
                // yep, load the page template
                get_template_part( 'views/kebo-twitter-list' );
                    
            } else {
                
                require( KEBO_TWITTER_PLUGIN_PATH . 'views/list.php' );
                
            }
            
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