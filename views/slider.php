<?php
/*
 * HTML output for the Horizontal Slider style of widget.
 */

// Requires jQuery
wp_enqueue_script('jquery');
// Prints Slider Javascript using 'wp_footer' hook.
kebo_twitter_print_js();
?>

<?php
$classes[] = 'kebo-tweets';
$classes[] = 'slider';
$classes[] = $instance['theme'];
?>

<ul class="<?php echo implode(' ', $classes); ?>" id="kebo-tweet-slider" data-timer="10000" data-transition="1000" data-animation="fade">

    <?php $i = 0; ?>
        
    <?php if ( isset($tweets[0]->created_at ) ) : ?>
        
        <?php foreach ($tweets as $tweet) : ?>

            <?php
                if ( date( 'Ymd' ) == date( 'Ymd', strtotime($tweet->created_at) ) ) {
                    // Covert created at date into timeago format
                    $created = human_time_diff( date('U', strtotime($tweet->created_at)), current_time('timestamp') );
                } else {
                    // Convert created at date into easily readable format.
                    $created = date('jS M', strtotime($tweet->created_at));
                }
            ?>

            <li class="ktweet">

                <div class="kmeta">
                    <a class="kaccount" href="https://twitter.com/<?php echo $tweet->user->screen_name; ?>" target="_blank">@<?php echo $tweet->user->screen_name; ?></a>
                    <a class="kdate" href="https://twitter.com/<?php echo $tweet->user->screen_name; ?>/statuses/<?php echo $tweet->id_str; ?>" target="_blank">
                        <time title="<?php _e('Time posted'); ?>: <?php echo date('dS M Y H:i:s e', strtotime($tweet->created_at)); ?>" datetime="<?php echo date('c', strtotime($tweet->created_at)); ?>" aria-label="<?php _e('Posted on '); ?><?php echo date('jS M', strtotime($tweet->created_at)); ?>"><?php echo $created; ?></time>
                    </a>
                </div>

                <p class="ktext">
                    <?php if ( 'avatar' == $instance['avatar'] ) : ?>
                        <a href="https://twitter.com/<?php echo $tweet->user->screen_name; ?>" target="_blank">
                            <img class="kavatar" src="<?php echo $tweet->user->profile_image_url; ?>" />
                        </a>
                    <?php endif; ?>
                    <?php echo $tweet->text; ?>
                </p>

                <div class="kfooter">
                    <a class="kreply" title="<?php _e('Reply'); ?>" href="javascript:void(window.open('https://twitter.com/intent/tweet?in_reply_to=<?php echo $tweet->id_str; ?>', 'twitter', 'width=600, height=400'));"></a>
                    <a class="kretweet" title="<?php _e('Re-Tweet'); ?>" href="javascript:void(window.open('https://twitter.com/intent/retweet?tweet_id=<?php echo $tweet->id_str; ?>', 'twitter', 'width=600, height=400'));"></a>
                    <a class="kfavourite" title="<?php _e('Favourite'); ?>" href="javascript:void(window.open('https://twitter.com/intent/favorite?tweet_id=<?php echo $tweet->id_str; ?>', 'twitter', 'width=600, height=400'));"></a>
                </div>

            </li>

            <?php if ( ++$i == $instance['count'] ) break; ?>

        <?php endforeach; ?>
        
    <?php else : ?>
            
            <p><?php _e('Sorry, no Tweets were found.', 'kebo_twitter'); ?></p>
            
    <?php endif; ?>
        
    <?php unset( $tweets ); ?>

</ul>