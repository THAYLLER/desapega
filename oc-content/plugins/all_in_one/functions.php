<?php
// GENERATE TAGS
function ais_create_tag( $active_elements, $delimiter = NULL ) {
  $tag = array();

  $category_id = osc_search_category_id();
  $category_id = isset($category_id[0]) ? $category_id[0] : '';

  if( $category_id > 0 ) { 
    $category = Category::newInstance()->findByPrimaryKey( $category_id );
    $category_meta = ModelAisCategory::newInstance()->findByCategoryId( $category_id, osc_current_user_locale() );
  }


  if( osc_static_page_id() <> '' && osc_static_page_id() > 0 ) {
    $page_meta = ModelAisPage::newInstance()->findByPageId( osc_static_page_id(), osc_current_user_locale() );
  }


  if(ais_search_country() <> '') {
    $country_name = ais_search_country();
    $country_meta = ModelAisLocation::newInstance()->findByCountryName( ais_search_country(), osc_current_user_locale() );
  }


  if(osc_search_region() <> '') {
    $region_name = osc_search_region();
    $region_meta = ModelAisLocation::newInstance()->findByRegionName( osc_search_region(), ais_search_country(), osc_current_user_locale() );
  }


  if(osc_item_id() <> '' && osc_item_id() > 0) {
    $item_meta = ModelAisItem::newInstance()->findByItemId( osc_item_id(), osc_current_user_locale() );
  }


  if(isset($delimiter) && $delimiter <> '') {
    $delimiter = ' ' . $delimiter . ' ';
  } else {
    $delimiter = ' ' . osc_get_preference('title_delimiter', 'plugin-ais') . ' ';
  }

  $elem = explode(',', $active_elements);


  foreach($elem as $e) {
    switch ( $e ) {
      case 'web_title':
        $tag[] = trim(osc_page_title());
        break;


      case 'web_description':
        $tag[] = trim(osc_page_description());
        break;


      case 'page_title':
        $tag[] = trim(osc_static_page_title());
        break;


      case 'page_text':
        $tag[] = trim(osc_highlight(osc_static_page_text(), 120));
        break;


      case 'page_meta_title':
        $tag[] = trim( isset($page_meta['s_title']) ? $page_meta['s_title'] : '' );
        break;


      case 'page_meta_description':
        $tag[] = trim( isset($page_meta['s_description']) ? $page_meta['s_description'] : '' );
        break;


      case 'page_custom_text':
        $tag[] = trim( osc_get_preference('page_custom_text', 'plugin-ais') );
        break;


      case 'search_pattern':
        $tag[] = trim( osc_search_pattern() );
        break;


      case 'category_name':
        $tag[] = trim( isset($category['s_name']) ? $category['s_name'] : '' );
        break;


      case 'category_description':
        $tag[] = trim( isset($category['s_description']) ? osc_highlight($category['s_description'], 120) : '' );
        break;


      case 'category_meta_title':
        $tag[] = trim( isset($category_meta['s_title']) ? $category_meta['s_title'] : '' );
        break;


      case 'category_meta_description':
        $tag[] = trim( isset($category_meta['s_description']) ? $category_meta['s_description'] : '' );
        break;


      case 'country_name':
        $tag[] = trim( isset($country_name) ? $country_name : '' );
        break;


      case 'country_meta_title':
        $tag[] = trim( isset($country_meta['s_title']) ? $country_meta['s_title'] : '' );
        break;


      case 'country_meta_description':
        $tag[] = trim( isset($country_meta['s_description']) ? $country_meta['s_description'] : '' );
        break;


      case 'region_name':
        $tag[] = trim( isset($region_name) ? $region_name : '' );
        break;


      case 'region_meta_title':
        $tag[] = trim( isset($region_meta['s_title']) ? $region_meta['s_title'] : '' );
        break;


      case 'region_meta_description':
        $tag[] = trim( isset($region_meta['s_description']) ? $region_meta['s_description'] : '' );
        break;


      case 'city_name':
        $tag[] = trim( osc_search_city() );
        break;


      case 'page_number':
        if( Params::getParam('iPage') <> '' && Params::getParam('iPage') > 1) {
          $tag[] = trim(__('Page', 'all_in_one') . ' ' . Params::getParam('iPage'));
        }
        break;


      case 'item_country':
        $tag[] = trim( osc_item_country() );
        break;


      case 'item_region':
        $tag[] = trim( osc_item_region() );
        break;


      case 'item_city':
        $tag[] = trim( osc_item_city() );
        break;


      case 'item_category':
        $tag[] = trim( osc_item_category() );
        break;


      case 'item_title':
        $tag[] = trim( osc_item_title() );
        break;


      case 'item_description':
        $tag[] = trim( osc_highlight(osc_item_description(), 120) );
        break;


      case 'item_meta_title':
        $tag[] = trim( isset($item_meta['s_title']) ? $item_meta['s_title'] : '' );
        break;


      case 'item_meta_description':
        $tag[] = trim( isset($item_meta['s_description']) ? $item_meta['s_description'] : '' );
        break;


      case 'item_custom_text':
        $tag[] = trim( osc_get_preference('item_custom_text', 'plugin-ais') );
        break;


      case 'search_custom_text':
        $tag[] = trim( osc_get_preference('search_custom_text', 'plugin-ais') );
        break;


    }
  }


  $tag = array_filter($tag);             // remove empty fields
  $tag = implode($delimiter, $tag);      // convert array to string using delimiter
  return $tag;
}



// REPLACE META TITLE WITH TITLE
function ais_title() {
  return ais_title_filter();
}



