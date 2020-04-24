<?php 

$pluginInfo = osc_plugin_get_info('all_in_one/index.php');
$dao_preference = new Preference();

$show_links_footer = '';
if(Params::getParam('show_links_footer') != '') {
  $show_links_footer = Params::getParam('show_links_footer');
} else {
  $show_links_footer = (osc_get_preference('allSeo_links_footer', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_links_footer', 'plugin-all_in_one') : '' ;
}

// check if delete command was not send for backlink
if(Params::getParam('what') == 'delete' and Params::getParam('link_id') <> '') { 
  $det = ModelSeoLink::newInstance()->getAttrByLinkId( Params::getParam('link_id') );
  if(ModelSeoLink::newInstance()->deleteLink( Params::getParam('link_id') )) { 
    message_ok('Back Link with ID ' . Params::getParam('link_id') . ' and title <strong>' . $det['seo_title'] . '</strong> was successfully deleted!'); 
  } else {
    message_error('Error occurred while deleting BackLink with <strong>ID ' . Params::getParam('link_id') . '</strong>. Probably it was already deleted!'); 
  }
}

// check if delete command was not send for reciprocal link
if(Params::getParam('what') == 'delete_rec' and Params::getParam('link_id') <> '') { 
  $det = ModelSeoLink::newInstance()->getRecLinkById( Params::getParam('link_id') );
  if(ModelSeoLink::newInstance()->deleteLinkRec( Params::getParam('link_id') )) { 
    message_ok('Reciprocal Link with ID ' . Params::getParam('link_id') . ' and placed on <strong>' . $det['seo_href_from'] . '</strong> was successfully deleted!'); 
  } else {
    message_error('Error occurred while deleting reciprocal link with <strong>ID ' . Params::getParam('link_id') . '</strong>. Probably it was already deleted!'); 
  }
}

// check if refresh status command was not send 
if(Params::getParam('what') == 'refresh' and Params::getParam('link_id') <> '') { 
  $detail = ModelSeoLink::newInstance()->getRecLinkById( Params::getParam('link_id') );

  $file = $detail['seo_href_from'];
  $file_headers = @get_headers($file);

  if($file_headers[0] <> 'HTTP/1.1 404 Not Found' and $file_headers[0] <> '' and !empty($file_headers)) {

    $web_content = htmlentities(file_get_contents($detail['seo_href_from']));
    $web_content = str_replace('www.', '', strtolower($web_content));

    if($web_content == '') {
      ModelSeoLink::newInstance()->updateRecStatus(Params::getParam('link_id'), 0 );
      message_error(__('It is not possible to get content of website', 'all_in_one') . ' ' . $detail['seo_href_from']); 
    } else {
      if(strpos($web_content, $detail['seo_href_to']) !== false) {
        ModelSeoLink::newInstance()->updateRecStatus( Params::getParam('link_id'), 1 );
        message_ok(__('Status of Reciprocal Link with ID', 'all_in_one') . ' ' . Params::getParam('link_id') . ' ' . __('was successfully updated', 'all_in_one')); 
      } else {
        ModelSeoLink::newInstance()->updateRecStatus( Params::getParam('link_id'), 2 );
        message_ok(__('Status of Reciprocal Link with ID', 'all_in_one') . ' ' . Params::getParam('link_id') . ' ' . __('was successfully updated', 'all_in_one')); 
      }
    }
  } else {
    message_error(__('It is not possible to get content of website', 'all_in_one') . ' ' . $detail['seo_href_from']); 
  }
}

if(Params::getParam('plugin_action')=='done') {
  if(Params::getParam('link_add_update') == 'update') {
    //update parameter
    $dao_preference->update(array("s_value" => $show_links_footer), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_links_footer")) ;
    osc_reset_preferences();

    foreach( osc_has_links_seo() as $links ) {
      $detail = ModelSeoLink::newInstance()->getAttrByLinkId( $links['seo_link_id'] );
      $show_footer = Params::getParam('seo_footer' . $links['seo_link_id']) == 'on' ? 1 : 0;
      $nofollow = Params::getParam('seo_rel' . $links['seo_link_id']) == 'on' ? 1 : 0;

      if(Params::getParam('seo_title' . $links['seo_link_id']) == '') {
        message_error(__('Error when updating backlink link', 'all_in_one') . ' #' .  $links['seo_link_id'] . ': ' . __('Link title cannot be empty!', 'all_in_one'));
      } else if(Params::getParam('seo_href' . $links['seo_link_id']) == '') {
        message_error(__('Error when updating  backlink', 'all_in_one') . ' #' .  $links['seo_link_id'] . ': ' . __('Link URL cannot be empty!', 'all_in_one'));
      } else {
        if(isset($detail['seo_link_id'])) {
          ModelSeoLink::newInstance()->updateAttr( $links['seo_link_id'], Params::getParam('seo_title' . $links['seo_link_id']), Params::getParam('seo_href' . $links['seo_link_id']), $show_footer, $nofollow );
        } else {
          ModelSeoLink::newInstance()->insertAttr( $links['seo_link_id'], Params::getParam('seo_title' . $links['seo_link_id']), Params::getParam('seo_href' . $links['seo_link_id']), $show_footer, $nofollow );
        }
      }
    }

    message_ok(__('Links updated', 'all_in_one'));
  }

  if(Params::getParam('link_add_update') == 'add') {
    // If new links is added
    $new_title = Params::getParam('seo_title_new');
    $new_href = Params::getParam('seo_href_new');
    
    if(!Params::getParam('seo_title_new') <> '' or Params::getParam('seo_href_new') <> '') {
      if( isset( $new_title ) and isset( $new_href ) and $new_title <> '' and $new_href <> '' ) {
        ModelSeoLink::newInstance()->insertAttr( null, Params::getParam('seo_title_new'), Params::getParam('seo_href_new'), Params::getParam('seo_footer_new'), Params::getParam('seo_rel_new') );
        message_ok(__('BackLink was successfully created', 'all_in_one'));
      } else {
        message_error(__('Error when creating backlink link', 'all_in_one') . ': ' . __('Link title & URL cannot be empty!', 'all_in_one'));
      }
    }
  }
}

if(Params::getParam('plugin_action')=='rec_link') {
  if(Params::getParam('link_rec_add_update') == 'update') {
    foreach( osc_has_links_rec_seo() as $links ) {
      $detail = ModelSeoLink::newInstance()->getRecLinkById( $links['seo_link_id'] );

      if(Params::getParam('seo_href_to' . $links['seo_link_id']) == '') {
        message_error(__('Error when updating reciprocal link', 'all_in_one') . ' #' .  $links['seo_link_id'] . ': ' . __('Your referral URL cannot be empty!', 'all_in_one'));
      } else if(Params::getParam('seo_href_from' . $links['seo_link_id']) == '') {
        message_error(__('Error when updating reciprocal link', 'all_in_one') . ' #' .  $links['seo_link_id'] . ': ' . __('URL with your link cannot be empty!', 'all_in_one'));
      } else {
        $href_to = Params::getParam('seo_href_to' . $links['seo_link_id']);
        $href_to = strtolower($href_to);
        $href_to = str_replace('www.', '', $href_to);
        
        if(substr($href_to, -1) == '/') {
          $href_to = substr($href_to, 0, -1);
        }

        if(Params::getParam('seo_contact' . $links['seo_link_id']) <> '') {
          if(!filter_var(Params::getParam('seo_contact' . $links['seo_link_id']) , FILTER_VALIDATE_EMAIL)) {
            message_error(__('Warning: Entered contact email in reciprocal link', 'all_in_one') . ' #' . $links['seo_link_id'] . ' ' . __('is not in correct format!', 'all_in_one'));
          }
        }

        if(isset($detail['seo_link_id'])) {
          ModelSeoLink::newInstance()->updateRec( $links['seo_link_id'], $href_to, Params::getParam('seo_href_from' . $links['seo_link_id']), Params::getParam('seo_contact' . $links['seo_link_id']) );
        } else {
          ModelSeoLink::newInstance()->insertRec( $links['seo_link_id'], $href_to, Params::getParam('seo_href_from' . $links['seo_link_id']), Params::getParam('seo_contact' . $links['seo_link_id']) );
        }
      }
    }

    message_ok(__('Reciprocal Links updated', 'all_in_one'));
  }

  if(Params::getParam('link_rec_add_update') == 'add') {
    // If new links is added
    $new_href_to = Params::getParam('seo_href_to_new');
    $new_href_from = Params::getParam('seo_href_from_new');
    $new_contact = Params::getParam('seo_contact_new');
    
    if($new_contact <> '') {
      if(!filter_var($new_contact , FILTER_VALIDATE_EMAIL)) {
        message_error(__('Warning: Entered contact email is not in correct format!', 'all_in_one'));
      }
    }

    $new_href_to = strtolower($new_href_to);
    $new_href_to = str_replace('www.', '', $new_href_to);
       
    if(substr($new_href_to, -1) == '/') {
      $href_to = substr($new_href_to, 0, -1);
    }

    if(Params::getParam('seo_href_to_new') <> '' or Params::getParam('seo_href_from_new') <> '' or Params::getParam('seo_contact_new') <> '') {
      if( isset( $new_href_to ) and isset( $new_href_from ) and $new_href_to <> '' and $new_href_from <> '' ) {
        ModelSeoLink::newInstance()->insertRec( null, $new_href_to, $new_href_from, $new_contact );
        message_ok(__('Reciprocal Link was successfully created', 'all_in_one'));
      } else {
        message_error(__('Error when creating reciprocal link', 'all_in_one') . ': ' . __('Your referral URL and URL with your link cannot be empty!', 'all_in_one'));
      }
    }
  }

  if(Params::getParam('link_rec_add_update') == 'email') {
    foreach( osc_has_links_rec_seo() as $links ) {
      if(Params::getParam('seo_email_send' . $links['seo_link_id']) == 'on' or Params::getParam('seo_email_send' . $links['seo_link_id']) == 1) {
        $detail = ModelSeoLink::newInstance()->getRecLinkById( $links['seo_link_id'] );

        if(filter_var($detail['seo_contact'], FILTER_VALIDATE_EMAIL) and $detail['seo_contact'] <> '') {
          email_link_problem($detail['seo_href_from'], $detail['seo_href_to'], $detail['seo_contact']);
          message_ok(__('Owner of website', 'all_in_one') . ' ' . $detail['seo_href_from'] . ' ' . __('was successfully informed that backlink was not found', 'all_in_one'));
        } else {
          message_error(__('Error when sending email to reciprocal link', 'all_in_one') . ' #' . $links['seo_link_id'] . ': ' . __('Contact email is not valid or is empty!', 'all_in_one'));
        }
      }
    }
  }
} 
?>

<div id="settings_form">
  <?php echo config_menu(); ?>

  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>links.php" />
    <input type="hidden" name="plugin_action" value="done" />
    <input type="hidden" name="link_add_update" id="link_add_update" value="" />

    <fieldset class="round3">
      <legend class="orange round2"><?php _e('Back links Management', 'all_in_one'); ?></legend>
    
      <div class="title"><i class="fa fa-upload"></i>&nbsp;<?php _e('Add new link', 'all_in_one'); ?></div>
      <div class="del"></div>

      <span class="cat-note"><span class="note"><?php _e('Note', 'all_in_one'); ?>:</span> <?php _e('Make sure you enter correct URL that contains http:// or https://, otherwise link will not work', 'all_in_one'); ?></span>
      <div class="clear" style="margin:15px 0;"></div>

      <label for="seo_title_new" class="text-label"><?php _e('Link Title', 'all_in_one'); ?> <sup class="sup-go go1">(1)</sup></label>
      <input type="text" name="seo_title_new" id="seo_title" size="20" />

      <div class="clear" style="margin:6px 0;"></div>

      <label for="seo_href_new" class="text-label"><?php _e('Link URL', 'all_in_one'); ?> <sup class="sup-go go2">(2)</sup></label>
      <input type="text" name="seo_href_new" id="seo_href" class="long" size="20" />
      
      <div class="clear" style="margin:12px 0;"></div>

      <button name="theButton" id="theButton" type="submit" style="float: left;" class="btn btn-submit link-add"><?php _e('Add link', 'all_in_one');?></button>


      <div class="clear"></div>
      <br /><br /><br />

      <div class="title"><i class="fa fa-globe"></i>&nbsp;<?php _e('Show links in footer', 'all_in_one'); ?></div>
      <div class="del"></div>

      <span class="cat-note"><span class="note"><?php _e('Note', 'all_in_one'); ?>:</span> <?php _e('You can show BackLinks wherever you want placing this code:', 'all_in_one'); ?> <strong class="code-text">&lt;?php echo SeoFooterLinks(); ?&gt;</strong></span>

      <div class="clear" style="margin:12px 0;"></div>

      <label for="show_links_footer" class="text-label"><?php _e('Auto-hook links to footer', 'all_in_one'); ?>  <sup class="sup-go go3">(3)</sup></label>
      <select name="show_links_footer" id="show_links_footer"> 
        <option <?php if($show_links_footer == 1){echo 'selected="selected"';}?>value='1'><?php _e('Yes', 'all_in_one'); ?></option>
        <option <?php if($show_links_footer == 0){echo 'selected="selected"';}?>value='0'><?php _e('No', 'all_in_one'); ?></option>
      </select>

      <div class="clear"></div>
      <br /><br /><br />

      <div class="title"><i class="fa fa-list"></i>&nbsp;<?php _e('Current footer links', 'all_in_one'); ?></div>
      <div class="del"></div>

      <div class="link-list">
        <?php if(!osc_has_links_seo()) { echo '<span class="empty">No BackLinks added yet.</span>';} else { ?>
          <div class="link-head round3">
            <div class="link-elem id"><?php _e('ID', 'all_in_one'); ?></div>
            <div class="link-elem titl"><?php _e('Title', 'all_in_one'); ?></div>
            <div class="link-elem url"><?php _e('Link URL', 'all_in_one'); ?></div>
            <div class="link-elem show"><span><?php _e('Footer', 'all_in_one'); ?></span> <sup class="sup-go go4">(4)</sup></div>
            <div class="link-elem nofollow"><span><?php _e('nofollow', 'all_in_one'); ?></span> <sup class="sup-go go5">(5)</sup></div>
            <div class="link-elem generate"><?php _e('Generated link', 'all_in_one'); ?></div>
            <div class="link-elem del-link"></div>
          </div>
        <?php } ?>

        <?php foreach( osc_has_links_seo() as $links ) { ?>
          <?php $detail = ModelSeoLink::newInstance()->getAttrByLinkId( $links['seo_link_id'] ); ?>

          <div class="link-row">
            <div class="link-elem id"><?php echo $links['seo_link_id']; ?></div>
            <div class="link-elem titl"><input type="text" name="seo_title<?php echo $links['seo_link_id']; ?>" id="seo_title" value="<?php echo $detail['seo_title']; ?>" size="20" /></div>
            <div class="link-elem url"><input type="text" name="seo_href<?php echo $links['seo_link_id']; ?>" id="seo_href" value="<?php echo $detail['seo_href']; ?>" size="20" /></div>
            <div class="link-elem show">
              <input type="checkbox" name="seo_footer<?php echo $links['seo_link_id']; ?>" id="seo_footer" <?php echo ($detail['seo_footer'] == 1 ? 'checked' : ''); ?> />
              <label for="seo_footer" style="font-weight: bold;"><?php _e('Show', 'all_in_one'); ?></label>
            </div>
            <div class="link-elem nofollow">
              <input type="checkbox" name="seo_rel<?php echo $links['seo_link_id']; ?>" id="seo_rel" <?php echo ($detail['seo_rel'] == 1 ? 'checked' : ''); ?> />
              <label for="seo_rel" style="font-weight: bold;"><?php _e('Add', 'all_in_one'); ?></label>
            </div>
            <div class="link-elem generate"><?php echo generate_link( $detail['seo_title'], $detail['seo_href'], $detail['seo_rel'] ); ?></div>
            <div class="link-elem del-link"><a href="<?php echo osc_base_url();?>oc-admin/index.php?page=plugins&action=renderplugin&file=all_in_one/admin/links.php&what=delete&link_id=<?php echo $links['seo_link_id']; ?>" onclick="return confirm('<?php echo __('Are you sure you want to delete link', 'all_in_one') . ' #' . $links['seo_link_id'];?>?')"><i class="fa fa-trash"></i><?php _e('Delete', 'all_in_one'); ?></a></div>
          </div>
        <?php } ?>

        <div class="clear"></div>
        <br />

        <button name="theButton" id="theButton" type="submit" style="float: left;" class="btn btn-submit link-update"><?php _e('Update', 'all_in_one');?></button>
      </div>
    </fieldset>
  </form>

  <div class="clear"></div>
  <br /><br />

  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>links.php" />
    <input type="hidden" name="plugin_action" value="rec_link" />
    <input type="hidden" name="link_rec_add_update" id="link_rec_add_update" value="" />

    <fieldset class="round3">
      <legend class="orange round2"><?php _e('Reciprocal links Management', 'all_in_one'); ?></legend>

      <div class="title"><i class="fa fa-pencil"></i>&nbsp;<?php _e('Add new reciprocal link', 'all_in_one'); ?></div>
      <div class="del"></div>

      <span class="cat-note"><span class="note"><?php _e('Note', 'all_in_one'); ?>:</span> <?php _e('Slash (/) at the end of link will be removed from Your referral link', 'all_in_one'); ?></span>
      <span class="cat-note"><span class="note"><?php _e('Note', 'all_in_one'); ?>:</span> <?php _e('www will be removed from Your referral link', 'all_in_one'); ?></span>
      <span class="cat-note"><span class="note"><?php _e('Note', 'all_in_one'); ?>:</span> <?php _e('Your (referral) URL is link address in backlink - usually URL to your site', 'all_in_one'); ?></span>
      <span class="cat-note"><span class="note"><?php _e('Note', 'all_in_one'); ?>:</span> <?php _e('URL with your link is link to website, where was placed your backlink - usually some external site', 'all_in_one'); ?></span>
      <span class="cat-note"><span class="note"><?php _e('Note', 'all_in_one'); ?>:</span> <?php _e('Contact is email to owner of website where is placed your backlink', 'all_in_one'); ?></span>

      <div class="clear" style="margin:15px 0;"></div>

      <label for="seo_href_to_new" class="text-label"><?php _e('Your (referral) URL', 'all_in_one'); ?> <sup class="sup-go go6">(6)</sup></label>
      <input type="text" name="seo_href_to_new" id="seo_href_to_new" class="long" size="20" />

      <div class="clear" style="margin:6px 0;"></div>

      <label for="seo_href_from_new" class="text-label"><?php _e('URL with your link', 'all_in_one'); ?> <sup class="sup-go go7">(7)</sup></label>
      <input type="text" name="seo_href_from_new" id="seo_href_from_new" class="long" size="20" />

      <div class="clear" style="margin:6px 0;"></div>

      <label for="seo_contact_new" class="text-label"><?php _e('Contact to web owner', 'all_in_one'); ?> <sup class="sup-go go8">(8)</sup></label>
      <input type="text" name="seo_contact_new" id="seo_contact_new" class="long" size="20" />
      
      <div class="clear" style="margin:12px 0;"></div>

      <button name="theButton" id="theButton" type="submit" style="float: left;" class="btn btn-submit link-rec-add"><?php _e('Add link', 'all_in_one');?></button>


      <div class="clear"></div>
      <br /><br /><br />

      <div class="title"><i class="fa fa-exchange"></i>&nbsp;<?php _e('Current reciprocal links', 'all_in_one'); ?></div>
      <div class="del"></div>

      <div class="link-list rec">
        <?php if(!osc_has_links_rec_seo()) { echo '<span class="empty">No reciprocal links added yet.</span>';} else { ?>
          <div class="link-head round3">
            <div class="link-elem id"><?php _e('ID', 'all_in_one'); ?></div>
            <div class="link-elem url_to"><span><?php _e('Your (referral) URL', 'all_in_one'); ?></span> <sup class="sup-go go6">(6)</sup></div>
            <div class="link-elem url_from"><span><?php _e('URL where is placed your link', 'all_in_one'); ?></span> <sup class="sup-go go7">(7)</sup></div>
            <div class="link-elem contact"><span><?php _e('Owner email', 'all_in_one'); ?></span> <sup class="sup-go go8">(8)</sup></div>
            <div class="link-elem status"><?php _e('Status', 'all_in_one'); ?></div>
            <div class="link-elem email"><span><?php _e('Email', 'all_in_one'); ?></span> <sup class="sup-go go9">(9)</sup></div>
            <div class="link-elem refresh"></div>
            <div class="link-elem del-link"></div>
          </div>
        <?php } ?>

        <?php foreach( osc_has_links_rec_seo() as $links ) { ?>
          <?php $detail = ModelSeoLink::newInstance()->getRecLinkById( $links['seo_link_id'] ); ?>

          <div class="link-row">
            <div class="link-elem id"><?php echo $links['seo_link_id']; ?></div>
            <div class="link-elem url_to"><input type="text" name="seo_href_to<?php echo $links['seo_link_id']; ?>" id="seo_href_to" value="<?php echo $detail['seo_href_to']; ?>" size="20" /></div>
            <div class="link-elem url_from"><input type="text" name="seo_href_from<?php echo $links['seo_link_id']; ?>" id="seo_href_from" value="<?php echo $detail['seo_href_from']; ?>" size="20" /></div>
            <div class="link-elem contact"><input type="text" name="seo_contact<?php echo $links['seo_link_id']; ?>" id="seo_contact" value="<?php echo $detail['seo_contact']; ?>" size="20" /></div>
            <div class="link-elem status">
              <?php 
                if($links['seo_status'] == 1) {
                  echo '<i class="fa fa-check green-color" title="' . __('Link was found, everything is good', 'all_in_one') . '"></i>';
                } else if($links['seo_status'] == 2) {
                  echo '<i class="fa fa-close red-color" title="' . __('Link was not found', 'all_in_one') . '"></i>';
                } else {
                  echo '<i class="fa fa-question blue-color" title="' . __('No status saved yet, refresh status', 'all_in_one') . '"></i>';
                }

              ?>
            </div>
            <div class="link-elem email"><input type="checkbox" <?php if($links['seo_status'] <> 2) { ?>disabled<?php } ?> name="seo_email_send<?php echo $links['seo_link_id']; ?>" id="seo_email_send" /><label for="seo_email_send" <?php if($links['seo_status'] <> 2) { ?>class="disabled"<?php } ?>><?php _e('Send', 'all_in_one'); ?></label></div>
            <div class="link-elem refresh"><a href="<?php echo osc_base_url();?>oc-admin/index.php?page=plugins&action=renderplugin&file=all_in_one/admin/links.php&what=refresh&link_id=<?php echo $links['seo_link_id']; ?>" title="<?php _e('Refresh status of this reciprocal link', 'all_in_one'); ?>"><i class="fa fa-refresh"></i><?php _e('Refresh', 'all_in_one'); ?></a></div>
            <div class="link-elem del-link"><a href="<?php echo osc_base_url();?>oc-admin/index.php?page=plugins&action=renderplugin&file=all_in_one/admin/links.php&what=delete_rec&link_id=<?php echo $links['seo_link_id']; ?>" onclick="return confirm('<?php echo __('Are you sure you want to delete reciprocal link', 'all_in_one') . ' #' . $links['seo_link_id'];?>?')"><i class="fa fa-trash"></i><?php _e('Delete', 'all_in_one'); ?></a></div>
          </div>
        <?php } ?>

        <div class="clear"></div>

        <div class="legend">
          <div class="elem first"><?php _e('Status explanation', 'all_in_one');?>:</div>
          <div class="elem"><i class="fa fa-check green-color"></i><?php _e('Link was found, everything is good', 'all_in_one');?></div>
          <div class="elem"><i class="fa fa-close red-color"></i><?php _e('Link was not found', 'all_in_one');?></div>
          <div class="elem"><i class="fa fa-question blue-color"></i><?php _e('No status saved yet, refresh status', 'all_in_one');?></div>
        </div>
        <div class="clear"></div>
        <br />

        <button name="theButton" id="theButton" type="submit" style="float: left;" class="btn btn-submit link-rec-update"><?php _e('Update', 'all_in_one');?></button>
        <button name="theButton" id="theButton" type="submit" style="margin-left:5px;float: left;" class="btn btn-submit link-rec-email"><?php _e('Send Warning Emails', 'all_in_one');?></button>
    </fieldset>
  </form>
  
  <div class="clear"></div>
  <br /><br />

  <div class="warn"><sup class="sup-go1">(1)</sup> <?php _e('Link Title cannot be empty, otherwise link will not be visible for user.', 'all_in_one'); ?></div>
  <div class="warn"><sup class="sup-go2">(2)</sup> <?php _e('Enter URL with <strong>http://</strong> or <strong>https://</strong> ... if you enter just www.your_site.com, this may not work!', 'all_in_one'); ?></div>
  <div class="warn"><sup class="sup-go3">(3)</sup> <?php _e('When auto-hooked, it is added to hook <strong>footer</strong> that should be placed in every theme in footer.php (footer file) at bottom of page. Links are wrapped in div with id <strong>#footer-links</strong> and has default style: width:100%; float:left; clear:both;', 'all_in_one'); ?></div>
  <div class="warn"><sup class="sup-go4">(4)</sup> <?php _e('Check this to add link to footer. This link will be thrown by function <strong>SeoFooterLinks()</strong> that needs to be auto-hooked or placed manually to footer - read <sup class="sup-go go1">(1)</sup>. Otherwise, link will not be shown.', 'all_in_one'); ?></div>
  <div class="warn"><sup class="sup-go5">(5)</sup> <?php _e('Check this to add <strong>rel="nofollow"</strong> to body of link. This cause that link will not be followed by search engines and in fact it improves your SEO ranking (because you lower number of links that follow to external sites). Remember that this practice is not 100% fair for people you are exchanging links and they can stop to work with you when they realize that links has nofollow attribute.', 'all_in_one'); ?></div>
  <div class="warn"><sup class="sup-go6">(6)</sup> <?php _e('Enter here URL that reffers - points to your site.<br /><strong>Example:</strong> If you ask someone to place on his website your backlink, it can be something like this', 'all_in_one'); ?>: <span class="code-text bold">&lt;href="<?php echo osc_base_url(); ?>"&gt;<?php _e('Buy & Sell everything', 'all_in_one'); ?>&lt;a&gt;</span> - <?php _e('in this link, ', 'all_in_one'); ?> <span class="code-text bold"><?php echo osc_base_url(); ?></span> <?php _e('is ', 'all_in_one'); ?> <span class="underline"><?php _e('your referral URL', 'all_in_one'); ?></span></div>
  <div class="warn"><sup class="sup-go7">(7)</sup> <?php _e('Enter here URL where is placed your backlink. Usually this is some external site that refers back to your website.<br /><strong>Example:</strong> If your backlink would be placed on', 'all_in_one'); ?> <span class="code-text bold">http://www.mb-themes.com</span>, <?php _e('this would be', 'all_in_one'); ?> <span class="underline"><?php _e('URL with your link, ', 'all_in_one'); ?></span></div>
  <div class="warn"><sup class="sup-go8">(8)</sup> <?php _e('Enter email contact to owner of website, where is placed your link. In case link is removed (or cannot be found), plugin can send warning email to this person that link was removed and if will not be added again, cooperation with that website will be cancelled', 'all_in_one'); ?></div>
  <div class="warn"><sup class="sup-go9">(9)</sup> <?php _e('Select to which people you want to send warning email that reciprocal link was not found on their website with kindly request to add it here or inform you why it is not here. You can send email just in case status is red - link not found. You can also select which people you want to contact.', 'all_in_one'); ?></div>
</div>

<div class="clear"></div>
<br /><br />

<?php echo $pluginInfo['plugin_name'] . ' | ' . __('Version', 'all_in_one') . ' ' . $pluginInfo['version'] . ' | ' . __('Author', 'all_in_one') . ': ' . $pluginInfo['author'] . ' | Cannot be redistributed | &copy; ' . date('Y') . ' <a href="' . $pluginInfo['plugin_uri'] . '" target="_blank">MB Themes</a>'; ?>             