<?php
/*
 * Twitter Feed Widget
 */

/*
 * Only register Widget if connection has been made to our Twitter App.
 */
if ( false !== ( $twitter_data = get_transient( 'kebo_twitter_connection' ) ) ) {
    
    add_action( 'widgets_init', function() {
        register_widget( 'Kebo_Twitter_Feed_Widget' );
    });
            
}

class Kebo_Twitter_Feed_Widget extends WP_Widget {

    function Kebo_Twitter_Feed_Widget() {

        $widget_ops = array(
            'classname' => 'kebo_twitter_feed_widget',
            'description' => __('Displays a list of your most recent Tweets.', 'kebo_twitter')
        );

        $this->WP_Widget(false, __('Kebo Twitter Feed', 'kebo_twitter'), $widget_ops);
    }

    /*
     * Outputs Content
     */
    function widget($args, $instance) {

        extract($args, EXTR_SKIP);
        
        /*
         * Get tweets from transient and refresh is its expired.
         */
        if ( false === ( $tweets = get_transient('kebo_twitter_feed') )) {
            
            $tweets = kebo_twitter_get_tweets();
        
        }
        
        if ( 2 == $instance['style'] ) {
            
            require_once( KEBO_TWITTER_PLUGIN_PATH . 'views/widget_horizontal.php' );
            
        } else {
            
            require_once( KEBO_TWITTER_PLUGIN_PATH . 'views/widget_vertical.php' );
            
        }
        
    }

    /*
     * Outputs Options Form
     */
    function form($instance) {
        ?>
        
        <label for="<?php echo $this->get_field_id('title'); ?>">
            <p><?php echo __('Title', 'kebo_twitter'); ?>: <input style="width: 100%;" type="text" value="<?php echo $instance['title']; ?>" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>"></p>
        </label>

        <label for="<?php echo $this->get_field_id('style'); ?>">
            <p>
                <?php echo __('Style', 'kebo_twitter'); ?>:
                <select id="<?php echo $this->get_field_id('style') ?>" name="<?php echo $this->get_field_name('style'); ?>">
                    <option value="1" <?php if ( 1 == $instance['style'] ) { echo 'selected="selected"'; } ?>><?php echo __('Vertical List', 'kebo_twitter'); ?></option>
                    <option value="2" <?php if ( 2 == $instance['style'] ) { echo 'selected="selected"'; } ?>><?php echo __('Horizontal Slider', 'kebo_twitter'); ?></option>
                </select>
            </p>
        </label>

        <label for="<?php echo $this->get_field_id('theme'); ?>">
            <p>
                <?php echo __('Theme', 'kebo_twitter'); ?>:
                <select style="width: 108px;" id="<?php echo $this->get_field_id('theme') ?>" name="<?php echo $this->get_field_name('theme'); ?>">
                    <option value="light" <?php if ( 'light' == $instance['theme'] ) { echo 'selected="selected"'; } ?>><?php echo __('Light', 'kebo_twitter'); ?></option>
                    <option value="dark" <?php if ( 'dark' == $instance['theme'] ) { echo 'selected="selected"'; } ?>><?php echo __('Dark', 'kebo_twitter'); ?></option>
                </select>
            </p>
        </label>

        <label for="<?php echo $this->get_field_id('count'); ?>">
            <p><?php echo __('Number Of Tweets', 'kebo_twitter'); ?>: <input style="width: 28px;" type="text" value="<?php echo $instance['count']; ?>" name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>"><span> <?php echo __('Range 1-50', 'kebo_twitter') ?></span></p>
        </label>

        <?php
    }

    /*
     * Validates and Updates Options
     */
    function update($new_instance, $old_instance) {
        
        $instance = array();
        
        $instance = $old_instance;
        
        $instance['title'] = wp_filter_nohtml_kses( $new_instance['title'] );
        $instance['style'] = wp_filter_nohtml_kses( $new_instance['style'] );
        $instance['theme'] = wp_filter_nohtml_kses( $new_instance['theme'] );
        
        if ( is_numeric( $new_instance['count'] ) ) {
            
            if ( 50 <= intval( $new_instance['count'] ) ) {
                $new_instance['count'] = 50;
            }
            
            if ( 1 >= intval( $new_instance['count'] ) ) {
                $new_instance['count'] = 1;
            }
            
            $instance['count'] = intval( $new_instance['count'] );
            
        }
        
        return $instance;
    }

}