jQuery(document).ready(function($){
    $(function(){
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
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
            });
        });
    });
});