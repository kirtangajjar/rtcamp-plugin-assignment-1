<?php
/**
 * Plugin Name: rtCamp Slideshow Plugin Assignment
 * Description: A simple plugin that can add slideshow to any post
 * Version: 1.0.0
 * Author: Kirtan Gajjar
 * License: MIT License
 */

/**
 * I've prefixed every function with rtsa(Rtcamp Slideshow Assignment) to avoid possible namespace collisions
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
    add_options_page('rtCamp Slideshow Plugin', 'rtsa', 'manage_options', 'rtsa', 'rtsa_settings_page_html');
}

function rtsa_shortcodes_init()
{
    function rtsa_shortcode($atts = [], $content = null)
    {
        // do something to $content
        $content .= '<h1>Hello World</h1>';
        // always return
        return $content;
    }
    add_shortcode('rtsa', 'rtsa_shortcode');    
}

add_action('init', 'rtsa_shortcodes_init');
add_action('admin_menu', 'rtsa_settings_page');