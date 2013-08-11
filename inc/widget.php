<?php
/*
 * Twitter Feed Widget
 */

/*
 * Only register Widget if connection has been made to our Twitter App.
 */
if ( false !== ( $twitter_data = get_transient( 'kebo_twitter_connection_' . get_current_blog_id() ) ) ) {
    
    add_action('widgets_init', 'kebo_twitter_register_widget');
    
    function kebo_twitter_register_widget() {
        
        register_widget( 'Kebo_Twitter_Feed_Widget' );
        
    }
            
}

class Kebo_Twitter_Feed_Widget extends WP_Widget {

    function Kebo_Twitter_Feed_Widget() {

        $widget_ops = array(
            'classname' => 'kebo_twitter_feed_widget',
            'description' => __('Displays your Twitter Feed on your website.', 'kebo_twitter')
        );

        $this->WP_Widget( false, __('Kebo Twitter Feed', 'kebo_twitter'), $widget_ops );
        
    }

    /*
     * Outputs Content
     */
    function widget($args, $instance) {
        
        extract($args, EXTR_SKIP);
        
        // Enqueue Style Sheet
        wp_enqueue_style( 'kebo-twitter-plugin' );
        
        /*
         * Get tweets from transient and refresh if its expired.
         */
        if ( false === ( $tweets = kebo_twitter_get_tweets() ) )
            return;
        
        // Output opening Widget HTML
        echo $before_widget;
        
        // If Title is set, output it with Widget title opening and closing HTML
        if (isset($instance['title']) && !empty($instance['title'])) {

            echo $before_title;
            echo $instance['title'];
            echo $after_title;
            
        }
        
        /*
         * Check which Style (Slider/List) has been chosen and use correct view file, default List.
         */
        if ( 2 == $instance['style'] ) {
            
            require( KEBO_TWITTER_PLUGIN_PATH . 'views/slider.php' );
            
        } else {
            
            require( KEBO_TWITTER_PLUGIN_PATH . 'views/list.php' );
            
        }
        
        // Output closing Widget HTML
        echo $after_widget;
        
    }

    /*
     * Outputs Options Form
     */
    function form($instance) {
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
            
        ?>
        
        <label for="<?php echo $this->get_field_id('title'); ?>">
            <p><?php _e('Title', 'kebo_twitter'); ?>: <input style="width: 100%;" type="text" value="<?php echo $instance['title']; ?>" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>"></p>
        </label>

        <label for="<?php echo $this->get_field_id('style'); ?>">
            <p>
                <?php _e('Style', 'kebo_twitter'); ?>:
                <select style="width: 108px;" id="<?php echo $this->get_field_id('style') ?>" name="<?php echo $this->get_field_name('style'); ?>">
                    <option value="1" <?php if ( 1 == $instance['style'] ) { echo 'selected="selected"'; } ?>><?php _e('List', 'kebo_twitter'); ?></option>
                    <option value="2" <?php if ( 2 == $instance['style'] ) { echo 'selected="selected"'; } ?>><?php _e('Slider', 'kebo_twitter'); ?></option>
                </select>
            </p>
        </label>

        <label for="<?php echo $this->get_field_id('theme'); ?>">
            <p>
                <?php _e('Theme', 'kebo_twitter'); ?>:
                <select style="width: 108px;" id="<?php echo $this->get_field_id('theme') ?>" name="<?php echo $this->get_field_name('theme'); ?>">
                    <option value="light" <?php if ( 'light' == $instance['theme'] ) { echo 'selected="selected"'; } ?>><?php _e('Light', 'kebo_twitter'); ?></option>
                    <option value="dark" <?php if ( 'dark' == $instance['theme'] ) { echo 'selected="selected"'; } ?>><?php _e('Dark', 'kebo_twitter'); ?></option>
                </select>
            </p>
        </label>

        <label for="<?php echo $this->get_field_id('count'); ?>">
            <p><?php _e('Number Of Tweets', 'kebo_twitter'); ?>: <input style="width: 28px;" type="text" value="<?php echo $instance['count']; ?>" name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>"><span> <?php _e('Range 1-50', 'kebo_twitter') ?></span></p>
        </label>

        <label for="<?php echo $this->get_field_id('avatar'); ?>">
            <p><input style="width: 28px;" type="checkbox" value="avatar" name="<?php echo $this->get_field_name('avatar'); ?>" id="<?php echo $this->get_field_id('avatar'); ?>" <?php if ( 'avatar' == $instance['avatar'] ) { echo 'checked="checked"'; } ?>> <?php _e('Show profile image?', 'kebo_twitter'); ?> </p>
        </label>

        <?php
    }

    /*
     * Validates and Updates Options
     */
    function update($new_instance, $old_instance) {
        
        $instance = array();
        
        // Use old figures in case they are not updated.
        $instance = $old_instance;
        
        // Update text inputs and remove HTML.
        $instance['title'] = wp_filter_nohtml_kses( $new_instance['title'] );
        $instance['style'] = wp_filter_nohtml_kses( $new_instance['style'] );
        $instance['theme'] = wp_filter_nohtml_kses( $new_instance['theme'] );
        $instance['avatar'] = wp_filter_nohtml_kses( $new_instance['avatar'] );
        
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