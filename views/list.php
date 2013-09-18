<?php
/*
 * HTML output for the Vertical List style of widget.
 */
?>

<?php $classes = 'kebo-tweets list ' . $instance['theme']; ?>

<ul class="<?php echo $classes; ?>">
        
    <?php $i = 0; ?>
    
    <?php
    $options = kebo_get_twitter_options();
    $format = $options['kebo_twitter_date_format'];
    ?>
    
    <?php if ( isset( $tweets[0]->created_at ) ) : ?>
        
        <?php
        // Skip if no Tweet Data
        if ( ! isset( $tweet->created_at ) ) {
            continue;
        }
        ?>
    
        <?php foreach ($tweets as $tweet) : ?>

            <?php
            // Prepare Date Formats
            if ( date( 'Ymd' ) == date( 'Ymd', strtotime( $tweet->created_at ) ) ) {
                    
                // Covert created at date into timeago format
                $created = human_time_diff( date( 'U', strtotime( $tweet->created_at ) ), current_time( 'timestamp', $gmt = 1 ) );
                    
            } else {
                    
                // Convert created at date into easily readable format.
                $created = date( $format, strtotime( $tweet->created_at ) );
                    
            }
            
            // Check if we should display replies and hide if so and this is a reply.
            if ( ! true == $instance['conversations'] && ( ! empty( $tweet->in_reply_to_screen_name ) || ! empty( $tweet->in_reply_to_user_id_str ) || ! empty( $tweet->in_reply_to_status_id_str ) ) )
                continue; // skip this loop without changing the counter
            
            ?>

            <li class="ktweet">

                <div class="kmeta">
                    <a class="kaccount" href="https://twitter.com/<?php echo $tweet->user->screen_name; ?>" target="_blank">@<?php echo $tweet->user->screen_name; ?></a>
                    <a class="kdate" href="https://twitter.com/<?php echo $tweet->user->screen_name; ?>/statuses/<?php echo $tweet->id_str; ?>" target="_blank">
                        <time title="<?php _e('Time posted'); ?>: <?php echo date_i18n( 'dS M Y H:i:s', strtotime( $tweet->created_at ) + $tweet->user->utc_offset ); ?>" datetime="<?php echo date_i18n( 'c', strtotime( $tweet->created_at ) + $tweet->user->utc_offset ); ?>" aria-label="<?php _e('Posted on '); ?><?php echo date_i18n( 'dS M Y H:i:s', strtotime( $tweet->created_at ) + $tweet->user->utc_offset ); ?>"><?php echo $created; ?></time>
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
            
            <p><?php _e( 'The Tweet data is not in the expected format.', 'kebo_twitter' ); ?></p>
            
    <?php endif; ?>
        
    <?php unset( $tweets ); ?>

</ul>