<?php
    /*
		*
		*                        Copyright (C) 2015 Puiu Calin
		*
		*       This program is a commercial software. Copying or distribution without a license is forbidden.
		*     
	*/
?>
<!-- container -->
<?php if( osc_get_preference('top_bar', 'one') != '0') { ?>
	<?php osc_current_web_theme_path('top.bar.php') ; ?>
<?php } ?>	
<div class="container">
	<!-- header -->
	<!--control div-->
	<div class="control_div">
		<!-- header ad 728x60-->
		<div class="header_ads">
			<?php echo osc_get_preference('header-728x90', 'one'); ?>
		</div>
		<!-- /header ad 728x60-->
		<div id="header">
			<a id="logo" href="<?php echo osc_base_url(); ?>">
				<?php echo logo_header(); ?>
			</a>
			<div id="user_menu">
				<?php if(osc_users_enabled()) { ?>
					<?php if( osc_is_web_user_logged_in() ) { ?>
						<div class="first logged">
							<div class="icon_acc">
							</div>
							<a class="show" href="<?php echo osc_user_dashboard_url(); ?>"><span><?php echo osc_logged_user_name(); ?></span><span class="down"></span></a>
							<div class="menu">
								<span class="icon"></span>
								<span class="text"><span></span><?php _e('My account', 'one'); ?></span>
								<div class="private">
									<?php echo osc_private_user_menu( get_user_menu() ); ?>
								</div>
							</div>
						</div>
						<?php } else { ?>
						<div class="first">
							<div class="icon_acc">
							</div>						
							<a id="login_open" href="<?php echo osc_user_login_url(); ?>"><span><?php _e('Login', 'one'); ?></span></a>                      
						</div>
					<?php } ?>
				<?php } ?>
				<?php if( osc_users_enabled() || ( !osc_users_enabled() && !osc_reg_user_post() )) { ?>
					<div class="form_publish">
						<div class="icon_pss"><span class="pl_ss">+</span>
						</div>
						<a href="<?php echo osc_item_post_url_in_category(); ?>"><?php _e("Publish your ad for free", 'one');?></a>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="clear"></div>
		<!-- /header -->
	</div>
	<!-- /end control div -->
	<div class="control_2">
		<?php
			osc_show_widgets('header');
			if( osc_is_ad_page()){
				$breadcrumb = osc_breadcrumb('&raquo;', false);
				if( $breadcrumb != '') { ?>
				<div class="rett">
					<?php one_navigate($show_next_img = true); ?>
					<div class="breadcrumb item">
						<?php echo $breadcrumb; ?>
						<div class="clear"></div>
					</div>
				</div>
				<?php
				} }
		?>
		<div class="forcemessages-inline">
			<?php osc_show_flash_message(); ?>
		</div>
	</div>	