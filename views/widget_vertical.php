<?php
/*
 * HTML output for the Vertical List style of widget.
 */
?>

<ul class="kebo-tweets vertical">
    
<?php foreach ($tweets as $tweet) : ?>

    <?php
    // Convert created at date into easily readable format.
    $created = date( 'dS M', strtotime( $tweet->created_at ) );
    ?>
    
    <li class="tweet">
        
        <div>
            <a class="tweet-account" href="https://twitter.com/<?php echo $tweet->user->screen_name; ?>" target="_blank">@<?php echo $tweet->user->screen_name; ?></a>
            <a class="tweet-date" href="https://twitter.com/<?php echo $tweet->user->screen_name; ?>/statuses/<?php echo $tweet->id_str; ?>" target="_blank">
                <time title="<?php echo __('Time posted'); ?>: <?php echo date( 'dS M Y H:i:s e', strtotime( $tweet->created_at ) ); ?>" datetime="<?php echo date( 'c', strtotime( $tweet->created_at ) ); ?>" aria-label="<?php echo __('Posted on '); ?><?php echo $created; ?>"><?php echo $created; ?></time>
            </a>
        </div>
        
        <p class="tweet-text"><?php echo $tweet->text; ?></p>
        
        <div class="links">
            <a title="<?php echo __('Reply'); ?>" href="javascript:void(window.open('https://twitter.com/intent/tweet?in_reply_to=<?php echo $tweet->id_str; ?>', 'twitter', 'width=600, height=400'));">Reply</a>
            <a title="<?php echo __('Re-Tweet'); ?>" href="javascript:void(window.open('https://twitter.com/intent/retweet?tweet_id=<?php echo $tweet->id_str; ?>', 'twitter', 'width=600, height=400'));">Re-Tweet</a>
            <a title="<?php echo __('Favourite'); ?>" href="javascript:void(window.open('https://twitter.com/intent/favorite?tweet_id=<?php echo $tweet->id_str; ?>', 'twitter', 'width=600, height=400'));">Favourite</a>
        </div>

    </li>
    
<?php endforeach; ?>
    
</ul>