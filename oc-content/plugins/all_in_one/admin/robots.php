<?php
  // Create menu
  $title = __('Robots.txt', 'all_in_one');
  ais_menu($title);


  // GET & UPDATE PARAMETERS
  // $variable = ais_param_update( 'param_name', 'form_name', 'input_type', 'plugin_var_name' );
  // input_type: check, code or value


  // GET & UPDATE PARAMETERS
  $robots_file = ais_param_update( 'robots_file', 'plugin_action', 'value', 'plugin-ais' );
  $robots_custom = ais_param_update( 'robots_custom', 'plugin_action', 'code', 'plugin-ais' );



  // UPDATE FILES
  if(Params::getParam('plugin_action')=='done') {
    if($robots_file == 0) {
      if(file_exists(osc_base_path() .  "robots_backup.txt")) {
        $content = file_get_contents(osc_base_path() .  "robots_backup.txt");
      } else {
        $content = 'User-agent: * <br> Disallow: /oc-admin/'; 
      }

      $robots = $content;
    } else {
      if(!file_exists(osc_base_path() .  "robots_backup.txt")) {
        $fp_backup = fopen(osc_base_path() .  "robots_backup.txt", "w+"); 
        fwrite($fp_backup, file_get_contents(osc_base_path() .  "robots.txt"));
        fclose($fp_backup);
        message_ok(__('Backup file robots_backup.txt file was successfully created','all_in_one'));
      }

      $content = $robots_custom;
    }
    
    $fp = fopen(osc_base_path() .  "robots.txt", "w+"); 
    fwrite($fp, $content);
    fclose($fp);

    osc_reset_preferences();
    message_ok(__('robots.txt file was successfully updated','all_in_one'));

    if(!is_writable(osc_base_path() .  "robots.txt")) {
      message_error(__('It is impossible to write to robots.txt file, please change CHMOD settings on this file.','all_in_one'));
    }
  }
?>


<div class="mb-body">
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>robots.php" />
    <input type="hidden" name="plugin_action" value="done" />
    
    <!-- ROBOTS SETTINGS -->
    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-cog"></i> <?php _e('Robots.txt file settings', 'all_in_one'); ?></div>

      <div class="mb-inside">
        <div class="mb-row">
          <label for="robots_file" class="h1"><span><?php _e('Select robots.txt file', 'all_in_one'); ?></span></label> 
          <select name="robots_file" id="robots_file"> 
            <option <?php if($robots_file == 1){ ?>selected="selected"<?php } ?> value="1"><?php _e('Custom', 'all_in_one'); ?></option>
            <option <?php if($robots_file == 0){ ?>selected="selected"<?php } ?> value="0"><?php _e('Original', 'all_in_one'); ?></option>
          </select>
          
          <div class="mb-explain"><?php _e('Choose which robots.txt file should be use, if your custom, or default one.', 'all_in_one'); ?></div>
        </div>

        <div class="mb-row">
          <label for="robots_custom" class="h2"><span><?php _e('Custom robots.txt file content', 'all_in_one'); ?></span></label> 
          <textarea <?php if ($robots_file == 0) { ?>readonly<?php } ?> rows="20" type="text" id="robots_custom" name="robots_custom" class="mb-textarea-super-large"><?php echo htmlentities($robots_custom); ?></textarea>
          
          <div class="mb-explain"><?php _e('Define content of custom robots.txt file.', 'all_in_one'); ?></div>
        </div>       

      </div>

      <div class="mb-foot">
        <button type="submit" class="mb-button"><?php _e('Save', 'all_in_one');?></button>
      </div>
    </div>
    
  </form>

  

  <!-- HELP TOPICS -->
  <div class="mb-box" id="mb-help">
    <div class="mb-head"><i class="fa fa-question-circle"></i> <?php _e('Help', 'all_in_one'); ?></div>

    <div class="mb-inside">
      <div class="mb-row mb-help"><span class="sup">(1)</span> <div class="h1"><?php _e('You can use robots.txt generated by this form (custom) or default robots.txt (original). When original choosen will be choosen, copy from backup file will be used to restore original file', 'all_in_one'); ?></div></div>
      <div class="mb-row mb-help"><div><?php _e('File robots.txt give instruction to search engine crawlers how to index website, what to index, what not to index and similar. <strong>Example:</strong> admin folder (oc-admin for osclass) is usually not indexed because you do not want your customer to access your backoffice, or show links to your backoffice in search engine.', 'all_in_one'); ?> <?php _e('Therefore you should always disable admin folder (oc-admin) not to be indexed by search engines. For your site it is path:', 'all_in_one'); ?> <span class="underline"><?php echo osc_admin_base_url(); ?></span></div></div>
      <div class="mb-row mb-help"><div><?php _e('When you create robots.txt file using this form, original one will be back up in same folder with name <strong>robots_backup.txt</strong>. This file will be used just in case it does not exist. If it exists, it will not be overwritten.', 'all_in_one'); ?></div></div>
      <div class="mb-row mb-help">
        <div class="mb-line"><?php _e('Do not miss following pages that helps you to understand and correctly generate robots.txt file:', 'all_in_one'); ?></div>
        <div class="mb-line" style="margin:0;"><a href="http://www.yellowpipe.com/yis/tools/robots.txt/" target="_blank"><?php _e('robots.txt generator', 'all_in_one'); ?></a></div>
        <div class="mb-line" style="margin:0;"><a href="http://www.robotstxt.org/orig.html" target="_blank"><?php _e('robots.txt documentation', 'all_in_one'); ?></a></div>
      </div>
    </div>
  </div>
</div>

<?php echo ais_footer(); ?>