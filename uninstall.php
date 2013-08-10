<?php
/*
 * Uninstall - Removed Options and Transients.
 */

// Check for Un-Install constant.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
    exit();

if (is_multisite()) {

    global $wpdb;

    // Store Network Site ID so we can get back later.
    $current_blog = get_current_blog_id();

    // Get a list of all Blog IDs, ignore network admin with ID of 1.
    $blogs = $wpdb->get_results("
            SELECT blog_id
            FROM {$wpdb->blogs}
            WHERE site_id = '{$wpdb->siteid}'
            AND spam = '0'
            AND deleted = '0'
            AND archived = '0'
            AND blog_id != '{$current_blog}'
        ");

    foreach ($blogs as $blog) {

        switch_to_blog($blog->blog_id);

        // Delete the Options we registered.
        delete_option('kebo_twitter_options');
        delete_option('kebo_twitter_errors');

        // Delete the Transients we registered.
        delete_transient('kebo_twitter_connection_' . $blog->blog_id);
        delete_transient('kebo_twitter_feed_' . $blog->blog_id);
    }

    // Go back to Network Site
    switch_to_blog($current_blog);
    
} else {

    // Delete the Option we registered.
    delete_option('kebo_twitter_options');

    // Delete the Transients we registered.
    delete_transient('kebo_twitter_connection_1');
    delete_transient('kebo_twitter_feed_1');
}