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

    <div>
        <input type="button" name="save-btn" id="save-btn" class="button-primary" value="Save">
        <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Add New Images">
    </div>
    <!-- <div id="success-message" class="notice notice-success is-dismissible">
        <p>asd</p>
    </div> -->
</div>
<style>

</style>
<script type="text/javascript">
</script>
    
    <?php
}

// Function to print slider
function rtsa_slider_preview() {
    $images = get_option('rtsa_images');
    echo '<div id="slider-container" style="max-width:600px;"><ul id="lightSlider">';
    if($images)
    {
        foreach($images as $image)
        {
            $thumb_url = wp_get_attachment_thumb_url($image);
            $url = wp_get_attachment_url($image);
            echo "<li data-thumb='$thumb_url'><img class='slider-items' src='$url' width='600px'/></li>";
        }
    }
    echo '</ul></div>';
}

// Function to display images in "Images section"
function rtsa_display_images() {
    $images = get_option('rtsa_images');
    echo '<ul id="sortable">';
    if($images)
    {
        foreach($images as $image)
        {
            $thumb_url = wp_get_attachment_thumb_url($image);
            $fullsize_url = wp_get_attachment_url($image);
            echo "<li class='ui-state-default' data-id='$image' data-thumbnail='$thumb_url' data-fullsize='$fullsize_url'>
            <img src='$thumb_url' />
            </li>";
        }
    }
    echo '</ul>';
}

// Function called at the beggining of the script 
function rtsa_settings_page()
{
    // register_setting('rtsa', 'rtsa_images');
    
    add_settings_section('rtsa_preview', 'Slider Live Preview', 'rtsa_slider_preview', 'rtsa' );
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
    check_ajax_referer('rtsa_ajax_nonce','nonce');
    
    $images = $_POST['images'];
    if(isset($images) && gettype($images) === 'array' && rtsa_validate_ints($images))
    {
        update_option('rtsa_images', $images);
    }    
    wp_die();
}
// function to validate integers
function rtsa_validate_ints($images)
{
    foreach($images as $image)
    {
        $result = intval($image) ? true : false;
        
        if($result === false)
            return false;
    }
    return true;
}
add_action('wp_ajax_rtsa_update_images','rtsa_ajax_update_images');

function rtsa_register_scripts()
{
    wp_register_script('rtsa-slider-script', plugins_url('/node_modules/lightslider/dist/js/lightslider.min.js', __FILE__ ), array('jquery'));
    wp_enqueue_script('rtsa-slider-script');
    wp_register_script('rtsa-script', plugins_url('/rtcamp-slideshow-script.js', __FILE__ ), array('jquery', 'jquery-ui-core', 'rtsa-slider-script'));
    wp_enqueue_script('rtsa-script');

    wp_register_style('rtsa-slider-style', plugins_url('/node_modules/lightslider/dist/css/lightslider.min.css', __FILE__ ));
    wp_enqueue_style('rtsa-slider-style');
    wp_register_style('rtsa-style', plugins_url('/rtcamp-slideshow-style.css', __FILE__ ));
    wp_enqueue_style('rtsa-style');

    wp_localize_script('rtsa-script','rtsa', array(
        'nonce' => wp_create_nonce('rtsa_ajax_nonce')        
    ));
}
add_action('admin_enqueue_scripts', 'rtsa_register_scripts');