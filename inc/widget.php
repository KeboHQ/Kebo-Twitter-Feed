<?php
/*
 * Twitter Feed Widget
 */

$twitter_data = get_option( 'kebo_twitter_connection' );

/*
 * Only register Widget if connection has been made to our Twitter App.
 */
if ( ! empty ( $twitter_data ) ) {
        
    add_action('widgets_init', 'kebo_twitter_register_widget');
    
    function kebo_twitter_register_widget() {
        
        register_widget( 'Kebo_Twitter_Feed_Widget' );
        
    }
            
}

class Kebo_Twitter_Feed_Widget extends WP_Widget {

    /**
     * Has the Tweet Intent javascript been printed?
     */
    static $printed_intent_js;
    
    /**
     * Has the Tweet Media javascript been printed?
     */
    static $printed_media_js;
    
    /**
     * Widget IDs using Slider display
     */
    static $slider_ids = array();
    
    /**
     * Register Widget Details 
     */
    function Kebo_Twitter_Feed_Widget() {

        $widget_ops = array(
            'classname' => 'kebo_twitter_feed_widget',
            'description' => __('Displays your Twitter Feed on your website.', 'kbso')
        );

        $this->WP_Widget( false, __('Kebo Twitter Feed', 'kbso'), $widget_ops );
        
    }

    /*
     * Outputs Content
     */
    function widget( $args, $instance ) {
        
        extract( $args, EXTR_SKIP );
        
        // Enqueue Style Sheet
        wp_enqueue_style( 'kebo-twitter-plugin' );
        wp_enqueue_script( 'jquery' );
        
        if ( ! true == self::$printed_intent_js ) {
            
            self::$printed_intent_js = true;
            add_action( 'wp_footer', 'kebo_twitter_intent_script', 90 );
            
        }
        
        if ( 2 == $instance['style'] ) {
            
            self::$slider_ids[] = $widget_id;
            wp_enqueue_script( 'responsive-slides' );
            add_action( 'wp_footer', 'kebo_twitter_slider_script', 90 );

        }
        
        /*
         * Get tweets from transient and refresh if its expired.
         */
        if ( false === ( $tweets = kebo_twitter_get_tweets() ) ) {
            return;
        }
        
        // Ensure not undefined for updates
        if ( ! isset( $instance['conversations'] ) )
            $instance['conversations'] = false;
        
        // Ensure not undefined for updates
        if ( ! isset( $instance['media'] ) )
            $instance['media'] = false;
        
        // Ensure not undefined for updates
        if ( ! isset( $instance['display'] ) )
            $instance['display'] = 'tweets';
        
        // Output opening Widget HTML
        echo $before_widget;
        
        // If Title is set, output it with Widget title opening and closing HTML
        if ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) {

            echo $before_title;
            echo esc_html( $instance['title'] );
            echo $after_title;
            
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
        
        // Output closing Widget HTML
        echo $after_widget;
        
    }

