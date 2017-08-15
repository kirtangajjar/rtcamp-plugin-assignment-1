jQuery(document).ready(function($){
    $(function(){
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
    });

    $("#lightSlider").lightSlider({
        pager: true,
        gallery:true,
        item:1,
        thumbItem:9,
        slideMargin: 0,
        speed:500,
        auto:true,
        loop:true,
    });
    
    $('#save-btn').click(function(e){
        var images = [];
        $('#sortable > li').each(function(){
            images.push($(this).attr('data-id'));
        });
        console.log(images);
        var data = {
            'images': images,
            'action': 'rtsa_update_images'
        };
        $.post(wp.ajax.settings.url, data);
        
        // TODO: Add success message

        // .done(function(data) {
        //     $('.wrap > h1').after( `<div id="success-message" class="notice notice-success is-dismissible">
        //     <p>All prefrences saved</p>
        // <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>`) 
        // });
    });

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
            $('#sortable').empty();            
            // This will return the selected image from the Media Uploader, the result is an array
            var selected_images = frame.state().get('selection');
            
            console.log(selected_images.toJSON());
            
            selected_images.forEach(function(image){
                // console.log(image);
                var img = $("<img />").attr('src', image.attributes.sizes.thumbnail.url)
                .on('load', function() {
                    if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
                        alert('received broken image!');
                    } else {
                        var item = `<li class="ui-state-default" data-id="${image.id}">${img[0].outerHTML}</li>`;
                        $('#sortable').append(item);
                        // $("#something").append(img);
                    }
                });
            });
        });
    });
});