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
    wp_enqueue_script('jquery');
    // This will enqueue the Media Uploader script
    wp_enqueue_media();
    ?>
    
<div class="wrap">
    <h1>rtCamp Slideshow Plugin</h1>    
    
    <?php
        do_settings_sections('rtsa');
    ?>
    <ul id="sortable">
    </ul>
    <div>
        <input type="button" name="save-btn" id="save-btn" class="button-primary" value="Save">
        <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Add New Images">
    </div>
</div>
<style>

</style>
<script type="text/javascript">
</script>
    
    <?php
}

function rtsa_slider_preview() {
    // Print HTML code of slider
}

// Function to display images
function rtsa_display_images() {

}

// Function called at the beggining of the script 
function rtsa_settings_page()
{
    // register_setting('rtsa', 'rtsa_images');
    
    add_settings_section('rtsa_preview', 'Slider Preview', 'rtsa_slider_preview', 'rtsa' );
    add_settings_section('rtsa_images', 'Images', 'rtsa_display_images', 'rtsa' );
    add_options_page('rtCamp Slideshow Plugin', 'rtsa', 'manage_options', 'rtsa', 'rtsa_settings_page_html');
}
add_action('admin_menu', 'rtsa_settings_page');

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

// Function to handle AJAX Update image request
function rtsa_ajax_update_images()
{
    echo 'In here!';
    wp_die();
}
add_action('wp_ajax_rtsa_update_images','rtsa_ajax_update_images');

function rtsa_register_scripts()
{
    wp_register_script('rtsa-slider-script', plugins_url('/rtcamp-slideshow-script.js', __FILE__ ), array('jquery', 'jquery-ui-core'));
    wp_enqueue_script('rtsa-slider-script');

    wp_register_style('rtsa-slider-style', plugins_url('/rtcamp-slideshow-style.css', __FILE__ ));
    wp_enqueue_style('rtsa-slider-style');
}
add_action('admin_enqueue_scripts', 'rtsa_register_scripts');