<?php
  // Create menu
  $title = __('Sitemap', 'all_in_one');
  ais_menu($title);


  // GET & UPDATE PARAMETERS
  // $variable = ais_param_update( 'param_name', 'form_name', 'input_type', 'plugin_var_name' );
  // input_type: check, code or value


  // GET & UPDATE PARAMETERS
  $sitemap_frequency = ais_param_update( 'sitemap_frequency', 'plugin_action', 'value', 'plugin-ais' );
  $sitemap_items_include = ais_param_update( 'sitemap_items_include', 'plugin_action', 'check', 'plugin-ais' );
  $sitemap_items_limit = ais_param_update( 'sitemap_items_limit', 'plugin_action', 'value', 'plugin-ais' );


  // GENERATE SITEMAP MANUALLY
  if(Params::getParam('plugin_action') == 'generate') {
    $execution_time = ais_generate_sitemap();
    message_ok(__('Sitemap.xml generated correctly in', 'all_in_one') . ' ' . round($execution_time, 2) . ' ' . __('seconds', 'all_in_one') . '.');
  }
?>


<div class="mb-body">
  <div class="mb-info-box" style="margin:10px 0 35px 0;">
    <div class="mb-line"><?php _e('To have sitemap automatically generated, cron must be set for your osclass installation.', 'all_in_one'); ?></div>
    <div class="mb-line"><?php _e('Do not use built-in cron (General > Settings) as it is not reliable.', 'all_in_one'); ?></div>
    <div class="mb-line"><?php _e('Contact your hosting provider to help you set cron for your osclass. Cron server must be used.', 'all_in_one'); ?></div>
    <div class="mb-line"><?php _e('Check osclass docs how to set cron correctly', 'all_in_one'); ?>: <a target="_blank" href="https://doc.osclass.org/Cron"><?php _e('Osclass cron settings', 'all_in_one'); ?></a></div>
  </div>


  <!-- SITEMAP SETTINGS -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>sitemap.php" />
    <input type="hidden" name="plugin_action" value="done" />
    
    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-cog"></i> <?php _e('Sitemap settings', 'all_in_one'); ?></div>

      <div class="mb-inside">
        <div class="mb-row">
          <label for="sitemap_frequency" class="h1"><span><?php _e('Sitemap Refresh Frequency', 'all_in_one'); ?></span></label> 
          <select name="sitemap_frequency" id="sitemap_frequency"> 
            <option <?php if($sitemap_frequency == 1){ ?>selected="selected"<?php } ?> value="1"><?php _e('Weekly', 'all_in_one'); ?></option>
            <option <?php if($sitemap_frequency == 2){ ?>selected="selected"<?php } ?> value="2"><?php _e('Daily', 'all_in_one'); ?></option>
            <option <?php if($sitemap_frequency == 3){ ?>selected="selected"<?php } ?> value="3"><?php _e('Hourly', 'all_in_one'); ?></option>
            <option <?php if($sitemap_frequency == 9){ ?>selected="selected"<?php } ?> value="9"><?php _e('None', 'all_in_one'); ?></option>
          </select>
          
          <div class="mb-explain"><?php _e('Select how often will be sitemap file refreshed using cron.', 'all_in_one'); ?></div>
        </div>

        <div class="mb-row">
          <label for="sitemap_items_include" class="h2"><span><?php _e('Include Listings', 'all_in_one'); ?></span></label> 
          <input name="sitemap_items_include" id="sitemap_items_include" class="element-slide" type="checkbox" <?php echo ($sitemap_items_include == 1 ? 'checked' : ''); ?> />
          
          <div class="mb-explain"><?php _e('When set to YES, latest listings will be included in sitemap.', 'all_in_one'); ?></div>
        </div>

        <div class="mb-row">
          <label for="sitemap_items_limit" class="h3"><span><?php _e('Maximum Count of Listings', 'all_in_one'); ?></span></label> 
          <input size="6" name="sitemap_items_limit" id="sitemap_items_limit" class="mb-short" type="text" value="<?php echo $sitemap_items_limit; ?>" />
          <div class="mb-input-desc"><?php _e('items', 'all_in_one'); ?></div>
          
          <div class="mb-explain"><?php _e('Define maximum count of latest listings included in sitemap. More listings means more time required to refresh sitemap.', 'all_in_one'); ?></div>
        </div>       

      </div>

      <div class="mb-foot">
        <button type="submit" class="mb-button"><?php _e('Save', 'all_in_one');?></button>
      </div>
    </div>
  </form>


  
  <!-- GENERATE SITEMAP -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>sitemap.php" />
    <input type="hidden" name="plugin_action" value="generate" />
    
    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-stack-overflow"></i> <?php _e('Generate sitemap manually', 'all_in_one'); ?></div>

      <div class="mb-inside">
        <div class="mb-row">
          <div class="mb-line"><?php _e('View your current', 'all_in_one'); ?> <a href="<?php echo osc_base_url() . 'sitemap.xml';?>" target="_blank"><?php _e('sitemap.xml file', 'all_in_one'); ?></a></div>
          <div class="mb-line"><?php _e('When sitemap is successfully generated, it is automatically send to Google, Bing and Yahoo.', 'all_in_one'); ?></div>
        </div>
      </div>

      <div class="mb-foot">
        <button type="submit" class="mb-button"><?php _e('Generate', 'all_in_one');?></button>
      </div>
    </div>
  </form>


  <!-- HELP TOPICS -->
  <div class="mb-box" id="mb-help">
    <div class="mb-head"><i class="fa fa-question-circle"></i> <?php _e('Help', 'all_in_one'); ?></div>

    <div class="mb-inside">
      <div class="mb-row mb-help"><span class="sup">(1)</span> <div class="h1"><?php _e('When frequency of refresh is set, sitemap will be regulary generated using osclass cron functions, therefore make sure you have set external cron job that manage cron!', 'all_in_one'); ?></div></div>
      <div class="mb-row mb-help"><span class="sup">(2)</span> <div class="h2"><?php _e('When allowed, also latest listings will be included in sitemap.', 'all_in_one'); ?></div></div>
      <div class="mb-row mb-help"><span class="sup">(3)</span> <div class="h3"><?php _e('Too many listings included in sitemap can break sitemap generation (too much server resources - exhausting). There should not be more than 1000 listings included in sitemap.', 'all_in_one'); ?></div></div>
      <div class="mb-row mb-help"><div><?php _e('You can set cron to refresh sitemap regardless osclass cron calling file', 'all_in_one'); ?>: <strong><?php echo osc_base_url(); ?>oc-content/plugins/all_in_one/cron.php</strong></div></div>
      <div class="mb-row mb-help"><div><?php _e('Maximum number of items that can be added to sitemap is 10 000, even if you enter higher number, just 10 000 listings will be included.', 'all_in_one'); ?></div></div>
      <div class="mb-row mb-help"><div><?php _e('Maximum execution time on your server is', 'all_in_one'); ?> <strong><?php echo ini_get('max_execution_time'); ?> <?php _e('seconds', 'all_in_one'); ?></strong>. <?php _e('If generation of sitemap takes almost as long as is execution time, contact your hosting provider to increase Maximum execution time on your server, or lower number of items included to sitemap', 'all_in_one'); ?>.</div></div>
    </div>
  </div>
</div>

<?php echo ais_footer(); ?>
