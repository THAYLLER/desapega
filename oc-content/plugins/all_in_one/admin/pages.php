<?php
  // Create menu
  $title = __('Static Pages', 'all_in_one');
  ais_menu($title);



  // DEFINE AVAILABLE ELEMENTS IN PAGE TAGS
  $all_elements = array(
    array('web_title', __('Website Name', 'all_in_one'), __('Defined General > Settings', 'all_in_one')),
    array('web_description', __('Website Description', 'all_in_one'), __('Defined General > Settings', 'all_in_one')),
    array('page_title', __('Page Title', 'all_in_one'), __('Name of certain page', 'all_in_one')),
    array('page_text', __('Page Content', 'all_in_one'), __('First 120 characters of text', 'all_in_one')),
    array('page_meta_title', __('Page Meta Title', 'all_in_one'), __('Defined bellow', 'all_in_one')),
    array('page_meta_description', __('Page Meta Description', 'all_in_one'), __('Defined bellow', 'all_in_one')),
    array('page_custom_text', __('Custom Page Text', 'all_in_one'), __('Defined bellow', 'all_in_one'))
  );



  // UPDATE CUSTOM META TAGS FOR PAGES
  if(Params::getParam('plugin_action') == 'update') {
    $pages = Page::newInstance()->listAll(false, 0); 

    foreach( $pages as $p ) {
      $detail = ModelAisPage::newInstance()->findByPageId( $p['pk_i_id'] );

      if(isset($detail['fk_i_page_id']) && $detail['fk_i_page_id'] > 0) {
        ModelAisPage::newInstance()->updatePageMeta( $p['pk_i_id'], Params::getParam('page_title_' . $p['pk_i_id']), Params::getParam('page_description_' . $p['pk_i_id']) );
      } else {
        ModelAisPage::newInstance()->insertPageMeta( $p['pk_i_id'], Params::getParam('page_title_' . $p['pk_i_id']), Params::getParam('page_description_' . $p['pk_i_id']) );
      } 
    }

    message_ok(__('Pages meta settings saved', 'all_in_one') . ' (' . ais_get_locale() . ')');
  }



  // GET & UPDATE PARAMETERS
  // $variable = ais_param_update( 'param_name', 'form_name', 'input_type', 'plugin_var_name' );
  // input_type: check, code or value
  $page_custom_text = ais_param_update( 'page_custom_text', 'plugin_action', 'value', 'plugin-ais' );
  $page_title_active = ais_param_update( 'page_title_active', 'plugin_action_title', 'value', 'plugin-ais' );
  $page_meta_title_active = ais_param_update( 'page_meta_title_active', 'plugin_action_meta_title', 'value', 'plugin-ais' );
  $page_meta_description_active = ais_param_update( 'page_meta_description_active', 'plugin_action_meta_description', 'value', 'plugin-ais' );



  // CREATE ARRAY FROM ACTIVE ELEMENTS
  $page_title_active_array = explode(',', $page_title_active);
  $page_meta_title_active_array = explode(',', $page_meta_title_active);
  $page_meta_description_active_array = explode(',', $page_meta_description_active);


  if(Params::getParam('plugin_action') == 'done') {
    message_ok(__('Custom text for pages was successfully saved.', 'all_in_one'));
  }

  if(Params::getParam('plugin_action_title') == 'done') {
    message_ok(__('Title settings for pages were successfully saved.', 'all_in_one'));
  }

  if(Params::getParam('plugin_action_meta_title') == 'done') {
    message_ok(__('Meta title settings for pages were successfully saved.', 'all_in_one'));
  }

  if(Params::getParam('plugin_action_meta_description') == 'done') {
    message_ok(__('Meta description settings for pages were successfully saved.', 'all_in_one'));
  }
?>


