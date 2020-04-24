<?php
function seo_categories_list($category = null) {
  seo_category_list(Category::newInstance()->toTree(), $category);
}

function seo_category_list($categories, $category) {
  foreach($categories as $c) {
    $detail = ModelSeoCategory::newInstance()->getAttrByCategoryId( $c['pk_i_id'] ); 
    $level = 1;

    //Update if anything
    if(Params::getParam('plugin_action')=='done' and (Params::getParam('seo_title' . $c['pk_i_id']) or Params::getParam('seo_desc' . $c['pk_i_id']) or Params::getParam('seo_keywords' . $c['pk_i_id']) )) {
      if(Params::getParam('seo_title' . $c['pk_i_id']) <> '' or Params::getParam('seo_desc' . $c['pk_i_id']) <> '' or Params::getParam('seo_keywords' . $c['pk_i_id']) <> '') {
        if(isset($detail['seo_category_id'])) {
          ModelSeoCategory::newInstance()->updateAttr( $c['pk_i_id'], Params::getParam('seo_title' . $c['pk_i_id']), Params::getParam('seo_desc' . $c['pk_i_id']), Params::getParam('seo_keywords' . $c['pk_i_id']) );
        } else {
          ModelSeoCategory::newInstance()->insertAttr( $c['pk_i_id'], Params::getParam('seo_title' . $c['pk_i_id']), Params::getParam('seo_desc' . $c['pk_i_id']), Params::getParam('seo_keywords' . $c['pk_i_id']) );
        } 
      }
    }

    if(Params::getParam('plugin_action')=='done' and Params::existParam('seo_title' . $c['pk_i_id']) and Params::existParam('seo_desc' . $c['pk_i_id']) and Params::existParam('seo_keywords' . $c['pk_i_id']) and Params::getParam('seo_title' . $c['pk_i_id']) == '' and Params::getParam('seo_desc' . $c['pk_i_id']) == '' and Params::getParam('seo_keywords' . $c['pk_i_id']) == '' ) {
      if(isset($detail['seo_category_id'])) { ModelSeoCategory::newInstance()->deleteCategory( $detail['seo_category_id'] ); } 
    }

    $detail = ModelSeoCategory::newInstance()->getAttrByCategoryId( $c['pk_i_id'] ); 

    echo '<div class="cat-row level' . $level . '">';
      echo '<div class="cat-elem id">' . $c['pk_i_id']. '</div>';
      echo '<div class="cat-elem name">' . $c['s_name']. '</div>';
      echo '<div class="cat-elem titl"><input type="text" name="seo_title' . $c['pk_i_id']. '" id="seo_title" disabled value="' . $detail['seo_title'] . '" size="20" /></div>';
      echo '<div class="cat-elem desc"><input type="text" name="seo_desc' . $c['pk_i_id']. '" id="seo_desc" disabled value="' . $detail['seo_desc'] . '" size="20" /></div>';
      echo '<div class="cat-elem keywords"><input type="text" name="seo_keywords' . $c['pk_i_id']. '" id="seo_keywords" disabled value="' . $detail['seo_keywords'] . '" size="20" /></div>';
      echo '<div class="cat-elem lock"><a id="' . $c['pk_i_id']. '" class="unlock-link" href="#"><i class="fa fa-lock"></i>' . __('Unlock','all_in_one') . '</a></div>';
    echo '</div>';
   
    if(isset($c['categories']) && is_array($c['categories'])) {
      seo_subcategory_list($c['categories'], $category, $level);
    }
  }
}

