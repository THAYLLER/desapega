<link href="<?php echo osc_base_url().'oc-content/themes/one/admin/admin.css'; ?>" rel="stylesheet" type="text/css" />
<div id="adminmenu">
	<ul>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/header.php"); ?>"><?php echo __('General settings', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/img_settings.php"); ?>"><?php echo __('Image settings', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/color.php"); ?>"><?php echo __('Color settings', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/settings.php"); ?>"><?php echo __('Ads', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/mobile_image.php"); ?>"><?php echo __('Mobile image', 'one'); ?></a></li>
		<li class="current"><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/log.php"); ?>"><?php echo __('Change log', 'one'); ?></a></li>
	</ul>
</div>
<?php include 'change.html';?>
<div class="author">
	<div>
		<span class="logo"><a href="http://theme.calinbehtuk.ro/"><img src="<?php echo osc_base_url().'oc-content/themes/one/admin/calinbehtuk.png'; ?>" /></a></span>
		<span class="text"><?php _e('2015 All rights reserved ONE Theme by Puiu Calin', 'one'); ?></span>
	</div>
</div>