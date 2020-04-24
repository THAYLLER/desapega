<script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('top.bar.js') ; ?>"></script>
<div class="floating_bar">
	<div class="content_bar">
		<?php if (osc_is_home_page()) { ?>
			<div class="home_icon"><a href="<?php echo osc_base_url(); ?>" title="<?php _e("Home", 'one');?>"></a></div>
			<div class="active_bar_items"><?php _e("Mais que", 'one');?><span> <?php echo osc_total_active_items(); ?></span> <?php _e("anúncios ativos", 'one');?></div>
			<?php } else { ?>
			<div class="page_icon">
				<a class="hom" href="<?php echo osc_base_url(); ?>" title="<?php _e("Home", 'one');?>"></a>
				<span class="bar_point"></span>
				<div class="hover_active">
					<div class="menu_home">
						<span class="iconss"></span>
						<?php if (osc_is_publish_page()) { ?>
							<a class="home_link" href="<?php echo osc_base_url(); ?>" title="<?php _e("Home", 'one');?>"><?php _e("Home", 'one');?></a>
							<a class="search_link" href="<?php echo osc_search_url() ; ?>" title="<?php _e("Search", 'one');?>"><?php _e("Search", 'one');?></a>
							<a class="contact_link" href="<?php echo osc_contact_url(); ?>" title="<?php _e("Contact", 'one');?>"><?php _e("Contact", 'one');?></a>
							<?php } else if (osc_is_edit_page()) { ?>
							<a class="home_link" href="<?php echo osc_base_url(); ?>" title="<?php _e("Home", 'one');?>"><?php _e("Home", 'one');?></a>
							<a class="publish_link" href="<?php echo osc_item_post_url_in_category(); ?>" title="<?php _e("Publish", 'one');?>"><?php _e("Publish", 'one');?></a>
							<a class="search_link" href="<?php echo osc_search_url() ; ?>" title="<?php _e("Search", 'one');?>"><?php _e("Search", 'one');?></a>
							<a class="contact_link" href="<?php echo osc_contact_url(); ?>" title="<?php _e("Contact", 'one');?>"><?php _e("Contact", 'one');?></a>		
							<?php } else if (osc_is_search_page()) { ?>
							<a class="home_link" href="<?php echo osc_base_url(); ?>" title="<?php _e("Home", 'one');?>"><?php _e("Home", 'one');?></a>
							<a class="publish_link" href="<?php echo osc_item_post_url_in_category(); ?>" title="<?php _e("Publish", 'one');?>"><?php _e("Publish", 'one');?></a>
							<a class="contact_link" href="<?php echo osc_contact_url(); ?>" title="<?php _e("Contact", 'one');?>"><?php _e("Contact", 'one');?></a>
							<?php } else{ ?>
							<a class="home_link" href="<?php echo osc_base_url(); ?>" title="<?php _e("Home", 'one');?>"><?php _e("Home", 'one');?></a>
							<a class="publish_link" href="<?php echo osc_item_post_url_in_category(); ?>" title="<?php _e("Publish", 'one');?>"><?php _e("Publish", 'one');?></a>
							<a class="search_link" href="<?php echo osc_search_url() ; ?>" title="<?php _e("Search", 'one');?>"><?php _e("Search", 'one');?></a>
							<?php if( !osc_is_contact_page() ){ ?>
								<a class="contact_link" href="<?php echo osc_contact_url(); ?>" title="<?php _e("Contact", 'one');?>"><?php _e("Contact", 'one');?></a>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php if (osc_is_edit_page() || osc_is_contact_page()) { ?>
				<?php  $search2 = new Search(false);
				$act_items2 = $search2->count();?>
				<div class="active_bar_items"><?php _e("Mais de", 'one');?><span> <?php echo $act_items2; ?></span> <?php _e("anúncios activos", 'one');?></div>
			<?php } ?>
			<?php if(osc_is_publish_page()){ ?>
				<?php
					$curent_ads = osc_total_items_today();
					$your_ad = $curent_ads + '1';
				?>
				<div class="your_ad_is">
					<?php _e("Total de anúncios.", 'one');?> <span><?php echo $your_ad; ?></span> <?php _e("publicados hoje", 'one');?>
				</div>
			<?php } ?>
			<?php if(osc_is_ad_page()){ ?>
				<div class="title_top">
					<?php echo osc_item_title(); ?>
				</div>
			<?php } ?>
			<div class="top_user">
				<?php _e("Usuário", 'one');?> <?php echo osc_user_name(); ?>
			</div>
			<div class="top_items_user">
				<?php
					if( osc_is_web_user_logged_in() ) {
						$id = osc_logged_user_id();
						$user = User::newInstance()->findByPrimaryKey($id);
						$num_items_user = $user['i_items'];
					?>
					<?php _e("Você tem", 'one');?> <span><?php echo $num_items_user; ?></span> <?php _e("Anúncios ativo", 'one');?>
					<?php
					}
				?>
			</div>
		<?php } ?> 
		<?php if (osc_is_search_page()) { ?>
			<div class="filter_bar">
				<span class="results"><span><?php echo osc_search_total_items() ?> </span>
					<?php if( osc_search_total_items() == 1){ ?>
						<?php _e("resultado", 'one');?>
						<?php } else { ?>
						<?php _e("resultados", 'one');?>
					<?php } ?>
				</span>
				<div class="categ_selct">
					<span class="cat_bar"title="<?php _e("Change category", 'one');?>" ><?php top_one(); ?></span>
					<div class="all_categ" style="display:none;">
						<span class="pointicon"></span>
						<div class="top_use">
							<div class="top_back" title="<?php _e("Voltar", 'one');?>" style="display:none;"></div>
							<div class="top_close" title="<?php _e("Fechar", 'one');?>"> X </div>
						</div>
						<div class="main_categ">
							<?php osc_goto_first_category() ; ?>
							<?php while ( osc_has_categories() ) { ?>
								<span class="top_selected">
									<span id="top_show<?php echo osc_category_slug(); ?>" class=""  title="<?php echo osc_category_description() ; ?>" alt="<?php echo osc_category_name() ; ?>">             
										<div class="main_categ_top" id="<?php echo osc_category_id(); ?>"><?php echo osc_highlight( strip_tags( osc_category_name() ),30 ); ?></div>
									</span>
								</span>
							<?php } ?>
						</div>
						<?php osc_goto_first_category() ; ?>
						<?php while ( osc_has_categories() ) { ?>
							<div class="top_categg">
								<div class="top_mainctgg" id="<?php echo osc_category_slug();?>">
									<span id="<?php echo osc_category_slug(); ?>" title="<?php echo osc_category_description() ; ?>" alt="<?php echo osc_category_name() ; ?>">             
										<strong>
											<?php echo osc_highlight( strip_tags( osc_category_name() ),30 ); ?>
										</strong>
									</span>
								</div>
								<div class="tt_sub">
									<?php top_drawSubcategory(osc_category()); ?>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
				
			</div>
		<?php } ?>  
		
		<?php if( osc_users_enabled() || ( !osc_users_enabled() && !osc_reg_user_post() )) { ?>
            <div class="msss">
				<div class="form_publish">
					<div class="icon_pss"><span class="pl_ss">+</span>
					</div>
					<a href="<?php echo osc_item_post_url_in_category(); ?>"><?php _e("Publish your ad for free", 'one');?></a>
				</div>
			</div>
		<?php } ?>	
		<?php if (osc_is_publish_page() || (osc_is_edit_page() )) { ?>
			<div class="promote_bar">
				<a href="<?php echo osc_user_login_url(); ?>"><?php _e("Promova seus anúncios aqui", 'one');?></a>
			</div>
		<?php } ?> 
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
	</div>			
</div>