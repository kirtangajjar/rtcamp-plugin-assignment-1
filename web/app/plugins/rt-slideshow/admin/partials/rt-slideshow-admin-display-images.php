<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/kirtangajjar
 * @since      1.0.0
 *
 * @package    Rt_Slideshow
 * @subpackage Rt_Slideshow/admin/partials
 */

?>

<?php $images = get_option( 'rtsa_images' ); ?>

<ul id="sortable">
	<?php
	if ( $images ) {

		foreach ( $images as $image ) {

				$thumb_url = wp_get_attachment_thumb_url( $image );
			$fullsize_url = wp_get_attachment_url( $image );

					?>

			<li class='ui-state-default' data-id='<?php echo wp_kses_post( $image ); ?>' 
				data-thumbnail='<?php echo wp_kses_post( $thumb_url ); ?>' data-fullsize='<?php echo wp_kses_post( $fullsize_url ); ?>'>
				<img src='<?php echo wp_kses_post( $thumb_url ); ?>' />
				</li>

								<?php
		}
	}
	?>
</ul>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
