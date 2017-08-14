<?php
/**
 * Plugin Name: rtCamp Slideshow Plugin Assignment
 * Description: A simple plugin that can add slideshow to any post
 * Version: 1.0.0
 * Author: Kirtan Gajjar
 * License: MIT License
 */

/**
 * Displays HTML on plugin setting page
 *
 * @return void
 */
function rtsa_settings_page_html()
{
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    
    <h1>Hello World</h1>
    
    <?php
}

function rtsa_settings_page()
{
    add_options_page('rtCamp Slideshow Plugin', 'Slideshow', 'manage_options', 'Slideshow1', 'rtsa_settings_page_html');
}

add_action('admin_menu', 'rtsa_settings_page');