<link href="<?php echo osc_base_url().'oc-content/themes/one/admin/admin.css'; ?>" rel="stylesheet" type="text/css" />
<div id="adminmenu">
	<ul>
		<li class="current"><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/header.php"); ?>"><?php echo __('Configurações Gerais', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/img_settings.php"); ?>"><?php echo __('Configurações de Imagem', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/color.php"); ?>"><?php echo __('configurações de cor', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/settings.php"); ?>"><?php echo __('Publicidade', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/mobile_image.php"); ?>"><?php echo __('Mobile image', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/log.php"); ?>"><?php echo __('Registro de Alterações', 'one'); ?></a></li>
	</ul>
</div>
<style type="text/css" media="screen">
    .command { background-color: white; color: #2E2E2E; border: 1px solid black; padding: 8px; }
    .theme-files { min-width: 500px; }
</style>
<div class="header_lg" style="float:left; width:47%;border:1px solid #ddd; padding:1%;margin-right:10px;">
	<h2 class="render-title"><?php _e('Header logo', 'one'); ?></h2>
	<?php if( is_writable( WebThemes::newInstance()->getCurrentThemePath() . "images/") ) { ?>
		<?php if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) { ?>
			<h3 class="render-title"><?php _e('Preview', 'one') ?></h3>
			<img border="0" alt="<?php echo osc_esc_html( osc_page_title() ); ?>" src="<?php echo osc_current_web_theme_url('images/logo.jpg');?>" />
			<form action="<?php echo osc_admin_render_theme_url('oc-content/themes/one/admin/header.php');?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="action_specific" value="remove" />
				<fieldset>
					<div class="form-horizontal">
						<div class="form-actions">
							<input id="button_remove" type="submit" value="<?php echo osc_esc_html(__('Remove logo','one')); ?>" class="btn btn-red">
						</div>
					</div>
				</fieldset>
			</form>
		</p>
		<?php } else { ?>
        <div class="flashmessage flashmessage-warning flashmessage-inline" style="display: block;">
            <p><?php _e("No logo has been uploaded yet", 'one'); ?></p>
		</div>
	<?php } ?>
    <h2 class="render-title separate-top"><?php _e('Upload logo', 'one') ?></h2>
    <p>
        <?php _e('The preferred size of the logo is 600x100.', 'one'); ?>
        <?php if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) { ?>
			<?php _e('<strong>Note:</strong> Uploading another logo will overwrite the current logo.', 'one'); ?>
		<?php } ?>
	</p>
    <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/one/admin/header.php'); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action_specific" value="upload_logo" />
        <fieldset>
            <div class="form-horizontal">
                <div class="form-row">
                    <div class="form-label"><?php _e('Logo image (png,gif,jpg)','one'); ?></div>
                    <div class="form-controls">
                        <input type="file" name="logo" id="package" />
					</div>
				</div>
                <div class="form-actions">
                    <input id="button_save" type="submit" value="<?php echo osc_esc_html(__('Upload','one')); ?>" class="btn btn-submit">
				</div>
			</div>
		</fieldset>
	</form>
	<?php } else { ?>
    <div class="flashmessage flashmessage-error" style="display: block;">
        <p>
            <?php
                $msg  = sprintf(__('The images folder <strong>%s</strong> is not writable on your server', 'one'), WebThemes::newInstance()->getCurrentThemePath() ."images/" ) .", ";
                $msg .= __("OSClass can't upload the logo image from the administration panel.", 'one') . ' ';
                $msg .= __("Please make the aforementioned image folder writable.", 'one') . ' ';
                echo $msg;
			?>
		</p>
        <p>
            <?php _e('To make a directory writable under UNIX execute this command from the shell:','one'); ?>
		</p>
        <p class="command">
            chmod a+w <?php echo WebThemes::newInstance()->getCurrentThemePath() ."images/" ; ?>
		</p>
	</div>
<?php } ?>
</div>
<div class="footer_lg" style="float:left; width:47%;border:1px solid #ddd;padding:1%;">
	<h2 class="render-title"><?php _e('Logo do Rodapé', 'one'); ?></h2>
	<?php if( is_writable( WebThemes::newInstance()->getCurrentThemePath() . "images/") ) { ?>
		<?php if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo_footer.jpg" ) ) { ?>
			<h3 class="render-title"><?php _e('Preview', 'one') ?></h3>
			<img border="0" alt="<?php echo osc_esc_html( osc_page_title() ); ?>" src="<?php echo osc_current_web_theme_url('images/logo_footer.jpg');?>" />
			<form action="<?php echo osc_admin_render_theme_url('oc-content/themes/one/admin/header.php');?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="action_specific" value="remove_footer"/>
				<fieldset>
					<div class="form-horizontal">
						<div class="form-actions">
							<input id="button_remove" type="submit" value="<?php echo osc_esc_html(__('Remove logo','one')); ?>" class="btn btn-red">
						</div>
					</div>
				</fieldset>
			</form>
		</p>
		<?php } else { ?>
        <div class="flashmessage flashmessage-warning flashmessage-inline" style="display: block;">
            <p><?php _e("No logo has been uploaded yet", 'one'); ?></p>
		</div>
	<?php } ?>
    <h2 class="render-title separate-top"><?php _e('Upload logo', 'one') ?></h2>
    <p>
        <?php _e('The preferred size of the logo is 175x108.', 'one'); ?>
        <?php if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) { ?>
			<?php _e('<strong>Note:</strong> Uploading another logo will overwrite the current logo.', 'one'); ?>
		<?php } ?>
	</p>
    <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/one/admin/header.php'); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action_specific" value="upload_logo_footer" />
        <fieldset>
            <div class="form-horizontal">
                <div class="form-row">
                    <div class="form-label"><?php _e('Logo image (png,gif,jpg)','one'); ?></div>
                    <div class="form-controls">
                        <input type="file" name="logo_footer" id="package" />
					</div>
				</div>
                <div class="form-actions">
                    <input id="button_save" type="submit" value="<?php echo osc_esc_html(__('Upload','one')); ?>" class="btn btn-submit">
				</div>
			</div>
		</fieldset>
	</form>
	<?php } else { ?>
    <div class="flashmessage flashmessage-error" style="display: block;">
        <p>
            <?php
                $msg  = sprintf(__('The images folder <strong>%s</strong> is not writable on your server', 'one'), WebThemes::newInstance()->getCurrentThemePath() ."images/" ) .", ";
                $msg .= __("OSClass can't upload the logo image from the administration panel.", 'one') . ' ';
                $msg .= __("Please make the aforementioned image folder writable.", 'one') . ' ';
                echo $msg;
			?>
		</p>
        <p>
            <?php _e('To make a directory writable under UNIX execute this command from the shell:','one'); ?>
		</p>
        <p class="command">
            chmod a+w <?php echo WebThemes::newInstance()->getCurrentThemePath() ."images/" ; ?>
		</p>
	</div>
<?php } ?>
</div>
<form action="<?php echo osc_admin_render_theme_url('oc-content/themes/one/admin/header.php'); ?>" method="post" class="nocsrf" style="float:left;width:100%;margin-top:20px;">
    <input type="hidden" name="action_specific" value="sttings_one" /> 	  
    <fieldset>
		<div class="form-horizontal">
			<h2><?php _e('Configurações', 'one'); ?></h2>
			<div class="form-row">
				<div class="form-label"><?php _e('Caixa de texto de informações', 'one'); ?></div>
				<div class="form-controls">
					<textarea style="height: 115px; width: 500px;"name="text_home"><?php echo osc_esc_html( osc_get_preference('text_home', 'one') ); ?></textarea>
					<p>	<?php _e('Este texto aparece na página inicial abaixo de categorias principais.','one'); ?></p>
				</div>
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Botão do Facebook', 'one'); ?></div>
				<div class="form-controls">
					<textarea style="height: 115px; width: 500px;"name="social_facebook"><?php echo osc_esc_html( osc_get_preference('social_facebook', 'one') ); ?></textarea>
					<p>	<?php _e('Incluir o código para facebook como botão neste campo, html aceito. Este botão aparece na primeira página.','one'); ?></p>
				</div>
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Botão do Twitter', 'one'); ?></div>
				<div class="form-controls">
					<textarea style="height: 115px; width: 500px;"name="social_twitter"><?php echo osc_esc_html( osc_get_preference('social_twitter', 'one') ); ?></textarea>
					<p>	<?php _e('Incluir o código para o botão do twitter nesta caixa, html aceito. Este botão aparece na primeira página.','one'); ?></p>
				</div>
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Botão do Google', 'one'); ?></div>
				<div class="form-controls">
					<textarea style="height: 115px; width: 500px;"name="social_google"><?php echo osc_esc_html( osc_get_preference('social_google', 'one') ); ?></textarea>
					<p>	<?php _e('Incluir o código para o botão do Google nesta caixa, html aceito. Este botão aparece na primeira página.','one'); ?></p>
				</div>
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Social widget footer', 'one'); ?></div>
				<div class="form-controls">
					<textarea style="height: 115px; width: 500px;"name="social_widget"><?php echo osc_esc_html( osc_get_preference('social_widget', 'one') ); ?></textarea>
					<p>	<?php _e('Você pode incluir uma dimensão social como a caixa, e aparecerá na footer.html aceito.','one'); ?></p>
				</div>
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Direitos auterais no rodapé', 'one'); ?></div>
				<div class="form-controls">
					<textarea style="height: 115px; width: 500px;"name="autor"><?php echo osc_esc_html( osc_get_preference('autor', 'one') ); ?></textarea>
					<p>	<?php _e('O seu texto de direitos autorais.','one'); ?></p>
				</div>
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Número de anúncios premium','one'); ?></div>
				<div class="form-controls">
					<input type="text" class="xlarge" name="premiumsearch" value="<?php echo osc_esc_html( osc_get_preference('premiumsearch', 'one') ); ?>">
					<p>	<?php _e('Número de anúncios premium na página de pesquisa, no modo de lista.','one'); ?></p>		
				</div>		
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Número de anúncios premium','one'); ?></div>
				<div class="form-controls">
					<input type="text" class="xlarge" name="premiumsearchgl" value="<?php echo osc_esc_html( osc_get_preference('premiumsearchgl', 'one') ); ?>">
					<p>	<?php _e('Número de anúncios premium na página de pesquisa, no modo de galeria.','one'); ?></p>		
				</div>		
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Anúncios relacionados','one'); ?></div>
				<div class="form-controls">
					<input type="text" class="xlarge" name="related" value="<?php echo osc_esc_html( osc_get_preference('related', 'one') ); ?>">
					<p>	<?php _e('Número de anúncios relacionados na página item.','one'); ?></p>		
				</div>		
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Anúncios do usuário','one'); ?></div>
				<div class="form-controls">
					<input type="text" class="xlarge" name="userads" value="<?php echo osc_esc_html( osc_get_preference('userads', 'one') ); ?>">
					<p>	<?php _e('Número de anúncios do usuario na página item.','one'); ?></p>		
				</div>		
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Mostrar anúncios do usuário','one'); ?></div>
				<div class="form-controls">
					<select name="useradspc" id="useradspc">
						<option name="useradspc" value="1" <?php if( osc_get_preference('useradspc', 'one') !== '0'){echo 'selected="selected"';}?>><?php _e('Sim', 'one'); ?></option> 
						<option name="useradspc" value="0"<?php if( osc_get_preference('useradspc', 'one') !== '1'){echo 'selected="selected"';}?>><?php _e('Não', 'one'); ?></option>
					</select>
					<p>	<?php _e('Esta opção mostra anúncios de utilizador apenas com imagem.','one'); ?></p>		
				</div>		
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Mostrar barra superior','one'); ?></div>
				<div class="form-controls">
					<select name="top_bar" id="top_bar">
						<option name="top_bar" value="1" <?php if( osc_get_preference('top_bar', 'one') !== '0'){echo 'selected="selected"';}?>><?php _e('Sim', 'one'); ?></option> 
						<option name="top_bar" value="0"<?php if( osc_get_preference('top_bar', 'one') !== '1'){echo 'selected="selected"';}?>><?php _e('Não', 'one'); ?></option>
					</select>
					<p>	<?php _e('Esta opção mostrar o cabeçalho bar flutuante','one'); ?></p>		
				</div>		
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('lançamentos relacionados no autocomplete','one'); ?></div>
				<div class="form-controls">
					<select name="autocomplete_related" id="autocomplete_related">
						<option name="autocomplete_related" value="1" <?php if( osc_get_preference('autocomplete_related', 'one') !== '0'){echo 'selected="selected"';}?>><?php _e('Sim', 'one'); ?></option> 
						<option name="autocomplete_related" value="0"<?php if( osc_get_preference('autocomplete_related', 'one') !== '1'){echo 'selected="selected"';}?>><?php _e('Não', 'one'); ?></option>
					</select>
					<p>	<?php _e('Esta exibição opção na home page da listagem relacionada com base na palavra digitada no campo de entrada de pesquisa.','one'); ?></p>		
				</div>		
			</div>
			<div class="c_custom" style="border:1px solid #bbb; display:block;padding:10px 0px;margin:10px 0px;background: #F0F3E7;">
				<div class="form-row">
					<div class="form-label"><strong><?php _e('Anúncios personalizados','one'); ?></strong></div>
					<div class="form-controls">
						<select name="custom_items" id="custom_items">
							<option name="custom_items" value="1" <?php if( osc_get_preference('custom_items', 'one') !== '0'){echo 'selected="selected"';}?>><?php _e('Sim', 'one'); ?></option> 
							<option name="custom_items" value="0"<?php if( osc_get_preference('custom_items', 'one') !== '1'){echo 'selected="selected"';}?>><?php _e('Não', 'one'); ?></option>
						</select>
						<p>	<?php _e('Esta opção Mostrar Listas personalizadas controle deslizante na página inicial','one'); ?></p>		
					</div>		
				</div>
				<strong style="padding:10px;display:block;"><?php _e('Opção para anúncios personalizados','one'); ?></strong>
				<div class="form-row">
					<div class="form-label"><?php _e('Nome personalizado','one'); ?></div>
					<div class="form-controls">
						<input type="text" class="xlarge" name="name_custom" value="<?php echo osc_esc_html( osc_get_preference('name_custom', 'one') ); ?>">
						<p>	<?php _e('Este é o nome que aparecerá na parte superior do controle deslizante. Se você deixar este campo em branco o nome padrão é "Anúncios Premium".','one'); ?></p>		
					</div>		
				</div>
				<div class="form-row">
					<div class="form-label"><?php _e('Nome da Categoria','one'); ?></div>
					<div class="form-controls">
						<input type="text" class="xlarge" name="category_custom" value="<?php echo osc_esc_html( osc_get_preference('category_custom', 'one') ); ?>">
						<p>	<?php _e('Definir o nome da categoria para a lista personalizada. Você pode usar várias categorias separadas por vírgula.','one'); ?><i> <?php _e('For example: animal,cars etc.','one'); ?></i></p>		
					</div>		
				</div>
				<div class="form-row">
					<div class="form-label"><?php _e('Nome da Cidade','one'); ?></div>
					<div class="form-controls">
						<input type="text" class="xlarge" name="city_custom" value="<?php echo osc_esc_html( osc_get_preference('city_custom', 'one') ); ?>">
						<p>	<?php _e('Definir o nome da cidade para a lista personalizada. Você pode usar múltiplos da cidade separadas por vírgula.','one'); ?><i> <?php _e('For example: Arad,Cluj etc.','one'); ?></i></p>		
					</div>		
				</div>
				<div class="form-row">
					<div class="form-label"><?php _e('Nome de Região','one'); ?></div>
					<div class="form-controls">
						<input type="text" class="xlarge" name="region_custom" value="<?php echo osc_esc_html( osc_get_preference('region_custom', 'one') ); ?>">
						<p>	<?php _e('Definir o nome da região para a lista personalizada. Você pode usar múltiplos da cidade separadas por vírgula.','one'); ?><i> <?php _e('For example: Arad,Cluj etc.','one'); ?></i></p>		
					</div>		
				</div>
				<div class="form-row">
					<div class="form-label"><?php _e('Número de anúncios personalizados','one'); ?></div>
					<div class="form-controls">
						<input type="text" class="xlarge" name="number_custom" value="<?php echo osc_esc_html( osc_get_preference('number_custom', 'one') ); ?>">
						<p>	<?php _e('Defina o número de anúncios (padrão 12).','one'); ?></p>		
					</div>		
				</div>
				<div class="form-row">
					<div class="form-label"><?php _e('Apenas premium','one'); ?></div>
					<div class="form-controls">
						<select name="premium_custom" id="premium_custom">
							<option name="premium_custom" value="1" <?php if( osc_get_preference('premium_custom', 'one') !== '0'){echo 'selected="selected"';}?>><?php _e('Sim', 'one'); ?></option> 
							<option name="premium_custom" value="0"<?php if( osc_get_preference('premium_custom', 'one') !== '1'){echo 'selected="selected"';}?>><?php _e('Não', 'one'); ?></option>
						</select>
						<p>	<?php _e('Esta opção mostrar somente anúncios premium.','one'); ?></p>		
					</div>		
				</div>
				<div class="form-row">
					<div class="form-label"><?php _e('Ordem aleatória','one'); ?></div>
					<div class="form-controls">
						<select name="random_custom" id="random_custom">
							<option name="random_custom" value="1" <?php if( osc_get_preference('random_custom', 'one') !== '0'){echo 'selected="selected"';}?>><?php _e('Sim', 'one'); ?></option> 
							<option name="random_custom" value="0"<?php if( osc_get_preference('random_custom', 'one') !== '1'){echo 'selected="selected"';}?>><?php _e('Não', 'one'); ?></option>
						</select>
						<p>	<?php _e('Esta opção mostrar anúncios aleatórios.','one'); ?></p>		
					</div>		
				</div>
				<i style="margin-left:50px;"><?php _e('Se você deixar os campos vazios nenhum filtro será aplicar em listas personalizadas.','one'); ?></i>
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Novos anúncios','one'); ?></div>
				<div class="form-controls">
					<select name="latest" id="latest">
						<option name="latest" value="1" <?php if( osc_get_preference('latest', 'one') !== '0'){echo 'selected="selected"';}?>><?php _e('Sim', 'one'); ?></option> 
						<option name="latest" value="0"<?php if( osc_get_preference('latest', 'one') !== '1'){echo 'selected="selected"';}?>><?php _e('Não', 'one'); ?></option>
					</select>
					<p>	<?php _e('Esta opção Mostra novos anúncios na home page','one'); ?></p>		
				</div>		
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Região ou publicar','one'); ?></div>
				<div class="form-controls">
					<select name="region_pub" id="region_pub">
						<option name="region_pub" value="0" <?php if( osc_get_preference('region_pub', 'one') !== '1'){echo 'selected="selected"';}?>><?php _e('Botão publicar', 'one'); ?></option> 
						<option name="region_pub" value="1"<?php if( osc_get_preference('region_pub', 'one') !== '0'){echo 'selected="selected"';}?>><?php _e('Regiões', 'one'); ?></option>
					</select>
					<p>	<?php _e('Esta opção mostrar toda a região ou o botão publicar na barra lateral do homepage','one'); ?></p>		
				</div>		
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Depois de número de pesquisas','one'); ?></div>
				<div class="form-controls">
					<input type="text" class="xlarge" name="number_order" value="<?php echo osc_esc_html( osc_get_preference('number_order', 'one') ); ?>">
					<p>	<?php _e('Definir depois de quantos número de procurar uma palavra a aparecer na maioria dos itens pesquisados.','one'); ?></p>		
				</div>		
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Número de mais pesquisados','one'); ?></div>
				<div class="form-controls">
					<input type="text" class="xlarge" name="number_set" value="<?php echo osc_esc_html( osc_get_preference('number_set', 'one') ); ?>">
					<p>	<?php _e('Defina o número de mais itens pesquisados, que aparecerão na página inicial e página de pesquisa.','one'); ?></p>		
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