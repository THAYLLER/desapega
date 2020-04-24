<?php
	/*
		*
		*                        Copyright (C) 2015 Puiu Calin
		*
		*       This program is a commercial software. Copying or distribution without a license is forbidden.
		*     
	*/
	
    osc_enqueue_script('jquery-validate');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php'); ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
		<script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('one.js') ; ?>"></script>
        <!-- only item-edit.php -->
		<?php ItemForm::location_javascript(); ?>
        <?php
			if(osc_images_enabled_at_items() && !one_is_fineuploader()) {
				ItemForm::photos_javascript();
			}
		?>
        <script type="text/javascript">
			
            $(document).ready(function(){
                $('body').on("created", '[name^="select_"]',function(evt) {
                    $(this).uniform();
				});
                $('body').on("removed", '[name^="select_"]',function(evt) {
                    $(this).parent().remove();
				});
			});
			
            function uniform_input_file(){
                photos_div = $('div.photos');
                $('div',photos_div).each(
				function(){
					if( $(this).find('div.uploader').length == 0  ){
						divid = $(this).attr('id');
						if(divid != 'photos'){
							divclass = $(this).hasClass('box');
							if( !$(this).hasClass('box') & !$(this).hasClass('uploader') & !$(this).hasClass('row')){
								$("div#"+$(this).attr('id')+" input:file").uniform({fileDefaultText: fileDefaultText,fileBtnText: fileBtnText});
							}
						}
					}
				}
                );
			}
			
            setInterval("uniform_plugins()", 250);
            function uniform_plugins() {
				
                var content_plugin_hook = $('#plugin-hook').text();
                content_plugin_hook = content_plugin_hook.replace(/(\r\n|\n|\r)/gm,"");
                if( content_plugin_hook != '' ){
					
                    var div_plugin_hook = $('#plugin-hook');
                    var num_uniform = $("div[id*='uniform-']", div_plugin_hook ).size();
                    if( num_uniform == 0 ){
                        if( $('#plugin-hook input:text').size() > 0 ){
                            $('#plugin-hook input:text').uniform();
						}
                        if( $('#plugin-hook select').size() > 0 ){
                            $('#plugin-hook select').uniform();
						}
					}
				}
			}
            <?php if(osc_locale_thousands_sep()!='' || osc_locale_dec_point() != '') { ?>
				$().ready(function(){
					$("#price").blur(function(event) {
						var price = $("#price").prop("value");
						<?php if(osc_locale_thousands_sep()!='') { ?>
							while(price.indexOf('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>')!=-1) {
								price = price.replace('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>', '');
							}
						<?php }; ?>
						<?php if(osc_locale_dec_point()!='') { ?>
							var tmp = price.split('<?php echo osc_esc_js(osc_locale_dec_point())?>');
							if(tmp.length>2) {
								price = tmp[0]+'<?php echo osc_esc_js(osc_locale_dec_point())?>'+tmp[1];
							}
						<?php }; ?>
						$("#price").prop("value", price);
					});
				});
			<?php }; ?>
		</script>
        <!-- end only item-edit.php -->
	</head>
    <body class="psss edit">
		<div id="back_body">
			<div id="categ_area">
				<div class="head">
					<div class="close"></div>
					<span id="first_back" class="back"><?php _e('Back to categories', 'one'); ?></span>
					<span id ="second_back" class="back" style="display:none;"><?php _e('Back to subcategories', 'one'); ?></span>
					<span id ="three_back" class="back" style="display:none;"><?php _e('Back', 'one'); ?></span>
					<span class="ffft"><?php _e('Select a category', 'one'); ?></span>
					<span class="ssst"><?php _e('Select a subcategory', 'one'); ?></span>
				</div>
				<div class="list">
					<?php //echo subcategories
						// function 1
						function drawSubcategory2($category) {
							if ( osc_count_subcategories2() > 0 ) {
								osc_category_move_to_children();
							?>
							<ul>
								<?php while ( osc_has_categories() ) { ?>
									<?php if ( osc_count_subcategories2() > 0 ) { ?>
										<span class="second_sbctgg" ><strong class="<?php echo osc_category_id(); ?>"><a class="second_to_hide" ><span class="more"></span><?php echo osc_category_name(); ?></a></strong> 	
											<?php if( osc_count_subcategories2() > 0 ) { ?>				
												<span class="second2" style="display:none;">
													<?php drawSubcategory2(osc_category()); ?>
												</span>
											<?php } ?>
										</span>
										<?php } else { ?>
										<span class="sbctgg" ><span class="less"><strong class="<?php echo osc_category_id() ; ?>"><a class="second_to_hide"><?php echo osc_category_name() ; ?></a></strong></span></span>
									<?php  } ?>
								<?php } ?>
							</ul>
							<?php
								osc_category_move_to_parent();
							}
						}
						//function 2
						function drawSubcategory($category) {
							if ( osc_count_subcategories2() > 0 ) {
								osc_category_move_to_children();
							?>
							<div class="subcategory" id="subcategories-<?php echo osc_category_id() ; ?>" style="display:none;">      
								<?php while ( osc_has_categories() ) { ?>
									<?php if ( osc_count_subcategories2() > 0 ) { ?>
										<span id="" class="first_sbctgg" ><strong  class="<?php echo osc_category_id() ; ?>"><a class="to_hide"><span class="more"><?php echo osc_category_name() ; ?></span></a></strong>
											<?php if ( osc_count_subcategories2() > 0 ) { ?>
												<span class="second" style="display:none;"><?php drawSubcategory2(osc_category()); ?></span>
											<?php } ?>
										</span>
										<?php } else { ?>
										<span class="sbctgg" ><span class="less"><strong class="<?php echo osc_category_id() ; ?>"><a class="to_hide"><?php echo osc_category_name() ; ?></a></strong></span></span>
									<?php } ?>
								<?php } ?>
							</div>
							<?php
								osc_category_move_to_parent();
							}
						}
					?>
					<?php osc_goto_first_category() ; ?>
					<?php while ( osc_has_categories() ) { ?>
						<div class="categg">
							<div class="mainctgg" id="<?php echo osc_category_id();?>">
								<a href="#" title="<?php echo osc_category_description() ; ?>" alt="<?php echo osc_category_name() ; ?>">       
									<img class="photo" src="<?php echo osc_current_web_theme_url('images/categ_image/') . osc_category_id() .'.png' ?>" />
									<strong>
										<?php echo osc_highlight( strip_tags( osc_category_name() ),30 ); ?>
									</strong>
								</a>
							</div>
							
							<?php drawSubcategory(osc_category()); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
        <?php osc_current_web_theme_path('header.php'); ?>
        <div class="content add_item">
            <h1><strong><?php _e('Update your listing', 'one'); ?></strong></h1>
            <ul id="error_list"></ul>
			<form name="item" action="<?php echo osc_base_url(true)?>" method="post" enctype="multipart/form-data">
                <fieldset>
                    <input type="hidden" name="action" value="item_edit_post" />
                    <input type="hidden" name="page" value="item" />
                    <input type="hidden" name="id" value="<?php echo osc_item_id();?>" />
                    <input type="hidden" name="secret" value="<?php echo osc_item_secret();?>" />
					<div class="box general_info">
						<div class="row title">
							<label><?php _e('Title', 'one'); ?><span>*</span></label>
							<div class="backkk">
								<?php ItemForm::title_input('title',osc_locale_code(), osc_esc_html( one_item_title() )); ?>
								<div class="count_title">
									<strong id="remain"><?php echo osc_get_preference('title_character_length', 'osclass'); ?></strong> <?php _e('Characters remaining', 'one'); ?>
									<script type="text/javascript">
										$(document).ready(function(){
											$(".title input").keyup(function() {										
												var x = $(".title input").val();
												var newLines = x.match(/(\r\n|\n|\r)/g);
												var addition = 0;
												if (newLines != null) {
													addition = newLines.length;
												}
												var j = x.length + addition;
												var i = <?php echo osc_get_preference('title_character_length', 'osclass'); ?> - j;
												$("#used").text( j );
												$("#remain").text( i );
											});
										});
									</script>
								</div>	
							</div>
						</div>
                        <div class="row clett">
							<div class="first">
								<label><?php _e('Category', 'one'); ?><span>*</span></label>
								<?php ItemForm::category_select(null, null, __('Select a category', 'one')); ?>
							</div>
							<div class="second_second">
								<div id="sClect"><span></span></div>
							</div>
						</div>
                        <div class="row dess">
							<label><?php _e('Description', 'one'); ?><span>*</span></label>
							<div class="m_text" style="float:left;">
								<?php ItemForm::description_textarea('description',osc_locale_code(), osc_esc_html( one_item_description() )); ?>
								<div class="count_description" style="margin-top:4px;color: #A6A6A6;font-size:11px;">
									<strong id="remain2"><?php echo osc_get_preference('description_character_length', 'osclass'); ?></strong> <?php _e('Characters remaining', 'one'); ?>
									<script type="text/javascript">
										$(document).ready(function(){
											$(".dess textarea").keyup(function() {
												var x = $(".dess textarea").val();
												var newLines = x.match(/(\r\n|\n|\r)/g);
												var addition = 0;
												if (newLines != null) {
													addition = newLines.length;
												}
												var j = x.length + addition;
												var i = <?php echo osc_get_preference('description_character_length', 'osclass'); ?> - j;
												$("#used").text( j );
												$("#remain2").text( i );
											});
										});
									</script>
								</div>	
							</div>
						</div>
					</div>
					<?php if( osc_price_enabled_at_items() ) { ?>
						<div class="row price">
							<label><?php _e('Price', 'modern'); ?></label>
							<?php ItemForm::price_input_text(); ?>
							<?php ItemForm::currency_select(); ?>
						</div>
					<?php } ?>
					<?php if( osc_images_enabled_at_items() ) { ?>
                        <div class="box photos">
                            <?php
								if(osc_images_enabled_at_items()) {
									if(one_is_fineuploader()) {
										// new ajax photo upload
										ItemForm::ajax_photos();
									}
								} else { ?>
								<h2><?php _e('Photos', 'one'); ?></h2>
								<?php ItemForm::photos(); ?>
								<div id="photos">
									<?php if(osc_max_images_per_item()==0 || (osc_max_images_per_item()!=0 && osc_count_item_resources()<  osc_max_images_per_item())) { ?>
										<div class="row">
											<input type="file" name="photos[]" />
										</div>
									<?php }; ?>
								</div>
								<a href="#" onclick="addNewPhoto(); uniform_input_file(); return false;"><?php _e('Add new photo', 'one'); ?></a>
								<?php
								}
							}
						?>
					</div>
					<div class="box location">
						<div class="row">
							<label><?php _e('Country', 'one'); ?></label>
							<?php ItemForm::country_select(); ?>
						</div>
						<div class="row">
							<label><?php _e('Region', 'one'); ?></label>
							<?php ItemForm::region_select(osc_get_regions(osc_user_region_id()), osc_user()) ; ?>
						</div>
						<div class="row">
							<label><?php _e('City', 'one'); ?></label>
							<?php ItemForm::city_select(osc_get_cities(osc_user_region_id()), osc_user()) ; ?>
						</div>                           
						<div class="row">
							<label><?php _e('Address', 'one'); ?></label>
							<?php ItemForm::address_text(); ?>
						</div>
						<div class="row">
							<label><?php _e('Contact phone', 'one'); ?></label>
							<?php ItemForm::city_area_text(); ?>
						</div>
					</div>						
					<?php ItemForm::plugin_edit_item(); ?>
					<?php if( osc_recaptcha_items_enabled() ) {?>
                        <div class="box">
                            <div class="row">
                                <?php osc_show_recaptcha(); ?>
							</div>
						</div>
					<?php }?>
                    <button class="itemFormButton" type="submit"><?php _e('Update', 'one'); ?></button>
                    <a href="javascript:history.back(-1)" class="go_back"><?php _e('Cancel', 'one'); ?></a>
				</fieldset>
			</form>
		</div>
		<script type="text/javascript"> 
			$(document).ready(function(){ 
				$('.sbctgg strong').click(function(){
					$('#catId').click();
				});
				$('.first_sbctgg strong').click(function(){
					$('#catId').click();
				});
				$("#catId").click(function(){
					var cat_id = $(this).val();
					var url = '<?php echo osc_base_url(); ?>index.php';
					var result = '';
					if(cat_id != '') {
						if(catPriceEnabled[cat_id] == 1) {
							$("#price").closest("div").show();
							} else {
							$("#price").closest("div").hide();
							$('#price').val('') ;
						}
						$.ajax({
							type: "POST",
							url: url,
							data: 'page=ajax&action=runhook&hook=item_form&catId=' + cat_id,
							dataType: 'html',
							success: function(data){
								$("#plugin-hook").html(data);
							}
						});
					}
				});
			});
		</script>
        <?php osc_current_web_theme_path('footer.php'); ?>
	</body>
</html>