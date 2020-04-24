<?php
  // Create menu
  $title = __('Back Links', 'all_in_one');
  ais_menu($title);


  // ADD NEW BACK LINK
  if(Params::getParam('plugin_action') == 'add') {
    $title = Params::getParam('link_title');
    $url = Params::getParam('link_url');
    $footer = ( Params::getParam('link_footer') == 'on' ? 1 : 0 );
    $nofollow = ( Params::getParam('link_nofollow') == 'on' ? 1 : 0 );
    
    if($title <> '' && $url <> '') {
      ModelAisLink::newInstance()->insertBackLink( $title, $url, $footer, $nofollow );
      message_ok(__('Link was successfully created', 'all_in_one'));
    } else {
      message_error(__('Error when creating backlink link', 'all_in_one') . ': ' . __('Link title & URL cannot be empty!', 'all_in_one'));
    }
  }


  // UPDATE BACKLINKS
  if(Params::getParam('plugin_action') == 'update') {
    $links = ModelAisLink::newInstance()->getAllBackLinks();

    foreach( $links as $l ) {
      $detail = ModelAisLink::newInstance()->findBackLinkById( $l['pk_i_id'] );

      if( Params::getParam('link_title_' . $l['pk_i_id']) <> '' && Params::existParam('link_url_' . $l['pk_i_id']) <> '' ) {
        $footer = ( Params::getParam('link_footer_' . $l['pk_i_id']) == 'on' ? 1 : 0 );
        $nofollow = ( Params::getParam('link_nofollow_' . $l['pk_i_id']) == 'on' ? 1 : 0 );  

        ModelAisLink::newInstance()->updateBackLink( $l['pk_i_id'], Params::getParam('link_title_' . $l['pk_i_id']), Params::getParam('link_url_' . $l['pk_i_id']), $footer, $nofollow );
      } else {
        message_error( __('Link ID', 'all_in_one') . ': ' . $l['pk_i_id'] . ' - ' . __('Title and URL cannot be empty!', 'all_in_one') );
      }
    }

    message_ok(__('Links updated correctly', 'all_in_one'));
  }



  // REMOVE BACKLINK
  if(Params::getParam('remove_link_id') <> '' && Params::getParam('remove_link_id') > 0) { 
    ModelAisLink::newInstance()->deleteBackLink( Params::getParam('remove_link_id') );
    message_ok( __('Back Link with ID', 'all_in_one') . ' <strong>' . Params::getParam('remove_link_id') . '</strong> ' .  __('has been successfully removed.', 'all_in_one') ); 
  }



  // GET & UPDATE PARAMETERS
  // $variable = ais_param_update( 'param_name', 'form_name', 'input_type', 'plugin_var_name' );
  // input_type: check, code or value


  // GET & UPDATE PARAMETERS
  $backlinks_hook = ais_param_update( 'backlinks_hook', 'plugin_action', 'check', 'plugin-ais' );

?>


