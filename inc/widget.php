<?php
/*
 * Twitter Feed Widget
 */

add_action( 'widgets_init', function(){
     register_widget( 'Kebo_Twitter_Feed_Widget' );
});

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
        
            extract( $args, EXTR_SKIP );

            echo $before_widget;

            echo '<h2>Title</h2>';
            echo '<p>sdgsdgsdgsd</p>';
            
            echo $after_widget;
    }
    
    /*
     * Outputs Options Form
     */
    function form($instance) {
        ?>

        <label for="<?php echo $this->get_field_id('style'); ?>">
            <p>
            <?php echo __( 'Style', 'kebo_twitter' ); ?>
            <select id="<?php echo $this->get_field_id('style') ?>" name="<?php echo $this->get_field_name('style'); ?>">
                <option value="1"><?php echo __( 'Vertical List', 'kebo_twitter' ); ?></option>
                <option value="2"><?php echo __( 'Horizontal Slider', 'kebo_twitter' ); ?></option>
            </select>
            </p>
        </label>

        <label for="<?php echo $this->get_field_id('num_tweets'); ?>">
            <p><?php echo __( 'Number Of Tweets', 'kebo_twitter' ); ?> <input  type="text" size="3" value="<?php echo $config['num_tweets']; ?>" name="<?php echo $this->get_field_name('num_tweets'); ?>" id="<?php echo $this->get_field_id('num_tweets'); ?>"></p>
        </label>

        <?php
    }
    
    /*
     * Validates and Updates Options
     */
    function update($new_instance, $old_instance) {

        $instance = $old_instance;
        //update the username
        $instance['username'] = $new_instance['username'];
        $instance['title'] = $new_instance['title'];
        $num = (int) $newinstance['num'];
        $num = intval($num);
        $num = ($num > 1) ? $num : 1;
        $instance['url'] = "http://api.twitter.com/1/statuses/user_timeline.json?screen_name={$newinstance['username']}&count={$num}";
        $instance['num'] = $num;
        return $instance;
    }

}