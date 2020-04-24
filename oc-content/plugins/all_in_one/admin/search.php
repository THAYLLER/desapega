<?php
  // Create menu
  $title = __('Search', 'all_in_one');
  ais_menu($title);



  // DEFINE AVAILABLE ELEMENTS IN SEARCH TAGS
  $all_elements = array(
    array('web_title', __('Website Name', 'all_in_one'), __('Defined General > Settings', 'all_in_one')),
    array('web_description', __('Website Description', 'all_in_one'), __('Defined General > Settings', 'all_in_one')),
    array('search_pattern', __('Search Pattern', 'all_in_one'), __('Searched text', 'all_in_one')),
    array('search_custom_text', __('Custom Search Text', 'all_in_one'), __('Defined bellow', 'all_in_one')),
    array('category_name', __('Category Name', 'all_in_one'), __('Defined in General > Categories', 'all_in_one')),
    array('category_description', __('Category Description', 'all_in_one'), __('First 120 characters', 'all_in_one')),
    array('category_meta_title', __('Category Meta Title', 'all_in_one'), __('Defined in Categories section', 'all_in_one')),
    array('category_meta_description', __('Category Meta Description', 'all_in_one'), __('Defined in Categories section', 'all_in_one')),
    array('country_name', __('Country Name', 'all_in_one')),
    array('country_meta_title', __('Country Meta Title', 'all_in_one'), __('Defined in Locations section', 'all_in_one')),
    array('country_meta_description', __('Country Meta Description', 'all_in_one'), __('Defined in Locations section', 'all_in_one')),
    array('region_name', __('Region Name', 'all_in_one')),
    array('region_meta_title', __('Region Meta Title', 'all_in_one'), __('Defined in Locations section', 'all_in_one')),
    array('region_meta_description', __('Region Meta Description', 'all_in_one'), __('Defined in Locations section', 'all_in_one')),
    array('city_name', __('City Name', 'all_in_one')),
    array('page_number', __('Page Number', 'all_in_one'), __('Currently browsed page number', 'all_in_one'))
  );



  // GET & UPDATE PARAMETERS
  // $variable = ais_param_update( 'param_name', 'form_name', 'input_type', 'plugin_var_name' );
  // input_type: check, code or value
  $search_custom_text = ais_param_update( 'search_custom_text', 'plugin_action', 'value', 'plugin-ais' );
  $search_title_active = ais_param_update( 'search_title_active', 'plugin_action_title', 'value', 'plugin-ais' );
  $search_meta_title_active = ais_param_update( 'search_meta_title_active', 'plugin_action_meta_title', 'value', 'plugin-ais' );
  $search_meta_description_active = ais_param_update( 'search_meta_description_active', 'plugin_action_meta_description', 'value', 'plugin-ais' );



  // CREATE ARRAY FROM ACTIVE ELEMENTS
  $search_title_active_array = explode(',', $search_title_active);
  $search_meta_title_active_array = explode(',', $search_meta_title_active);
  $search_meta_description_active_array = explode(',', $search_meta_description_active);


  if(Params::getParam('plugin_action') == 'done') {
    message_ok(__('Custom text for search was successfully saved.', 'all_in_one'));
  }

  if(Params::getParam('plugin_action_title') == 'done') {
    message_ok(__('Title settings for search were successfully saved.', 'all_in_one'));
  }

  if(Params::getParam('plugin_action_meta_title') == 'done') {
    message_ok(__('Meta title settings for search were successfully saved.', 'all_in_one'));
  }

  if(Params::getParam('plugin_action_meta_description') == 'done') {
    message_ok(__('Meta description settings for search were successfully saved.', 'all_in_one'));
  }
?>


