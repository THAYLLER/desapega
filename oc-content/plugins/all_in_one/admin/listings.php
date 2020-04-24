<?php

$dao_preference = new Preference();
$pluginInfo = osc_plugin_get_info('all_in_one/index.php');

$keywords = '';
if(Params::getParam('keywords') != '') {
  $keywords = Params::getParam('keywords');
} else {
  $keywords = (osc_get_preference('allSeo_keywords', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_keywords', 'plugin-all_in_one') : '' ;
}

$allow_custom_meta = '';
if(Params::getParam('allow_custom_meta') != '') {
  $allow_custom_meta = Params::getParam('allow_custom_meta');
} else {
  $allow_custom_meta = (osc_get_preference('allSeo_allow_custom_meta', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_allow_custom_meta', 'plugin-all_in_one') : '' ;
}

$delimiter = '';
if(Params::getParam('delimiter') != '') {
  $delimiter = trim(Params::getParam('delimiter'));
} else {
  $delimiter = (osc_get_preference('allSeo_delimiter', 'plugin-all_in_one') != '') ? trim(osc_get_preference('allSeo_delimiter', 'plugin-all_in_one')) : '' ;
} 


// LISTINGS PAGE PARAMETERS
$showCity = '';
if(Params::getParam('showCity')=='on') {
  $showCity = 1;
} else {
  if(Params::getParam('plugin_action')=='done') {
    $showCity = 0;
  } else {
    $showCity = (osc_get_preference('allSeo_city_show', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_city_show', 'plugin-all_in_one') : '' ;
  }
}

$showRegion = '';
if(Params::getParam('showRegion')=='on') {
  $showRegion = 1;
} else {
  if(Params::getParam('plugin_action')=='done') {
    $showRegion = 0;
  } else {
    $showRegion = (osc_get_preference('allSeo_region_show', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_region_show', 'plugin-all_in_one') : '' ;
  }
}

$showCountry = '';
if(Params::getParam('showCountry')=='on') {
  $showCountry = 1;
} else {
  if(Params::getParam('plugin_action')=='done') {
    $showCountry = 0;
  } else {
    $showCountry = (osc_get_preference('allSeo_country_show', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_country_show', 'plugin-all_in_one') : '' ;
  }
}

$showCategory = '';
if(Params::getParam('showCategory')=='on') {
  $showCategory = 1;
} else {
  if(Params::getParam('plugin_action')=='done') {
    $showCategory = 0;
  } else {
    $showCategory = (osc_get_preference('allSeo_category_show', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_category_show', 'plugin-all_in_one') : '' ;
  }
}

$showTitle = '';
if(Params::getParam('showTitle')=='on') {
  $showTitle = 1;
} else {
  if(Params::getParam('plugin_action')=='done') {
    $showTitle = 0;
  } else {
    $showTitle = (osc_get_preference('allSeo_title_show', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_title_show', 'plugin-all_in_one') : '' ;
  }
}

$orderCity = '';
if(Params::getParam('orderCity') != '') {
  $orderCity = Params::getParam('orderCity');
} else {
  $orderCity = (osc_get_preference('allSeo_city_order', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_city_order', 'plugin-all_in_one') : '' ;
}

$orderRegion = '';
if(Params::getParam('orderRegion') != '') {
  $orderRegion = Params::getParam('orderRegion');
} else {
  $orderRegion = (osc_get_preference('allSeo_region_order', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_region_order', 'plugin-all_in_one') : '' ;
}

$orderCountry = '';
if(Params::getParam('orderCountry') != '') {
  $orderCountry = Params::getParam('orderCountry');
} else {
  $orderCountry = (osc_get_preference('allSeo_country_order', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_country_order', 'plugin-all_in_one') : '' ;
}

$orderCategory = '';
if(Params::getParam('orderCategory') != '') {
  $orderCategory = Params::getParam('orderCategory');
} else {
  $orderCategory = (osc_get_preference('allSeo_category_order', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_category_order', 'plugin-all_in_one') : '' ;
}

$orderTitle = '';
if(Params::getParam('orderTitle') != '') {
  $orderTitle = Params::getParam('orderTitle');
} else {
  $orderTitle = (osc_get_preference('allSeo_title_order', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_title_order', 'plugin-all_in_one') : '' ;
}

$orderBody = '';
if(Params::getParam('orderBody') != '') {
  $orderBody = Params::getParam('orderBody');
} else {
  $orderBody = (osc_get_preference('allSeo_body_order', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_body_order', 'plugin-all_in_one') : '' ;
}

$pageTitle = '';
if(Params::getParam('pageTitle') != '') {
  $pageTitle = Params::getParam('pageTitle');
} else {
  $pageTitle = (osc_get_preference('allSeo_page_title', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_page_title', 'plugin-all_in_one') : '' ;
}


// CATEGORY & SEARCH PAGE PARAMETERS
$improveDesc = '';
if(Params::getParam('improveDesc')=='on') {
  $improveDesc = 1;
} else {
  if(Params::getParam('plugin_action')=='done') {
    $improveDesc = 0;
  } else {
    $improveDesc = (osc_get_preference('allSeo_search_improve_desc', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_search_improve_desc', 'plugin-all_in_one') : '' ;
  }
}

$showSearchCity = '';
if(Params::getParam('showSearchCity')=='on') {
  $showSearchCity = 1;
} else {
  if(Params::getParam('plugin_action')=='done') {
    $showSearchCity = 0;
  } else {
    $showSearchCity = (osc_get_preference('allSeo_search_city_show', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_search_city_show', 'plugin-all_in_one') : '' ;
  }
}

$showSearchRegion = '';
if(Params::getParam('showSearchRegion')=='on') {
  $showSearchRegion = 1;
} else {
  if(Params::getParam('plugin_action')=='done') {
    $showSearchRegion = 0;
  } else {
    $showSearchRegion = (osc_get_preference('allSeo_search_region_show', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_search_region_show', 'plugin-all_in_one') : '' ;
  }
}

$showSearchCountry = '';
if(Params::getParam('showSearchCountry')=='on') {
  $showSearchCountry = 1;
} else {
  if(Params::getParam('plugin_action')=='done') {
    $showSearchCountry = 0;
  } else {
    $showSearchCountry = (osc_get_preference('allSeo_search_country_show', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_search_country_show', 'plugin-all_in_one') : '' ;
  }
}

$showSearchTitle = '';
if(Params::getParam('showSearchTitle')=='on') {
  $showSearchTitle = 1;
} else {
  if(Params::getParam('plugin_action')=='done') {
    $showSearchTitle = 0;
  } else {
    $showSearchTitle = (osc_get_preference('allSeo_search_title_show', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_search_title_show', 'plugin-all_in_one') : '' ;
  }
}

$orderSearchCity = '';
if(Params::getParam('orderSearchCity') != '') {
  $orderSearchCity = Params::getParam('orderSearchCity');
} else {
  $orderSearchCity = (osc_get_preference('allSeo_search_city_order', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_search_city_order', 'plugin-all_in_one') : '' ;
}

$orderSearchRegion = '';
if(Params::getParam('orderSearchRegion') != '') {
  $orderSearchRegion = Params::getParam('orderSearchRegion');
} else {
  $orderSearchRegion = (osc_get_preference('allSeo_search_region_order', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_search_region_order', 'plugin-all_in_one') : '' ;
}

$orderSearchCountry = '';
if(Params::getParam('orderSearchCountry') != '') {
  $orderSearchCountry = Params::getParam('orderSearchCountry');
} else {
  $orderSearchCountry = (osc_get_preference('allSeo_search_country_order', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_search_country_order', 'plugin-all_in_one') : '' ;
}

$orderSearchCategory = '';
if(Params::getParam('orderSearchCategory') != '') {
  $orderSearchCategory = Params::getParam('orderSearchCategory');
} else {
  $orderSearchCategory = (osc_get_preference('allSeo_search_category_order', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_search_category_order', 'plugin-all_in_one') : '' ;
}

$orderSearchPattern = '';
if(Params::getParam('orderSearchPattern') != '') {
  $orderSearchPattern = Params::getParam('orderSearchPattern');
} else {
  $orderSearchPattern = (osc_get_preference('allSeo_search_pattern_order', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_pattern_category_order', 'plugin-all_in_one') : '' ;
}

$orderSearchTitle = '';
if(Params::getParam('plugin_action')=='done') {
  $orderSearchTitle = Params::getParam('orderSearchTitle');
} else {
  $orderSearchTitle = (osc_get_preference('allSeo_search_title_order', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_search_title_order', 'plugin-all_in_one') : '' ;
}

$pageSearchTitle = '';
if(Params::getParam('plugin_action')=='done') {
  $pageSearchTitle = Params::getParam('pageSearchTitle');
} else {
  $pageSearchTitle = (osc_get_preference('allSeo_search_page_title', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_search_page_title', 'plugin-all_in_one') : '' ;
}


// HOME & OTHER PAGES PARAMETERS
$pageHomeTitle = '';
if(Params::getParam('plugin_action')=='done') {
  $pageHomeTitle = Params::getParam('pageHomeTitle');
} else {
  $pageHomeTitle = (osc_get_preference('pageTitle', 'osclass') != '') ? osc_get_preference('pageTitle', 'osclass') : '' ;
}

$pageHomeDesc = '';
if(Params::getParam('plugin_action')=='done') {
  $pageHomeDesc = Params::getParam('pageHomeDesc');
} else {
  $pageHomeDesc = (osc_get_preference('pageDesc', 'osclass') != '') ? osc_get_preference('pageDesc', 'osclass') : '' ;
}

$pageOtherTitle = '';
if(Params::getParam('plugin_action')=='done') {
  $pageOtherTitle = Params::getParam('pageOtherTitle');
} else {
  $pageOtherTitle = (osc_get_preference('allSeo_other_page_title', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_other_page_title', 'plugin-all_in_one') : '' ;
}

$showTitleFirst = '';
if(Params::getParam('plugin_action')=='done') {
  $showTitleFirst = Params::getParam('showTitleFirst');
} else {
  $showTitleFirst = (osc_get_preference('allSeo_title_first', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_title_first', 'plugin-all_in_one') : '' ;
}


// UPDATE PROCESS OF PARAMETERS	
if(Params::getParam('plugin_action')=='done') {
  $dao_preference->update(array("s_value" => $keywords), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_keywords"));         
  $dao_preference->update(array("s_value" => $delimiter), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_delimiter"));
         
  $dao_preference->update(array("s_value" => $showCity), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_city_show"));         
  $dao_preference->update(array("s_value" => $showRegion), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_region_show"));         
  $dao_preference->update(array("s_value" => $showCountry), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_country_show"));  
  $dao_preference->update(array("s_value" => $showCategory), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_category_show"));  
  $dao_preference->update(array("s_value" => $showTitle), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_title_show"));  
  $dao_preference->update(array("s_value" => $orderCity), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_city_order"));         
  $dao_preference->update(array("s_value" => $orderRegion), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_region_order"));         
  $dao_preference->update(array("s_value" => $orderCountry), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_country_order"));  		
  $dao_preference->update(array("s_value" => $orderCategory), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_category_order"));  		
  $dao_preference->update(array("s_value" => $orderTitle), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_title_order"));  		
  $dao_preference->update(array("s_value" => $orderBody), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_body_order"));
  $dao_preference->update(array("s_value" => $pageTitle), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_page_title"));

  $dao_preference->update(array("s_value" => $showSearchCity), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_search_city_show"));         
  $dao_preference->update(array("s_value" => $showSearchRegion), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_search_region_show"));         
  $dao_preference->update(array("s_value" => $showSearchCountry), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_search_country_show"));  
  $dao_preference->update(array("s_value" => $showSearchTitle), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_search_title_show"));  
  $dao_preference->update(array("s_value" => $orderSearchCity), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_search_city_order"));         
  $dao_preference->update(array("s_value" => $orderSearchRegion), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_search_region_order"));         
  $dao_preference->update(array("s_value" => $orderSearchCountry), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_search_country_order"));  		
  $dao_preference->update(array("s_value" => $orderSearchCategory), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_search_category_order"));  		
  $dao_preference->update(array("s_value" => $orderSearchPattern), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_search_pattern_order"));  		
  $dao_preference->update(array("s_value" => $orderSearchTitle), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_search_title_order"));  		
  $dao_preference->update(array("s_value" => $pageSearchTitle), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_search_page_title"));
  $dao_preference->update(array("s_value" => $improveDesc), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_search_improve_desc"));

  $dao_preference->update(array("s_value" => $pageHomeTitle), array("s_section" => "osclass", "s_name" => "pageTitle"));
  $dao_preference->update(array("s_value" => $pageHomeDesc), array("s_section" => "osclass", "s_name" => "pageDesc"));
  $dao_preference->update(array("s_value" => $pageOtherTitle), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_other_page_title"));

  $dao_preference->update(array("s_value" => $showTitleFirst), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_title_first"));         
  $dao_preference->update(array("s_value" => $allow_custom_meta), array("s_section" => "plugin-all_in_one", "s_name" => "allSeo_allow_custom_meta"));         
  osc_reset_preferences();    
  message_ok(__('Meta Settings Saved','all_in_one'));
}

unset($dao_preference) ;
?>



<div id="settings_form">
  <?php echo config_menu(); ?>

  <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>listings.php" />
    <input type="hidden" name="plugin_action" value="done" />
    <br />

    <fieldset class="round3 global-set">
      <legend class="blue round2"><?php _e('Meta Global Settings','all_in_one'); ?></legend>
      <label for="allow_custom_meta" class="text-label"><?php _e('Meta Tags on item post/edit', 'all_in_one'); ?> <sup class="sup-go go1">(1)</sup></label>
      <select name="allow_custom_meta" id="allow_custom_meta"> 
        <option <?php if($allow_custom_meta == 1){echo 'selected="selected"';}?>value='1'><?php _e('Allow to all users','all_in_one'); ?></option>
        <option <?php if($allow_custom_meta == 2){echo 'selected="selected"';}?>value='2'><?php _e('Allow to registered users only','all_in_one'); ?></option>
        <option <?php if($allow_custom_meta == 0){echo 'selected="selected"';}?>value='0'><?php _e('Allow only to admin','all_in_one'); ?></option>
      </select>
      <?php if ($allow_custom_meta == 0) { ?><div style="padding: 5px 10px;float:left;clear:both;" class="flashmessage flashmessage-warning flashmessage-inline"><?php _e('If you are logged in as admin (in oc-admin), you will still be able to see custom meta option even if it is disabled. If you loggout from oc-admin, you will not see it.', 'all_in_one'); ?></div><div class="clear"></div><?php } ?>

      <div class="clear" style="margin:6px 0;"></div>

      <label for="keywords" class="text-label"><?php _e('Keywords', 'all_in_one'); ?> <sup class="sup-go go2">(2)</sup></label>
      <textarea type="text" id="keywords" name="keywords"><?php echo $keywords; ?></textarea>
      <div class="clear" style="margin:1px 0;"></div>
      <div class="keywords-note"><?php echo '<strong>' . __('Note', 'all_in_one') . '</strong>: ' . __('Separate keywords with comma, i.e.: key1, key2, key3', 'all_in_one'); ?></div>

      <div class="clear" style="margin:6px 0;"></div>

      <label for="delimiter"  class="text-label"><?php _e('Delimiter (used in title) ', 'all_in_one'); ?> <sup class="sup-go go3">(3)</sup></label>
      <input type="text" id="delimiter" name="delimiter" value="<?php echo $delimiter; ?>" />
    </fieldset>
             
    <br /><br /> 

    <fieldset class="round3">
      <legend class="blue round2"><?php _e('Meta Settings','all_in_one'); ?></legend>

      <!-- --------------------------------------- Listing page meta settings ------------------------------------------------- -->
      <div class="listing-left listing">
        <div class="title"><i class="fa fa-list"></i>&nbsp;<?php _e("Listing page - this settings will be reflected just on this pages", 'all_in_one'); ?></div>
        <div class="del"></div>

        <div class="wrap"><?php echo CurrentMetaOrderListing(); ?></div>
        <div class="clear"></div>
        <br /><br />

        <label for="pageTitle" class="text-label"><?php _e('Page title on listing page', 'all_in_one'); ?></label>
        <input type="text" id="pageTitle" name="pageTitle" value="<?php echo $pageTitle; ?>" />

        <div class="clear"></div>
        <br />

        <div class="elem-row first round3">
          <div class="left"><?php _e('Name of field', 'all_in_one'); ?></div>
          <div class="middle"><?php _e('Show in meta title', 'all_in_one'); ?></div>
          <div class="right"><?php _e('Order', 'all_in_one'); ?></div>
        </div>

        <div class="elem-row">
          <div class="left"><?php _e('City', 'all_in_one'); ?></div>
          <div class="middle">
            <input type="checkbox" name="showCity" id="showCity" <?php echo ($showCity == 1 ? 'checked' : ''); ?> />
            <label for="showCity" style="font-weight: bold;"><?php _e('Show', 'all_in_one'); ?></label>
          </div>
          <div class="right">
            <select name="orderCity" id="orderCity"> 
              <option <?php if($orderCity == 1){echo 'selected="selected"';}?>value='1'><?php _e('1. First', 'all_in_one'); ?></option>
              <option <?php if($orderCity == 2){echo 'selected="selected"';}?>value='2'><?php _e('2. Second', 'all_in_one'); ?></option>
              <option <?php if($orderCity == 3){echo 'selected="selected"';}?>value='3'><?php _e('3. Third', 'all_in_one'); ?></option>
              <option <?php if($orderCity == 4){echo 'selected="selected"';}?>value='4'><?php _e('4. Fourth', 'all_in_one'); ?></option>
              <option <?php if($orderCity == 5){echo 'selected="selected"';}?>value='5'><?php _e('5. Fifth', 'all_in_one'); ?></option>
              <option <?php if($orderCity == 6){echo 'selected="selected"';}?>value='6'><?php _e('6. Sixth', 'all_in_one'); ?></option>
            </select>	
          </div>
        </div>

        <div class="elem-row">
          <div class="left"><?php _e('Region', 'all_in_one'); ?></div>
          <div class="middle">
            <input type="checkbox" name="showRegion" id="showRegion" <?php echo ($showRegion == 1 ? 'checked' : ''); ?> />
            <label for="showRegion" style="font-weight: bold;"><?php _e('Show', 'all_in_one'); ?></label>
          </div>
          <div class="right">
            <select name="orderRegion" id="orderRegion"> 
              <option <?php if($orderRegion == 1){echo 'selected="selected"';}?>value='1'><?php _e('1. First', 'all_in_one'); ?></option>
              <option <?php if($orderRegion == 2){echo 'selected="selected"';}?>value='2'><?php _e('2. Second', 'all_in_one'); ?></option>
              <option <?php if($orderRegion == 3){echo 'selected="selected"';}?>value='3'><?php _e('3. Third', 'all_in_one'); ?></option>
              <option <?php if($orderRegion == 4){echo 'selected="selected"';}?>value='4'><?php _e('4. Fourth', 'all_in_one'); ?></option>
              <option <?php if($orderRegion == 5){echo 'selected="selected"';}?>value='5'><?php _e('5. Fifth', 'all_in_one'); ?></option>
              <option <?php if($orderRegion == 6){echo 'selected="selected"';}?>value='6'><?php _e('6. Sixth', 'all_in_one'); ?></option>
            </select>	
          </div>
        </div>

        <div class="elem-row">
          <div class="left"><?php _e('Country', 'all_in_one'); ?></div>
          <div class="middle">
            <input type="checkbox" name="showCountry" id="showCountry" <?php echo ($showCountry == 1 ? 'checked' : ''); ?> />
            <label for="showCountry" style="font-weight: bold;"><?php _e('Show', 'all_in_one'); ?></label>
          </div>
          <div class="right">
            <select name="orderCountry" id="orderCountry"> 
              <option <?php if($orderCountry == 1){echo 'selected="selected"';}?>value='1'><?php _e('1. First', 'all_in_one'); ?></option>
              <option <?php if($orderCountry == 2){echo 'selected="selected"';}?>value='2'><?php _e('2. Second', 'all_in_one'); ?></option>
              <option <?php if($orderCountry == 3){echo 'selected="selected"';}?>value='3'><?php _e('3. Third', 'all_in_one'); ?></option>
              <option <?php if($orderCountry == 4){echo 'selected="selected"';}?>value='4'><?php _e('4. Fourth', 'all_in_one'); ?></option>
              <option <?php if($orderCountry == 5){echo 'selected="selected"';}?>value='5'><?php _e('5. Fifth', 'all_in_one'); ?></option>
              <option <?php if($orderCountry == 6){echo 'selected="selected"';}?>value='6'><?php _e('6. Sixth', 'all_in_one'); ?></option>
            </select>	
          </div>
        </div>

        <div class="elem-row">
          <div class="left"><?php _e('Category', 'all_in_one'); ?></div>
          <div class="middle">
            <input type="checkbox" name="showCategory" id="showCategory" <?php echo ($showCategory == 1 ? 'checked' : ''); ?> />
            <label for="showCategory" style="font-weight: bold;"><?php _e('Show', 'all_in_one'); ?></label>
          </div>
          <div class="right">
            <select name="orderCategory" id="orderCategory"> 
              <option <?php if($orderCategory == 1){echo 'selected="selected"';}?>value='1'><?php _e('1. First', 'all_in_one'); ?></option>
              <option <?php if($orderCategory == 2){echo 'selected="selected"';}?>value='2'><?php _e('2. Second', 'all_in_one'); ?></option>
              <option <?php if($orderCategory == 3){echo 'selected="selected"';}?>value='3'><?php _e('3. Third', 'all_in_one'); ?></option>
              <option <?php if($orderCategory == 4){echo 'selected="selected"';}?>value='4'><?php _e('4. Fourth', 'all_in_one'); ?></option>
              <option <?php if($orderCategory == 5){echo 'selected="selected"';}?>value='5'><?php _e('5. Fifth', 'all_in_one'); ?></option>
              <option <?php if($orderCategory == 6){echo 'selected="selected"';}?>value='6'><?php _e('6. Sixth', 'all_in_one'); ?></option>
            </select>	
          </div>
        </div>

        <div class="elem-row">
          <div class="left"><?php _e('Page Title', 'all_in_one'); ?> <sup class="sup-go go4">(4)</sup></div>
          <div class="middle">
            <input type="checkbox" name="showTitle" id="showTitle" <?php echo ($showTitle == 1 ? 'checked' : ''); ?> />
            <label for="showTitle" style="font-weight: bold;"><?php _e('Show', 'all_in_one'); ?></label>
          </div>
          <div class="right">
            <select name="orderTitle" id="orderTitle"> 
              <option <?php if($orderTitle == 1){echo 'selected="selected"';}?>value='1'><?php _e('1. First', 'all_in_one'); ?></option>
              <option <?php if($orderTitle == 2){echo 'selected="selected"';}?>value='2'><?php _e('2. Second', 'all_in_one'); ?></option>
              <option <?php if($orderTitle == 3){echo 'selected="selected"';}?>value='3'><?php _e('3. Third', 'all_in_one'); ?></option>
              <option <?php if($orderTitle == 4){echo 'selected="selected"';}?>value='4'><?php _e('4. Fourth', 'all_in_one'); ?></option>
              <option <?php if($orderTitle == 5){echo 'selected="selected"';}?>value='5'><?php _e('5. Fifth', 'all_in_one'); ?></option>
              <option <?php if($orderTitle == 6){echo 'selected="selected"';}?>value='6'><?php _e('6. Sixth', 'all_in_one'); ?></option>
            </select>	
          </div>
        </div>

        <div class="elem-row">
          <div class="left"><?php _e('Item Title', 'all_in_one'); ?> <sup class="sup-go go5">(5)</sup></div>
          <div class="middle"></div>
          <div class="right">
            <select name="orderBody" id="orderBody"> 
              <option <?php if($orderBody == 1){echo 'selected="selected"';}?>value='1'><?php _e('1. First', 'all_in_one'); ?></option>
              <option <?php if($orderBody == 2){echo 'selected="selected"';}?>value='2'><?php _e('2. Second', 'all_in_one'); ?></option>
              <option <?php if($orderBody == 3){echo 'selected="selected"';}?>value='3'><?php _e('3. Third', 'all_in_one'); ?></option>
              <option <?php if($orderBody == 4){echo 'selected="selected"';}?>value='4'><?php _e('4. Fourth', 'all_in_one'); ?></option>
              <option <?php if($orderBody == 5){echo 'selected="selected"';}?>value='5'><?php _e('5. Fifth', 'all_in_one'); ?></option>
              <option <?php if($orderBody == 6){echo 'selected="selected"';}?>value='6'><?php _e('6. Sixth', 'all_in_one'); ?></option>
            </select>	
          </div>
        </div>
      </div>

      <!-- --------------------------------------- Category / Search page meta settings --------------------------------------- -->

      <div class="listing-right listing">
        <div class="title"><i class="fa fa-folder-open"></i>&nbsp;<?php _e("Category / Search page - this settings will be reflected just on this pages", 'all_in_one'); ?></div>
        <div class="del"></div>

        <div class="wrap"><?php echo CurrentMetaOrderCategory(); ?></div>
        <div class="clear"></div>
        <br /><br />

        <label for="pageSearchTitle" class="text-label"><?php _e('Page title on category page', 'all_in_one'); ?></label>
        <input type="text" id="pageSearchTitle" name="pageSearchTitle" value="<?php echo $pageSearchTitle; ?>" />

        <div class="clear"></div>
        <br />

        <div class="elem-row first round3">
          <div class="left"><?php _e('Name of field', 'all_in_one'); ?></div>
          <div class="middle"><?php _e('Show in meta title', 'all_in_one'); ?></div>
          <div class="right"><?php _e('Order', 'all_in_one'); ?></div>
        </div>

        <div class="elem-row">
          <div class="left"><?php _e('City', 'all_in_one'); ?></div>
          <div class="middle">
            <input type="checkbox" name="showSearchCity" id="showSearchCity" <?php echo ($showSearchCity == 1 ? 'checked' : ''); ?> />
            <label for="showSearchCity" style="font-weight: bold;"><?php _e('Show', 'all_in_one'); ?></label>
          </div>
          <div class="right">
            <select name="orderSearchCity" id="orderSearchCity"> 
              <option <?php if($orderSearchCity == 1){echo 'selected="selected"';}?>value='1'><?php _e('1. First', 'all_in_one'); ?></option>
              <option <?php if($orderSearchCity == 2){echo 'selected="selected"';}?>value='2'><?php _e('2. Second', 'all_in_one'); ?></option>
              <option <?php if($orderSearchCity == 3){echo 'selected="selected"';}?>value='3'><?php _e('3. Third', 'all_in_one'); ?></option>
              <option <?php if($orderSearchCity == 4){echo 'selected="selected"';}?>value='4'><?php _e('4. Fourth', 'all_in_one'); ?></option>
              <option <?php if($orderSearchCity == 5){echo 'selected="selected"';}?>value='5'><?php _e('5. Fifth', 'all_in_one'); ?></option>
              <option <?php if($orderSearchCity == 6){echo 'selected="selected"';}?>value='6'><?php _e('6. Sixth', 'all_in_one'); ?></option>
            </select>	
          </div>
        </div>

        <div class="elem-row">
          <div class="left"><?php _e('Region', 'all_in_one'); ?></div>
          <div class="middle">
            <input type="checkbox" name="showSearchRegion" id="showSearchRegion" <?php echo ($showSearchRegion == 1 ? 'checked' : ''); ?> />
            <label for="showSearchRegion" style="font-weight: bold;"><?php _e('Show', 'all_in_one'); ?></label>
          </div>
          <div class="right">
            <select name="orderSearchRegion" id="orderSearchRegion"> 
              <option <?php if($orderSearchRegion == 1){echo 'selected="selected"';}?>value='1'><?php _e('1. First', 'all_in_one'); ?></option>
              <option <?php if($orderSearchRegion == 2){echo 'selected="selected"';}?>value='2'><?php _e('2. Second', 'all_in_one'); ?></option>
              <option <?php if($orderSearchRegion == 3){echo 'selected="selected"';}?>value='3'><?php _e('3. Third', 'all_in_one'); ?></option>
              <option <?php if($orderSearchRegion == 4){echo 'selected="selected"';}?>value='4'><?php _e('4. Fourth', 'all_in_one'); ?></option>
              <option <?php if($orderSearchRegion == 5){echo 'selected="selected"';}?>value='5'><?php _e('5. Fifth', 'all_in_one'); ?></option>
              <option <?php if($orderSearchRegion == 6){echo 'selected="selected"';}?>value='6'><?php _e('6. Sixth', 'all_in_one'); ?></option>
            </select>	
          </div>
        </div>

        <div class="elem-row">
          <div class="left"><?php _e('Country', 'all_in_one'); ?></div>
          <div class="middle">
            <input type="checkbox" name="showSearchCountry" id="showSearchCountry" <?php echo ($showSearchCountry == 1 ? 'checked' : ''); ?> />
            <label for="showSearchCountry" style="font-weight: bold;"><?php _e('Show', 'all_in_one'); ?></label>
          </div>
          <div class="right">
            <select name="orderSearchCountry" id="orderSearchCountry"> 
              <option <?php if($orderSearchCountry == 1){echo 'selected="selected"';}?>value='1'><?php _e('1. First', 'all_in_one'); ?></option>
              <option <?php if($orderSearchCountry == 2){echo 'selected="selected"';}?>value='2'><?php _e('2. Second', 'all_in_one'); ?></option>
              <option <?php if($orderSearchCountry == 3){echo 'selected="selected"';}?>value='3'><?php _e('3. Third', 'all_in_one'); ?></option>
              <option <?php if($orderSearchCountry == 4){echo 'selected="selected"';}?>value='4'><?php _e('4. Fourth', 'all_in_one'); ?></option>
              <option <?php if($orderSearchCountry == 5){echo 'selected="selected"';}?>value='5'><?php _e('5. Fifth', 'all_in_one'); ?></option>
              <option <?php if($orderSearchCountry == 6){echo 'selected="selected"';}?>value='6'><?php _e('6. Sixth', 'all_in_one'); ?></option>
            </select>	
          </div>
        </div>

        <div class="elem-row">
          <div class="left"><?php _e('Page Title', 'all_in_one'); ?> <sup class="sup-go go6">(6)</sup></div>
          <div class="middle">
            <input type="checkbox" name="showSearchTitle" id="showSearchTitle" <?php echo ($showSearchTitle == 1 ? 'checked' : ''); ?> />
            <label for="showSearchTitle" style="font-weight: bold;"><?php _e('Show', 'all_in_one'); ?></label>
          </div>
          <div class="right">
            <select name="orderSearchTitle" id="orderSearchTitle"> 
              <option <?php if($orderSearchTitle == 1){echo 'selected="selected"';}?>value='1'><?php _e('1. First', 'all_in_one'); ?></option>
              <option <?php if($orderSearchTitle == 2){echo 'selected="selected"';}?>value='2'><?php _e('2. Second', 'all_in_one'); ?></option>
              <option <?php if($orderSearchTitle == 3){echo 'selected="selected"';}?>value='3'><?php _e('3. Third', 'all_in_one'); ?></option>
              <option <?php if($orderSearchTitle == 4){echo 'selected="selected"';}?>value='4'><?php _e('4. Fourth', 'all_in_one'); ?></option>
              <option <?php if($orderSearchTitle == 5){echo 'selected="selected"';}?>value='5'><?php _e('5. Fifth', 'all_in_one'); ?></option>
              <option <?php if($orderSearchTitle == 6){echo 'selected="selected"';}?>value='6'><?php _e('6. Sixth', 'all_in_one'); ?></option>
            </select>	
          </div>
        </div>

        <div class="elem-row">
          <div class="left"><?php _e('Category', 'all_in_one'); ?> <sup class="sup-go go7">(7)</sup></div>
          <div class="middle">
          </div>
          <div class="right">
            <select name="orderSearchCategory" id="orderSearchCategory"> 
              <option <?php if($orderSearchCategory == 1){echo 'selected="selected"';}?>value='1'><?php _e('1. First', 'all_in_one'); ?></option>
              <option <?php if($orderSearchCategory == 2){echo 'selected="selected"';}?>value='2'><?php _e('2. Second', 'all_in_one'); ?></option>
              <option <?php if($orderSearchCategory == 3){echo 'selected="selected"';}?>value='3'><?php _e('3. Third', 'all_in_one'); ?></option>
              <option <?php if($orderSearchCategory == 4){echo 'selected="selected"';}?>value='4'><?php _e('4. Fourth', 'all_in_one'); ?></option>
              <option <?php if($orderSearchCategory == 5){echo 'selected="selected"';}?>value='5'><?php _e('5. Fifth', 'all_in_one'); ?></option>
              <option <?php if($orderSearchCategory == 6){echo 'selected="selected"';}?>value='6'><?php _e('6. Sixth', 'all_in_one'); ?></option>
            </select>	
          </div>
        </div>

        <div class="elem-row">
          <div class="left"><?php _e('Search Pattern', 'all_in_one'); ?> <sup class="sup-go go8">(8)</sup></div>
          <div class="middle">
          </div>
          <div class="right">
            <select name="orderSearchPattern" id="orderSearchPattern"> 
              <option <?php if($orderSearchPattern == 1){echo 'selected="selected"';}?>value='1'><?php _e('1. First', 'all_in_one'); ?></option>
              <option <?php if($orderSearchPattern == 2){echo 'selected="selected"';}?>value='2'><?php _e('2. Second', 'all_in_one'); ?></option>
              <option <?php if($orderSearchPattern == 3){echo 'selected="selected"';}?>value='3'><?php _e('3. Third', 'all_in_one'); ?></option>
              <option <?php if($orderSearchPattern == 4){echo 'selected="selected"';}?>value='4'><?php _e('4. Fourth', 'all_in_one'); ?></option>
              <option <?php if($orderSearchPattern == 5){echo 'selected="selected"';}?>value='5'><?php _e('5. Fifth', 'all_in_one'); ?></option>
              <option <?php if($orderSearchPattern == 6){echo 'selected="selected"';}?>value='6'><?php _e('6. Sixth', 'all_in_one'); ?></option>
            </select>	
          </div>
        </div>

        <div class="clear"></div>

        <div class="check-under">
          <input type="checkbox" name="improveDesc" id="improveDesc" <?php echo ($improveDesc == 1 ? 'checked' : ''); ?> />
          <label for="improveDesc" style="font-weight: bold;"><?php _e('Improve Meta description of category & search pages', 'all_in_one'); ?> <sup class="sup-go go9">(9)</sup></label>
        </div>
      </div>

      <div class="clear"></div>
      <br /><br /><br /><br />

      <!-- --------------------------------------- Home page meta settings ---------------------------------------------------- -->

      <div class="listing-left listing">
        <div class="title"><i class="fa fa-home"></i>&nbsp;<?php _e("Home page - this settings will be reflected just on this pages", 'all_in_one'); ?></div>
        <div class="del"></div>

        <label for="pageHomeTitle" class="text-label"><?php _e('Title on home page', 'all_in_one'); ?> <sup class="sup-go go10">(10)</sup></label>
        <input type="text" id="pageHomeTitle" name="pageHomeTitle" value="<?php echo $pageHomeTitle; ?>" />

        <div class="clear" style="margin:6px 0;"></div>

        <label for="pageHomeDesc" class="text-label"><?php _e('Description on home page', 'all_in_one'); ?> <sup class="sup-go go10">(10)</sup></label>
        <textarea type="text" id="pageHomeDesc" name="pageHomeDesc"><?php echo $pageHomeDesc; ?></textarea>
      </div>

      <!-- --------------------------------------- Other pages meta settings -------------------------------------------------- -->

      <div class="listing-right listing">
        <div class="title"><i class="fa fa-yelp"></i>&nbsp;<?php _e("Other pages - this settings will be reflected just on this pages", 'all_in_one'); ?></div>
        <div class="del"></div>

        <label for="showTitleFirst" class="text-label"><?php _e('Position of page title', 'all_in_one'); ?> <sup class="sup-go go11">(11)</sup></label><br />
        <select name="showTitleFirst" id="showTitleFirst"> 
          <option <?php if($showTitleFirst == 1) { echo 'selected="selected"'; } ?>value='1'><?php _e('First','all_in_one'); ?></option>
          <option <?php if($showTitleFirst == 0) { echo 'selected="selected"'; } ?>value='0'><?php _e('Last','all_in_one'); ?></option>
        </select>

        <div class="clear" style="margin:5px 0;"></div>

        <label for="pageOtherTitle" class="text-label"><?php _e('Page title on other pages', 'all_in_one'); ?></label>
        <input type="text" id="pageOtherTitle" name="pageOtherTitle" value="<?php echo $pageOtherTitle; ?>" />
      </div>

      <div class="clear"></div>
      <br />
    </fieldset>

    <!-- Show what we got now -->
    <br /><br />
                   
    <button name="theButton" id="theButton" type="submit" style="float: left;" class="btn btn-submit"><?php _e('Update', 'all_in_one');?></button>
  </form>

  <div class="clear"></div>
  <br /><br />

  <div class="tip round3">
    <div class="top-note"><i class="fa fa-dashboard"></i><?php _e('Important notes for good SEO performance', 'all_in_one'); ?></div>
    <div class="single-elem first"></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('Objective of this plugin is improve Meta Tags for your classifieds and bring more customers from search engines and higher click rate in search engines', 'all_in_one'); ?></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('Before using this plugin, read some tips & tricks of SEO for your contry. You should also get familiar with Search Engine Optimization so you know what are you doing', 'all_in_one'); ?>: <a href="http://en.wikipedia.org/wiki/Search_engine_optimization" target="blank"><?php _e('What is SEO ?', 'all_in_one'); ?></a></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('Almost all parts of plugin (except BackLink section) is targeted to improve <strong>on-page SEO factors</strong> that are just part of SEO success', 'all_in_one'); ?></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('BackLink section helps you in BackLink Management (link exchange) with other websites and improve <strong>off-page SEO factors</strong> that are very important as well', 'all_in_one'); ?></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('When you change your meta titles & description, you can have less vistors for few days till search engines reindex your website with new meta details', 'all_in_one'); ?></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('Plugin itself cannot break anything. You cannot set plugin to be <strong>wrong</strong>, there are just <strong>better</strong> and <strong>less better</strong> solutions', 'all_in_one'); ?></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('There are no general good pratices in setting order of meta tags, please do not contact us with this question', 'all_in_one'); ?></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('To set Meta Tags best as you can, check competitive websites in your country (other successful classifieds) and check what they use in meta title, description & keywords and use similar settings or try to improve it', 'all_in_one'); ?></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('<strong>Meta Title</strong> should be long <strong>50-60 characters</strong>, otherwise it will not be shown whole in search engines', 'all_in_one'); ?></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('<strong>Meta Description</strong> should be long <strong>150-160 characters</strong>, otherwise it will not be shown whole in search engines', 'all_in_one'); ?></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('Best practice for Meta Title & Description is when there are keywords usually used in search. This will secure that those tags will be shown in search engine in particular search', 'all_in_one'); ?></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('When no keywords from search are found in your meta tags, search engine generate own meta tags for your site that fits search parameters more then your own', 'all_in_one'); ?></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('Text shown in left (shown first) in meta tags has more weight than text on right side', 'all_in_one'); ?></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('You should not have more than <strong>10 meta keywords</strong> on page', 'all_in_one'); ?></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('Do not contact us about SEO questions and support, we are developers, not SEO consultants', 'all_in_one'); ?></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('SEO is neverending story, you should still try to improve it and do it with love and patient', 'all_in_one'); ?></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('There are also other very important areas - copywritting, blogs, no duplicates on your website, no spam, try to get unique content... Check osclass for more tips', 'all_in_one'); ?></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('If you have tips & ideas for improvement of this plugin, place your ideas into forums thread of this plugin', 'all_in_one'); ?>: <a class="bold" href="http://forums.osclass.org/plugins-20/(premium)-all-in-one-seo-plugin/" target="blank"><?php _e('All in One SEO Forum Thread', 'all_in_one'); ?></a></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('You can see in action how this plugin helps osclass', 'all_in_one'); ?>: <a class="bold" href="http://mb-themes.com/content/2-how-seo-plugins-helps-osclass" target="blank"><?php _e('How All in One SEO Plugin helps osclass', 'all_in_one'); ?></a></div>
    <div class="single-elem"><i class="fa fa-angle-right"></i>&nbsp;<?php _e('When you are starting classifieds, you can check general good tips & practices on our website', 'all_in_one'); ?>: <a class="bold" href="http://mb-themes.com/content/8-how-to-start-classified" target="blank"><?php _e('How to start classifieds', 'all_in_one'); ?></a></div>
  </div>

  <div class="warn"><sup class="sup-go1">(1)</sup> <?php _e('If allowed only to admin, administrator can add/edit meta tags of listings on front & backend as well, when logged in to oc-admin in web browser.', 'all_in_one'); ?></div>
  <div class="warn"><sup class="sup-go2">(2)</sup> <?php _e('Keywords needs to be separated with <strong>,</strong> (comma). After last keyword, there should not be comma.', 'all_in_one'); ?><br /><?php _e('Keywords will be added to Meta Keywords on every osclass page as appendix (to the end).', 'all_in_one'); ?><br /><?php _e('To disable this function, leave keywords field blank.', 'all_in_one'); ?></div>
  <div class="warn"><sup class="sup-go3">(3)</sup> <?php _e('You do not need to enter white spaces around delimiter, it will be added automatically. Means, add delimiter sign only.', 'all_in_one'); ?></div>
  <div class="warn"><sup class="sup-go4">(4)</sup> <?php _e('Your current page title for Listings page is', 'all_in_one'); ?>: <span class="real"><?php echo ($pageTitle == '' ? osc_page_title() : $pageTitle); ?></span>. <?php _e('You can change this in field <strong>Page title on listing page</strong>. When this field is empty, default Home Page title is shown.', 'all_in_one'); ?></div>
  <div class="warn"><sup class="sup-go5">(5)</sup> <?php _e('When user define Meta Title, this is shown, otherwise, normal Title of Listing is shown. You cannot hide this field in Meta title.', 'all_in_one'); ?></div>
  <div class="warn"><sup class="sup-go6">(6)</sup> <?php _e('Your current page title is', 'all_in_one'); ?>: <span class="real"><?php echo ($pageSearchTitle == '' ? osc_page_title() : $pageSearchTitle); ?></span>. <?php _e('You can change this in field <strong>Page title on listing page</strong>. When this field is empty, default Home Page title is shown.', 'all_in_one'); ?></div>
  <div class="warn"><sup class="sup-go7">(7)</sup> <?php _e('When Meta Title for Category is defined, this one is taken. Otherwise Category name is used.', 'all_in_one'); ?></div>
  <div class="warn"><sup class="sup-go8">(8)</sup> <?php _e('Search pattern cannot be hidden and if is not empty, it will be shown.', 'all_in_one'); ?></div>
  <div class="warn"><sup class="sup-go9">(9)</sup> <?php _e('It is recommended to allow this. It will add part of listing title that are in currect category or search to improve chance of matching search keyword.', 'all_in_one'); ?></div>
  <div class="warn"><sup class="sup-go10">(10)</sup> <?php _e('Title & Description on homepage is exactly same as found in Settings > General. If you edit it here, it will reflect also there.', 'all_in_one'); ?></div>
  <div class="warn"><sup class="sup-go11">(11)</sup> <?php _e('On all pages except Search/Category, Home & Listings page, this setting is valid. You can add custom Page Title that can be shown at first or last position in Meta Title. When Title for Other pages is empty, default title is taken (same as Home Page title).', 'all_in_one'); ?></div>

  <div class="code round3" style="margin-top:2px;">
    <?php _e('If you want to use custom meta title, description and keywords of items on <strong>listing</strong> and <strong>search</strong> page</li> (search_list.php, search_gallery.php, item.php, main.php - latest block), you can do it with following functions', 'all_in_one'); ?>:<br /><br />
    <strong>&lt;?php echo GetItemTitle();?&gt;</strong> - custom meta title<br />
    <strong>&lt;?php echo GetItemDesc();?&gt;</strong> - custom meta description<br />
    <strong>&lt;?php echo GetItemKeywords();?&gt;</strong> - custom meta keywords<br /><br />
    <?php _e('Above listed functions automatically use to identify item, osclass build in function <strong>osc_item_id()</strong>, so you can use them only on pages where osc_item_id() is active', 'all_in_one'); ?>
  </div>
  <div class="clear"></div>
  <br /><br />

  <?php echo $pluginInfo['plugin_name'] . ' | ' . __('Version','all_in_one') . ' ' . $pluginInfo['version'] . ' | ' . __('Author','all_in_one') . ': ' . $pluginInfo['author'] . ' | Cannot be redistributed | &copy; ' . date('Y') . ' <a href="' . $pluginInfo['plugin_uri'] . '" target="_blank">MB Themes</a>'; ?>             
</div>