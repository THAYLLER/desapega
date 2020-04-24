<?php
    /*
		*
		*                        Copyright (C) 2015 Puiu Calin
		*
		*       This program is a commercial software. Copying or distribution without a license is forbidden.
		*     
	*/
?>
<?php 
	$result_country = osc_get_countries();
	if(count($result_country) > 1){ ?>
	<script type="text/javascript">
		$( document ).ready(function() {
			$(".country strong").on("click",function(event){
				event.stopPropagation();
				$(".country").fadeOut();
				$('.region_c').show();
				$('.regionselect').fadeIn(700);
				var pk_c_code = $(this).attr('class');
				var text = $(this).text();
				$('#sCountry').val(pk_c_code);
				$('.top_selection #sCountry').val(pk_c_code);
				$('.slectt').html(text);
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
							$(".regions").html(result);
							$(".region_new").html(result);
							$(".region_new").addClass('active');
							$(".regions").addClass('active');
						}
					});
				}
			});
			$('.input_visibile').click(function(event) {
				event.stopPropagation();
				if($('.regions.active').length){
					$('.regionselect').show();
					} else {
					$('.country').show().animate({top: '80px'});
				}
				$('#sRegion').val('');				
			});
			$('.regions').on('click', '#regiune', function() {
				$('.regionselect').hide();
				var value = $(this).attr('class');
				var text = $(this).text();
				var country_val = $('.top_selection #sCountry').val();
				var country_text = $('.'+country_val).text();
				var text = $(this).text();
				var r_text = ', '+text;
				$('.slectt').html(country_text+r_text);
				$('.allc_tohide').html(country_text+r_text);
				$('#sRegion').val(value);
				$('#newsRegion').val(value);
			});
			$('html').click(function() {
				$('.country').hide();
				$('.regionselect').hide();
			});
			$('.back_country').click(function(event) {
				event.stopPropagation();
				$('.country').show().animate({top: '80px'});
				$('.regionselect').hide();
			});
			$('.only_sc').click(function(event) {
				event.stopPropagation();
				var country_val = $('.top_selection #sCountry').val();
				var country_text = $('#'+country_val).text();
				$('.allc_tohide').html(country_text);
				$('.slectt').html(country_text); 				
				$('#newsRegion').val('');
				$('#sRegion').val('');
				$('.regionselect').hide();
			});
		});
	</script>
	<div class="country">
		<?php $aC = Country::newInstance()->listAll(); ?>
		<div class="text_countryy"><?php _e('Selecione seu País', 'one'); ?></div>
		<?php if(count($aC) > 0 ) { ?>
			<?php foreach($aC as $c) { ?>
				<strong class="<?php echo $c['pk_c_code'] ; ?>"><?php echo $c['s_name'] ; ?></strong>
			<?php } ?>
		<?php } ?>
	</div>
	<form action="<?php echo osc_base_url(true); ?>" method="get" class="search nocsrf" <?php /* onsubmit="javascript:return doSearch();"*/ ?>>
		<input type="hidden" name="page" value="search" />
		<fieldset class="main">
			<div class="backf">
				<input type="text" name="sPattern" placeholder="<?php echo osc_esc_html(__(osc_get_preference('keyword_placeholder', 'one'), 'one')); ?>" id="query" value="" />
				<div class="one_autocomplete_search">
					<h3><?php _e('Related results', 'one'); ?></h3>
					<div class="one_autocomplete_list">						
					</div>
				</div>
				<input type="hidden" name="sRegion" id="sRegion"/>
				<input type="hidden" name="sCountry" id="sCountry"/>
				<div class="input_visibile"><span class="slectt"><?php _e('Selecione País...', 'one'); ?></span></div>
				<div class="regionselect">
					<div class="icon"></div>										
					<div class="region_c">
						<div class="text_country"><div class="back_country"><< <?php _e('Voltar ao País', 'one'); ?></div><?php _e('Selecionar Região', 'one'); ?><div class="only_sc"><?php _e('Todo País', 'one'); ?></div></div>
							<div class="regions"></div>
						</div>
						</div>	
					</div>
					<div class="home_b"><input class="clicc" type="submit" value=""/><span class="icon"></span><span class="clic"><?php _e('Search', 'one'); ?></span></div>
				</fieldset>
				<div id="search-example"></div>
			</form>		
			<?php } else { ?>
			<script type="text/javascript">
				$( document ).ready(function() {
					$('.regionselect span').click(function() {
						$('.regionselect').hide();
						var value = $(this).attr('class');
						$('#sRegion').val(value);
						$('#newsRegion').val(value);
					});
					$('.input_visibile').click(function() {
						$('.regionselect').show();
						$("#sRegion").val('');
						$(".intr").html("");
						$("#newsRegion").val('');
						$(".replace").html("");
						$(".new_value").html("");
					});
					$('.clic').click(function() {
						$('.clicc').click();	
					});
					$('html').click(function() {
						$('.regionselect').hide();
					});
					$('.input_visibile ').click(function(event){
						event.stopPropagation();
					});
				});
				$( document ).ready(function() {
					$('.regionselect span, .all').click(function() {
						$('.slectt').hide();
						$('.to_select').hide();
						$('.allc_tohide').hide();
						var chat_screen = $(this).text();
						$(".intr").append(chat_screen);
						$(".replace").append(chat_screen);
						$(".new_value").append(chat_screen);
					});
				});
			</script>
			<form action="<?php echo osc_base_url(true); ?>" method="get" class="search nocsrf" <?php /* onsubmit="javascript:return doSearch();"*/ ?>>
				<input type="hidden" name="page" value="search" />
				<fieldset class="main">
					<div class="backf">
						<input type="text" name="sPattern" placeholder="<?php echo osc_esc_html(__(osc_get_preference('keyword_placeholder', 'one'), 'one')); ?>" id="query" value=""/>
						<div class="one_autocomplete_search">
							<h3><?php _e('Resultados relacionados', 'one'); ?></h3>
							<div class="one_autocomplete_list">						
							</div>
						</div>
						<input type="hidden" name="sRegion" id="sRegion"/>
						<div class="input_visibile"><span class="slectt"><?php _e('Selecionar a Região...', 'one'); ?></span><span class="intr"></span></div>
						<div class="regionselect">
							<div class="icon"></div>
							<div class="all"><strong><?php _e('Todo País', 'one'); ?></strong></div>
							<?php $aRegions = Region::newInstance()->listAll(); ?>
							<?php if(count($aRegions) > 0 ) { ?>
								<?php foreach($aRegions as $region) { ?>
									<span class="<?php echo $region['pk_i_id'] ; ?>"><strong><?php echo $region['s_name'] ; ?></strong></span>
								<?php } ?>
							<?php } ?>
						</div>	
					</div>
					<div class="home_b"><input class="clicc" type="submit" value=""/><span class="icon"></span><span class="clic"><?php _e('Pesquisa', 'one'); ?></span></div>
				</fieldset>
				<div id="search-example"></div>
			</form>	
		<?php } ?>
		<?php if(osc_get_preference('autocomplete_related', 'one') !== '0'){ ?>
		<script type="text/javascript">
			$( document ).ready(function() {
			if ($(window).width() > 640) {
				$('body').click(function(){
					$('.one_autocomplete_search').removeClass('active');
				});
				$('#query').on('keyup.autocomplete', function(){
					var value = $.trim($(this).val());
					var value_no_trim = $(this).val();
					var result = value_no_trim.length - value.length;
					if(result < 2 && value.length > 2){
						$.ajax({
							type: "POST",
							url: '<?php echo osc_base_url(); ?>oc-content/themes/one/ajax/autocomplete.php?action=search&value='+value,
							dataType: 'html',
							success: function(data){
								if(data !='0'){
									$('.one_autocomplete_search').addClass('active');
									$('.one_autocomplete_list').html(data);
									} else {
									$('.one_autocomplete_search').removeClass('active');
								}
							}
						});
					} else { $('.one_autocomplete_search').removeClass('active');}
				});
				}
			});			
		</script>
<?php } ?>