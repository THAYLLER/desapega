<?php
	/*
		*
		*                        Copyright (C) 2015 Puiu Calin
		*
		*       This program is a commercial software. Copying or distribution without a license is forbidden.
		*     
	*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php'); ?>
        <?php if( osc_count_items() == 0 || Params::getParam('iPage') > 0 || stripos($_SERVER['REQUEST_URI'], 'search') )  { ?>
            <meta name="robots" content="noindex, nofollow" />
            <meta name="googlebot" content="noindex, nofollow" />
			<?php } else { ?>
            <meta name="robots" content="index, follow" />
            <meta name="googlebot" content="index, follow" />
		<?php } ?>                 
		<script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('search.js') ; ?>"></script>
	</head>
    <body class="hisss">
        <?php osc_current_web_theme_path('header.php'); ?>
		<div class="subscribe">
			<div class="search_w">
				<div class="close"></div>
				<?php osc_alert_form(); ?>
			</div>
		</div>	
		<div class="search_top">
			<div class="filters">
				<form action="<?php echo osc_base_url(true); ?>" method="get" id="search" onsubmit="return doSearch()" class="nocsrf">
					<input type="hidden" name="page" value="search" />
					<input type="hidden" name="sOrder" value="<?php echo osc_esc_html(osc_search_order()); ?>" />
					<input type="hidden" class="sShowAs" id="sShowAs" name="sShowAs" value="<?php echo Params::getParam('sShowAs'); ?>" />
					<input type="hidden" class="OnlyPremium" id="OnlyPremium" name="OnlyPremium" value="<?php echo Params::getParam('OnlyPremium'); ?>" />
					<input type="hidden" name="sCompany" class="sCompany" id="sCompany" value="<?php echo Params::getParam('sCompany');?>" />
					<input type="hidden" name="iOrderType" value="<?php $allowedTypesForSorting = Search::getAllowedTypesForSorting(); echo osc_esc_html($allowedTypesForSorting[osc_search_order_type()]); ?>" />
					<?php foreach(osc_search_user() as $userId) { ?>
						<input type="hidden" name="sUser[]" value="<?php echo $userId; ?>" />
					<?php } ?>
					<fieldset class="box location">
						<div class="row one_input">
							<input type="text" name="sPattern" placeholder="<?php _e('Your search', 'one'); ?>...." id="query" value="<?php echo osc_esc_html( osc_search_pattern() ); ?>" />    							
   							<?php 
								$result_country = osc_get_countries();
								if(count($result_country) > 1){ ?>
								<div class="loc_res">
									<?php $country_m = Country::newInstance()->listAll(); ?>
									<?php  if(count($country_m) >= 0 ) { ?>
										<select id="sCountry" name="sCountry"   class="">
											<option value=""><?php _e('Select a Country', 'one'); ?></option>
											<?php  foreach($country_m as $c_m) { ?>
												<option class="sCountry"  value="<?php echo $c_m['pk_c_code']; ?>" <?php if(Params::getParam('sCountry') == $c_m['pk_c_code']) { ?>selected id="selecteddd"<?php } ?>><?php echo $c_m['s_name'] ; ?></option>
											<?php } ?>
										</select><?php } ?>
										<select    name="sRegion" id="sRegion"  class=""> 
											<option value=""><?php _e('Selecionar Região', 'one'); ?></option>
										</select>
										<select    name="sCity" id="sCity"  class=""> 
											<option value=""><?php _e('Selecionar Cidade', 'one'); ?></option>
										</select>
								</div>
								<?php } else { ?>
								<div class="cat_select">
									<?php  if ( !osc_search_category() ) { ?>
										<?php osc_categories_select_one('sCategory', null, __('Selecionar Categoria', 'one')); ?>
										<?php  } else { ?>
										<?php osc_categories_select_one('sCategory', osc_search_category_id(), __('Selecionar Categoria', 'one')); ?>
									<?php  } ?>
								</div>  
								<div class="loc_res">								
									<?php if (osc_get_countries()> 0 ) {?>
										<?php  
											$dao = new DAO();
											$dao->dao->select('*');
											$dao->dao->from(DB_TABLE_PREFIX.'t_country');
											$result = $dao->dao->get();
											$code = $result->row();	
											$country = $code['pk_c_code'];
										?><?php } ?>            
										<?php $aRegions = Region::newInstance()->getByCountry($country); ?>
										<?php  if(count($aRegions) >= 0 ) { ?>
											<select id="sRegion" name="sRegion"   class="">
												<option value=""><?php _e('Selecionar Região', 'one'); ?></option>
												<?php  foreach($aRegions as $region) { ?>
													<option class="sRegion"  value="<?php echo $region['pk_i_id']; ?>" <?php if(Params::getParam('sRegion') == $region['pk_i_id']) { ?>selected id="selecteddd"<?php } ?>><?php echo $region['s_name'] ; ?></option>
												<?php } ?>
											</select><?php } ?>
											<select    name="sCity" id="sCity"  class=""> 
												<option value=""><?php _e('Selecionar Cidade', 'one'); ?></option>
											</select>	
								</div>	
							<?php } ?>
						</div>
					</fieldset>
					<fieldset class="box show_only">                           
						<div id="search-example"></div>  
						<?php 
							$result_country = osc_get_countries();
							if(count($result_country) > 1){ ?>
							<div class="cat_select ct">
								<?php  if ( !osc_search_category() ) { ?>
									<?php osc_categories_select_one('sCategory', null, __('Selecionar Categoria', 'one')); ?>
									<?php  } else { ?>
									<?php osc_categories_select_one('sCategory', osc_search_category_id(), __('Selecionar Categoria', 'one')); ?>
								<?php  } ?>
							</div> 
						<?php } ?>
						<?php if( osc_price_enabled_at_items() ) { ?>
                            <div class="row two_input">                                
                                <div class="min"><span class="onee"><?php _e('Min', 'one'); ?></span><input type="text" id="priceMin" name="sPriceMin" placeholder="<?php _e('Preço Min.', 'one'); ?>" value="<?php echo osc_esc_html(osc_search_price_min()); ?>"  size="6" /></div>
                                <div class="max"><span class="onee"><?php _e('Max', 'one'); ?></span><input type="text" id="priceMax" name="sPriceMax" value="<?php echo osc_esc_html(osc_search_price_max()); ?>" placeholder="<?php _e('Preço Max.', 'one'); ?>" size="6" /></div>
							</div>
						<?php } ?> 
						<?php if( osc_images_enabled_at_items() ) { ?>
                            <div class="row checkboxes">
                                <ul>
                                    <li>
                                        <input type="checkbox" name="bPic" id="withPicture" value="1" <?php echo (osc_search_has_pic() ? 'checked="checked"' : ''); ?> />
                                        <label for="withPicture"><?php _e('Show only listings with pictures', 'one'); ?></label>
									</li>
								</ul>
							</div>
						<?php } ?>
					</fieldset>
					<div class="filter_plugin">
                        <?php
                            if(osc_search_category_id()) {
                                osc_run_hook('search_form', osc_search_category_id());
								} else {
                                osc_run_hook('search_form');
							}
						?>
					</div>
					<div class="force">						
                        <button type="submit"><div class="icon"></div><?php _e('Apply', 'one'); ?></button>
						<div class="show" title="<?php _e ('Subscribe to this search', 'one'); ?>"></div>
						<div class="reset"><span></span><ins><?php _e ('Limpar filtros', 'one'); ?></ins></div>
					</div>	
				</form>									               
			</div>
		</div>		
        <div class="content list">			
			<div class="user_type">
				<div class="search_num">
					<?php
						$search_number = one_search_number();
						printf(__('%1$d - %2$d de %3$d anúncios', 'bender'), $search_number['from'], $search_number['to'], $search_number['of']);
					?></div>
					<div class="all <?php if(Params::getParam('sCompany') == '' or Params::getParam('sCompany') == null) { ?>active<?php } ?>"><span><?php _e('All'); ?></span><div class="force_down"></div></div>
					<div class="personal <?php if(Params::getParam('sCompany') == '0') { ?>active<?php } ?>"><span><?php _e('Usuário'); ?></span></div>
					<div class="firm <?php if(Params::getParam('sCompany') == '1') { ?>active<?php } ?>"><span><?php _e('Company'); ?></span></div>
			</div>
            <div id="main">
				<div class="home">
					<?php breadcrumbs_one(); ?>
				</div>
				<div class="subcateg_list">
					<?php $spubcat = get_categoriesOlx(); ?>
					<?php if (!isset($spubcat[2]) && !isset($spubcat[1]) && isset($spubcat[0])) { ?>
						<?php ;
							foreach(get_subcategories() as $subcat) {
								echo "<li><span><a href='".$subcat["url"]."'><span>".$subcat["s_name"]."</span></a> <span class='color'>" . get_category_num_items($subcat) . "</span></span></li>";
							} }?>
				</div>			
                <div class="ad_list">
                    <div id="list_head">
                        <div class="inner">
							<div class="option">
								<div class="show_thext"><?php _e("Anúncios patrocinados", "one"); ?> 
									<?php if(Params::getParam('OnlyPremium') == 0){ ?>
										<a href="<?php echo osc_esc_html(osc_update_search_url(array('OnlyPremium'=>1, 'iPage'=>null))); ?>"><?php _e('Todos os anúncios prêmio', 'one'); ?></a>
										<?php } else { ?>
										<a href="<?php echo osc_esc_html(osc_update_search_url(array('OnlyPremium'=>0, 'iPage'=>null))); ?>"><?php _e('Voltar para todos os anúncios', 'one'); ?></a>
									<?php } ?>
								</div>
								<div class="promote_text">
									<span><?php _e('Vender rápido', 'one'); ?>. 
										<?php if(Params::getParam('OnlyPremium') == 1){ ?>
											<a href="<?php echo osc_esc_html(osc_update_search_url(array('OnlyPremium'=>0, 'iPage'=>null))); ?>"><?php _e('Voltar para todos os anúncios', 'one'); ?></a>
											<?php } ?>
									<a href="<?php echo osc_user_login_url(); ?>"><?php _e('Promover se anúncio aqui', 'one'); ?></a>!</span>
								</div>
							</div>
                            <h1>
                                <strong><?php echo search_title(); ?></strong>
							</h1>							
							<div class="see_by">					   
								<span><?php _e('Sort by', 'one'); ?>:</span>
								<span class="box_select">
									<?php
										$orders = osc_list_orders();
										$current = '';
										foreach($orders as $label => $params) {
											$orderType = ($params['iOrderType'] == 'asc') ? '0' : '1';
											if(osc_search_order() == $params['sOrder'] && osc_search_order_type() == $orderType) {
												$current = $label;
											}
										}
									?>
									<label><?php echo $current; ?></label>
									<b class="arrow-down"></b>
								</span>
								<?php $i = 0; ?>			
								<ul class="drop">
									<?php
										foreach($orders as $label => $params) {
										$orderType = ($params['iOrderType'] == 'asc') ? '0' : '1'; ?>
										<?php if(osc_search_order() == $params['sOrder'] && osc_search_order_type() == $orderType) { ?>
											<li><a class="current" href="<?php echo osc_esc_html(osc_update_search_url($params)); ?>"><?php echo $label; ?></a></li>
											<?php } else { ?>
											<li><a href="<?php echo osc_esc_html(osc_update_search_url($params)); ?>"><?php echo $label; ?></a></li>
										<?php } ?>
										<?php $i++; ?>
									<?php } ?>
								</ul>
							</div>
							<div class="show_as">
								<span><?php _e('Modo', 'one'); ?>:</span>
								<?php $paramst['sShowAs'] = 'gallery'; ?>
								<a class="gall <?php echo Params::getParam('sShowAs'); ?>" title="<?php echo 'Gallery'; ?>" href="<?php echo osc_update_search_url($paramst) ; ?>"><span></span></a>
								<?php $paramst['sShowAs'] = 'list'; ?>
								<a class="lis <?php echo Params::getParam('sShowAs'); ?>" title="<?php echo 'List'; ?>"href="<?php echo osc_update_search_url($paramst) ; ?>"><span></span></a>
							</div>
						</div>
					</div>					
                    <?php if(osc_count_items() == 0) { ?>
                        <p class="empty result" ><?php printf(__('There are no results matching "%s"', 'one'), osc_search_pattern()); ?></p>
						<?php } else { ?>
                        <?php osc_run_hook('search_ads_listing_top_one'); ?>
                        <?php require(osc_search_show_as() == 'list' ? 'search_list.php' : 'search_gallery.php'); ?>
                        <div class="paginate" >
							<?php echo osc_search_pagination(); ?>
						</div>
					<?php } ?> 
                    <div class="clear"></div>                 
				</div>
			</div>
			<script type="text/javascript">
				$(document).ready(function() {
					$('.user_type div').click(function() {
						if($(this).hasClass('all')) {
							$('input#sCompany').val('');
						}
						if($(this).hasClass('personal')) {
							$('input#sCompany').val(0);
						}
						if($(this).hasClass('firm')) {
							$('input#sCompany').val(1);
						}
						$('.search_top .button').click();
					});
				});
			</script>    
			<?php 
				$result_countrys = osc_get_countries();
				if(count($result_countrys) > 1){ ?>
				<script>
					$(document).ready(function() { 
						//@for region
						var nume_regiune = '<?php echo osc_esc_html(osc_search_region()); ?>';
						if(nume_regiune !=''){
							$('#uniform-sRegion span').text(nume_regiune);
						}
						$("#sCountry").on("change",function(){
						    $("#sCity").attr('disabled',true);
							$('#uniform-sCity span').text('<?php _e("Selecionar Cidade", "one"); ?>');
							var pk_c_code = $(this).val();						
							var url = '<?php echo osc_base_url(true)."?page=ajax&action=regions&countryId="; ?>' + pk_c_code;
							$('#uniform-sRegion span').text('<?php _e("Selecionar Região", "one"); ?>');
							var result = '';
							if(pk_c_code != '') {
								$("#sRegion").attr('disabled',false);
								$.ajax({
									type: "GET",
									url: url,
									dataType: 'json',
									success: function(data){
										var length = data.length;
										if(length > 0) {
											result += '<option selected value=""><?php _e("Selecionar Região", "one"); ?></option>';
											for(key in data) {
												result += '<option value="' + data[key].pk_i_id + '">' + data[key].s_name + '</option>';
											}
											$("#region").before('<select name="sRegion" id="sRegion" ></select>');
											$("#region").remove();
											} else {
											result += '<option value=""><?php _e('No results') ?></option>';
											$("#sRegion").before('<input type="text" name="region" id="region" />');
											$("#sRegion").remove();
										}
										$("#sRegion").html(result);
									}
								});
								} else {
								$("#sRegion").attr('disabled',true);
							}
						});
						if( $("#sCountry").attr('value') == "")  {
							$("#sRegion").attr('disabled',true);
						}
						//if country is not empty echo option to select region
						if( $("#sCountry").attr('value') !="")  {
							var value = $('#sCountry #selecteddd').val();
							var url = '<?php echo osc_base_url(true)."?page=ajax&action=regions&countryId="; ?>' + value;
							var results = '';
							if(value != '') {
								$("#sRegion").attr('disabled',false);
								$.ajax({
									type: "GET",
									url: url,
									dataType: 'json',
									success: function(data){
										var length = data.length;
										if(length > 0) {
											results += '<option selected value=""><?php _e("Selecionar Cidade", "one"); ?></option>';
											for(key in data) {
												results += '<option value="' + data[key].pk_i_id + '">' + data[key].s_name + '</option>';
											}
											$("#region").before('<select name="sRegion" id="sRegion" ></select>');
											$("#region").remove();
											} else {
											results += '<option value=""><?php _e('No results') ?></option>';
											$("#sRegion").before('<input type="text" name="region" id="region" />');
											$("#sRegion").remove();
										}
										$("#sRegion").html(results);
										var regiune = '<?php echo Params::getParam('sRegion');?>';																	
										$('#sRegion option[value="'+ regiune +'"]').attr('selected',true);
									}
								});
								} else {
								$("#sRegion").attr('disabled',true);
							}
						}
						//@for city
						var nume = '<?php echo osc_esc_html(osc_search_city()); ?>';
						if(nume !=''){
							$('#uniform-sCity span').text(nume);
						}
						$("#sRegion").on("change",function(){
							$('#uniform-sCity span').text('<?php _e("Selecionar Cidade", "one"); ?>');
							var pk_c_code = $(this).val();						
							var url = '<?php echo osc_base_url(true)."?page=ajax&action=cities&regionId="; ?>' + pk_c_code;
							var result_c = '';
							if(pk_c_code != '') {
								$("#sCity").attr('disabled',false);
								$.ajax({
									type: "GET",
									url: url,
									dataType: 'json',
									success: function(data){
										var length = data.length;
										if(length > 0) {
											result_c += '<option selected value=""><?php _e("Selecionar Cidade", "one"); ?></option>';
											for(key in data) {
												result_c += '<option value="' + data[key].pk_i_id + '">' + data[key].s_name + '</option>';
											}
											$("#city").before('<select name="sCity" id="sCity" ></select>');
											$("#city").remove();
											} else {
											result_c += '<option value=""><?php _e('No results') ?></option>';
											$("#sCity").before('<input type="text" name="sCity" id="sCity" />');
											$("#sCity").remove();
										}
										$("#sCity").html(result_c);
									}
								});
								} else {
								$("#sCity").attr('disabled',true);
							}
						});
						var check_region = '<?php echo Params::getParam('sRegion');?>';//check for region selection
						if(check_region == "")  {
							$("#sCity").attr('disabled',true);
						}
						if(check_region !="")  {
							var value = check_region;
							var url = '<?php echo osc_base_url(true)."?page=ajax&action=cities&regionId="; ?>' + value;
							var results_c = '';
							if(value != '') {
								$("#sCity").attr('disabled',false);
								$.ajax({
									type: "GET",
									url: url,
									dataType: 'json',
									success: function(data){
										var length = data.length;
										if(length > 0) {
											results_c += '<option selected value=""><?php _e("Selecionar cidade", "one"); ?></option>';
											for(key in data) {
												results_c += '<option value="' + data[key].pk_i_id + '">' + data[key].s_name + '</option>';
											}
											$("#city").before('<select name="sCity" id="sCity" ></select>');
											$("#city").remove();
											} else {
											results_c += '<option value=""><?php _e('No results') ?></option>';
											$("#sCity").before('<input type="text" name="sCity" id="sCity" />');
											$("#sCity").remove();
										}
										$("#sCity").html(results_c);
										var oras = '<?php echo Params::getParam('sCity');?>';																	
										$('#sCity option[value="'+ oras +'"]').attr('selected',true);
									}
								});
								} else {
								$("#sCity").attr('disabled',true);
							}
						}
					});
				</script>
				<?php } else { ?>
				<script type="text/javascript">
					$(document).ready(function() { 	
						var nume = '<?php echo osc_esc_html(osc_search_city()); ?>';
						if(nume !=''){
							$('#uniform-sCity span').text(nume);
						}
						$("#sRegion").on("change",function(){
							var pk_c_code = $(this).val();						
							var url = '<?php echo osc_base_url(true)."?page=ajax&action=cities&regionId="; ?>' + pk_c_code;
							var result = '';
							if(pk_c_code != '') {
								$("#sCity").attr('disabled',false);
								$.ajax({
									type: "GET",
									url: url,
									dataType: 'json',
									success: function(data){
										var length = data.length;
										if(length > 0) {
											result += '<option selected value=""><?php _e("Selecionar Cidade", "one"); ?></option>';
											for(key in data) {
												result += '<option value="' + data[key].pk_i_id + '">' + data[key].s_name + '</option>';
											}
											$("#city").before('<select name="sCity" id="sCity" ></select>');
											$("#city").remove();
											} else {
											result += '<option value=""><?php _e('No results') ?></option>';
											$("#sCity").before('<input type="text" name="city" id="city" />');
											$("#sCity").remove();
										}
										$("#sCity").html(result);
									}
								});
								} else {
								$("#sCity").attr('disabled',true);
							}
						});
						if( $("#sRegion").attr('value') == "")  {
							$("#sCity").attr('disabled',true);
						}
						if( $("#sRegion").attr('value') !="")  {
							var value = $('#sRegion #selecteddd').val();
							var url = '<?php echo osc_base_url(true)."?page=ajax&action=cities&regionId="; ?>' + value;
							var results = '';
							if(value != '') {
								$("#sCity").attr('disabled',false);
								$.ajax({
									type: "GET",
									url: url,
									dataType: 'json',
									success: function(data){
										var length = data.length;
										if(length > 0) {
											results += '<option selected value=""><?php _e("Selecionar Cidade", "one"); ?></option>';
											for(key in data) {
												results += '<option value="' + data[key].pk_i_id + '">' + data[key].s_name + '</option>';
											}
											$("#city").before('<select name="sCity" id="sCity" ></select>');
											$("#city").remove();
											} else {
											results += '<option value=""><?php _e('No results') ?></option>';
											$("#sCity").before('<input type="text" name="city" id="city" />');
											$("#sCity").remove();
										}
										$("#sCity").html(results);
										var oras = '<?php echo Params::getParam('sCity');?>';																	
										$('#sCity option[value="'+ oras +'"]').attr('selected',true);
									}
								});
								} else {
								$("#sCity").attr('disabled',true);
							}
						}
					});
				</script>
			<?php } ?>
		</div>
		<div class="search_main_categories">
			<script type="text/javascript" >
				$(document).ready(function() {
					$(".hisss .search_main_categories span ").click(function(){
						$(".hisss .search_main_categories .hiddd").show();
					});
				});	 
			</script>
			<p><span><?php _e("Categorias principais", 'one');?></span></p>
			<div class="hiddd">
				<strong><?php _e("Main categories", 'one');?> :</strong>
				<?php osc_goto_first_category() ; ?>
                <?php if(osc_count_categories () > 0) { ?>
                    <?php while ( osc_has_categories() ) { ?>
						<ul><li>
						<a href="<?php echo osc_search_category_url() ; ?>"><span><?php echo osc_category_name() ; ?> </span></a></li></ul>,
					<?php } ?>				                  
				<?php } ?>
			</div>
		</div>
		<div class="lct">
			<?php if ( !View::newInstance()->_exists('list_contries') ) {
				View::newInstance()->_exportVariableToView('list_regions', Search::newInstance()->listRegions('%%%%', '>=', 'region_name ASC') ) ;
			}
			if( osc_count_list_regions() ) { ?>
			<?php while( osc_has_list_regions() ) { ?>
				<ul><li>
					<a href="<?php echo osc_search_url( array( 'sRegion' => osc_list_region_id() ) ) ; ?>"><span><?php echo osc_list_region_name() ; ?></span></a> (<?php echo osc_list_region_items() ; ?>)
				</li></ul>
			<?php } ?>
			<?php } ?>
		</div>
		<?php if( osc_get_preference('save_latest_searches', 'osclass') == 1) { ?>
			<div class="frecvent">		
				
				<?php if(osc_count_latest_searches()>0) { ?>
					<?php most_used_search();?>
				<?php } ?>		
			</div>
		<?php } ?>
        <?php osc_current_web_theme_path('footer.php'); ?>
	</body>
</html>