function seo_subcategory_list($categories, $category, $level = 0) {
  $level++;
  $elem = '<i class="fa fa-angle-right level"></i>';
  $arrows = '';

  if($level == 2) {
    $arrows = $elem;
  } else if($level == 3) {
    $arrows = $elem . $elem;
  } else if($level == 4) {
    $arrows = $elem . $elem . $elem;
  } else {
    $arrows = $elem . $elem . $elem . $elem;
  }

  foreach($categories as $c) {

    $detail = ModelSeoCategory::newInstance()->getAttrByCategoryId( $c['pk_i_id'] ); 

    //Update if anything
    if(Params::getParam('plugin_action')=='done' and (Params::getParam('seo_title' . $c['pk_i_id']) or Params::getParam('seo_desc' . $c['pk_i_id']) or Params::getParam('seo_keywords' . $c['pk_i_id']) )) {
      if(Params::getParam('seo_title' . $c['pk_i_id']) <> '' or Params::getParam('seo_desc' . $c['pk_i_id']) <> '' or Params::getParam('seo_keywords' . $c['pk_i_id']) <> '') {
        if(isset($detail['seo_category_id'])) {
          ModelSeoCategory::newInstance()->updateAttr( $c['pk_i_id'], Params::getParam('seo_title' . $c['pk_i_id']), Params::getParam('seo_desc' . $c['pk_i_id']), Params::getParam('seo_keywords' . $c['pk_i_id']) );
        } else {
          ModelSeoCategory::newInstance()->insertAttr( $c['pk_i_id'], Params::getParam('seo_title' . $c['pk_i_id']), Params::getParam('seo_desc' . $c['pk_i_id']), Params::getParam('seo_keywords' . $c['pk_i_id']) );
        } 
      }
    }

    if(Params::getParam('plugin_action')=='done' and Params::existParam('seo_title' . $c['pk_i_id']) and Params::existParam('seo_desc' . $c['pk_i_id']) and Params::existParam('seo_keywords' . $c['pk_i_id']) and Params::getParam('seo_title' . $c['pk_i_id']) == '' and Params::getParam('seo_desc' . $c['pk_i_id']) == '' and Params::getParam('seo_keywords' . $c['pk_i_id']) == '' ) {
      if(isset($detail['seo_category_id'])) { ModelSeoCategory::newInstance()->deleteCategory( $detail['seo_category_id'] ); } 
    }

    $detail = ModelSeoCategory::newInstance()->getAttrByCategoryId( $c['pk_i_id'] ); 

    echo '<div class="cat-row level' . $level . '">';
      echo '<div class="cat-elem id">' . $c['pk_i_id']. '</div>';
      echo '<div class="cat-elem name">' . $arrows . '&nbsp;' . $c['s_name']. '</div>';
      echo '<div class="cat-elem titl"><input type="text" name="seo_title' . $c['pk_i_id']. '" id="seo_title" disabled value="' . $detail['seo_title'] . '" size="20" /></div>';
      echo '<div class="cat-elem desc"><input type="text" name="seo_desc' . $c['pk_i_id']. '" id="seo_desc" disabled value="' . $detail['seo_desc'] . '" size="20" /></div>';
      echo '<div class="cat-elem keywords"><input type="text" name="seo_keywords' . $c['pk_i_id']. '" id="seo_keywords" disabled value="' . $detail['seo_keywords'] . '" size="20" /></div>';
      echo '<div class="cat-elem lock"><a id="' . $c['pk_i_id']. '" class="unlock-link" href="#"><i class="fa fa-lock"></i>' . __('Unlock','all_in_one') . '</a></div>';
    echo '</div>';
    
    if(isset($c['categories']) && is_array($c['categories'])) {
      seo_subcategory_list($c['categories'], $category, $level);
    }
  }
}


