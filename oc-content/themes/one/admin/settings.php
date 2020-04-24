<link href="<?php echo osc_base_url().'oc-content/themes/one/admin/admin.css'; ?>" rel="stylesheet" type="text/css" />
<div id="adminmenu">
	<ul>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/header.php"); ?>"><?php echo __('Configurações Gerais', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/img_settings.php"); ?>"><?php echo __('Configurações de Imagem', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/color.php"); ?>"><?php echo __('Configurações de Cores', 'one'); ?></a></li>
		<li class="current"><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/settings.php"); ?>"><?php echo __('Publicidade', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/mobile_image.php"); ?>"><?php echo __('Mobile Image', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/log.php"); ?>"><?php echo __('Registro de Alterações', 'one'); ?></a></li>
		</ul>
</div>
<h2><?php _e('Configurações do tema', 'one'); ?></h2>
<form action="<?php echo osc_admin_render_theme_url('oc-content/themes/one/admin/settings.php'); ?>" method="post">
    <input type="hidden" name="action_specific" value="settings" />
    <fieldset>
        <div class="form-horizontal">
            <div class="form-row">
                <div class="form-label"><?php _e('Espaço reservado para pesquiza', 'one'); ?></div>
                <div class="form-controls"><input type="text" class="xlarge" name="keyword_placeholder" value="<?php echo osc_esc_html( osc_get_preference('keyword_placeholder', 'one') ); ?>"></div>
			</div>
		</div>
	</fieldset>
	
	
    <h2 class="render-title"><?php _e('Ads management', 'one'); ?></h2>
    <div class="form-row">
        <div class="form-label"></div>
        <div class="form-controls">
            <p><?php _e('In this section you can configure your site to display ads and start generating revenue.', 'one'); ?><br/><?php _e('If you are using an online advertising platform, such as Google Adsense, copy and paste here the provided code for ads.', 'one'); ?></p>
		</div>
	</div>
    <fieldset>
        <div class="form-horizontal">
            <div class="form-row">
                <div class="form-label"><?php _e('Header 728x90', 'one'); ?></div>
                <div class="form-controls">
                    <textarea style="height: 115px; width: 500px;"name="header-728x90"><?php echo osc_esc_html( osc_get_preference('header-728x90', 'one') ); ?></textarea>
                    <br/><br/>
                    <div class="help-box"><?php _e('This ad will be shown at the top of your website, next to the site title and above the search results. Note that the size of the ad has to be 728x90 pixels.', 'one'); ?></div>
				</div>
			</div>
            <div class="form-row">
                <div class="form-label"><?php _e('Homepage 728x90', 'one'); ?></div>
                <div class="form-controls">
                    <textarea style="height: 115px; width: 500px;" name="homepage-728x90"><?php echo osc_esc_html( osc_get_preference('homepage-728x90', 'one') ); ?></textarea>
                    <br/><br/>
                    <div class="help-box"><?php _e('This ad will be shown on the main site of your website. It will appear both at the top and bottom of your site homepage. Note that the size of the ad has to be 728x90 pixels.', 'one'); ?></div>
				</div>
			</div>
            <div class="form-row">
                <div class="form-label"><?php _e('Search results 728x90 (top of the page)', 'one'); ?></div>
                <div class="form-controls">
                    <textarea style="height: 115px; width: 500px;" name="search-results-top-728x90"><?php echo osc_esc_html( osc_get_preference('search-results-top-728x90', 'one') ); ?></textarea>
                    <br/><br/>
                    <div class="help-box"><?php _e('This ad will be shown on top of the search results of your site. Note that the size of the ad has to be 728x90 pixels.', 'one'); ?></div>
				</div>
			</div>
            <div class="form-row">
                <div class="form-label"><?php _e('Search results 728x90 (middle of the page)', 'one'); ?></div>
                <div class="form-controls">
                    <textarea style="height: 115px; width: 500px;" name="search-results-middle-728x90"><?php echo osc_esc_html( osc_get_preference('search-results-middle-728x90', 'one') ); ?></textarea>
                    <br/><br/>
                    <div class="help-box"><?php _e('This ad will be shown among the search results of your site. Note that the size of the ad has to be 728x90 pixels.', 'one'); ?></div>
				</div>
			</div>
            <div class="form-row">
                <div class="form-label"><?php _e('Sidebar 300x250', 'one'); ?></div>
                <div class="form-controls">
                    <textarea style="height: 115px; width: 500px;" name="sidebar-300x250"><?php echo osc_esc_html( osc_get_preference('sidebar-300x250', 'one') ); ?></textarea>
                    <br/><br/>
                    <div class="help-box"><?php _e('This ad will be shown at the right sidebar of your website, on the product detail page. Note that the size of the ad has to be 300x350 pixels.', 'one'); ?></div>
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