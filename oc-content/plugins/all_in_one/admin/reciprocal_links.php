<?php
  // Create menu
  $title = __('Reciprocal Links', 'all_in_one');
  ais_menu($title);


  // ADD RECIPROCAL LINK
  if(Params::getParam('plugin_action') == 'rec_add') {
    $email_pass = true;
    $your_url = strtolower(Params::getParam('your_url'));
    $link_url = strtolower(Params::getParam('link_url'));
    $owner_email = Params::getParam('owner_email');
    
    
    // check email
    if($owner_email <> '') {
      if(!filter_var($owner_email , FILTER_VALIDATE_EMAIL)) {
        message_error(__('Warning: Owner email is not in correct format! Reciprocal link has not been saved.', 'all_in_one'));
        $email_pass = false;
      }
    }


    // prepare url where your link is placed, to be able to check content
    $link_url = str_replace('www.', '', $link_url);
       
    if(substr($link_url, -1) == '/') {
      $link_url = substr($link_url, 0, -1);
    }


    if( $email_pass && $your_url <> '' && $link_url <> '' && $owner_email <> '' ) {
      ModelAisLink::newInstance()->insertRecLink( $your_url, $link_url, $owner_email );
      message_ok(__('Reciprocal Link was successfully created', 'all_in_one'));
    }
  }



  // REFRESH STATUS OF RECIPROCAL LINK
  if(Params::getParam('refresh_rec_link_id') <> '' && Params::getParam('refresh_rec_link_id') > 0) { 
    $detail = ModelAisLink::newInstance()->getRecLinkById( Params::getParam('refresh_rec_link_id') );

    $file = $detail['s_link_url'];
    $file_headers = @get_headers($file);

    // get content of URL where link is placed
    if($file_headers[0] <> 'HTTP/1.1 404 Not Found' and $file_headers[0] <> '' and !empty($file_headers)) {

      $web_content = htmlentities(@file_get_contents($detail['s_link_url']));
      $web_content = str_replace('www.', '', strtolower($web_content));
      $your_url = str_replace('www.', '', strtolower($detail['s_your_url']));

      if($web_content == '') {
        ModelAisLink::newInstance()->updateRecLinkStatus(Params::getParam('refresh_rec_link_id'), 0 );
        message_error(__('It is not possible to get content of website', 'all_in_one') . ': ' . $detail['s_link_url']); 
      } else {
        if(strpos($web_content, $your_url) !== false) {
          ModelAisLink::newInstance()->updateRecLinkStatus( Params::getParam('refresh_rec_link_id'), 1 );
          message_ok(__('Status of Reciprocal Link with ID', 'all_in_one') . ' ' . Params::getParam('refresh_rec_link_id') . ' ' . __('was successfully updated - link was found', 'all_in_one')); 
        } else {
          ModelAisLink::newInstance()->updateRecLinkStatus( Params::getParam('refresh_rec_link_id'), 2 );
          message_ok(__('Status of Reciprocal Link with ID', 'all_in_one') . ' ' . Params::getParam('refresh_rec_link_id') . ' ' . __('was successfully updated - link was not found', 'all_in_one')); 
        }
      }
    } else {
      message_error(__('It is not possible to get content of website', 'all_in_one') . ' ' . $detail['s_link_url']); 
    }
  }



  // REMOVE RECIPROCAL LINK
  if(Params::getParam('remove_rec_link_id') <> '' && Params::getParam('remove_rec_link_id') > 0) { 
    ModelAisLink::newInstance()->deleteRecLink( Params::getParam('remove_rec_link_id') );
    message_ok( __('Reciprocal Link with ID', 'all_in_one') . ' <strong>' . Params::getParam('remove_rec_link_id') . '</strong> ' .  __('has been successfully removed.', 'all_in_one') ); 
  }



  // UPDATE RECIPROCAL LINKS
  if(Params::getParam('plugin_action') == 'rec_update') {
    $links = ModelAisLink::newInstance()->getAllRecLinks();

    foreach( $links as $l ) {
      if( Params::getParam('your_url_' . $l['pk_i_id']) <> '' && Params::getParam('link_url_' . $l['pk_i_id']) <> '' && Params::getParam('owner_email_' . $l['pk_i_id']) <> '' ) {
        $link_url = Params::getParam('link_url_' . $l['pk_i_id']);
        $link_url = strtolower($link_url);
        $link_url = str_replace('www.', '', $link_url);
        
        if(substr($link_url, -1) == '/') {
          $link_url = substr($link_url, 0, -1);
        }

        if(Params::getParam('owner_email_' . $l['pk_i_id']) <> '') {
          if(!filter_var(Params::getParam('owner_email_' . $l['pk_i_id']) , FILTER_VALIDATE_EMAIL)) {
            message_error(__('Warning: Entered contact email in reciprocal link', 'all_in_one') . ' #' . $l['pk_i_id'] . ' ' . __('is not in correct format!', 'all_in_one'));
          }
        }

        ModelAisLink::newInstance()->updateRecLink( $l['pk_i_id'], Params::getParam('your_url_' . $l['pk_i_id']), $link_url, Params::getParam('owner_email_' . $l['pk_i_id']) );
      } else if (Params::existParam('your_url_' . $l['pk_i_id'])) {
        message_error(__('Error: Your URL, Link URL and Owner Email cannot be empty - problem on link ID', 'all_in_one') . ': ' . $l['pk_i_id']);
      }
    }

    message_ok(__('Reciprocal Links were updated', 'all_in_one'));
  }



  // SEND NOTIFICATIONS TO OWNERS OF RECIPROCAL LINKS (EMAIL)
  if(Params::getParam('plugin_action') == 'rec_update') {
    $links = ModelAisLink::newInstance()->getAllRecLinks();

    foreach( $links as $l ) {
      if(Params::getParam('notify_' . $l['pk_i_id']) == 'on' || Params::getParam('notify_' . $l['pk_i_id']) == 1) {
        $detail = ModelAisLink::newInstance()->getRecLinkById( $l['pk_i_id'] );

        if(filter_var($detail['s_email'], FILTER_VALIDATE_EMAIL) && $detail['s_email'] <> '') {
          ais_email_rec_link($detail['s_link_url'], $detail['s_your_url'], $detail['s_email']);
          message_ok(__('Owner of website', 'all_in_one') . ' ' . $detail['s_link_url'] . ' ' . __('was successfully notified that backlink was not found', 'all_in_one'));
        } else {
          message_error(__('Error when sending email to reciprocal link', 'all_in_one') . ' #' . $l['pk_i_id'] . ': ' . __('Contact email is not valid or is empty!', 'all_in_one'));
        }
      }
    }
  }



  // GET & UPDATE PARAMETERS
  // $variable = ais_param_update( 'param_name', 'form_name', 'input_type', 'plugin_var_name' );
  // input_type: check, code or value


