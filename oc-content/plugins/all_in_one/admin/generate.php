<?php 
$pluginInfo = osc_plugin_get_info('all_in_one/index.php');
$dao_preference = new Preference();

$freq = '';
if(Params::getParam('sitemap_freq') != '') {
  $freq = Params::getParam('sitemap_freq');
} else {
  $freq = (osc_get_preference('allSeo_sitemap_freq', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_sitemap_freq', 'plugin-all_in_one') : '' ;
}

$sitemap_items = '';
if(Params::getParam('sitemap_items') != '') {
  $sitemap_items = Params::getParam('sitemap_items');
} else {
  $sitemap_items = (osc_get_preference('allSeo_sitemap_items', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_sitemap_items', 'plugin-all_in_one') : '' ;
}

$sitemap_items_limit = '';
if(Params::getParam('sitemap_items_limit') != '') {
  $sitemap_items_limit = Params::getParam('sitemap_items_limit');
} else {
  $sitemap_items_limit = (osc_get_preference('allSeo_sitemap_items_limit', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_sitemap_items_limit', 'plugin-all_in_one') : '' ;
}

if(Params::getParam('plugin_action')=='done') {
  $dao_preference->update(array("s_value" => $freq), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_sitemap_freq")) ;
  $dao_preference->update(array("s_value" => $sitemap_items), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_sitemap_items")) ;
  $dao_preference->update(array("s_value" => $sitemap_items_limit), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_sitemap_items_limit")) ;

  //Generate sitemap
  $execution_time = seo_sitemap_generator();
  message_ok(__('Sitemap.xml generated correctly in', 'all_in_one') . ' ' . round($execution_time, 2) . ' ' . __('seconds', 'all_in_one') . '.');
  osc_reset_preferences();
}

unset($dao_preference) ;
?>

<div id="settings_form">
  <?php echo config_menu(); ?>
  
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>generate.php" />
    <input type="hidden" name="plugin_action" value="done" />

    <fieldset class="round3">
      <legend class="purple round2"><?php _e('Sitemap Generator', 'all_in_one'); ?></legend>
      <span class="cat-note"><a href="<?php echo osc_base_url() . 'sitemap.xml';?>" target="_blank"><i class="fa fa-sitemap"></i><?php _e('View sitemap.xml file','all_in_one'); ?></a></span>
      <span class="cat-note"><span class="note"><?php _e('Note', 'all_in_one'); ?>:</span> <?php _e('When sitemap is successfully generated, it is automatically send to Google, Bing and Yahoo.','all_in_one'); ?></span>
      <span class="cat-note"><span class="note"><?php _e('Note', 'all_in_one'); ?>:</span> <a style="margin:0;float:none;" href="<?php echo osc_base_url() . 'oc-admin/index.php?page=settings'; ?>" target="_blank"><?php _e('Check your cron job settings', 'all_in_one'); ?></a> <?php _e('if you want to generate sitemap automatically', 'all_in_one'); ?></span>

      <div class="clear" style="margin:15px 0;"></div>

      <label for="sitemap_freq" class="text-label sitemap"><?php _e('Frequency of sitemap generation', 'all_in_one'); ?> <sup class="sup-go go1">(1)</sup></label>
      <select name="sitemap_freq" id="sitemap_freq"> 
        <option <?php if($freq == 'weekly'){echo 'selected="selected"';}?>value='weekly'><?php _e('Weekly','all_in_one'); ?></option>
        <option <?php if($freq == 'daily'){echo 'selected="selected"';}?>value='daily'><?php _e('Daily','all_in_one'); ?></option>
        <option <?php if($freq == 'hourly'){echo 'selected="selected"';}?>value='hourly'><?php _e('Hourly','all_in_one'); ?></option>
        <option <?php if($freq == 'none'){echo 'selected="selected"';}?>value='none'><?php _e('No automatical refresh','all_in_one'); ?></option>
      </select>

      <div class="clear" style="margin:6px 0;"></div>

      <label for="sitemap_items" class="text-label sitemap"><?php _e('Include listings into sitemap','all_in_one'); ?> <sup class="sup-go go2">(2)</sup></label>
      <select name="sitemap_items" id="sitemap_items"> 
        <option <?php if($sitemap_items == 1){echo 'selected="selected"';}?>value='1'><?php _e('Yes','all_in_one'); ?></option>
        <option <?php if($sitemap_items == 0){echo 'selected="selected"';}?>value='0'><?php _e('No','all_in_one'); ?></option>
      </select>

      <div class="clear" style="margin:6px 0;"></div>

      <label for="sitemap_items_limit" class="text-label sitemap"><?php _e('Max count of items in sitemap','all_in_one'); ?> <sup class="sup-go go3">(3)</sup></label>
      <input type="text" name="sitemap_items_limit" id="sitemap_items_limit" value="<?php echo $sitemap_items_limit;?>" />
    </fieldset> 
      
    <br /><br />  
					                 
    <button name="theButton" id="theButton" type="submit" style="float: left;" class="btn btn-submit"><?php _e('Save & Generate Sitemap', 'all_in_one');?></button>
  </form>
  
  <div class="clear"></div>
  <br /><br />

  <div class="warn"><sup class="sup-go1">(1)</sup> <?php _e('When frequency of refresh set, sitemap will be regulary generated using osclass cron functions, therefore make sure you enabled build-in cron for your osclass (Settings > General) <strong>OR</strong> you have set external cron job that manage cron!', 'all_in_one'); ?></div>
  <div class="warn"><sup class="sup-go2">(2)</sup> <?php _e('When allowed, also listings will be included in sitemap.', 'all_in_one'); ?></div>
  <div class="warn"><sup class="sup-go3">(3)</sup> <?php _e('Too many listings included in sitemap can break sitemap generation (too much server resources - exhausting). There should not be more than 1000 listings included in sitemap.', 'all_in_one'); ?></div>
  <div class="warn"><?php _e('Maximum number of items that can be added to sitemap is 10 000, even if you enter higher number, just 10 000 listings will be included.', 'all_in_one'); ?></div>
  <div class="warn"><?php _e('Maximum execution time on your server is', 'all_in_one'); ?> <strong><?php echo ini_get('max_execution_time'); ?> <?php _e('seconds', 'all_in_one'); ?></strong>. <?php _e('If generation of sitemap takes almost as long as is execution time, contact your hosting provider to increase Maximum execution time on your server, or lower number of items included to sitemap', 'all_in_one'); ?>.</div>

  <div class="clear"></div>
  <br /><br />

  <?php echo $pluginInfo['plugin_name'] . ' | ' . __('Version','all_in_one') . ' ' . $pluginInfo['version'] . ' | ' . __('Author','all_in_one') . ': ' . $pluginInfo['author'] . ' | Cannot be redistributed | &copy; ' . date('Y') . ' <a href="' . $pluginInfo['plugin_uri'] . '" target="_blank">MB Themes</a>'; ?>             
</div>

<script>
  if($('#sitemap_items').val() == 0) { $('#sitemap_items_limit').css('opacity', '0.7');$('#sitemap_items_limit').prop('disabled', true); $('#sitemap_items_limit').css('color', '#666'); $('#sitemap_items_limit').css('background-color', '#fefefe'); } else { $('#sitemap_items_limit').prop('disabled', false); $('#sitemap_items_limit').css('color', '#000'); $('#sitemap_items_limit').css('background-color', '#fff');$('#sitemap_items_limit').css('opacity', '1'); }
</script>