function seo_country_region_list() {
  $countries = ModelSeoLocation::newInstance()->getCountryList();

  foreach($countries as $c) {
    $level = 1;
    $detail = ModelSeoLocation::newInstance()->getAttrByCountryCode( $c['pk_c_code'] );

    $regions = ModelSeoLocation::newInstance()->getRegionList($c['pk_c_code']);

    $elem = '<i class="fa fa-angle-right level"></i>';

    //Update if anything
    if(Params::getParam('plugin_action')=='done' and (Params::getParam('seo_title' . $c['pk_c_code']) or Params::getParam('seo_desc' . $c['pk_c_code']) or Params::getParam('seo_keywords' . $c['pk_c_code']) )) {
      if(Params::getParam('seo_title' . $c['pk_c_code']) <> '' or Params::getParam('seo_desc' . $c['pk_c_code']) <> '' or Params::getParam('seo_keywords' . $c['pk_c_code']) <> '') {
        if(isset($detail['seo_country_code'])) {
          ModelSeoLocation::newInstance()->updateCtrAttr( $c['pk_c_code'], Params::getParam('seo_title' . $c['pk_c_code']), Params::getParam('seo_desc' . $c['pk_c_code']), Params::getParam('seo_keywords' . $c['pk_c_code']) );
        } else {
          ModelSeoLocation::newInstance()->insertCtrAttr( $c['pk_c_code'], Params::getParam('seo_title' . $c['pk_c_code']), Params::getParam('seo_desc' . $c['pk_c_code']), Params::getParam('seo_keywords' . $c['pk_c_code']) );
        } 
      }
    }

    if(Params::getParam('plugin_action')=='done' and Params::existParam('seo_title' . $c['pk_c_code']) and Params::existParam('seo_desc' . $c['pk_c_code']) and Params::existParam('seo_keywords' . $c['pk_c_code']) and Params::getParam('seo_title' . $c['pk_c_code']) == '' and Params::getParam('seo_desc' . $c['pk_c_code']) == '' and Params::getParam('seo_keywords' . $c['pk_c_code']) == '' ) {
      if(isset($detail['seo_country_code'])) { ModelSeoLocation::newInstance()->deleteCountry( $detail['seo_country_code'] ); } 
    }

    $detail = ModelSeoLocation::newInstance()->getAttrByCountryCode( $c['pk_c_code'] );

    echo '<div class="cat-row level' . $level . '">';
      echo '<div class="cat-elem id">' . $c['pk_c_code']. '</div>';
      echo '<div class="cat-elem name">' . $c['s_name']. '</div>';
      echo '<div class="cat-elem titl"><input type="text" name="seo_title' . $c['pk_c_code']. '" id="seo_title" disabled value="' . $detail['seo_title'] . '" size="20" /></div>';
      echo '<div class="cat-elem desc"><input type="text" name="seo_desc' . $c['pk_c_code']. '" id="seo_desc" disabled value="' . $detail['seo_desc'] . '" size="20" /></div>';
      echo '<div class="cat-elem keywords"><input type="text" name="seo_keywords' . $c['pk_c_code']. '" id="seo_keywords" disabled value="' . $detail['seo_keywords'] . '" size="20" /></div>';
      echo '<div class="cat-elem lock"><a id="' . $c['pk_c_code']. '" class="unlock-link" href="#"><i class="fa fa-lock"></i>' . __('Unlock','all_in_one') . '</a></div>';
    echo '</div>';
   

    
    // REGION LIST OF PARTICULAR COUNTRY
 
    foreach($regions as $r) {
      $level = 2;
      $detail = ModelSeoLocation::newInstance()->getAttrByRegionId( $r['pk_i_id'] );

      $regions = ModelSeoLocation::newInstance()->getRegionList($r['pk_i_id']);
      $elem = '<i class="fa fa-angle-right level"></i>';

      //Update if anything
      if(Params::getParam('plugin_action')=='done' and (Params::getParam('seo_title' . $r['pk_i_id']) or Params::getParam('seo_desc' . $r['pk_i_id']) or Params::getParam('seo_keywords' . $r['pk_i_id']) )) {
        if(Params::getParam('seo_title' . $r['pk_i_id']) <> '' or Params::getParam('seo_desc' . $r['pk_i_id']) <> '' or Params::getParam('seo_keywords' . $r['pk_i_id']) <> '') {
          if(isset($detail['seo_region_id'])) {
            ModelSeoLocation::newInstance()->updateRegAttr( $r['pk_i_id'], Params::getParam('seo_title' . $r['pk_i_id']), Params::getParam('seo_desc' . $r['pk_i_id']), Params::getParam('seo_keywords' . $r['pk_i_id']) );
          } else {
            ModelSeoLocation::newInstance()->insertRegAttr( $r['pk_i_id'], Params::getParam('seo_title' . $r['pk_i_id']), Params::getParam('seo_desc' . $r['pk_i_id']), Params::getParam('seo_keywords' . $r['pk_i_id']) );
          } 
        }
      }

      if(Params::getParam('plugin_action')=='done' and Params::existParam('seo_title' . $r['pk_i_id']) and Params::existParam('seo_desc' . $r['pk_i_id']) and Params::existParam('seo_keywords' . $r['pk_i_id']) and Params::getParam('seo_title' . $r['pk_i_id']) == '' and Params::getParam('seo_desc' . $r['pk_i_id']) == '' and Params::getParam('seo_keywords' . $r['pk_i_id']) == '' ) {
        if(isset($detail['seo_region_id'])) { ModelSeoLocation::newInstance()->deleteRegion( $detail['seo_region_id'] ); } 
      }

      $detail = ModelSeoLocation::newInstance()->getAttrByRegionId( $r['pk_i_id'] );

      echo '<div class="cat-row level' . $level . '">';
        echo '<div class="cat-elem id">' . $r['pk_i_id']. '</div>';
        echo '<div class="cat-elem name">' . $arrows . '&nbsp;' . $r['s_name']. '</div>';
        echo '<div class="cat-elem titl"><input type="text" name="seo_title' . $r['pk_i_id']. '" id="seo_title" disabled value="' . $detail['seo_title'] . '" size="20" /></div>';
        echo '<div class="cat-elem desc"><input type="text" name="seo_desc' . $r['pk_i_id']. '" id="seo_desc" disabled value="' . $detail['seo_desc'] . '" size="20" /></div>';
        echo '<div class="cat-elem keywords"><input type="text" name="seo_keywords' . $r['pk_i_id']. '" id="seo_keywords" disabled value="' . $detail['seo_keywords'] . '" size="20" /></div>';
        echo '<div class="cat-elem lock"><a id="' . $r['pk_i_id']. '" class="unlock-link" href="#"><i class="fa fa-lock"></i>' . __('Unlock','all_in_one') . '</a></div>';
      echo '</div>';


    }
    // END REGION LIST
  }
}
?>