<div class="mb-body">

  <!-- PAGES TITLE SETTINGS -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data"  <?php if( osc_get_preference('title_extra', 'plugin-ais') == 0 ) { ?>style="display:none;"<?php } ?> >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>pages.php" />
    <input type="hidden" name="plugin_action_title" value="done" />
    <input type="hidden" name="page_title_active" id="page_title_active" value="<?php echo $page_title_active; ?>" />

    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-cog"></i> <?php _e('Pages <strong>title</strong> settings', 'all_in_one'); ?><span><?php _e('Used browser tab, usually it is same as Meta Title', 'all_in_one'); ?></span></div>

      <div class="mb-inside">
        <div class="mb-dropzone mb-row">
          <div class="mb-drag-drop">
            <img src="<?php echo osc_base_url(); ?>oc-content/plugins/all_in_one/img/drag_drop.png" />
            <span><?php _e('Drag & drop elements between boxes', 'all_in_one'); ?></span>
          </div>


          <!-- ACTIVE ELEMENTS -->
          <div class="mb-sort-box mb-box-active mb-left">
            <span class="mb-row"><?php _e('Active elements', 'all_in_one'); ?></span>

            <ul id="page-title-sort-active" class="conn-sort-title">
              <?php foreach($page_title_active_array as $a) { ?>
                <?php foreach($all_elements as $e) { ?>
                  <?php if( $a == $e[0] ) { ?>
                    <li id="<?php echo $e[0]; ?>">
                      <strong><?php echo $e[1]; ?></strong>
                      <?php if(isset($e[2]) && $e[2] <> '') { ?> - <?php echo $e[2]; ?><?php } ?>
                    </li>
                  <?php } ?>
                <?php } ?>
              <?php } ?>
            </ul>
          </div>


          <!-- AVAILABLE ELEMENTS -->
          <div class="mb-sort-box mb-box-avl mb-right">
            <span class="mb-row"><?php _e('Available elements', 'all_in_one'); ?></span>

            <ul id="page-title-sort-avl" class="conn-sort-title">
              <?php foreach($all_elements as $e) { ?>
                <?php if( !in_array($e[0], $page_title_active_array) ) { ?>
                  <li id="<?php echo $e[0]; ?>">
                    <strong><?php echo $e[1]; ?></strong>
                    <?php if(isset($e[2]) && $e[2] <> '') { ?> - <?php echo $e[2]; ?><?php } ?>
                  </li>
                <?php } ?>
              <?php } ?>
            </ul>
          </div>

        </div>
      </div>

      <div class="mb-foot">
        <button type="submit" class="mb-button"><?php _e('Save', 'all_in_one');?></button>
      </div>
    </div>
  </form>



  <!-- PAGES META TITLE SETTINGS -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>pages.php" />
    <input type="hidden" name="plugin_action_meta_title" value="done" />
    <input type="hidden" name="page_meta_title_active" id="page_meta_title_active" value="<?php echo $page_meta_title_active; ?>" />

    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-cog"></i> <?php _e('Pages <strong>meta title</strong> settings', 'all_in_one'); ?><span><?php _e('Used in Google Results as title. Recommended length is 50-60 characters.', 'all_in_one'); ?></span></div>

      <div class="mb-inside">
        <div class="mb-dropzone mb-row">
          <div class="mb-drag-drop">
            <img src="<?php echo osc_base_url(); ?>oc-content/plugins/all_in_one/img/drag_drop.png" />
            <span><?php _e('Drag & drop elements between boxes', 'all_in_one'); ?></span>
          </div>


          <!-- ACTIVE ELEMENTS -->
          <div class="mb-sort-box mb-box-active mb-left">
            <span class="mb-row"><?php _e('Active elements', 'all_in_one'); ?></span>

            <ul id="page-meta-title-sort-active" class="conn-sort-meta-title">
              <?php foreach($page_meta_title_active_array as $a) { ?>
                <?php foreach($all_elements as $e) { ?>
                  <?php if( $a == $e[0] ) { ?>
                    <li id="<?php echo $e[0]; ?>">
                      <strong><?php echo $e[1]; ?></strong>
                      <?php if(isset($e[2]) && $e[2] <> '') { ?> - <?php echo $e[2]; ?><?php } ?>
                    </li>
                  <?php } ?>
                <?php } ?>
              <?php } ?>
            </ul>
          </div>


          <!-- AVAILABLE ELEMENTS -->
          <div class="mb-sort-box mb-box-avl mb-right">
            <span class="mb-row"><?php _e('Available elements', 'all_in_one'); ?></span>

            <ul id="page-meta-title-sort-avl" class="conn-sort-meta-title">
              <?php foreach($all_elements as $e) { ?>
                <?php if( !in_array($e[0], $page_meta_title_active_array) ) { ?>
                  <li id="<?php echo $e[0]; ?>">
                    <strong><?php echo $e[1]; ?></strong>
                    <?php if(isset($e[2]) && $e[2] <> '') { ?> - <?php echo $e[2]; ?><?php } ?>
                  </li>
                <?php } ?>
              <?php } ?>
            </ul>
          </div>

        </div>
      </div>

      <div class="mb-foot">
        <button type="submit" class="mb-button"><?php _e('Save', 'all_in_one');?></button>
      </div>
    </div>
  </form>



  <!-- PAGES META DESCRIPTION SETTINGS -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>pages.php" />
    <input type="hidden" name="plugin_action_meta_description" value="done" />
    <input type="hidden" name="page_meta_description_active" id="page_meta_description_active" value="<?php echo $page_meta_description_active; ?>" />

    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-cog"></i> <?php _e('Pages <strong>meta description</strong> settings', 'all_in_one'); ?><span><?php _e('Used in Google Results as description. Recommended length is 150-160 characters.', 'all_in_one'); ?></span></div>

      <div class="mb-inside">
        <div class="mb-dropzone mb-row">
          <div class="mb-drag-drop">
            <img src="<?php echo osc_base_url(); ?>oc-content/plugins/all_in_one/img/drag_drop.png" />
            <span><?php _e('Drag & drop elements between boxes', 'all_in_one'); ?></span>
          </div>


          <!-- ACTIVE ELEMENTS -->
          <div class="mb-sort-box mb-box-active mb-left">
            <span class="mb-row"><?php _e('Active elements', 'all_in_one'); ?></span>

            <ul id="page-meta-description-sort-active" class="conn-sort-meta-description">
              <?php foreach($page_meta_description_active_array as $a) { ?>
                <?php foreach($all_elements as $e) { ?>
                  <?php if( $a == $e[0] ) { ?>
                    <li id="<?php echo $e[0]; ?>">
                      <strong><?php echo $e[1]; ?></strong>
                      <?php if(isset($e[2]) && $e[2] <> '') { ?> - <?php echo $e[2]; ?><?php } ?>
                    </li>
                  <?php } ?>
                <?php } ?>
              <?php } ?>
            </ul>
          </div>


          <!-- AVAILABLE ELEMENTS -->
          <div class="mb-sort-box mb-box-avl mb-right">
            <span class="mb-row"><?php _e('Available elements', 'all_in_one'); ?></span>

            <ul id="page-meta-description-sort-avl" class="conn-sort-meta-description">
              <?php foreach($all_elements as $e) { ?>
                <?php if( !in_array($e[0], $page_meta_description_active_array) ) { ?>
                  <li id="<?php echo $e[0]; ?>">
                    <strong><?php echo $e[1]; ?></strong>
                    <?php if(isset($e[2]) && $e[2] <> '') { ?> - <?php echo $e[2]; ?><?php } ?>
                  </li>
                <?php } ?>
              <?php } ?>
            </ul>
          </div>

        </div>
      </div>

      <div class="mb-foot">
        <button type="submit" class="mb-button"><?php _e('Save', 'all_in_one');?></button>
      </div>
    </div>
  </form>



  <!-- CUSTOM TEXT ON PAGES -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>pages.php" />
    <input type="hidden" name="plugin_action" value="done" />
    
    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-pencil"></i> <?php _e('Define custom pages text', 'all_in_one'); ?></div>

      <div class="mb-inside">
        <div class="mb-row">
          <label for="page_custom_text" class="h1"><span><?php _e('Custom Text', 'all_in_one'); ?></span></label> 
          <input size="40" name="page_custom_text" id="page_custom_text" type="text" value="<?php echo $page_custom_text; ?>" />

          <div class="mb-explain"><?php _e('Define custom text for pages and use it in title, meta title or meta description.', 'all_in_one'); ?></div>
        </div>
      </div>

      <div class="mb-foot">
        <button type="submit" class="mb-button"><?php _e('Update', 'all_in_one');?></button>
      </div>
    </div>
  </form>


  
  <!-- CUSTOM META TAGS ON PAGES -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>pages.php" />
    <input type="hidden" name="plugin_action" value="update" />
    
    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-file-o"></i> <?php _e('Manage custom meta tags for pages', 'all_in_one'); ?> <?php echo ais_locale_box( 'pages.php' ); ?></div>

      <div class="mb-inside">
        <?php $pages = Page::newInstance()->listAll(false, 0); ?>

        <div class="mb-table">
          <div class="mb-table-head">
            <div class="mb-col-1"><?php _e('ID', 'all_in_one'); ?></div>
            <div class="mb-col-4 mb-align-left"><?php _e('Name', 'all_in_one'); ?></div>
            <div class="mb-col-5 mb-align-left"><?php _e('Meta Title', 'all_in_one'); ?></div>
            <div class="mb-col-10 mb-align-left"><?php _e('Meta Description', 'all_in_one'); ?></div>
            <div class="mb-col-2">&nbsp;</div>
            <div class="mb-col-2">&nbsp;</div>
          </div>

          <?php if(count($pages) <= 0) { ?>
            <div class="mb-table-row mb-row-empty">
              <i class="fa fa-warning"></i><span><?php _e('No pages has been created yet', 'all_in_one'); ?></span>
            </div>
          <?php } else { ?>
            <?php foreach($pages as $p) { ?>
              <?php $detail = ModelAisPage::newInstance()->findByPageId( $p['pk_i_id'] ); ?>

              <div class="mb-table-row ais-link-list">
                <div class="mb-col-1"><?php echo $p['pk_i_id']; ?></div>
                <div class="mb-col-4 mb-align-left"><?php echo $p['locale'][osc_current_admin_locale()]['s_title']; ?></div>
                <div class="mb-col-5"><input type="text" id="page_title" name="page_title_<?php echo $p['pk_i_id']; ?>" value="<?php echo $detail['s_title']; ?>" /></div>
                <div class="mb-col-10"><input type="text" id="page_description" name="page_description_<?php echo $p['pk_i_id']; ?>" value="<?php echo $detail['s_description']; ?>" /></div>
                <div class="mb-col-2"><a href="<?php echo osc_admin_base_url(true) . '?page=pages&action=edit&id=' . $p['pk_i_id']; ?>" target="_blank"><?php _e('Edit', 'all_in_one'); ?></a></div>
                <div class="mb-col-2"><a href="<?php echo osc_base_url(true) . '?page=page&id=' . $p['pk_i_id']; ?>" target="_blank"><?php _e('Preview', 'all_in_one'); ?></a></div>
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




  <!-- META SNIPPET PREVIEW -->
  <div class="mb-box" id="mb-help">
    <div class="mb-head"><i class="fa fa-tv"></i> <?php _e('Snippet preview - shows how sample page will look in google search result', 'all_in_one'); ?></div>

    <?php 
      $page = Page::newInstance()->listAll(false);
      View::newInstance()->_exportVariableToView('pages', $page);
      $snippet_title = osc_highlight(ais_create_tag( $page_meta_title_active, ais_title_delimiter(), 60)); 
      $snippet_url = osc_static_page_url();
      $snippet_description = osc_highlight(ais_create_tag( $page_meta_description_active, ais_description_delimiter() ), 160); 
    ?>

    <div class="mb-inside">
      <?php if( osc_static_page_id() <> '' && osc_static_page_id() > 0 ) { ?>
        <div class="mb-row mb-snippet-preview mb-snippet-fake">
          <div class="mb-row mb-snippet-title"><?php _e('SomeWeb.com - Welcome', 'all_in_one'); ?></div>
          <div class="mb-row mb-snippet-url">https://www.google.com/search</div>
          <div class="mb-row mb-snippet-description"><?php _e('Hello user, welcome to our site. Feel free to check our great offer for best prices.', 'all_in_one'); ?></div>
        </div>

        <div class="mb-row mb-snippet-preview mb-snippet-real">
          <div class="mb-row mb-snippet-title"><?php echo $snippet_title; ?></div>
          <div class="mb-row mb-snippet-url"><?php echo $snippet_url; ?></div>
          <div class="mb-row mb-snippet-description"><?php echo $snippet_description; ?></div>

          <div class="mb-snippet-yours"><i class="fa fa-angle-left"></i><span><?php _e('Your website', 'all_in_one'); ?></span></div>
        </div>

        <div class="mb-row mb-snippet-preview mb-snippet-fake">
          <div class="mb-row mb-snippet-title"><?php _e('OtherSite.com - Alabama local', 'all_in_one'); ?></div>
          <div class="mb-row mb-snippet-url">https://www.youtube.com/classifieds</div>
          <div class="mb-row mb-snippet-description"><?php _e('Are you looking to trade with videos? Do you want to sell or share them? You are on right place.', 'all_in_one'); ?></div>
        </div>
      <?php } else { ?>
        <div class="mb-row mb-snippet-empty"><?php _e('No static pages has been found, preview could not be generated.', 'all_in_one'); ?></div>
      <?php } ?>
    </div>
  </div>




  <!-- PLUGIN INTEGRATION -->
  <div class="mb-box" <?php if( osc_get_preference('title_extra', 'plugin-ais') == 0 ) { ?>style="display:none;"<?php } ?> >
    <div class="mb-head"><i class="fa fa-wrench"></i> <?php _e('Plugin Setup', 'all_in_one'); ?></div>

    <div class="mb-inside">

      <div class="mb-row">
        <div class="mb-line"><?php _e('By default, <strong>Title</strong> and <strong>Meta Title</strong> are same. To apply different settings for them it is required to locate following code in your theme files', 'all_in_one'); ?>:</div>
        <span class="mb-code">&lt;title&gt;&lt;?php echo meta_title() ; ?&gt;&lt;/title&gt;</span>
        <div class="mb-line" style="margin-top:20px;"><?php _e('And replace it with', 'all_in_one'); ?>:</div>
        <span class="mb-code">&lt;title&gt;&lt;?php echo ais_title() ; ?&gt;&lt;/title&gt;</span>
        <div class="mb-line" style="margin-top:20px;"><?php _e('Usually this code is located in file head.php or common/head.php in your theme folder.', 'all_in_one'); ?></div>
      </div>
    </div>
  </div>



  <!-- HELP TOPICS -->
  <div class="mb-box" id="mb-help">
    <div class="mb-head"><i class="fa fa-question-circle"></i> <?php _e('Help', 'all_in_one'); ?></div>

    <div class="mb-inside">
      <div class="mb-row mb-help"><span class="sup">(1)</span> <div class="h1"><?php _e('Define custom text for pages and use it in title, meta title or meta description. You can use it i.e. when you want to place some specific text into title or description.', 'all_in_one'); ?></div></div>
      <div class="mb-row mb-help"><div><?php _e('Meta title should have 50-60 characters and Meta description 150-160 characters.', 'all_in_one'); ?></div></div>
    </div>
  </div>
</div>

<?php echo ais_footer(); ?>



<script>

  // SORTABLE JS FOR TITLE
  $(function() {
    $('#page-title-sort-avl, #page-title-sort-active').sortable({
      connectWith: '.conn-sort-title'
    }).disableSelection();
  });

  $(document).ready(function(){
    $('#page-title-sort-avl, #page-title-sort-active').sortable({
      stop : function(event, ui){
        $('#page_title_active').val($('#page-title-sort-active').sortable('toArray'));
      }
    });
  });



  // SORTABLE JS FOR META TITLE
  $(function() {
    $('#page-meta-title-sort-avl, #page-meta-title-sort-active').sortable({
      connectWith: '.conn-sort-meta-title'
    }).disableSelection();
  });

  $(document).ready(function(){
    $('#page-meta-title-sort-avl, #page-meta-title-sort-active').sortable({
      stop : function(event, ui){
        $('#page_meta_title_active').val($('#page-meta-title-sort-active').sortable('toArray'));
      }
    });
  });



  // SORTABLE JS FOR META DESCRIPTION
  $(function() {
    $('#page-meta-description-sort-avl, #page-meta-description-sort-active').sortable({
      connectWith: '.conn-sort-meta-description'
    }).disableSelection();
  });

  $(document).ready(function(){
    $('#page-meta-description-sort-avl, #page-meta-description-sort-active').sortable({
      stop : function(event, ui){
        $('#page_meta_description_active').val($('#page-meta-description-sort-active').sortable('toArray'));
      }
    });
  });

</script>
