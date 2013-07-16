<?php
/*
 * HTML output for the Horizontal Slider style of widget.
 */

// Prints Slider Javascript using 'wp_footer' hook.
kebo_twitter_print_js();
// Requires jQuery
wp_enqueue_script('jquery');
?>

<?php echo $before_widget; ?>

<?php
if (isset($instance['title']) && !empty($instance['title'])) {

    echo $before_title;
    echo $instance['title'];
    echo $after_title;
}
?>

<?php if ( 'light' == $instance['theme'] ) { ?>
    <ul class="kebo-tweets light vertical" id="kebo-tweet-slider">
<?php } elseif ( 'dark' == $instance['theme'] ) { ?>
    <ul class="kebo-tweets dark vertical" id="kebo-tweet-slider">
<?php } else { ?>
    <ul class="kebo-tweets light vertical" id="kebo-tweet-slider">
<?php } ?>

    <?php $i = 0; ?>
        
    <?php foreach ($tweets as $tweet) : ?>

        <?php
        // Convert created at date into easily readable format.
        $created = date('dS M', strtotime($tweet->created_at));
        ?>

        <li class="tweet" id="kebo-tweet-slider">

            <div>
                <a class="account" href="https://twitter.com/<?php echo $tweet->user->screen_name; ?>" target="_blank"><?php echo $tweet->user->name; ?> <span>@<?php echo $tweet->user->screen_name; ?></span></a>
                <a class="date" href="https://twitter.com/<?php echo $tweet->user->screen_name; ?>/statuses/<?php echo $tweet->id_str; ?>" target="_blank">
                    <time title="<?php echo __('Time posted'); ?>: <?php echo date('dS M Y H:i:s e', strtotime($tweet->created_at)); ?>" datetime="<?php echo date('c', strtotime($tweet->created_at)); ?>" aria-label="<?php echo __('Posted on '); ?><?php echo $created; ?>"><?php echo $created; ?></time>
                </a>
            </div>

            <p class="text"><?php echo $tweet->text; ?></p>

            <div class="links">
                <a class="reply" title="<?php echo __('Reply'); ?>" href="javascript:void(window.open('https://twitter.com/intent/tweet?in_reply_to=<?php echo $tweet->id_str; ?>', 'twitter', 'width=600, height=400'));"></a>
                <a class="retweet" title="<?php echo __('Re-Tweet'); ?>" href="javascript:void(window.open('https://twitter.com/intent/retweet?tweet_id=<?php echo $tweet->id_str; ?>', 'twitter', 'width=600, height=400'));"></a>
                <a class="favourite" title="<?php echo __('Favourite'); ?>" href="javascript:void(window.open('https://twitter.com/intent/favorite?tweet_id=<?php echo $tweet->id_str; ?>', 'twitter', 'width=600, height=400'));"></a>
            </div>

        </li>
        
        <?php if ( ++$i == $instance['count'] ) break; ?>

    <?php endforeach; ?>
        
    <?php unset( $tweets ); ?>

</ul>

<?php echo $after_widget; ?>