    /*
     * Outputs Options Form
     */
    function form( $instance ) {
        ?>

        <?php
        // Add defaults.
        if( !isset( $instance['count'] ) )
            $instance['count'] = 5;
        if( !isset( $instance['avatar'] ) )
            $instance['avatar'] = '';
        if( !isset( $instance['style'] ) )
            $instance['style'] = 1;
        if( !isset( $instance['theme'] ) )
            $instance['theme'] = 'light';
        if( !isset( $instance['title'] ) )
            $instance['title'] = '';
        if( !isset( $instance['conversations'] ) )
            $instance['conversations'] = false;
        if( !isset( $instance['media'] ) )
            $instance['media'] = false;
        if( !isset( $instance['display'] ) )
            $instance['display'] = 'tweets';
            
        ?>
        
        <label for="<?php echo $this->get_field_id('title'); ?>">
            <p><?php _e('Title', 'kebo_twitter'); ?>: <input style="width: 100%;" type="text" value="<?php echo $instance['title']; ?>" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>"></p>
        </label>

        <label for="<?php echo $this->get_field_id('display'); ?>">
            <p>
                <?php _e('Display', 'kebo_twitter'); ?>:
                <select style="width: 100%;" id="<?php echo $this->get_field_id('display') ?>" name="<?php echo $this->get_field_name('display'); ?>">
                    <option value="tweets" <?php if ( 'tweets' == $instance['display'] ) { echo 'selected="selected"'; } ?>><?php _e('Tweets', 'kebo_twitter'); ?></option>
                    <option value="retweets" <?php if ( 'retweets' == $instance['display'] ) { echo 'selected="selected"'; } ?>><?php _e('Re-Tweets', 'kebo_twitter'); ?></option>
                    <option value="all" <?php if ( 'all' == $instance['display'] ) { echo 'selected="selected"'; } ?>><?php _e('All Tweets', 'kebo_twitter'); ?></option>
                </select>
            </p>
        </label>

        <label for="<?php echo $this->get_field_id('style'); ?>">
            <p>
                <?php _e('Style', 'kebo_twitter'); ?>:
                <select style="width: 100%;" id="<?php echo $this->get_field_id('style') ?>" name="<?php echo $this->get_field_name('style'); ?>">
                    <option value="1" <?php if ( 1 == $instance['style'] ) { echo 'selected="selected"'; } ?>><?php _e('List', 'kebo_twitter'); ?></option>
                    <option value="2" <?php if ( 2 == $instance['style'] ) { echo 'selected="selected"'; } ?>><?php _e('Slider', 'kebo_twitter'); ?></option>
                </select>
            </p>
        </label>

        <label for="<?php echo $this->get_field_id('theme'); ?>">
            <p>
                <?php _e('Theme', 'kebo_twitter'); ?>:
                <select style="width: 100%;" id="<?php echo $this->get_field_id('theme') ?>" name="<?php echo $this->get_field_name('theme'); ?>">
                    <option value="light" <?php if ( 'light' == $instance['theme'] ) { echo 'selected="selected"'; } ?>><?php _e('Light', 'kebo_twitter'); ?></option>
                    <option value="dark" <?php if ( 'dark' == $instance['theme'] ) { echo 'selected="selected"'; } ?>><?php _e('Dark', 'kebo_twitter'); ?></option>
                </select>
            </p>
        </label>

        <label for="<?php echo $this->get_field_id('count'); ?>">
            <p><?php _e('Number Of Tweets', 'kebo_twitter'); ?>: <input style="width: 28px;" type="text" value="<?php echo $instance['count']; ?>" name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>"> <span><?php _e('Range 1-50', 'kebo_twitter') ?></span></p>
        </label>

        <label for="<?php echo $this->get_field_id('avatar'); ?>">
            <p><input style="width: 28px;" type="checkbox" value="avatar" name="<?php echo $this->get_field_name('avatar'); ?>" id="<?php echo $this->get_field_id('avatar'); ?>" <?php if ( 'avatar' == $instance['avatar'] ) { echo 'checked="checked"'; } ?>> <?php _e('Show profile image?', 'kebo_twitter'); ?> </p>
        </label>

        <label for="<?php echo $this->get_field_id('conversations'); ?>">
            <p><input style="width: 28px;" type="checkbox" value="true" name="<?php echo $this->get_field_name('conversations'); ?>" id="<?php echo $this->get_field_id('conversations'); ?>" <?php if ( 'true' == $instance['conversations'] ) { echo 'checked="checked"'; } ?>> <?php _e('Show conversations?', 'kebo_twitter'); ?> </p>
        </label>

        <label for="<?php echo $this->get_field_id('media'); ?>">
            <p><input style="width: 28px;" type="checkbox" value="true" name="<?php echo $this->get_field_name('media'); ?>" id="<?php echo $this->get_field_id('media'); ?>" <?php if ( 'true' == $instance['media'] ) { echo 'checked="checked"'; } ?>> <?php _e('Show media? (only Lists)', 'kebo_twitter'); ?> </p>
        </label>

        <?php
    }

    /*
     * Validates and Updates Options
     */
    function update( $new_instance, $old_instance ) {
        
        $instance = array();
        
        // Use old figures in case they are not updated.
        $instance = $old_instance;
        
        // Update text inputs and remove HTML.
        $instance['title'] = wp_filter_nohtml_kses( $new_instance['title'] );
        $instance['style'] = intval( $new_instance['style'] );
        $instance['theme'] = wp_filter_nohtml_kses( $new_instance['theme'] );
        $instance['avatar'] = wp_filter_nohtml_kses( $new_instance['avatar'] );
        $instance['conversations'] = wp_filter_nohtml_kses( $new_instance['conversations'] );
        $instance['media'] = wp_filter_nohtml_kses( $new_instance['media'] );
        $instance['display'] = wp_filter_nohtml_kses( $new_instance['display'] );
        
        // Check 'count' is numeric.
        if ( is_numeric( $new_instance['count'] ) ) {
            
            // If 'count' is above 50 reset to 50.
            if ( 50 <= intval( $new_instance['count'] ) ) {
                $new_instance['count'] = 50;
            }
            
            // If 'count' is below 1 reset to 1.
            if ( 1 >= intval( $new_instance['count'] ) ) {
                $new_instance['count'] = 1;
            }
            
            // Update 'count' using intval to remove decimals.
            $instance['count'] = intval( $new_instance['count'] );
            
        }
        
        return $instance;
    }

}