<div class="mb-body">
  <!-- SECTION DESCRIPTION -->
  <div class="mb-info-box" style="margin:10px 0 35px 0;">
    <div class="mb-line"><?php _e('For good SEO, it is required to build backlinks structure.', 'all_in_one'); ?></div>
    <div class="mb-line"><?php _e('You are exchanging links with other sites to get good off-page SEO factor.', 'all_in_one'); ?></div>
    <div class="mb-line"><?php _e('Backlinks functionality of All in One SEO Plugin helps you to manage backlinks shown on your site that points to other websites.', 'all_in_one'); ?></div>
    <div class="mb-line"><?php _e('In this section you can define backlinks and show them in footer without need to modify theme files everytime you want to place link to other website.', 'all_in_one'); ?></div>
    <div class="mb-line"><?php _e('You can also disable some links to not show them in footer without removing them.', 'all_in_one'); ?></div>
  </div>


  <!-- BACKLINK SETTINGS -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>back_links.php" />
    <input type="hidden" name="plugin_action" value="done" />
    
    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-cog"></i> <?php _e('Backlinks settings', 'all_in_one'); ?></div>

      <div class="mb-inside">
        <div class="mb-row">
          <label for="backlinks_hook" class="h1"><span><?php _e('Automatically Hook Back Links to Footer', 'all_in_one'); ?></span></label> 
          <input name="backlinks_hook" id="backlinks_hook" class="element-slide" type="checkbox" <?php echo ($backlinks_hook == 1 ? 'checked' : ''); ?> />
          
          <div class="mb-explain"><?php _e('Hook <strong>footer</strong> will be used', 'all_in_one'); ?></div>
        </div>
      </div>

      <div class="mb-foot">
        <button type="submit" class="mb-button"><?php _e('Save', 'all_in_one');?></button>
      </div>
    </div>
  </form>


  
  <!-- ADD NEW LINK -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>back_links.php" />
    <input type="hidden" name="plugin_action" value="add" />
    
    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-plus-circle"></i> <?php _e('Add new back link', 'all_in_one'); ?></div>

      <div class="mb-inside">
        <div class="mb-row">
          <label for="link_title" class="h2"><span><?php _e('Link Title', 'all_in_one'); ?></span></label> 
          <input size="30" name="link_title" id="link_title" type="text" placeholder="<?php _e('Enter title/name of link', 'all_in_one'); ?>" />
        </div>

        <div class="mb-row">
          <label for="link_url" class="h3"><span><?php _e('Link URL', 'all_in_one'); ?></span></label> 
          <input size="50" name="link_url" id="link_url" type="text" placeholder="<?php _e('Enter URL of link', 'all_in_one'); ?>" />
        </div>

        <div class="mb-row">
          <label for="link_footer" class="h4"><span><?php _e('Show Link in Footer', 'all_in_one'); ?></span></label> 
          <input name="link_footer" id="link_footer" class="element-slide" type="checkbox" />
        </div>

        <div class="mb-row">
          <label for="link_nofollow" class="h5"><span><?php _e('Set nofollow Attribute to Link', 'all_in_one'); ?></span></label> 
          <input name="link_nofollow" id="link_nofollow" class="element-slide" type="checkbox" />
        </div>
      </div>

      <div class="mb-foot">
        <button type="submit" class="mb-button"><?php _e('Add link', 'all_in_one');?></button>
      </div>
    </div>
  </form>



  <!-- SHOW ALL BACK LINKS -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>back_links.php" />
    <input type="hidden" name="plugin_action" value="update" />
    
    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-cloud-upload"></i> <?php _e('Manage existing back links', 'all_in_one'); ?></div>

      <div class="mb-inside">
        <?php $links = ModelAisLink::newInstance()->getAllBackLinks(); ?>
        
        <div class="mb-table">
          <div class="mb-table-head">
            <div class="mb-col-1"><?php _e('ID', 'all_in_one'); ?></div>
            <div class="mb-col-4 mb-align-left"><?php _e('Title', 'all_in_one'); ?></div>
            <div class="mb-col-7 mb-align-left"><?php _e('URL', 'all_in_one'); ?></div>
            <div class="mb-col-4"><?php _e('Generated Link', 'all_in_one'); ?></div>
            <div class="mb-col-3"><?php _e('Footer', 'all_in_one'); ?></div>
            <div class="mb-col-3"><?php _e('nofollow', 'all_in_one'); ?></div>
            <div class="mb-col-2">&nbsp;</div>
          </div>

          <?php if(count($links) <= 0) { ?>
            <div class="mb-table-row mb-row-empty">
              <i class="fa fa-warning"></i><span><?php _e('No links has been added yet', 'all_in_one'); ?></span>
            </div>
          <?php } else { ?>
            <?php foreach($links as $l) { ?>
              <div class="mb-table-row ais-link-list">
                <div class="mb-col-1"><?php echo $l['pk_i_id']; ?></div>
                <div class="mb-col-4"><input type="text" id="link_title" name="link_title_<?php echo $l['pk_i_id']; ?>" value="<?php echo $l['s_title']; ?>" /></div>
                <div class="mb-col-7"><input type="text" id="link_url" name="link_url_<?php echo $l['pk_i_id']; ?>" value="<?php echo $l['s_url']; ?>" /></div>
                <div class="mb-col-4"><a target="_blank" href="<?php echo $l['s_url']; ?>"><?php echo $l['s_title']; ?></a></div>
                <div class="mb-col-3"><input name="link_footer_<?php echo $l['pk_i_id']; ?>" id="link_footer" class="element-slide" type="checkbox" <?php echo ($l['i_footer'] == 1 ? 'checked' : ''); ?> /></div>
                <div class="mb-col-3"><input name="link_nofollow_<?php echo $l['pk_i_id']; ?>" id="link_nofollow" class="element-slide" type="checkbox" <?php echo ($l['i_nofollow'] == 1 ? 'checked' : ''); ?> /></div>
                <div class="mb-col-2"><a href="<?php echo osc_admin_base_url(true); ?>?page=plugins&action=renderplugin&file=all_in_one/admin/back_links.php&remove_link_id=<?php echo $l['pk_i_id']; ?>"><?php _e('Remove', 'all_in_one'); ?></a></div>
              </div>
            <?php } ?>
          <?php } ?>
        </div>
      </div>

      <div class="mb-foot">
        <button type="submit" class="mb-button"><?php _e('Update', 'all_in_one');?></button>
      </div>
    </div>
  </form>



  <!-- PLUGIN INTEGRATION -->
  <div class="mb-box">
    <div class="mb-head"><i class="fa fa-wrench"></i> <?php _e('Plugin Setup', 'instant_messenger'); ?></div>

    <div class="mb-inside">

      <div class="mb-row">
        <div class="mb-line"><?php _e('If you do not want to use hook <strong>footer</strong> as place to show your links, keep Autohook option disabled and add following code into your theme files into place you prefer', 'instant_messenger'); ?>:</div>
        <span class="mb-code">&lt;?php if(function_exists('ais_backlinks')) { ais_backlinks(); } ?&gt;</span>
      </div>

      <div class="mb-row">&nbsp;</div>

      <div class="mb-row">
        <div class="mb-line"><?php _e('Links are wrapped in div with id <strong>#footer-links</strong> and class <strong>.ais-backlinks</strong> so you can easily style them in your theme CSS style sheet.', 'instant_messenger'); ?>:</div>
      </div>
    </div>
  </div>



  <!-- HELP TOPICS -->
  <div class="mb-box" id="mb-help">
    <div class="mb-head"><i class="fa fa-question-circle"></i> <?php _e('Help', 'all_in_one'); ?></div>

    <div class="mb-inside">
      <div class="mb-row mb-help"><span class="sup">(1)</span> <div class="h1"><?php _e('Hook footer will be used and links will be shown on your site without need to modify theme files.', 'all_in_one'); ?></div></div>
      <div class="mb-row mb-help"><span class="sup">(2)</span> <div class="h2"><?php _e('Title/Name of link will be used to show link in fron-office. Title should contain some keyword of link.', 'all_in_one'); ?></div></div>
      <div class="mb-row mb-help"><span class="sup">(3)</span> <div class="h3"><?php _e('Make sure URL is in correct format and starts with http:// or https://, otherwise link will not be functional.', 'all_in_one'); ?></div></div>
      <div class="mb-row mb-help"><span class="sup">(4)</span> <div class="h4"><?php _e('Add link to footer, when "Automatically Hook Links to Footer" is enabled', 'all_in_one'); ?></div></div>
      <div class="mb-row mb-help"><span class="sup">(5)</span> <div class="h5"><?php _e('Add nofollow attribute to link, then link will not be considered by crawlers (google bot, ...)', 'all_in_one'); ?></div></div>

    </div>
  </div>
</div>

<?php echo ais_footer(); ?>
