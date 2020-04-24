<?php
if( !function_exists('osc_plugin_path') ) {
  function osc_plugin_path($file) {
    $file = preg_replace('|/+|','/', str_replace('\\','/',$file));
    $plugin_path = preg_replace('|/+|','/', str_replace('\\','/', PLUGINS_PATH));
    $file = $plugin_path . preg_replace('#^.*oc-content\/plugins\/#','',$file);
    return $file;
  }
}

function seo_sitemap_generator() {
  $start_time = microtime(true);
  $min = 1;

  $show_items = '';
  if(Params::getParam('sitemap_items') != '') {
    $show_items = Params::getParam('sitemap_items');
  } else {
    $show_items = (osc_get_preference('allSeo_sitemap_items', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_sitemap_items', 'plugin-all_in_one') : '' ;
  }

  $limit_items = '';
  if(Params::getParam('sitemap_items_limit') != '') {
    $limit_items = Params::getParam('sitemap_items_limit');
  } else {
    $limit_items = (osc_get_preference('allSeo_sitemap_items_limit', 'plugin-all_in_one') != '') ? osc_get_preference('allSeo_sitemap_items_limit', 'plugin-all_in_one') : '' ;
  }
  
  $limit_items = intval( $limit_items );
  $locales = osc_get_locales();

  $filename = osc_base_path() . 'sitemap.xml';    //link sitemap
  @unlink($filename);                             //remove original sitemap
  
  $start_xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
  file_put_contents($filename, $start_xml);

  // INDEX
  seo_sitemap_add_url(osc_base_url(), date('Y-m-d'), 'always');

  $categories = Category::newInstance()->listAll(false);
  $countries = Country::newInstance()->listAll();
  
  foreach($categories as $c) {
    $search = new Search();
    $search->addCategory($c['pk_i_id']);
    if($search->count()>=$min) {
      seo_sitemap_add_url(osc_search_url(array('sCategory' => $c['s_slug'])), date('Y-m-d'), 'hourly');
      foreach($countries as $country) {
        if(count($countries)>1) {
          $search = new Search();
          $search->addCategory($c['pk_i_id']);
          $search->addCountry($country['pk_c_code']);
          
          if($search->count()>$min) {
            seo_sitemap_add_url(osc_search_url(array('sCategory' => $c['s_slug'], 'sCountry' => $country['s_name'])), date('Y-m-d'), 'hourly');
          }
        }
        
        $regions = Region::newInstance()->findByCountry($country['pk_c_code']);
        foreach($regions as $region) {
          $search = new Search();
          $search->addCategory($c['pk_i_id']);
          $search->addCountry($country['pk_c_code']);
          $search->addRegion($region['pk_i_id']);
          if($search->count()>$min) {
            seo_sitemap_add_url(osc_search_url(array('sCategory' => $c['s_slug'], 'sCountry' => $country['s_name'], 'sRegion' => $region['s_name'])), date('Y-m-d'), 'hourly');
            $cities = City::newInstance()->findByRegion($region['pk_i_id']);
            foreach($cities as $city) {
              $search = new Search();
              $search->addCategory($c['pk_i_id']);
              $search->addCountry($country['pk_c_code']);
              $search->addRegion($region['pk_i_id']);
              $search->addCity($city['pk_i_id']);
              if($search->count()>$min) {
                seo_sitemap_add_url(osc_search_url(array('sCategory' => $c['s_slug'], 'sCountry' => $country['s_name'], 'sRegion' => $region['s_name'], 'sCity' => $city['s_name'])), date('Y-m-d'), 'hourly');
              }
            }
          }
        }
      }
    }
  }

  foreach($countries as $country) {
    $regions = Region::newInstance()->findByCountry($country['pk_c_code']);
    foreach($regions as $region) {
      $cities = CityStats::newInstance()->listCities($region['pk_i_id']);
      $l = min(count($cities), 30);
      for($k=0;$k<$l;$k++) {
        if($cities[$k]['items']>$min) {
          seo_sitemap_add_url(osc_search_url(array('sCountry' => $country['s_name'], 'sRegion' => $region['s_name'], 'sCity' => $cities[$k]['city_name'])), date('Y-m-d'), 'hourly');
        }
      }
    }
  }
  
  // ITEMS
  if( $show_items == 1 ) {
    $max_secure = 10000;
    $mSearch = new Search() ;
    $mSearch->limit(0, $limit_items) ; // fetch number of item for sitemap
    $aItems = $mSearch->doSearch(); 
    View::newInstance()->_exportVariableToView('items', $aItems); //exporting our searched item array

    if(osc_count_items() > 0) {
      $i = 0;
      while(osc_has_items() and $i < $limit_items and $i < $max_secure) {
        seo_sitemap_add_url(osc_item_url(), substr(osc_item_mod_date()!='' ? osc_item_mod_date() : osc_item_pub_date(), 0, 10), 'daily');
        $i++;
      }
    }
  }

  $end_xml = '</urlset>';
  file_put_contents($filename, $end_xml, FILE_APPEND);
  
  // PING SEARCH ENGINES
  seo_sitemap_ping_engines();
  
  $time_elapsed = microtime(true) - $start_time;
  return $time_elapsed;
}

function seo_sitemap_add_url($url = '', $date = '', $freq = 'daily') {
  if( preg_match('|\?(.*)|', $url, $match) ) {
    $sub_url = $match[1];
    $param = explode('&', $sub_url);
    foreach($param as &$p) {
      list($key, $value) = explode('=', $p);
      $p = $key . '=' . urlencode($value);
    }
    $sub_url = implode('&', $param);
    $url = preg_replace('|\?.*|', '?' . $sub_url, $url);
  } else {
    $help = $url; 
    $help_encode = urlencode($help);
    $help_fix = str_replace('%2C', ',', $help_encode);
    $help_fix = str_replace('%2F', '/', $help_fix);
    $help_fix = str_replace('%3A', ':', $help_fix);
    $url = $help_fix;     
  }

  $filename = osc_base_path() . 'sitemap.xml';
  $xml  = '  <url>' . PHP_EOL;
  $xml .= '    <loc>' . htmlentities($url, ENT_QUOTES, "UTF-8") . '</loc>' . PHP_EOL;
  $xml .= '    <lastmod>' . $date . '</lastmod>' . PHP_EOL;
  $xml .= '    <changefreq>' . $freq . '</changefreq>' . PHP_EOL;
  $xml .= '  </url>' . PHP_EOL;
  file_put_contents($filename, $xml, FILE_APPEND);
}

function seo_sitemap_ping_engines() {
  // GOOGLE
  osc_doRequest( 'http://www.google.com/webmasters/sitemaps/ping?sitemap='.urlencode(osc_base_url() . 'sitemap.xml'), array());
  // BING
  osc_doRequest( 'http://www.bing.com/webmaster/ping.aspx?siteMap='.urlencode(osc_base_url() . 'sitemap.xml'), array());
  // YAHOO!
  osc_doRequest( 'http://search.yahooapis.com/SiteExplorerService/V1/updateNotification?appid='.osc_page_title().'&url='.urlencode(osc_base_url() . 'sitemap.xml'), array());
}


// Frequency of generate
// CHANGE THIS LINE TO  'cron_hourly' or 'cron_daily' to modify the frequent of running it
$freq = osc_get_preference('allSeo_sitemap_freq', 'plugin-all_in_one');
if( $freq == 'weekly' ) {
  osc_add_hook('cron_weekly', 'seo_sitemap_generator');
} else if ( $freq == 'daily' ) {
  osc_add_hook('cron_daily', 'seo_sitemap_generator');
} else if ( $freq == 'hourly' ) {
  osc_add_hook('cron_hourly', 'seo_sitemap_generator');
} 