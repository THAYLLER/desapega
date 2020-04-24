<?php
    /*
		*
		*                        Copyright (C) 2015 Puiu Calin
		*
		*       This program is a commercial software. Copying or distribution without a license is forbidden.
		*     
	*/
	osc_enqueue_style('carousel', osc_current_web_theme_js_url('owl.carousel.css'));
	osc_enqueue_style('the', osc_current_web_theme_js_url('owl.theme.css'));
	osc_register_script('carousel', osc_current_web_theme_js_url('owl.carousel.js'), array('jquery'));
	osc_enqueue_script('carousel');	
	osc_enqueue_script('jquery-validate');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php'); ?>
		<script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('item.js') ; ?>"></script>
        <meta name="robots" content="index, follow" />
        <meta name="googlebot" content="index, follow" />
		<script type="text/javascript">
			$(document).ready(function(){			
				var sync1 = $("#sync1");
				var sync2 = $("#sync2");
				
				sync1.owlCarousel({
					singleItem : true,
					slideSpeed : 1000,
					navigation: true,
					navigationText: [
					"<span class='left'></span>",
					"<span class='right'></span>"
					],
					pagination:false,
					afterAction : syncPosition,
					responsiveRefreshRate : 200,
				});
				
				sync2.owlCarousel({
					items : '<?php echo osc_count_item_resources(); ?>',
					itemsDesktop      : [1199,10],
					itemsDesktopSmall     : [979,10],
					itemsTablet       : [768,8],
					itemsMobile       : [479,4],
					pagination:false,
					responsiveRefreshRate : 100,
					afterInit : function(el){
						el.find(".owl-item").eq(0).addClass("synced");
					}
				});
				
				function syncPosition(el){
					var current = this.currentItem;
					$("#sync2")
					.find(".owl-item")
					.removeClass("synced")
					.eq(current)
					.addClass("synced")
					if($("#sync2").data("owlCarousel") !== undefined){
						center(current)
					}
					
				}
				
				$("#sync2").on("click", ".owl-item", function(e){
					e.preventDefault();
					var number = $(this).data("owlItem");
					sync1.trigger("owl.goTo",number);
				});
				
				function center(number){
					var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
					
					var num = number;
					var found = false;
					for(var i in sync2visible){
						if(num === sync2visible[i]){
							var found = true;
						}
					}
					
					if(found===false){
						if(num>sync2visible[sync2visible.length-1]){
							sync2.trigger("owl.goTo", num - sync2visible.length+2)
							}else{
							if(num - 1 === -1){
								num = 0;
							}
							sync2.trigger("owl.goTo", num);
						}
						} else if(num === sync2visible[sync2visible.length-1]){
						sync2.trigger("owl.goTo", sync2visible[1])
						} else if(num === sync2visible[0]){
						sync2.trigger("owl.goTo", num-1)
					}
				}
			});
		</script>
		<?php one_print_ad(); ?>
	</head>
    <body class="item-page">
        <?php osc_current_web_theme_path('header.php'); ?>
        <div class="content item">
            <div id="main">
				<div class="one">
					<div id="item_head">
						<div class="inner">
							<div class="m_price">
								<?php if( osc_price_enabled_at_items() && osc_item_category_price_enabled() ) { ?><div class="m_m_m"><?php echo osc_item_formated_price(); ?></div> <?php } ?>
							</div>
							<h1><?php echo osc_item_title(); ?></h1>                   
						</div>
					</div>
					<div id="item_location">
						<span class="rgg">
							<span></span>
							<?php if ( osc_item_address() != "" ) { ?><strong><?php echo osc_item_address(); ?>, </strong><?php } ?>
							<?php if ( osc_item_city() != "" ) { ?><strong><?php echo osc_item_city(); ?>, </strong><?php } ?>
							<?php if ( osc_item_region() != "" ) { ?><strong><?php echo osc_item_region(); ?>, </strong><?php } ?>
							<?php if ( osc_item_country() != "" ) { ?><strong><?php echo osc_item_country(); ?></strong><?php } ?>
						</span>              
						<span class="publish"><?php if ( osc_item_pub_date() != '' ) echo __('Published date', 'one') . ': ' . osc_format_date( osc_item_pub_date() ); ?></span>
						<span class="update"><?php if ( osc_item_mod_date() != '' ) echo __('Modified date', 'one') . ': ' . osc_format_date( osc_item_mod_date() ); ?></span> 
					</div>
					<div class="new_image_galery">
						<?php if( osc_images_enabled_at_items() ) { 
							if( osc_count_item_resources() > 0 ) { ?>
							<?php if( osc_count_item_resources() > 1 ) { ?>
								<div class="po_galery_up"><span></span></div>
							<?php } ?>
							<div id="sync1" class="owl-carousel">				
								<?php for ( $i = 0; osc_has_item_resources(); $i++ ) { ?>
									<div id="<?php echo osc_resource_id(); ?>" class="item">
										<img src="<?php echo osc_resource_url(); ?>" />
									</div>
								<?php } ?>
								<?php View::newInstance()->_erase('resources'); ?>
							</div>
							<?php if( osc_count_item_resources() > 1 ) { ?>
								<div id="sync2" class="owl-carousel">
									<?php
										for ( $i = 0; osc_has_item_resources() ; $i++ ) { ?>
										<div class="item" ><img src="<?php echo osc_resource_thumbnail_url(); ?>" /></div>
									<?php } ?>	
									<?php View::newInstance()->_erase('resources'); ?>
								</div>
							<?php } ?>
						<?php } } ?>
					</div>
					<div id="description">
						<p><?php echo osc_item_description(); ?></p>
						<div id="custom_fields">
							<?php if( osc_count_item_meta() >= 1 ) { ?>
								<br />
								<div class="meta_list">
									<?php while ( osc_has_item_meta() ) { ?>
										<?php if(osc_item_meta_value()!='') { ?>
											<div class="meta">
												<strong><?php echo osc_item_meta_name(); ?>:</strong> <?php echo osc_item_meta_value(); ?>
											</div>
										<?php } ?>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
						<?php osc_run_hook('item_detail', osc_item() ); ?>
						<div class="hide_map">
							<div class="mapsss">
								<span class="xhide"></span>
								<div class="inter">
									<?php osc_run_hook('location'); ?>
								</div>
							</div>
						</div>
					</div>				
					<div class="next">
						<div class="link_next">
							<?php one_navigate(); ?>
						</div>
						<p class="contact_button">                     
							<span class="share"><a href="<?php echo osc_item_send_friend_url(); ?>" rel="nofollow"><?php _e('Share', 'one'); ?></a></span>
						</p>
						</br>
						<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-535d5a6132ffb0f3" async="async"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<div class="addthis_sharing_toolbox"></div>
</br>
						<p class="view_number">
							<?php _e('Visualizações', 'one') ; ?>:
							<strong><?php echo ItemStats::newInstance()->getViews(osc_item_id()); ?></strong>
						</p>
					</div>
				</div>				
			</div>
			<div class="contact_field">
				<div class="out">
					<div class="in">
						<ul id="error_list"></ul>
						<h2><?php _e("Contact publisher", 'one'); ?><span></span></h2>
						<?php ContactForm::js_validation(); ?>
						<form <?php if( osc_item_attachment() ) { ?>enctype="multipart/form-data"<?php } ?> action="<?php echo osc_base_url(true); ?>" method="post" name="contact_form" id="contact_form">
							<?php osc_prepare_user_info(); ?>
							<fieldset>
								<label for="yourName"><?php _e('Your name', 'one'); ?>:</label> <?php ContactForm::your_name(); ?>
								<label for="yourEmail"><?php _e('Your e-mail address', 'one'); ?>:</label> <?php ContactForm::your_email(); ?>
								<label for="phoneNumber"><?php _e('Phone number', 'one'); ?> (<?php _e('optional', 'one'); ?>):</label> <?php ContactForm::your_phone_number(); ?>
								<?php if( osc_item_attachment() ) { ?>
									<label for="contact-attachment"><?php _e('Attachments', 'twitter') ; ?></label><?php ContactForm::your_attachment() ; ?>
								<?php } ?>
								<?php osc_run_hook('item_contact_form', osc_item_id()); ?>
								<label for="message"><?php _e('Message', 'one'); ?>:</label> <?php ContactForm::your_message(); ?>
								<input type="hidden" name="action" value="contact_post" />
								<input type="hidden" name="page" value="item" />
								<input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
								<?php if( osc_recaptcha_public_key() ) { ?>
									<script type="text/javascript">
										var RecaptchaOptions = {
											theme : 'custom',
											custom_theme_widget: 'recaptcha_widget'
										};
									</script>
									<style type="text/css"> div#recaptcha_widget, div#recaptcha_image > img { width:280px; } </style>
									<div id="recaptcha_widget">
										<div id="recaptcha_image"><img /></div>
										<span class="recaptcha_only_if_image"><?php _e('Enter the words above','one'); ?>:</span>
										<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
										<div><a href="javascript:Recaptcha.showhelp()"><?php _e('Help', 'one'); ?></a></div>
									</div>
								<?php } ?>
								<?php osc_show_recaptcha(); ?>
								<button type="submit"><?php _e('Send', 'one'); ?></button>
							</fieldset>
						</form>
					</div>
				</div>
			</div> 
			<div class="backk">
				<div class="aut">
					<div class="inter">
						<div class="strong"><?php _e('Mark as', 'one'); ?>
							<span></span>
						</div>
						<div id="mark">
							<span>
								<a id="item_spam" href="<?php echo osc_item_link_spam(); ?>" rel="nofollow"><?php _e('spam', 'one'); ?></a>
								<a id="item_bad_category" href="<?php echo osc_item_link_bad_category(); ?>" rel="nofollow"><?php _e('misclassified', 'one'); ?></a>
								<a id="item_repeated" href="<?php echo osc_item_link_repeated(); ?>" rel="nofollow"><?php _e('duplicated', 'one'); ?></a>
								<a id="item_expired" href="<?php echo osc_item_link_expired(); ?>" rel="nofollow"><?php _e('expired', 'one'); ?></a>
								<a id="item_offensive" href="<?php echo osc_item_link_offensive(); ?>" rel="nofollow"><?php _e('offensive', 'one'); ?></a>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div id="sidebar">			
				<div class="second_sidebar">
					<div class="sidebar_price">
						<span></span>
						<?php if( osc_price_enabled_at_items() && osc_item_category_price_enabled() ) { ?><div class="price"><?php echo osc_item_formated_price(); ?></div> <?php } ?>
					</div>
					<?php if( osc_get_preference('sidebar-300x250', 'one') != '') {?>
						<!-- sidebar ad 350x250 -->
						<div class="ads_300">
							<?php echo osc_get_preference('sidebar-300x250', 'one'); ?>
						</div>
						<!-- /sidebar ad 350x250 -->
					<?php } ?>
					<h2><?php _e("Contact publisher", 'one'); ?>:</h2>
					<div id="contact">
						<div class="send_msg">
							<?php if( osc_item_is_expired () ) { ?>
								<p>
									<?php _e("The listing is expired. You can't contact the publisher.", 'one'); ?>
								</p>
								<?php } else if( ( osc_logged_user_id() == osc_item_user_id() ) && osc_logged_user_id() != 0 ) { ?>
								<p>
									<?php _e("It's your own listing, you can't contact the publisher.", 'one'); ?>
								</p>
								<?php } else if( osc_reg_user_can_contact() && !osc_is_web_user_logged_in() ) { ?>
								<p>
									<?php _e("You must log in or register a new account in order to contact the advertiser", 'one'); ?>
								</p>
								<p class="contact_button">
									<strong><a href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', 'one'); ?></a></strong>
									<strong><a href="<?php echo osc_register_account_url(); ?>"><?php _e('Register for a free account', 'one'); ?></a></strong>
								</p>
								<?php } else { ?>              
								
								<div class="msg">
									<span></span>
									<?php _e('Send message', 'one'); ?>
								</div>
							<?php } ?>					    
							<div class="pho">
								<?php if ( osc_item_city_area() != "" ) { ?>
									<div class="c_number">
										<div class="icon"></div>
										<div class="see">
											<span id="clickToShow"><?php echo osc_item_city_area(); ?></span>
										</div>
									</div>
								<?php } ?>
								<script>
									var shortNumber = $("#clickToShow").text().substring(0,  $("#clickToShow").text().length - 8);
									var eventTracking = "_gaq.push(['_trackEvent', 'EVENT-CATEGORY', 'EVENT-ACTION', 'EVENT-LABEL']);";
									$("#clickToShow").hide().after('<span id="clickToShowButton" onClick="' + eventTracking + '">' + shortNumber + 'xx xxx xxx <span class="text"><span><?php _e("Mostrar Telefone", 'one'); ?></span></span></span>');
									$("#clickToShowButton").click(function() {
										$("#clickToShow").show();
										$("#clickToShowButton").hide();
									});
								</script>
							</div>
						</div>
						<div class="loc">
							<span class="icon"></span>
							<div class="text">
								<span class="reg"> 
									<?php if ( osc_item_city() != "" ) { ?><?php echo osc_item_city(); ?>, <?php } ?>
									<?php if ( osc_item_region() != "" ) { ?><?php echo osc_item_region(); ?><?php } ?>
								</span>
								<a><span class="show"><?php _e("Localizar no Mapa", 'one'); ?></span></a>
							</div>
						</div>
						<div class="seler">
							<div class="span"></div>
							<div class="namer">
								<?php if( osc_item_user_id() != null ) { ?>
									<p class="name"><?php echo osc_item_contact_name(); ?></p>
									<a href="<?php echo osc_user_public_profile_url( osc_item_user_id() ); ?>" ><span><?php _e('Seller listings', 'one'); ?></span></a>
									<?php } else { ?>
									<p class="name"><?php echo osc_item_contact_name(); ?></p>
								<?php } ?>
								<?php if( osc_item_show_email() ) { ?>
									<p class="email"><?php _e('E-mail', 'one'); ?>: <?php echo osc_item_contact_email(); ?></p>
								<?php } ?>
							</div>
						</div>					   
						<div class="rap">
							<div class="icc"></div>
							<div class="area">
								<p>
									<a href="#" onClick="formpopup();document.printform.submit();return false;"><span><?php _e("Imprimir", 'one') ; ?></span></a>
								</p>
								<p>
									<?php if(osc_is_web_user_logged_in() && osc_logged_user_id()==osc_item_user_id()) { ?>
										<p id="edit_item_view">                          
											<a href="<?php echo osc_item_edit_url(); ?>" rel="nofollow"><span><?php _e('Editar Anúncio', 'one'); ?></span></a>
										</p>
										<?php } else { ?>
										<a href="<?php echo osc_user_login_url(); ?>" rel="nofollow"><span><?php _e('Editar Anúncio', 'one'); ?></span></a>
									<?php } ?>
								</p>
								<p>
									<p>
										<a class="raport"><span><?php _e('Marcar Anúncio', 'one'); ?></span></a>
									</p>
								</p>
							</div>
						</div>
						
					</div>
					
				</div>			
			</div>	       
			<div id="main">
				<div class="twww">
					<div id="related_ads">
						<?php related_listings(); ?>
						<?php if( osc_count_items() > 0 ) { ?>
							<div class="similar_ads">
								<h2><?php _e('Anuncios relacionados', 'one'); ?></h2>
								<?php
									View::newInstance()->_exportVariableToView("listType", 'items');
									osc_current_web_theme_path('related.php');
								?>
								<div class="clear"></div>
							</div>
						<?php } ?>
					</div>
					<div class="user_ads">				
						<?php if (function_exists('one_user_ads')) {one_user_ads();} ?>
					</div>
				</div>
				<!-- plugins -->
				<?php if( osc_comments_enabled() ) { ?>
					<?php if( osc_reg_user_post_comments () && osc_is_web_user_logged_in() || !osc_reg_user_post_comments() ) { ?>
						<div id="comments">
							<h2><?php _e('Comments', 'one'); ?></h2>
							<ul id="comment_error_list"></ul>
							<?php CommentForm::js_validation(); ?>
							<?php if( osc_count_item_comments() >= 1 ) { ?>
								<div class="comments_list">
									<?php while ( osc_has_item_comments() ) { ?>
										<div class="comment">
											<h3><strong><?php echo osc_comment_title(); ?></strong> <em><?php _e("by", 'one'); ?> <?php echo osc_comment_author_name(); ?>:</em></h3>
											<p><?php echo nl2br( osc_comment_body() ); ?> </p>
											<?php if ( osc_comment_user_id() && (osc_comment_user_id() == osc_logged_user_id()) ) { ?>
												<p>
													<a rel="nofollow" href="<?php echo osc_delete_comment_url(); ?>" title="<?php _e('Delete your comment', 'one'); ?>"><?php _e('Delete', 'one'); ?></a>
												</p>
											<?php } ?>
										</div>
									<?php } ?>
									<div class="paginate" style="text-align: right;">
										<?php echo osc_comments_pagination(); ?>
									</div>
								</div>
							<?php } ?>
							<form action="<?php echo osc_base_url(true); ?>" method="post" name="comment_form" id="comment_form">
								<fieldset>
									<h3><?php _e('Leave your comment (spam and offensive messages will be removed)', 'one'); ?></h3>
									<input type="hidden" name="action" value="add_comment" />
									<input type="hidden" name="page" value="item" />
									<input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
									<?php if(osc_is_web_user_logged_in()) { ?>
										<input type="hidden" name="authorName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
										<input type="hidden" name="authorEmail" value="<?php echo osc_logged_user_email();?>" />
										<?php } else { ?>
										<label for="authorName"><?php _e('Your name', 'one'); ?>:</label> <?php CommentForm::author_input_text(); ?><br />
										<label for="authorEmail"><?php _e('Your e-mail', 'one'); ?>:</label> <?php CommentForm::email_input_text(); ?><br />
									<?php }; ?>
									<label for="title"><?php _e('Title', 'one'); ?>:</label><?php CommentForm::title_input_text(); ?><br />
									<label for="body"><?php _e('Comment', 'one'); ?>:</label><?php CommentForm::body_input_textarea(); ?><br />
									<button type="submit"><?php _e('Send', 'one'); ?></button>
								</fieldset>
							</form>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
		<?php if ( osc_item_city_area() != "" ) { ?>
			<?php 
				$number_tel = osc_item_city_area();
				$count_number = strlen($number_tel);
				if ( is_numeric($number_tel) && $count_number > 9) { ?>
				<div class="mobile_sms">
					<ul>
						<li>
							<a class="tel" href="tel:<?php echo osc_item_city_area(); ?>"><span>Tel</span></a>
							<a class="sms" href="sms:<?php echo osc_item_city_area(); ?>"><span>Sms</span></a>
						</li>
					</ul>
				</div>
			<?php } ?>	
		<?php } ?>
		<?php if( osc_count_item_resources() > 0 ) { ?>
			<div class="pop_up_image">
				<?php osc_current_web_theme_path('po_up.php'); ?>
			</div>
		<?php } ?>
		<?php osc_current_web_theme_path('footer.php'); ?>
	</body>		
</html>			