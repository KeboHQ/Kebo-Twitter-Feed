<?php
/*
 * HTML output for the Horizontal Slider style of widget.
 */
?>

<?php
// Prepare Classes
$classes[] = 'kebo-tweets';
$classes[] = 'slider';
$classes[] = $instance['theme'];
if ( is_rtl() ) {
    $classes[] = 'rtl';
}
?>

<ul class="<?php echo implode(' ', $classes); ?>" id="kebo-tweet-slider" data-timer="10000" data-transition="1000" data-animation="fade">

    <?php $i = 0; ?>
    
    <?php
    $options = kebo_get_twitter_options();
    $format = get_option( 'date_format' );
    $corruption = 0;
    //$lang = mb_substr( get_bloginfo('language'), 0, 2 );// Needed for follow button
    ?>
        
    <?php if ( ! empty( $tweets->{0}->created_at ) ) : ?>
    
        <?php foreach ( $tweets as $tweet ) : ?>

            <?php
            // Skip if no Tweet data.
            if ( empty( $tweet->created_at ) ) {
                $corruption++;
                continue;
            }
            if ( 'tweets' == $instance['display'] ) {
                // Skip Re-Tweets
                if ( ! empty( $tweet->retweeted_status ) ) {
                    continue;
                }
            } elseif ( 'retweets' == $instance['display'] ) {
                // Skip Normal Tweets
                if ( empty( $tweet->retweeted_status ) ) {
                    continue;
                }
            }
            ?>
    
            <?php
            // Prepare Date Formats
            if ( date( 'Ymd' ) == date( 'Ymd', strtotime( $tweet->created_at ) ) ) {
                    
                // Covert created at date into timeago format
                $created = human_time_diff( date( 'U', strtotime( $tweet->created_at ) ), current_time( 'timestamp', $gmt = 1 ) );
                    
            } else {
                    
                // Convert created at date into easily readable format.
                $created = date_i18n( $format, strtotime( $tweet->created_at ) );
                    
            }
            // Prepare Avatar URL
            if ( is_ssl() ) {
                
                $profile_image = ( isset( $tweet->retweeted_status ) ) ? $tweet->retweeted_status->user->profile_image_url_https : $tweet->user->profile_image_url_https ;
            
            } else {
                
                $profile_image = ( isset( $tweet->retweeted_status ) ) ? $tweet->retweeted_status->user->profile_image_url : $tweet->user->profile_image_url ;
                
            }
            
            // Check if we should display replies and hide if so and this is a reply.
            if ( ! true == $instance['conversations'] && ( ! empty( $tweet->in_reply_to_screen_name ) || ! empty( $tweet->in_reply_to_user_id_str ) || ! empty( $tweet->in_reply_to_status_id_str ) ) ) {
                continue; // skip this loop without changing the counter
            }
            
            ?>

            <li class="ktweet" style="display: none;">

                <div class="kmeta">
                    <a class="kaccount" href="https://twitter.com/<?php echo ( ! empty( $tweet->retweeted_status ) ) ? $tweet->retweeted_status->user->screen_name : $tweet->user->screen_name ; ?>" target="_blank">@<?php echo ( ! empty( $tweet->retweeted_status ) ) ? $tweet->retweeted_status->user->screen_name : $tweet->user->screen_name ; ?></a>
                    <a class="kdate" href="https://twitter.com/<?php echo ( ! empty( $tweet->retweeted_status ) ) ? $tweet->retweeted_status->user->screen_name : $tweet->user->screen_name ; ?>/statuses/<?php echo ( ! empty( $tweet->retweeted_status ) ) ? $tweet->retweeted_status->id_str : $tweet->id_str ; ?>" target="_blank">
                        <time title="<?php _e( 'Time posted', 'kebo_twitter' ); ?>: <?php echo date_i18n( 'dS M Y H:i:s', strtotime( $tweet->created_at ) + $tweet->user->utc_offset ); ?>" datetime="<?php echo date_i18n( 'c', strtotime( $tweet->created_at ) + $tweet->user->utc_offset ); ?>" aria-label="<?php _e('Posted on ', 'kebo_twitter'); ?><?php echo date_i18n( 'dS M Y H:i:s', strtotime( $tweet->created_at ) + $tweet->user->utc_offset ); ?>"><?php echo $created; ?></time>
                    </a>
                </div>

                <p class="ktext">
                    <?php if ( 'avatar' == $instance['avatar'] ) : ?>
                        <a href="https://twitter.com/<?php echo ( isset( $tweet->retweeted_status ) ) ? $tweet->retweeted_status->user->screen_name : $tweet->user->screen_name ; ?>" title="<?php echo ( ! empty( $tweet->retweeted_status ) ) ? $tweet->retweeted_status->user->name : $tweet->user->name ; ?> @<?php echo ( ! empty( $tweet->retweeted_status ) ) ? $tweet->retweeted_status->user->screen_name : $tweet->user->screen_name ; ?>" target="_blank">
                            <img class="kavatar" src="<?php echo $profile_image; ?>" alt="<?php echo ( ! empty( $tweet->retweeted_status ) ) ? $tweet->retweeted_status->user->name : $tweet->user->name ; ?>" />
                        </a>
                    <?php endif; ?>
                    <?php echo ( ! empty( $tweet->retweeted_status ) ) ? $tweet->retweeted_status->text : $tweet->text ; ?>
                </p>

                <div class="kfooter">
                    <a class="kreply" title="<?php _e('Reply', 'kebo_twitter'); ?>" href="https://twitter.com/intent/tweet?in_reply_to=<?php echo $tweet->id_str; ?>"></a>
                    <a class="kretweet" title="<?php _e('Re-Tweet', 'kebo_twitter'); ?>" href="https://twitter.com/intent/retweet?tweet_id=<?php echo ( isset( $tweet->retweeted_status ) ) ? $tweet->retweeted_status->id_str : $tweet->id_str ; ?>"></a>
                    <a class="kfavorite" title="<?php _e('Favorite', 'kebo_twitter'); ?>" href="https://twitter.com/intent/favorite?tweet_id=<?php echo $tweet->id_str; ?>"></a>
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