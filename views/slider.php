<?php
/*
 * HTML output for the Horizontal Slider style of widget.
 */
?>

<?php
// Prepare Classes
$classes[] = 'kebo-tweets';
$classes[] = 'slider';
$classes[] = $widget_id;
$classes[] = $instance['theme'];
if ( is_rtl() ) {
    $classes[] = 'rtl';
}

$allowed_html = array(
    'a' => array(
        'href' => array(),
        'title' => array(),
        'target' => array()
    )
);
?>

<ul class="<?php echo implode(' ', $classes); ?>" data-timeout="10000" data-speed="1000" data-animation="fade">

    <?php $i = 0; ?>
    
    <?php
    $options = kebo_get_twitter_options();
    $format = get_option( 'date_format' );
    $corruption = 0;
    $count = 0;
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
            // Tweet ID
            $tweet_id = absint( ! empty( $tweet->retweeted_status ) ) ? $tweet->retweeted_status->id_str : $tweet->id_str ;
            // Screen Name
            $screen_name = ( ! empty( $tweet->retweeted_status ) ) ? $tweet->retweeted_status->user->screen_name : $tweet->user->screen_name ;
            // Name
            $name = ( ! empty( $tweet->retweeted_status ) ) ? $tweet->retweeted_status->user->name : $tweet->user->name ;
            
            // Check if we should display replies and hide if so and this is a reply.
            if ( ! true == $instance['conversations'] && ( ! empty( $tweet->in_reply_to_screen_name ) || ! empty( $tweet->in_reply_to_user_id_str ) || ! empty( $tweet->in_reply_to_status_id_str ) ) ) {
                continue; // skip this loop without changing the counter
            }
            
            $count++;
            ?>

            <li class="ktweet" <?php echo ( 1 != $count ) ? 'style="display: none;"' : ''; ?>>

                <div class="kmeta">
                    <a class="kaccount" href="<?php echo esc_url( 'https://twitter.com/' . $screen_name ); ?>" target="_blank">@<?php echo esc_html( $screen_name ); ?></a>
                    <a class="kdate" href="<?php echo esc_url( 'https://twitter.com/' . $screen_name . '/statuses/' . $tweet_id ); ?>" target="_blank">
                        <time title="<?php esc_attr_e( 'Time posted', 'kebo_twitter' ); ?>: <?php echo date_i18n( 'dS M Y H:i:s', strtotime( $tweet->created_at ) + $tweet->user->utc_offset ); ?>" datetime="<?php echo date_i18n( 'c', strtotime( $tweet->created_at ) + $tweet->user->utc_offset ); ?>" aria-label="<?php esc_attr_e('Posted on ', 'kebo_twitter'); ?><?php echo date_i18n( 'dS M Y H:i:s', strtotime( $tweet->created_at ) + $tweet->user->utc_offset ); ?>"><?php echo esc_html ( $created ); ?></time>
                    </a>
                </div>

                <p class="ktext">
                    <?php if ( 'avatar' == $instance['avatar'] ) : ?>
                        <a href="<?php echo esc_url( 'https://twitter.com/' . $screen_name ); ?>" title="<?php echo esc_attr( $name . ' @' . $screen_name ); ?>" target="_blank">
                            <img class="kavatar" src="<?php echo esc_url( $profile_image ); ?>" alt="<?php echo esc_attr( $name ); ?>" />
                        </a>
                    <?php endif; ?>
                    <?php echo wp_kses( ( ! empty( $tweet->retweeted_status ) ) ? $tweet->retweeted_status->text : $tweet->text, $allowed_html ); ?>
                </p>

                <div class="kfooter">
                    <a class="kreply" title="<?php esc_attr_e('Reply', 'kebo_twitter'); ?>" href="<?php echo esc_url( 'https://twitter.com/intent/tweet?in_reply_to=' . $tweet_id ); ?>"></a>
                    <a class="kretweet" title="<?php esc_attr_e('Re-Tweet', 'kebo_twitter'); ?>" href="<?php echo esc_url( 'https://twitter.com/intent/retweet?tweet_id=' . $tweet_id ); ?>"></a>
                    <a class="kfavorite" title="<?php esc_attr_e('Favorite', 'kebo_twitter'); ?>" href="<?php echo esc_url( 'https://twitter.com/intent/favorite?tweet_id=' . $tweet_id ); ?>"></a>
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