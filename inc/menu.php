<?php

/*
 * Registers and Renders the Menu page.
 */

function kebo_twitter_menu() {

    add_menu_page(
            __('Kebo Twitter', 'kebo_twitter'), // Page Title
            __('Kebo Twitter', 'kebo_twitter'), // Menu Title
            'manage_options', // Capability
            'kebo-twitter', // Menu Slug
            'kebo_twitter_menu_render', // Render Function
            null, // Icon URL
            '99.000083849' // Menu Position (use decimals to ensure no conflicts
    );

}

add_action('admin_menu', 'kebo_twitter_menu');

/**
 * Renders the Twitter Feed Options page.
 */
function kebo_twitter_menu_render() {
    
    if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
        
    if (isset($_GET['service']) && isset($_GET['token'])) :

            $userid = $_GET['userid'];
            $account = $_GET['account'];
            $account_link = $_GET['account_link'];

            $data = array(
                'service' => $_GET['service'],
                'token' => $_GET['token'],
                'secret' => $_GET['secret'],
                'expires' => $expires,
                'account' => $account,
                'account_link' => $account_link,
                'userid' => $userid,
            );

            set_transient('kebo_twitter_connection', $data, 10 * YEAR_IN_SECONDS);
            ?>
            <div class="updated">
                <p><?php echo __( 'Connection established with Twitter.', 'kebo_twitter' ); ?></p>
            </div>
            <?php
        endif;

        if ( isset( $_GET['reset'] ) && 'true' == $_GET['reset'] ) :

            if ( 'true' == $_GET['reset'] ) :

                delete_transient( 'kebo_twitter_connection' );
                ?>
                <div class="updated">
                    <p><?php echo __( 'Connection reset to Twitter.', 'kebo_twitter' ); ?></p>
                </div>
                <?php
            endif;

        endif;
        
    ?>
    <div class="wrap">
        <?php screen_icon('options-general'); ?>
        <h2><?php echo __('Twitter Feed', 'kebo_twitter'); ?></h2>
            <?php settings_errors(); ?>

        <form method="post" action="options.php">
            <?php
            settings_fields('kebo_twitter_options');
            do_settings_sections('kebo-twitter');
            submit_button();
            ?>
        </form>
    </div>
    <?php
    
}