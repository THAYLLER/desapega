<div class="second_categoriess">
	<?php 
		$result_country = osc_get_countries();
		if(count($result_country) > 1){ ?>
		<div class="country_new">
			<?php $as = Country::newInstance()->listAll(); ?>
			<div class="text_countryy"><?php _e('Select your Country', 'one'); ?></div>
			<?php if(count($as) > 0 ) { ?>
				<?php foreach($as as $s) { ?>
					<strong id="<?php echo $s['pk_c_code'] ; ?>"><?php echo $s['s_name'] ; ?></strong>
				<?php } ?>
			<?php } ?>
		</div>
		<div class="top_selection new">
			<div class="text"><div class="all_serch"><span class="span"></span><div class="allc_tohide"><?php _e("All Country", 'one'); ?></div></div>				
				<div class="search_hide">
					<form action="<?php echo osc_base_url(true); ?>" method="get" class="second_search" <?php /* onsubmit="javascript:return doSearch();"*/ ?>>
						<input type="hidden" name="page" value="search" />
						<fieldset class="main">
							<input type="hidden" name="sRegion" id="newsRegion"/>
							<input type="hidden" id="sCategory" name="sCategory"/>
							<input type="hidden" name="sCountry" id="sCountry"/>
							<div class="new_input"><div class="to_select"><?php _e('Select a region...', 'one'); ?></div></div>
							<div class="regionnew">	
								<div class="sicon"></div>		
								<div class="alltw"><div class="back_countryy"><< <?php _e('Back to Country', 'one'); ?></div> <?php _e('Select your Region', 'one'); ?> <div class="only_c"><?php _e('Todo país', 'one'); ?></div></div>
									<div class="region_new">
									</div>
								</div>
								<input class="sub" type="submit" value=""></input>
								</fieldset>
							</form>
						</div>
					</div> 
					<div class="text_for">
						<div class="change_location">
							<span><?php _e('Change location', 'one'); ?></span>
						</div>
						<div class="save_location">
							<span><?php _e('Save location', 'one'); ?></span>
						</div>
					</div>
					<script type="text/javascript">
						$( document ).ready(function() { 					
							$(".country_new strong").on("click",function(event){
								event.stopPropagation();
								$(".country_new").fadeOut();
								$('.region_new').show();
								$('.regionnew').fadeIn(700);
								var pk_c_code = $(this).attr('id');
								var text = $(this).text();
								$('.top_selection #sCountry').val(pk_c_code);
								$('.allc_tohide').html(text);
								var url = '<?php echo osc_base_url(true)."?page=ajax&action=regions&countryId="; ?>' + pk_c_code;    
								var result = '';
								if(pk_c_code != '') {
									$.ajax({
										type: "GET",
										url: url,
										dataType: 'json',
										success: function(data){
											var length = data.length;
											if(length > 0) {
												for(key in data) {
													result += '<span id="regiune" class="' + data[key].pk_i_id + '"><strong>' + data[key].s_name + '</strong></span>';
												}										
											}
											$(".region_new").html(result);
											$(".region_new").addClass('active');
										}
									});
								}
							});
							$('.region_new').on('click', '#regiune', function() {
								$('.change_location').hide();
								$('.regionnew').hide();
								var country_val = $('.top_selection #sCountry').val();
								var country_text = $('#'+country_val).text();
								var value = $(this).attr('class');
								var text = $(this).text();
								var r_text = ', '+text;
								$('.to_select').html(text);
								$('.allc_tohide').html(country_text+r_text);
								$('#newsRegion').val(value);
							});
							$('.back_countryy').click(function(event) {
								event.stopPropagation();
								$('.country_new').show().animate({top: '10px'});
								$('.regionnew').hide();
								$('#newsRegion').val('');
								$('.to_select').html('');
							});
							$('.only_c').click(function(event) {
								event.stopPropagation();
								var country_val = $('.top_selection #sCountry').val();
								var country_text = $('#'+country_val).text();
								$('.allc_tohide').html(country_text);
								$('.all_serch').show(); 
								$('.change_location').show();
								$('.save_location').hide();
								$('.search_hide').hide();	
								$('.regionnew').hide();
								$('#newsRegion').val('');
							});
							//functia asta sa ascunda textul si sa-l afisez cel selectat
							$('.text_for .change_location, .all_serch').click(function(event){
								event.stopPropagation();
								if($('.region_new.active').length){
									$('.regionnew').show();
									} else {
									$('.country_new').show().animate({top: '10px'});
								}
								$('.change_location').hide();
								$('.save_location').show();
								$('.search_hide').show();
								$('.all_serch').hide();   
							});
							$('.text_for .save_location').click(function() {
								$('.change_location').show();
								$('.save_location').hide();
								$('.search_hide').hide();
								$('.all_serch').show();  
							});
							
							$('html').click(function() {
								$('.change_location').show();
								$('.save_location').hide();
								$('.all_serch').show(); 
								$('.search_hide').hide();						
								$('.country_new').hide();
								$('.regionnew').hide();
							});
						});		
					</script>
				</div>
				<?php } else { ?>
				<div class="top_selection">
					<div class="text"><div class="all_serch"><span class="span"></span><div class="allc_tohide"><?php _e("Todo País", 'one'); ?></div><div class="new_value"></div></div>
						<div class="search_hide">
							<form action="<?php echo osc_base_url(true); ?>" method="get" class="second_search" <?php /* onsubmit="javascript:return doSearch();"*/ ?>>
								<input type="hidden" name="page" value="search" />
								<fieldset class="main">
									<input type="hidden" name="sRegion" id="newsRegion"/>
									<input type="hidden" id="sCategory" name="sCategory"/>  
									<div class="new_input"><div class="to_select"><?php _e('Select a region...', 'one'); ?></div><div class="replace"></div></div>
									<div class="regionnew">	
										<div class="sicon"></div>		
										<div class="alltw"><strong><?php _e('Todo País', 'one'); ?></strong></div>
										<?php $aRegions = Region::newInstance()->listAll(); ?>
										<?php if(count($aRegions) > 0 ) { ?>
											<?php foreach($aRegions as $region) { ?>
												<p class="<?php echo $region['pk_i_id'] ; ?>"><strong><?php echo $region['s_name'] ; ?></strong>
												</p>
											<?php } ?>
										<?php } ?>
									</div>
									<input class="sub" type="submit" value=""></input>
								</fieldset>
							</form>
						</div>
					</div> 
					<div class="text_for">
						<div class="change_location">
							<span><?php _e('Mudar localização', 'one'); ?></span>
						</div>
						<div class="save_location">
							<span><?php _e('Save location', 'one'); ?></span>
						</div>
					</div>
					<script type="text/javascript">
						$( document ).ready(function() { 
							$('.new_input').click(function() {
								$('.regionnew').show();
								$("#sRegion").val('');	// scoate valorile selectate anterior
								$("#newsRegion").val('');
								$(".replace").html("");
								$(".new_value").html("");
							});
							
							$('html').click(function() {
								$('.regionnew').hide();
							});
							
							$('.new_input ').click(function(event){
								event.stopPropagation();
							});
							
							$('.regionnew p').click(function() {
								$('.regionnew').hide();
								var value = $(this).attr('class');
								var input = $('#newsRegion');
								input.val(input.val() + value);
								return false;
							});
							//functia asta sa ascunda textul si sa-l afisez cel selectat
							$('.alltw, .regionnew p').click(function() {
								$('.allc_tohide').hide();
								$('.to_select').hide();
								var chat_screen = $(this).text();
								$(".replace").append(chat_screen);
								$(".new_value").append(chat_screen);
							});
							
							//functia asta sa ascunda textul si sa-l afisez cel selectat
							$('.text_for .change_location, .all_serch').click(function() {
								$('.change_location').hide();
								$('.save_location').show();
								$('.search_hide').show();
								$('.all_serch').hide();   
							});
							$('.text_for .save_location').click(function() {
								$('.change_location').show();
								$('.save_location').hide();
								$('.search_hide').hide();
								$('.all_serch').show();  
							});
						});		
					</script>
				</div>
			<?php } ?>
			<div class="force_down">
			</div>
			<div class="sidebar_categ">
				<div class="title">
					<h3><?php _e('Main categories', 'one') ; ?></h3>
				</div>
				<div class="all_ads">
					<a href="<?php echo osc_search_show_all_url();?>"><?php _e("See all offers", 'one'); ?></a>
				</div>
				<div class="casst">
					<?php osc_goto_first_category(); ?>
					<?php while ( osc_has_categories() ) { ?>
						<div class="second_category">
							<div class="thisone">
								<strong id="one<?php echo osc_category_id(); ?>"class="second cat_<?php echo osc_category_id(); ?>"><?php echo osc_category_name(); ?>
									<span class="ist">
									</span>
								</strong>
							</div>
							<div id="loopone<?php echo osc_category_id(); ?>" class="parent" >
							<?php
									if(file_exists(osc_themes_path() . 'one/images/categ_image/' . osc_category_id() . '.png')) {
										$img_g = osc_base_url() . 'oc-content/themes/one/images/categ_image/' . osc_category_id() . '.png';
										} else {
										$img_g = osc_base_url() . 'oc-content/themes/one/images/none.png';
									}
								?> 
								<div class="image_st"><img src="<?php echo $img_g; ?>" width="" height="" alt="<?php echo osc_category_name(); ?>" />
								</div>
								<div class="name"><?php echo osc_category_name(); ?></div>
								<p><?php echo osc_category_total_items(); ?> <?php _e("ads", 'one'); ?></p>
								<span class="<?php echo osc_category_id(); ?>"><?php _e("See all offers", 'one'); ?> >></span>
							</div>
							<?php if ( osc_count_subcategories() > 0 ) { ?>
								<div class="subcategory">                                     
									<?php while ( osc_has_subcategories() ) { ?>									
										<strong class="<?php echo osc_category_id() ; ?>">			
											<span class="sub_subcategimg"><img src="<?php if(file_exists(osc_themes_path() . 'one/images/categ_image/' . osc_category_id() . '.png')) { echo osc_base_url() . 'oc-content/themes/one/images/categ_image/' . osc_category_id() . '.png'; } else { echo osc_base_url() . 'oc-content/themes/one/images/none.png'; } ?>" width="" height="" alt="<?php echo osc_category_name() ; ?>" /></span>
										<span class="title_sub"><?php echo osc_highlight( strip_tags( osc_category_name() ),33 ); ?></span></strong>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
			<script type="text/javascript">
				$(document).ready(function(){
					$('.second_category .subcategory strong').click(function() {
						var value = $(this).attr('class');
						var input = $('#sCategory');
						input.val(input.val() + value);
						$('.sub').click();
						return false;	
					});
					
					$('.second_category .parent span').click(function() { //pentru categoriile principale salveaza selectia la regiune
						var value = $(this).attr('class');
						var input = $('#sCategory');
						input.val(input.val() + value);
						$('.sub').click();
						return false;	
					});
					
					
					$(".second_category .thisone strong").click(function() { 
						$('.parent').removeClass('selected');
						$('#loop' + this.id).addClass('selected');
					})
					
					$(".second_category strong").click(function() {
						var category = $(this).attr('class');
						$('#one' + category).addClass('red').click();    
					})
					
					$('.casst .second').click(function() {
						$('.second').removeClass('red');
						$(this).addClass('red');
					})
					
					$('.second').live('click',function(){		  
						$(".subcategory").removeClass("active");			   
						$(this).parents('.second_category').find('.subcategory').addClass("active");			
						$(".force_down").css({'height':($(".subcategory.active").height()+'px')});				
					});
				});	
			</script>
		</div>		