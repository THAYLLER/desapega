<?php
  // Create menu
  $title = __('Locations', 'all_in_one');
  ais_menu($title);



  // UPDATE COUNTRIES META TAGS
  if(Params::getParam('plugin_action') == 'country') {
    $countries = ModelAisLocation::newInstance()->getCountryList();

    foreach( $countries as $c ) {
      $detail = ModelAisLocation::newInstance()->findByCountryCode( $c['pk_c_code'] );

      if(isset($detail['fk_c_country_code']) && $detail['fk_c_country_code'] <> '') {
        ModelAisLocation::newInstance()->updateCountryMeta( $c['pk_c_code'], Params::getParam('country_title_' . $c['pk_c_code']), Params::getParam('country_description_' . $c['pk_c_code']) );
      } else {
        ModelAisLocation::newInstance()->insertCountryMeta( $c['pk_c_code'], Params::getParam('country_title_' . $c['pk_c_code']), Params::getParam('country_description_' . $c['pk_c_code']) );
      } 
    }

    message_ok(__('Countries meta settings saved', 'all_in_one') . ' (' . ais_get_locale() . ')');
  }


  // UPDATE REGIONS META TAGS
  if(Params::getParam('plugin_action') == 'region') {
    $countries = ModelAisLocation::newInstance()->getCountryList();

    foreach( $countries as $c ) {

      $regions = ModelAisLocation::newInstance()->getRegionList( $c['pk_c_code'] );

      foreach( $regions as $r ) {
        $detail = ModelAisLocation::newInstance()->findByRegionId( $r['pk_i_id'] );

        if(isset($detail['fk_i_region_id']) && $detail['fk_i_region_id'] > 0) {
          ModelAisLocation::newInstance()->updateRegionMeta( $r['pk_i_id'], Params::getParam('region_title_' . $r['pk_i_id']), Params::getParam('region_description_' . $r['pk_i_id']) );
        } else {
          ModelAisLocation::newInstance()->insertRegionMeta( $r['pk_i_id'], Params::getParam('region_title_' . $r['pk_i_id']), Params::getParam('region_description_' . $r['pk_i_id']) );
        } 
      }
    }

    message_ok(__('Regions meta settings saved', 'all_in_one') . ' (' . ais_get_locale() . ')');
  }



  // GET & UPDATE PARAMETERS
  // $variable = ais_param_update( 'param_name', 'form_name', 'input_type', 'plugin_var_name' );
  // input_type: check, code or value


?>


<div class="mb-body">
  <div class="mb-info-box" style="margin:10px 0 35px 0;">
    <div class="mb-line"><?php _e('Configuration for meta tags is set on <strong>Search</strong> settings of plugin, as location links are specific search links (search with country/region/city selected).', 'all_in_one'); ?></div>
  </div>


  <!-- CUSTOM META TAGS FOR COUNTRIES -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>locations.php" />
    <input type="hidden" name="plugin_action" value="country" />
    
    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-map-o"></i> <?php _e('Manage custom meta tags for countries', 'all_in_one'); ?> <?php echo ais_locale_box( 'locations.php' ); ?></div>

      <div class="mb-inside">
        <?php $countries = ModelAisLocation::newInstance()->getCountryList(); ?>

        <div class="mb-table">
          <div class="mb-table-head">
            <div class="mb-col-2"><?php _e('ID', 'all_in_one'); ?></div>
            <div class="mb-col-7 mb-align-left"><?php _e('Country', 'all_in_one'); ?></div>
            <div class="mb-col-6 mb-align-left"><?php _e('Meta Title', 'all_in_one'); ?></div>
            <div class="mb-col-9 mb-align-left"><?php _e('Meta Description', 'all_in_one'); ?></div>
          </div>

          <?php if(count($countries) <= 0) { ?>
            <div class="mb-table-row mb-row-empty">
              <i class="fa fa-warning"></i><span><?php _e('No countries has been added yet', 'all_in_one'); ?></span>
            </div>
          <?php } else { ?>
            <?php foreach($countries as $c) { ?>
              <?php $detail = ModelAisLocation::newInstance()->findByCountryCode( $c['pk_c_code'] ); ?>

              <div class="mb-table-row ais-link-list">
                <div class="mb-col-2"><?php echo $c['pk_c_code']; ?></div>
                <div class="mb-col-7 mb-align-left"><?php echo $c['s_name']; ?></div>
                <div class="mb-col-6"><input type="text" id="country_title" name="country_title_<?php echo $c['pk_c_code']; ?>" value="<?php echo $detail['s_title']; ?>" /></div>
                <div class="mb-col-9"><input type="text" id="country_description" name="country_description_<?php echo $c['pk_c_code']; ?>" value="<?php echo $detail['s_description']; ?>" /></div>
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



  <!-- CUSTOM META TAGS FOR REGIONS -->
  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>locations.php" />
    <input type="hidden" name="plugin_action" value="region" />
    
    <div class="mb-box">
      <div class="mb-head"><i class="fa fa-map-signs"></i> <?php _e('Manage custom meta tags for regions', 'all_in_one'); ?> <?php echo ais_locale_box( 'locations.php' ); ?></div>

      <div class="mb-inside">
        <?php $countries = ModelAisLocation::newInstance()->getCountryList(); ?>

        <?php foreach($countries as $c) { ?>
          <?php $regions = ModelAisLocation::newInstance()->getRegionList( $c['pk_c_code'] ); ?>

          <div class="mb-table">
            <div class="mb-table-head">
              <div class="mb-col-2"><?php _e('ID', 'all_in_one'); ?></div>
              <div class="mb-col-3 mb-align-left"><?php _e('Country', 'all_in_one'); ?></div>
              <div class="mb-col-4 mb-align-left"><?php _e('Region', 'all_in_one'); ?></div>
              <div class="mb-col-6 mb-align-left"><?php _e('Meta Title', 'all_in_one'); ?></div>
              <div class="mb-col-9 mb-align-left"><?php _e('Meta Description', 'all_in_one'); ?></div>
            </div>

            <?php if(count($regions) <= 0) { ?>
              <div class="mb-table-row mb-row-empty">
                <i class="fa fa-warning"></i><span><?php _e('No regions has been added yet', 'all_in_one'); ?></span>
              </div>
            <?php } else { ?>
              <?php foreach($regions as $r) { ?>
                <?php $detail = ModelAisLocation::newInstance()->findByRegionId( $r['pk_i_id'] ); ?>

                <div class="mb-table-row ais-link-list">
                  <div class="mb-col-2"><?php echo $r['pk_i_id']; ?></div>
                  <div class="mb-col-3 mb-align-left"><?php echo $c['s_name']; ?></div>
                  <div class="mb-col-4 mb-align-left"><?php echo $r['s_name']; ?></div>
                  <div class="mb-col-6"><input type="text" id="region_title" name="region_title_<?php echo $r['pk_i_id']; ?>" value="<?php echo $detail['s_title']; ?>" /></div>
                  <div class="mb-col-9"><input type="text" id="region_description" name="region_description_<?php echo $r['pk_i_id']; ?>" value="<?php echo $detail['s_description']; ?>" /></div>
                </div>
              <?php } ?>
            <?php } ?>
          </div>

        <?php } ?>
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
      <div class="mb-row mb-help"><div><?php _e('Meta title should have 50-60 characters and Meta description 150-160 characters.', 'all_in_one'); ?></div></div>
    </div>
  </div>
</div>

<?php echo ais_footer(); ?>
