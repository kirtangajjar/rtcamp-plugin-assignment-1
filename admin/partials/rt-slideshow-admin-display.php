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

<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<?php do_settings_sections( $this->plugin_name ); ?>
	<div>
		<input type="button" name="save-btn" id="save-btn" class="button-primary" value="Save">
		<input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Add New Images">
	</div>
</div>
