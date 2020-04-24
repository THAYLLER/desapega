<?php
  // Create menu
  $title = __('Categories', 'all_in_one');
  ais_menu($title);


  // UPDATE CATEGORIES META TAGS
  if(Params::getParam('plugin_action') == 'category') {
    $categories = ais_category_list();

    foreach( $categories as $c ) {
      if(Params::existParam('category_title_' . $c['pk_i_id'])) {
        $detail = ModelAisCategory::newInstance()->findByCategoryId( $c['pk_i_id'] );

        if(isset($detail['fk_i_category_id']) && $detail['fk_i_category_id'] > 0) {
          ModelAisCategory::newInstance()->updateCategoryMeta( $c['pk_i_id'], Params::getParam('category_title_' . $c['pk_i_id']), Params::getParam('category_description_' . $c['pk_i_id']) );
        } else {
          ModelAisCategory::newInstance()->insertCategoryMeta( $c['pk_i_id'], Params::getParam('category_title_' . $c['pk_i_id']), Params::getParam('category_description_' . $c['pk_i_id']) );
        }
      }
    }

    message_ok(__('Categories meta settings saved', 'all_in_one') . ' (' . ais_get_locale() . ')');
  }




  // GET & UPDATE PARAMETERS
  // $variable = ais_param_update( 'param_name', 'form_name', 'input_type', 'plugin_var_name' );
  // input_type: check, code or value


?>


<div class="mb-body">
  <div class="mb-info-box" style="margin:10px 0 35px 0;">
    <div class="mb-line"><?php _e('Configuration for meta tags is set on <strong>Search</strong> settings of plugin, as category links are specific search links (search with category selected).', 'all_in_one'); ?></div>
  </div>


  <!-- CUSTOM META TAGS FOR CATEGORIES -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>categories.php" />
    <input type="hidden" name="plugin_action" value="category" />
    
    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-bars"></i> <?php _e('Manage custom meta tags for categories', 'all_in_one'); ?> <?php echo ais_locale_box( 'categories.php' ); ?></div>

      <div class="mb-inside">
        <?php $categories = ais_category_list(); ?>

        <div class="mb-table">
          <div class="mb-table-head">
            <div class="mb-col-2"><?php _e('ID', 'all_in_one'); ?></div>
            <div class="mb-col-7 mb-align-left"><?php _e('Category', 'all_in_one'); ?></div>
            <div class="mb-col-6 mb-align-left"><?php _e('Meta Title', 'all_in_one'); ?></div>
            <div class="mb-col-9 mb-align-left"><?php _e('Meta Description', 'all_in_one'); ?></div>
          </div>

          <?php if(count($categories) <= 0) { ?>
            <div class="mb-table-row mb-row-empty">
              <i class="fa fa-warning"></i><span><?php _e('No categories has been added yet', 'all_in_one'); ?></span>
            </div>
          <?php } else { ?>
            <?php foreach($categories as $c) { ?>
              <?php $detail = ModelAisCategory::newInstance()->findByCategoryId( $c['pk_i_id'] ); ?>

              <div class="mb-table-row ais-link-list">
                <div class="mb-col-2"><?php echo $c['pk_i_id']; ?></div>
                <div class="mb-col-7 mb-align-left">
                  <?php if( $c['level'] == 1 ) { ?>
                    <strong title="<?php _e('Main category', 'all_in_one');?>"><?php echo $c['s_name']; ?></strong>
                  <?php } else { ?>
                    <?php echo ais_category_tabs($c['level']); ?><?php echo $c['s_name']; ?>
                  <?php } ?>

                  <a href="#" class="mb-lock" title="<?php _e('Unlock title and description', 'all_in_one'); ?>"><i class="fa fa-lock"></i></a>
                </div>
                <div class="mb-col-6"><input disabled="disabled" type="text" id="category_title" name="category_title_<?php echo $c['pk_i_id']; ?>" value="<?php echo $detail['s_title']; ?>" /></div>
                <div class="mb-col-9"><input disabled="disabled" type="text" id="category_description" name="category_description_<?php echo $c['pk_i_id']; ?>" value="<?php echo $detail['s_description']; ?>" /></div>
              </div>
            <?php } ?>
          <?php } ?>
        </div>
      </div>

      <div class="mb-foot">
        <button type="submit" class="mb-button"><?php _e('Update', 'all_in_one'); ?></button>
      </div>
    </div>
  </form>




  <!-- HELP TOPICS -->
  <div class="mb-box" id="mb-help">
    <div class="mb-head"><i class="fa fa-question-circle"></i> <?php _e('Help', 'all_in_one'); ?></div>

    <div class="mb-inside">
      <div class="mb-row mb-help"><div><?php _e('Meta title should have 50-60 characters and Meta description 150-160 characters.', 'all_in_one'); ?></div></div>
      <div class="mb-row mb-help"><div><?php _e('If you want to modify title or description, you need to unlock these fields for each category. Reason for this is HTML limitation when using too many inputs at once and this would cause troubles if you would have too many categories.', 'all_in_one'); ?></div></div>
    </div>
  </div>
</div>

<?php echo ais_footer(); ?>
