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
    
    <?php
    $options = kebo_get_twitter_options();
    $format = $options['kebo_twitter_date_format'];
    $corruption = 0;
    ?>
        
    <?php if ( ! empty( $tweets ) ) : ?>
    
        <?php foreach ( $tweets as $tweet ) : ?>

            <?php
            // Skip if corrupted data or Expiry time.
            if ( empty( $tweet->created_at ) ) {
                $corruption++;
                continue;
            }
            ?>
    
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
                    <a class="kreply" title="<?php _e('Reply'); ?>" href="https://twitter.com/intent/tweet?in_reply_to=<?php echo $tweet->id_str; ?>"></a>
                    <a class="kretweet" title="<?php _e('Re-Tweet'); ?>" href="https://twitter.com/intent/retweet?tweet_id=<?php echo $tweet->id_str; ?>"></a>
                    <a class="kfavourite" title="<?php _e('Favourite'); ?>" href="https://twitter.com/intent/favorite?tweet_id=<?php echo $tweet->id_str; ?>"></a>
                </div>

            </li>

            <?php if ( ++$i == $instance['count'] ) break; ?>

        <?php endforeach; ?>
    
    <?php else : ?>
            
            <p><?php _e( 'Sorry, no Tweets were found.', 'kebo_twitter' ); ?></p>
            
    <?php endif; ?>
            
    <?php if ( 1 < $corruption ) : ?>
            
            <p><?php _e( 'Sorry, the Tweet data is not in the expected format.', 'kebo_twitter' ); ?></p>
            
    <?php endif; ?>
            
    <?php unset( $tweets ); ?>

</ul>

<script type="text/javascript">
    
    /*
     * Capture Show/Hide photo link clicks, then show/hide the photo.
     */
    jQuery( '.ktweet .kfooter a:not(.ktogglemedia)' ).click(function(e) {
    
        // Prevent Click from Reloading page
        e.preventDefault();
        
        var href = jQuery(this).attr('href');
        window.open( href, 'twitter', 'width=600, height=400, top=0, left=0');

    });

</script>