?>


<div class="mb-body">
  <!-- SECTION DESCRIPTION -->
  <div class="mb-info-box" style="margin:10px 0 35px 0;">
    <div class="mb-line"><?php _e('For good SEO, it is required to build backlinks structure.', 'all_in_one'); ?></div>
    <div class="mb-line"><?php _e('Links that are shown on your site and point to other websites are managed in <strong>Back Links section</strong>.', 'all_in_one'); ?></div>
    <div class="mb-line"><?php _e('In this section you can control and manage links, that were placed on other websites and are pointing to your site.', 'all_in_one'); ?></div>
    <div class="mb-line"><?php _e('It often happen that people add to their website your link, but remove it after few days to get better SEO factor, in this section you can easily check if your link is still placed on partner\'s website.', 'all_in_one'); ?></div>
  </div>


  <!-- ADD NEW RECIPROCAL LINK -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>reciprocal_links.php" />
    <input type="hidden" name="plugin_action" value="rec_add" />
    
    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-plus-circle"></i> <?php _e('Add new reciprocal link', 'all_in_one'); ?></div>

      <div class="mb-inside">
        <div class="mb-row">
          <label for="your_url" class="h1"><span><?php _e('Your URL', 'all_in_one'); ?></span></label> 
          <input size="80" name="your_url" id="your_url" type="text" placeholder="<?php _e('Enter your URL you used in link', 'all_in_one'); ?>" />
        </div>

        <div class="mb-row">
          <label for="link_url" class="h2"><span><?php _e('URL with Your Link', 'all_in_one'); ?></span></label> 
          <input size="80" name="link_url" id="link_url" type="text" placeholder="<?php _e('Enter URL where is your link placed', 'all_in_one'); ?>" />
        </div>

        <div class="mb-row">
          <label for="owner_email" class="h3"><span><?php _e('Web Owner Email', 'all_in_one'); ?></span></label> 
          <input size="40" name="owner_email" id="owner_email" type="text" placeholder="<?php _e('Enter email of web owner', 'all_in_one'); ?>" />
        </div>


        <!-- TIPS FOR ADDING NEW LINK -->
        <div class="mb-info-box" style="margin:40px 0 15px 0;">
          <div class="mb-line" style="margin-bottom:20px;"><?php _e('To better understand, reciprocal link will means:<br/>Your partner has placed on his website <strong>[URL WITH YOUR LINK]</strong> link that points to your website <strong>[YOUR URL]</strong>. In case of problem with your link can contact your partner on email <strong>[WEB OWNER EMAIL]</strong>.', 'all_in_one'); ?></div>
          <div class="mb-line"><?php _e('<strong>Your URL</strong> - is website URL used in link placed on partner\'s web pointing to your own website.', 'all_in_one'); ?></div>
          <div class="mb-line"><?php _e('<strong>URL with Your Link</strong> - is website URL of your partner\'s web, where is your link placed and where you can see it.', 'all_in_one'); ?></div>
          <div class="mb-line"><?php _e('<strong>Web Owner Email</strong> - is contact email to your partner and you can contact partner on this mail in case of problems with your link (link disappeared, was changed, ...).', 'all_in_one'); ?></div>
        </div>

      </div>

      <div class="mb-foot">
        <button type="submit" class="mb-button"><?php _e('Add reciprocal link', 'all_in_one');?></button>
      </div>
    </div>
  </form>



  <!-- SHOW ALL RECIPROCAL LINKS -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>reciprocal_links.php" />
    <input type="hidden" name="plugin_action" value="rec_update" />
    
    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-shuffle"></i> <?php _e('Manage existing reciprocal links', 'all_in_one'); ?></div>

      <div class="mb-inside">
        <?php $links = ModelAisLink::newInstance()->getAllRecLinks(); ?>
        
        <div class="mb-table">
          <div class="mb-table-head">
            <div class="mb-col-1"><?php _e('ID', 'all_in_one'); ?></div>
            <div class="mb-col-5 mb-align-left"><?php _e('Your URL', 'all_in_one'); ?></div>
            <div class="mb-col-5 mb-align-left"><?php _e('Link URL', 'all_in_one'); ?></div>
            <div class="mb-col-4 mb-align-left"><?php _e('Owner Email', 'all_in_one'); ?></div>
            <div class="mb-col-3"><?php _e('Notify', 'all_in_one'); ?></div>
            <div class="mb-col-2"><?php _e('Status', 'all_in_one'); ?></div>
            <div class="mb-col-2">&nbsp;</div>
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
                <div class="mb-col-5"><input type="text" id="your_url" name="your_url_<?php echo $l['pk_i_id']; ?>" value="<?php echo $l['s_your_url']; ?>" /></div>
                <div class="mb-col-5"><input type="text" id="link_url" name="link_url_<?php echo $l['pk_i_id']; ?>" value="<?php echo $l['s_link_url']; ?>" /></div>
                <div class="mb-col-4"><input type="text" id="owner_email" name="owner_email_<?php echo $l['pk_i_id']; ?>" value="<?php echo $l['s_email']; ?>" /></div>
                <div class="mb-col-3"><input name="notify_<?php echo $l['pk_i_id']; ?>" id="notify" class="element-slide" type="checkbox" /></div>
                <div class="mb-col-2">
                  <?php 
                    if($l['i_status'] == 1) {
                      echo '<i class="mb-has-tooltip fa fa-check mb-status-green" title="' . __('Link was found, everything is good', 'all_in_one') . '"></i>';
                    } else if($l['i_status'] == 2) {
                      echo '<i class="mb-has-tooltip fa fa-close mb-status-red" title="' . __('Link was not found', 'all_in_one') . '"></i>';
                    } else if($l['i_status'] == 0) {
                      echo '<i class="mb-has-tooltip fa fa-warning mb-status-yellow" title="' . __('It is not possible to get content of partner\'s website, make sure it exists', 'all_in_one') . '"></i>';
                    } else {
                      echo '<i class="mb-has-tooltip fa fa-question mb-status-gray" title="' . __('No status saved yet or it is not possible to check link on URL, try to refresh status later', 'all_in_one') . '"></i>';
                    }
                  ?>
                </div>

                <div class="mb-col-2"><a href="<?php echo osc_admin_base_url(true); ?>?page=plugins&action=renderplugin&file=all_in_one/admin/reciprocal_links.php&refresh_rec_link_id=<?php echo $l['pk_i_id']; ?>"><?php _e('Refresh', 'all_in_one'); ?></a></div>
                <div class="mb-col-2"><a href="<?php echo osc_admin_base_url(true); ?>?page=plugins&action=renderplugin&file=all_in_one/admin/reciprocal_links.php&remove_rec_link_id=<?php echo $l['pk_i_id']; ?>"><?php _e('Remove', 'all_in_one'); ?></a></div>
              </div>
            <?php } ?>
          <?php } ?>
        </div>


        <!-- TIPS FOR LINK MANAGEMENT -->
        <div class="mb-info-box" style="margin:40px 0 15px 0;">
          <div class="mb-line"><?php _e('Status', 'all_in_one'); ?>:</div>
          <div class="mb-line"><i class="fa fa-check mb-status-green"></i> <?php _e('Link was found, everything is good', 'all_in_one'); ?></div>
          <div class="mb-line"><i class="fa fa-close mb-status-red"></i> <?php _e('Link was not found, you should contact your partner', 'all_in_one'); ?></div>
          <div class="mb-line"><i class="fa fa-warning mb-status-yellow"></i> <?php _e('It is not possible to get content of partner\'s website, make sure it exists', 'all_in_one'); ?></div>
          <div class="mb-line" style="margin-bottom:20px;"><i class="fa fa-question mb-status-gray"></i> <?php _e('Status has not been checked yet, click on refresh button', 'all_in_one'); ?></div>
          <div class="mb-line"><?php _e('If link was not found on partner\'s website and you want to send notification, mark "Notify" to "Yes" and update links. One time email notification will be sent to all selected partners.', 'all_in_one'); ?></div>
        </div>
      </div>

      <div class="mb-foot">
        <button type="submit" class="mb-button"><?php _e('Update', 'all_in_one');?></button>
      </div>
    </div>
  </form>



  <!-- HELP TOPICS -->
  <div class="mb-box" id="mb-help">
    <div class="mb-head"><i class="fa fa-question-circle"></i> <?php _e('Help', 'all_in_one'); ?></div>

    <div class="mb-inside">
      <div class="mb-row mb-help"><span class="sup">(1)</span> <div class="h1"><?php _e('Your URL is website URL used in link placed on partner\'s web pointing to your own website.', 'all_in_one'); ?></div></div>
      <div class="mb-row mb-help"><span class="sup">(2)</span> <div class="h2"><?php _e('URL with Your Link is website URL of your partner\'s web, where is your link placed and where you can see it.', 'all_in_one'); ?></div></div>
      <div class="mb-row mb-help"><span class="sup">(3)</span> <div class="h3"><?php _e('Web Owner Email is contact email to your partner and you can contact partner on this mail in case of problems with your link (link disappeared, was changed, ...).', 'all_in_one'); ?></div></div>

    </div>
  </div>
</div>

<?php echo ais_footer(); ?>