// HELP FUNCTIONS
if(!function_exists('ais_param_update')) {
  function ais_param_update( $param_name, $update_param_name, $type = NULL, $plugin_var_name ) {
  
    $val = '';
    if( $type == 'check') {

      // Checkbox input
      if( Params::getParam( $param_name ) == 'on' ) {
        $val = 1;
      } else {
        if( Params::getParam( $update_param_name ) == 'done' ) {
          $val = 0;
        } else {
          $val = ( osc_get_preference( $param_name, $plugin_var_name ) != '' ) ? osc_get_preference( $param_name, $plugin_var_name ) : '';
        }
      }
    } else if( $type == 'code' ) {

      // Code text
      if( Params::getParam( $update_param_name ) == 'done' && Params::existParam($param_name)) {
        $val = Params::getParam( $param_name, false, false );
      } else {
        $val = ( osc_get_preference( $param_name, $plugin_var_name) != '' ) ? osc_get_preference( $param_name, $plugin_var_name ) : '';
      }

    } else {

      // Other inputs (text, password, ...)
      if( Params::getParam( $update_param_name ) == 'done' && Params::existParam($param_name)) {
        $val = Params::getParam( $param_name );
      } else {
        $val = ( osc_get_preference( $param_name, $plugin_var_name) != '' ) ? osc_get_preference( $param_name, $plugin_var_name ) : '';
      }
    }


    // If save button was pressed, update param
    if( Params::getParam( $update_param_name ) == 'done' ) {

      if(osc_get_preference( $param_name, $plugin_var_name ) == '') {
        osc_set_preference( $param_name, $val, $plugin_var_name, 'STRING');  
      } else {
        $dao_preference = new Preference();
        $dao_preference->update( array( "s_value" => $val ), array( "s_section" => $plugin_var_name, "s_name" => $param_name ));
        osc_reset_preferences();
        unset($dao_preference);
      }
    }

    return $val;
  }
}



// DELIMITER FUNCTION
function ais_title_delimiter(){
  return trim(osc_get_preference('title_delimiter','plugin-ais'));
}



function ais_description_delimiter(){
  return trim(osc_get_preference('description_delimiter','plugin-ais'));
}



// CATEGORIES LIST
function ais_category_list() {
  $list = ais_get_categories(Category::newInstance()->toTree());
  return $list;
}



// GET MAIN CATEGORIES
function ais_get_categories($categories) {
  $list = array();

  foreach($categories as $c) {
    $level = 1;
    $list[] = array('pk_i_id' => $c['pk_i_id'], 's_name' => $c['s_name'], 'level' => $level );
   
    if(isset($c['categories']) && is_array($c['categories'])) {
      $list = array_merge($list, ais_get_subcategories($c['categories'], $level));
    }
  }

  return $list;
}



// GET SUBCATEGORIES
function ais_get_subcategories($categories, $level = 0) {
  $level++;
  $list = array();

  foreach($categories as $c) {
    $list[] = array('pk_i_id' => $c['pk_i_id'], 's_name' => $c['s_name'], 'level' => $level );
        
    if(isset($c['categories']) && is_array($c['categories'])) {
      $list = array_merge($list, ais_get_subcategories($c['categories'], $level));
    }
  }

  return $list;
}



// CREATE CATEGORY TABS
function ais_category_tabs( $level ) {
  $tab = '';

  if( $level == 2) {
    $tab = '<i class="fa fa-angle-right"></i>&nbsp;';
  } else if( $level == 3) {
    $tab = '&nbsp;&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;';
  } else if( $level == 4) {
    $tab = '&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;';
  }

  return $tab;
}



// HELP FUNCTION TO GET COUNTRY IN SEARCH
function ais_search_country() {
  if(View::newInstance()->_get('search_country')) {
    return View::newInstance()->_get('search_country');
  } else {
    return Params::getParam('sCountry');
  }
}



// OK MESSAGE
if(!function_exists('message_ok')) {
  function message_ok( $text ) {
    $final  = '<div style="padding: 1%;width: 98%;margin-bottom: 15px;" class="flashmessage flashmessage-ok flashmessage-inline">';
    $final .= $text;
    $final .= '</div>';
    echo $final;
  }
}



// ERROR MESSAGE
if(!function_exists('message_error')) {
  function message_error( $text ) {
    $final  = '<div style="padding: 1%;width: 98%;margin-bottom: 15px;" class="flashmessage flashmessage-error flashmessage-inline">';
    $final .= $text;
    $final .= '</div>';
    echo $final;
  }
}



// CREATE LOCALE SELECT BOX
function ais_locale_box( $file ) {
  $html = '';
  $locales = OSCLocale::newInstance()->listAllEnabled();
  $current = ais_get_locale();

  $html .= '<select rel="' . osc_admin_base_url(true) . '?page=plugins&action=renderplugin&file=all_in_one/admin/' . $file . '" class="mb-select mb-select-locale" id="ais-locale" name="ais-locale">';

  foreach( $locales as $l ) {
    $html .= '<option value="' . $l['pk_c_code'] . '" ' . ($current == $l['pk_c_code'] ? 'selected="selected"' : '') . '>' . $l['s_name'] . '</option>';
  }
 
  $html .= '</select>';
  return $html;
}



// GET CURRENT OR DEFAULT ADMIN LOCALE
function ais_get_locale() {
  $locales = OSCLocale::newInstance()->listAllEnabled();

  if(Params::getParam('ais-locale') <> '') {
    $current = Params::getParam('ais-locale');
  } else {
    $current = osc_current_admin_locale();
    $current_exists = false;

    // check if current locale exist in front-office
    foreach( $locales as $l ) {
      if($current == $l['pk_c_code']) {
        $current_exists = true;
      }
    }

    if( !$current_exists ) {
      $i = 0;
      foreach( $locales as $l ) {
        if( $i==0 ) {
          $current = $l['pk_c_code'];
        }

        $i++;
      }
    }
  }

  return $current;
}
?>