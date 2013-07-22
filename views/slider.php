<?php
/*
 * HTML output for the Horizontal Slider style of widget.
 */

// Requires jQuery
wp_enqueue_script('jquery');
// Prints Slider Javascript using 'wp_footer' hook.
kebo_twitter_print_js();
?>

<?php if ( 'light' == $instance['theme'] ) { ?>
    <ul class="kebo-tweets light slider" id="kebo-tweet-slider">
<?php } elseif ( 'dark' == $instance['theme'] ) { ?>
    <ul class="kebo-tweets dark slider" id="kebo-tweet-slider">
<?php } else { ?>
    <ul class="kebo-tweets light slider" id="kebo-tweet-slider">
<?php } ?>

    <?php $i = 0; ?>
        
    <?php foreach ($tweets as $tweet) : ?>

        <?php
        // Convert created at date into easily readable format.
        $created = date('jS M', strtotime($tweet->created_at));
        ?>

        <li class="tweet" id="kebo-tweet-slider">

            <div class="meta">
                <a class="account" href="https://twitter.com/<?php echo $tweet->user->screen_name; ?>" target="_blank">@<?php echo $tweet->user->screen_name; ?></a>
                <a class="date" href="https://twitter.com/<?php echo $tweet->user->screen_name; ?>/statuses/<?php echo $tweet->id_str; ?>" target="_blank">
                    <time title="<?php _e('Time posted', 'kebo_twitter'); ?>: <?php echo date('dS M Y H:i:s e', strtotime($tweet->created_at)); ?>" datetime="<?php echo date('c', strtotime($tweet->created_at)); ?>" aria-label="<?php _e('Posted on '); ?><?php echo $created; ?>"><?php echo $created; ?></time>
                </a>
            </div>

            <p class="text">
                <?php if ( 'avatar' == $instance['avatar'] ) : ?>
                    <img class="avatar" src="<?php echo $tweet->user->profile_image_url; ?>" />
                <?php endif; ?>
                <?php echo $tweet->text; ?>
            </p>
            
            <div class="footer">
                <?php if ( 'timeago' == $instance['timeago'] ) : ?>
                    <span class="timeago"><?php echo human_time_diff( date('U', strtotime($tweet->created_at)), current_time('timestamp') ) . ' ago'; ?></span>
                <?php endif; ?>
                <a class="reply" title="<?php _e('Reply'); ?>" href="javascript:void(window.open('https://twitter.com/intent/tweet?in_reply_to=<?php echo $tweet->id_str; ?>', 'twitter', 'width=600, height=400'));"></a>
                <a class="retweet" title="<?php _e('Re-Tweet'); ?>" href="javascript:void(window.open('https://twitter.com/intent/retweet?tweet_id=<?php echo $tweet->id_str; ?>', 'twitter', 'width=600, height=400'));"></a>
                <a class="favourite" title="<?php _e('Favourite'); ?>" href="javascript:void(window.open('https://twitter.com/intent/favorite?tweet_id=<?php echo $tweet->id_str; ?>', 'twitter', 'width=600, height=400'));"></a>
            </div>

        </li>
        
        <?php if ( ++$i == $instance['count'] ) break; ?>

    <?php endforeach; ?>
        
    <?php unset( $tweets ); ?>

</ul>