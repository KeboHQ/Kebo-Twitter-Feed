<?php

/*
 * Uninstall - Removed Options and Transients.
 */

function kebo_twitter_uninstall() {

    // Check for Un-Install constant.
    if (!defined('WP_UNINSTALL_PLUGIN'))
        exit();

    // Delete the Option we registered.
    delete_option('kebo_twitter_options');

    // Delete the Transient we registered.
    delete_transient('kebo_twitter_connection');
    
}