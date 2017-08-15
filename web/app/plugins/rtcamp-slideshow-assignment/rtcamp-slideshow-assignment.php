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
  #sortable { list-style-type: none; display: inline-block}
  #sortable li { margin: 3px 3px 0 0; 
  /* padding: 1px;  */
  float: left; }
</style>
<script type="text/javascript">
jQuery(document).ready(function($){
$( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
} );
    $('#upload-btn').click(function(e) {
        e.preventDefault();
        frame = wp.media({ 
            title: 'Select Image',
            multiple: true
        });
        frame.on('open', function () {
            // var selection = frame.state().get('selection');
            // ids = jQuery('#my_field_id').val().split(',');
            
            // ids.forEach(function(id) {
            //     attachment = wp.media.attachment(id);
            //     attachment.fetch();
            //     selection.add( attachment ? [ attachment ] : [] );
            // });
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an array
            var selected_images = frame.state().get('selection');
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            console.log(selected_images.toJSON());
            $('#sortable').empty();            
            selected_images.forEach(function(image){
                console.log(image);
                var img = $("<img />").attr('src', image.attributes.sizes.thumbnail.url)
                .on('load', function() {
                    if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
                        alert('broken image!');
                    } else {
                        var item = ` <li class="ui-state-default">${img[0].outerHTML}</li>`;
                        $('#sortable').append(item);
                        // $("#something").append(img);
                    }
                });

            })
        });
    });
});
</script>
    
    <?php
}

function rtsa_slider_preview() {
    // Print HTML code of slider
}

function rtsa_display_images() {

}

function rtsa_settings_page()
{
    add_settings_section('rtsa_preview', 'Slider Preview', 'rtsa_slider_preview', 'rtsa' );
    add_settings_section('rtsa_images', 'Images', 'rtsa_display_images', 'rtsa' );
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