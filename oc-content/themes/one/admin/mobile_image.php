﻿<link href="<?php echo osc_base_url().'oc-content/themes/one/admin/admin.css'; ?>" rel="stylesheet" type="text/css" />
<div id="adminmenu">
	<ul>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/header.php"); ?>"><?php echo __('Configurações Gerais', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/img_settings.php"); ?>"><?php echo __('Configurações de Imagem', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/color.php"); ?>"><?php echo __('Configurações de Cor', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/settings.php"); ?>"><?php echo __('Publicidade', 'one'); ?></a></li>
		<li class="current"><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/mobile_image.php"); ?>"><?php echo __('Mobile image', 'one'); ?></a></li>
		<li><a href="<?php echo osc_admin_render_theme_url("oc-content/themes/one/admin/log.php"); ?>"><?php echo __('Registro de Alterações', 'one'); ?></a></li>
	</ul>
</div>
<?php
	function one_images($categ_image_one, $deep = 0) {
		foreach($categ_image_one as $c) { 
			echo '<div' . ($deep == 0 ? ' class="categ_p"' : '') . '>';
			echo '<div class="sub' . $deep . ' name">' . $c['s_name'] .'</div>';	 
			if (file_exists(osc_themes_path() . 'one/images/m_categ_image/' . $c['pk_i_id'] . '.png')) {
				echo '<div class="image_show"><img style="height:50px; width:50px;" src="' . osc_base_url() . 'oc-content/themes/one/images/m_categ_image/' . $c['pk_i_id'] . '.png" alt="Exista" /></div>';
				
			?>
			<form action="<?php echo osc_admin_render_theme_url('oc-content/themes/one/admin/mobile_image.php'); ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="action_specific" value="m_remove_categ_image" />
				<input type="hidden" value="<?php echo $c['pk_i_id']; ?>" name="id_remove"/>	   
				<button type="submit" id="delete_image_bt"><?php _e('Deletar imagem da categoria','one'); ?></button>     
			</form>
			<?php   
				} else { 
			?>
			<form action="<?php echo osc_admin_render_theme_url('oc-content/themes/one/admin/mobile_image.php'); ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="action_specific" value="m_up_categ_image" />
				<input class="add_image" type="file" name="set_image" id="package" />
				<input type="hidden" value="<?php echo $c['pk_i_id']; ?>" name="id_category"/>	   
				<div class="save"><input id="button_save" type="submit" value="<?php echo osc_esc_html(__('Salvar imagem da categoria','one')); ?>" class="btn btn-submit"></div>      
			</form>
			<?php
			} 
			echo '</div>';    
		}
	}
	
?>
<div class="form-horizontal in">        
	<div class="top_in">      
		<span class="name"><?php _e('Nome da categoria', 'one'); ?></span>
		<span class="icon"><?php _e('Imagem da categoria', 'one'); ?></span>
	</div>
	<div class="sub_in">
		<?php echo one_images(Category::newInstance()->toTree(),  0); ?> 
	</div>		  
</div>
<div class="author">
	<div>
		<span class="logo"><a href="http://host.aqi.com.br/"><img src="http://aqi.com.br/BANNER_728X90.gif" /></a></span>
		
	</div>
</div>