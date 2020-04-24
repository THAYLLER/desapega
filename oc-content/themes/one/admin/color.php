<link href="<?php echo osc_base_url().'oc-content/themes/one/admin/admin.css'; ?>" rel="stylesheet" type="text/css" />
<div id="adminmenu">
	<ul>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/header.php"); ?>"><?php echo __('Configurações Gerais', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/img_settings.php"); ?>"><?php echo __('Configurações de Imagem', 'one'); ?></a></li>
		<li class="current"><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/color.php"); ?>"><?php echo __('Configurações de Cor', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/settings.php"); ?>"><?php echo __('Publicidade', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/mobile_image.php"); ?>"><?php echo __('Mobile imagem', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/log.php"); ?>"><?php echo __('Registro de Alterações', 'one'); ?></a></li>
	</ul>
</div>
<script type="text/javascript" src="<?php echo osc_base_url(). 'oc-content/themes/one/jscolor/jscolor.js'; ?>"></script>
<form action="<?php echo osc_admin_render_theme_url('oc-content/themes/one/admin/color.php'); ?>" method="post" class="nocsrf" style="float:left;width:100%;margin-top:20px;">
    <input type="hidden" name="action_specific" value="color_one" /> 	  
    <fieldset>
		<div class="form-horizontal">
			<h2><?php _e('Configurações de Cor', 'one'); ?></h2>
			
			<h3><?php _e('Geral', 'one'); ?></h3>
			<div class="form-row">
				<div class="form-label"><?php _e('Background color','one'); ?></div>
				<div class="form-controls">
					<input type="text" class="color {hash:true}" name="onebody" id="onebody" value="<?php echo osc_esc_html( osc_get_preference('onebody', 'one') ); ?>" />
				</div>
			</div>
			<?php /*
				<div class="form-row">
				<div class="form-label"><?php _e('Content color','one'); ?></div>
				<div class="form-controls">
				<input type="text" class="color {hash:true}" name="containercolor" id="containercolor" value="<?php echo osc_esc_html( osc_get_preference('containercolor', 'one') ); ?>" />
				</div>
			</div>*/ ?>
			<h3><?php _e('Home page', 'one'); ?></h3>
			<div class="form-row">
				<div class="form-label"><?php _e('Home search bar color','one'); ?></div>
				<div class="form-controls">
					<input type="text" class="color {hash:true}" name="homesearchc" id="homesearchc" value="<?php echo osc_esc_html( osc_get_preference('homesearchc', 'one') ); ?>" />
				</div>
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Save location bar color','one'); ?></div>
				<div class="form-controls">
					<input type="text" class="color {hash:true}" name="savelocationcolor" id="savelocationcolor" value="<?php echo osc_esc_html( osc_get_preference('savelocationcolor', 'one') ); ?>" />
				</div>
			</div>
			<div class="" style="background:#F0F3E7;padding:3px;display:inline-block">
				<div class="form-row">
					<div class="form-label"><?php _e('Search button color','one'); ?></div>
					<div class="form-controls">
						<input type="text" class="color {hash:true}" name="search_button_color" id="search_button_color" value="<?php echo osc_esc_html( osc_get_preference('search_button_color', 'one') ); ?>" />
					</div>
				</div>
				<div class="form-row">
					<div class="form-label"><?php _e('Search button hover color','one'); ?></div>
					<div class="form-controls">
						<input type="text" class="color {hash:true}" name="search_button_hover" id="search_button_hover" value="<?php echo osc_esc_html( osc_get_preference('search_button_hover', 'one') ); ?>" />
					</div>
				</div>
			</div>
			<div class="" style="background:#F0F3E7;padding:3px;display:inline-block">
				<div class="form-row">
					<div class="form-label"><?php _e('Publish top home button color','one'); ?></div>
					<div class="form-controls">
						<input type="text" class="color {hash:true}" name="top_pub_button_color" id="pub_button_color" value="<?php echo osc_esc_html( osc_get_preference('top_pub_button_color', 'one') ); ?>" />
					</div>
				</div>
				<div class="form-row">
					<div class="form-label"><?php _e('Publish top home button hover color','one'); ?></div>
					<div class="form-controls">
						<input type="text" class="color {hash:true}" name="top_pub_button_hover" id="top_pub_button_hover" value="<?php echo osc_esc_html( osc_get_preference('top_pub_button_hover', 'one') ); ?>" />
					</div>
				</div>
			</div>
			<div class="" style="background:#F0F3E7;padding:3px;display:inline-block">
				<div class="form-row">
					<div class="form-label"><?php _e('Publish button color','one'); ?></div>
					<div class="form-controls">
						<input type="text" class="color {hash:true}" name="pub_button_color" id="pub_button_color" value="<?php echo osc_esc_html( osc_get_preference('pub_button_color', 'one') ); ?>" />
					</div>
				</div>
				<div class="form-row">
					<div class="form-label"><?php _e('Publish button hover color','one'); ?></div>
					<div class="form-controls">
						<input type="text" class="color {hash:true}" name="pub_button_hover" id="pub_button_hover" value="<?php echo osc_esc_html( osc_get_preference('pub_button_hover', 'one') ); ?>" />
					</div>
				</div>
			</div>
			
			<h3><?php _e('Search page', 'one'); ?></h3>
			<div class="form-row">
				<div class="form-label"><?php _e('Search page bar color','one'); ?></div>
				<div class="form-controls">
					<input type="text" class="color {hash:true}" name="searchsearchc" id="searchsearchc" value="<?php echo osc_esc_html( osc_get_preference('searchsearchc', 'one') ); ?>" />
				</div>
			</div>
			<h3><?php _e('Publish page', 'one'); ?></h3>
			<div class="form-row">
				<div class="form-label"><?php _e('Upload image button color','one'); ?></div>
				<div class="form-controls">
					<input type="text" class="color {hash:true}" name="upload_button_color" id="upload_button_color" value="<?php echo osc_esc_html( osc_get_preference('upload_button_color', 'one') ); ?>" />
				</div>
			</div>
			<div class="" style="background:#F0F3E7;padding:3px;display:inline-block">
				<div class="form-row">
					<div class="form-label"><?php _e('Publish item button color','one'); ?></div>
					<div class="form-controls">
						<input type="text" class="color {hash:true}" name="publish_buton_color" id="publish_buton_color" value="<?php echo osc_esc_html( osc_get_preference('publish_buton_color', 'one') ); ?>" />
					</div>
				</div>
				<div class="form-row">
					<div class="form-label"><?php _e('Publish item button hover color','one'); ?></div>
					<div class="form-controls">
						<input type="text" class="color {hash:true}" name="publish_buton_hover" id="publish_buton_hover" value="<?php echo osc_esc_html( osc_get_preference('publish_buton_hover', 'one') ); ?>" />
					</div>
				</div>
			</div>
			<h3><?php _e('Item page', 'one'); ?></h3>
			<div class="form-row">
				<div class="form-label"><?php _e('Price background color','one'); ?></div>
				<div class="form-controls">
					<input type="text" class="color {hash:true}" name="background_price_color" id="background_price_color" value="<?php echo osc_esc_html( osc_get_preference('background_price_color', 'one') ); ?>" />
				</div>
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Price color','one'); ?></div>
				<div class="form-controls">
					<input type="text" class="color {hash:true}" name="price_color" id="price_color" value="<?php echo osc_esc_html( osc_get_preference('price_color', 'one') ); ?>" />
				</div>
			</div>
			
            <div class="form-actions">
                <input type="submit" value="<?php _e('Save changes', 'one'); ?>" class="btn btn-submit">
			</div>
		</div>
	</fieldset>	
</form>
<div class="author">
	<div>
		<span class="logo"><a href="http://host.aqi.com.br/"><img src="http://aqi.com.br/BANNER_728X90.gif" /></a></span>
		
	</div>
</div>