<div class="mb-body">

  <!-- SEARCH TITLE SETTINGS -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data"  <?php if( osc_get_preference('title_extra', 'plugin-ais') == 0 ) { ?>style="display:none;"<?php } ?> >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>search.php" />
    <input type="hidden" name="plugin_action_title" value="done" />
    <input type="hidden" name="search_title_active" id="search_title_active" value="<?php echo $search_title_active; ?>" />

    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-cog"></i> <?php _e('Search <strong>title</strong> settings', 'all_in_one'); ?><span><?php _e('Used browser tab, usually it is same as Meta Title', 'all_in_one'); ?></span></div>

      <div class="mb-inside">
        <div class="mb-dropzone mb-row">
          <div class="mb-drag-drop">
            <img src="<?php echo osc_base_url(); ?>oc-content/plugins/all_in_one/img/drag_drop.png" />
            <span><?php _e('Drag & drop elements between boxes', 'all_in_one'); ?></span>
          </div>


          <!-- ACTIVE ELEMENTS -->
          <div class="mb-sort-box mb-box-active mb-left">
            <span class="mb-row"><?php _e('Active elements', 'all_in_one'); ?></span>

            <ul id="search-title-sort-active" class="conn-sort-title">
              <?php foreach($search_title_active_array as $a) { ?>
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

            <ul id="search-title-sort-avl" class="conn-sort-title">
              <?php foreach($all_elements as $e) { ?>
                <?php if( !in_array($e[0], $search_title_active_array) ) { ?>
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



  <!-- SEARCH META TITLE SETTINGS -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>search.php" />
    <input type="hidden" name="plugin_action_meta_title" value="done" />
    <input type="hidden" name="search_meta_title_active" id="search_meta_title_active" value="<?php echo $search_meta_title_active; ?>" />

    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-cog"></i> <?php _e('Search <strong>meta title</strong> settings', 'all_in_one'); ?><span><?php _e('Used in Google Results as title. Recommended length is 50-60 characters.', 'all_in_one'); ?></span></div>

      <div class="mb-inside">
        <div class="mb-dropzone mb-row">
          <div class="mb-drag-drop">
            <img src="<?php echo osc_base_url(); ?>oc-content/plugins/all_in_one/img/drag_drop.png" />
            <span><?php _e('Drag & drop elements between boxes', 'all_in_one'); ?></span>
          </div>


          <!-- ACTIVE ELEMENTS -->
          <div class="mb-sort-box mb-box-active mb-left">
            <span class="mb-row"><?php _e('Active elements', 'all_in_one'); ?></span>

            <ul id="search-meta-title-sort-active" class="conn-sort-meta-title">
              <?php foreach($search_meta_title_active_array as $a) { ?>
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

            <ul id="search-meta-title-sort-avl" class="conn-sort-meta-title">
              <?php foreach($all_elements as $e) { ?>
                <?php if( !in_array($e[0], $search_meta_title_active_array) ) { ?>
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



  <!-- SEARCH META DESCRIPTION SETTINGS -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>search.php" />
    <input type="hidden" name="plugin_action_meta_description" value="done" />
    <input type="hidden" name="search_meta_description_active" id="search_meta_description_active" value="<?php echo $search_meta_description_active; ?>" />

    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-cog"></i> <?php _e('Search <strong>meta description</strong> settings', 'all_in_one'); ?><span><?php _e('Used in Google Results as description. Recommended length is 150-160 characters.', 'all_in_one'); ?></span></div>

      <div class="mb-inside">
        <div class="mb-dropzone mb-row">
          <div class="mb-drag-drop">
            <img src="<?php echo osc_base_url(); ?>oc-content/plugins/all_in_one/img/drag_drop.png" />
            <span><?php _e('Drag & drop elements between boxes', 'all_in_one'); ?></span>
          </div>


          <!-- ACTIVE ELEMENTS -->
          <div class="mb-sort-box mb-box-active mb-left">
            <span class="mb-row"><?php _e('Active elements', 'all_in_one'); ?></span>

            <ul id="search-meta-description-sort-active" class="conn-sort-meta-description">
              <?php foreach($search_meta_description_active_array as $a) { ?>
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

            <ul id="search-meta-description-sort-avl" class="conn-sort-meta-description">
              <?php foreach($all_elements as $e) { ?>
                <?php if( !in_array($e[0], $search_meta_description_active_array) ) { ?>
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



  <!-- CUSTOM TEXT ON SEARCH -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>search.php" />
    <input type="hidden" name="plugin_action" value="done" />
    
    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-pencil"></i> <?php _e('Define custom search text', 'all_in_one'); ?></div>

      <div class="mb-inside">
        <div class="mb-row">
          <label for="search_custom_text" class="h1"><span><?php _e('Custom Text', 'all_in_one'); ?></span></label> 
          <input size="40" name="search_custom_text" id="search_custom_text" type="text" value="<?php echo $search_custom_text; ?>" />

          <div class="mb-explain"><?php _e('Define custom text for search and use it in title, meta title or meta description.', 'all_in_one'); ?></div>
        </div>
      </div>

      <div class="mb-foot">
        <button type="submit" class="mb-button"><?php _e('Update', 'all_in_one');?></button>
      </div>
    </div>
  </form>



  <!-- META SNIPPET PREVIEW -->
  <div class="mb-box" id="mb-help">
    <div class="mb-head"><i class="fa fa-tv"></i> <?php _e('Snippet preview - shows how sample search result will look in google search result', 'all_in_one'); ?></div>

    <?php 
      $last_loc = ModelAisLocation::newInstance()->getSampleLocation();
      $cat = ModelAisCategory::newInstance()->getLastCategoryId();

      View::newInstance()->_exportVariableToView('search_country', $last_loc['country_name']);
      View::newInstance()->_exportVariableToView('search_region', $last_loc['region_name']);
      View::newInstance()->_exportVariableToView('search_city', $last_loc['city_name']);
      View::newInstance()->_exportVariableToView('search_pattern', __('Apple iPhone 5S', 'all_in_one'));
      View::newInstance()->_exportVariableToView('search_category', array( $cat['pk_i_id'] ));
      Params::setParam('iPage', 3);


      $snippet_title = osc_highlight(ais_create_tag( $search_meta_title_active, ais_title_delimiter(), 60)); 
      $snippet_url = osc_search_url();
      $snippet_description = osc_highlight(ais_create_tag( $search_meta_description_active, ais_description_delimiter() ), 160); 
    ?>

    <div class="mb-inside">
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
      <div class="mb-row mb-help"><span class="sup">(1)</span> <div class="h1"><?php _e('Define custom text for search and use it in title, meta title or meta description. You can use it i.e. when you want to place some specific text into title or description.', 'all_in_one'); ?></div></div>
      <div class="mb-row mb-help"><div><?php _e('Meta title should have 50-60 characters and Meta description 150-160 characters.', 'all_in_one'); ?></div></div>
    </div>
  </div>
</div>

<?php echo ais_footer(); ?>



<script>

  // SORTABLE JS FOR TITLE
  $(function() {
    $('#search-title-sort-avl, #search-title-sort-active').sortable({
      connectWith: '.conn-sort-title'
    }).disableSelection();
  });

  $(document).ready(function(){
    $('#search-title-sort-avl, #search-title-sort-active').sortable({
      stop : function(event, ui){
        $('#search_title_active').val($('#search-title-sort-active').sortable('toArray'));
      }
    });
  });



  // SORTABLE JS FOR META TITLE
  $(function() {
    $('#search-meta-title-sort-avl, #search-meta-title-sort-active').sortable({
      connectWith: '.conn-sort-meta-title'
    }).disableSelection();
  });

  $(document).ready(function(){
    $('#search-meta-title-sort-avl, #search-meta-title-sort-active').sortable({
      stop : function(event, ui){
        $('#search_meta_title_active').val($('#search-meta-title-sort-active').sortable('toArray'));
      }
    });
  });



  // SORTABLE JS FOR META DESCRIPTION
  $(function() {
    $('#search-meta-description-sort-avl, #search-meta-description-sort-active').sortable({
      connectWith: '.conn-sort-meta-description'
    }).disableSelection();
  });

  $(document).ready(function(){
    $('#search-meta-description-sort-avl, #search-meta-description-sort-active').sortable({
      stop : function(event, ui){
        $('#search_meta_description_active').val($('#search-meta-description-sort-active').sortable('toArray'));
      }
    });
  });

</script>
