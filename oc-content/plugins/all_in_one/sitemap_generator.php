<?php
// MAKE SURE OSC_PLUGIN_PATH FUNCTION EXISTS
if( !function_exists('osc_plugin_path') ) {
  function osc_plugin_path($file) {
    $file = preg_replace('|/+|','/', str_replace('\\','/',$file));
    $plugin_path = preg_replace('|/+|','/', str_replace('\\','/', PLUGINS_PATH));
    $file = $plugin_path . preg_replace('#^.*oc-content\/plugins\/#','',$file);
    return $file;
  }
}



// GENERATE SITEMAP
function ais_generate_sitemap() {
  $start_time = microtime(true);
  $min = 1;


  $show_items = (osc_get_preference('sitemap_items_include', 'plugin-ais') <> '' ? osc_get_preference('sitemap_items_include', 'plugin-ais') : 0);
  $limit_items = intval(osc_get_preference('sitemap_items_limit', 'plugin-ais') <> '' ? osc_get_preference('sitemap_items_limit', 'plugin-ais') : 1000);
  
  $locales = osc_get_locales();

  $filename = osc_base_path() . 'sitemap.xml';    //link sitemap
  @unlink($filename);                             //remove original sitemap
  
  $start_xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
  file_put_contents($filename, $start_xml);


  // INDEX
  ais_sitemap_add_url(osc_base_url(), date('Y-m-d'), 'always');


  // Old not optimized functions
  //$categories = Category::newInstance()->listAll(false);
  //$countries = Country::newInstance()->listAll();

  $categories = Category::newInstance()->toTree(false);
  $countries = CountryStats::newInstance()->listCountries('>');
  

  // ADD CATEGORIES
  foreach($categories as $c) {
    $search = new Search();
    $search->addCategory($c['pk_i_id']);

    if($search->count() >= $min) {
      ais_sitemap_add_url(osc_search_url(array('sCategory' => $c['s_slug'])), date('Y-m-d'), 'hourly');

      foreach($countries as $country) {
        if(count($countries) > 1) {
          $search = new Search();
          $search->addCategory($c['pk_i_id']);
          $search->addCountry($country['pk_c_code']);
          
          if($search->count() > $min) {
            ais_sitemap_add_url(osc_search_url(array('sCategory' => $c['s_slug'], 'sCountry' => $country['s_name'])), date('Y-m-d'), 'hourly');
          }
        }
        
        //$regions = Region::newInstance()->findByCountry($country['pk_c_code']);
        $regions = RegionStats::newInstance()->listRegions($country['pk_c_code'], '>');
        foreach($regions as $region) {
          $search = new Search();
          $search->addCategory($c['pk_i_id']);
          $search->addCountry($country['pk_c_code']);
          $search->addRegion($region['pk_i_id']);

          if($search->count() > $min) {
            ais_sitemap_add_url(osc_search_url(array('sCategory' => $c['s_slug'], 'sCountry' => $country['s_name'], 'sRegion' => $region['s_name'])), date('Y-m-d'), 'hourly');

            //$cities = City::newInstance()->findByRegion($region['pk_i_id']);
            $cities = CityStats::newInstance()->listCities($region['pk_i_id'], '>');
            foreach($cities as $city) {
              $search = new Search();
              $search->addCategory($c['pk_i_id']);
              $search->addCountry($country['pk_c_code']);
              $search->addRegion($region['pk_i_id']);
              $search->addCity($city['pk_i_id']);

              if($search->count() > $min) {
                ais_sitemap_add_url(osc_search_url(array('sCategory' => $c['s_slug'], 'sCountry' => $country['s_name'], 'sRegion' => $region['s_name'], 'sCity' => $city['s_name'])), date('Y-m-d'), 'hourly');
              }
            }
          }
        }
      }
    }
  }



  // ADD LOCATIONS (COUNTRY > REGION > CITY) THAT CONTAINS AT LEAST 1 LISTING
  foreach($countries as $country) {
    //$regions = Region::newInstance()->findByCountry($country['pk_c_code']);
    $regions = RegionStats::newInstance()->listRegions($country['pk_c_code'], '>');
    foreach($regions as $region) {
      $cities = CityStats::newInstance()->listCities($region['pk_i_id'], '>');
      $l = min(count($cities), 30);

      for($k=0; $k<$l; $k++) {
        if($cities[$k]['items'] > $min) {
          ais_sitemap_add_url(osc_search_url(array('sCountry' => $country['s_name'], 'sRegion' => $region['s_name'], 'sCity' => $cities[$k]['city_name'])), date('Y-m-d'), 'hourly');
        }
      }
    }
  }
  
  
  // ADD ITEMS
  if( $show_items == 1 ) {
    $max_secure = 10000;
    $mSearch = new Search() ;
    $mSearch->limit(0, $limit_items) ; // fetch number of item for sitemap
    $aItems = $mSearch->doSearch(); 
    View::newInstance()->_exportVariableToView('items', $aItems); //exporting our searched item array

    if(osc_count_items() > 0) {
      $i = 0;
      while(osc_has_items() and $i < $limit_items and $i < $max_secure) {
        ais_sitemap_add_url(osc_item_url(), substr(osc_item_mod_date()!='' ? osc_item_mod_date() : osc_item_pub_date(), 0, 10), 'daily');
        $i++;
      }
    }
  }

  $end_xml = '</urlset>';
  file_put_contents($filename, $end_xml, FILE_APPEND);
  

  // PING SEARCH ENGINES
  ais_sitemap_ping_engines();
  
  // CALCULATE GENERATION TIME
  $time_elapsed = microtime(true) - $start_time;
  return $time_elapsed;
}



// ADD URL TO SITEMAP - HELP FUNCTION
function ais_sitemap_add_url($url = '', $date = '', $freq = 'daily') {
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



// PING SEARCH ENGINES WITH NEW SITEMAP - HELP FUNCTION
function ais_sitemap_ping_engines() {
  // GOOGLE
  osc_doRequest( 'http://www.google.com/webmasters/sitemaps/ping?sitemap='.urlencode(osc_base_url() . 'sitemap.xml'), array());
  // BING
  osc_doRequest( 'http://www.bing.com/webmaster/ping.aspx?siteMap='.urlencode(osc_base_url() . 'sitemap.xml'), array());
  // YAHOO!
  osc_doRequest( 'http://search.yahooapis.com/SiteExplorerService/V1/updateNotification?appid='.osc_page_title().'&url='.urlencode(osc_base_url() . 'sitemap.xml'), array());
}



// SITEMAP REFRESH FREQUENCY
$freq = osc_get_preference('sitemap_frequency', 'plugin-ais');
if( $freq == 1 ) {
  osc_add_hook('cron_weekly', 'ais_generate_sitemap');
} else if ( $freq == 2 ) {
  osc_add_hook('cron_daily', 'ais_generate_sitemap');
} else if ( $freq == 3 ) {
  osc_add_hook('cron_hourly', 'ais_generate_sitemap');
}

?>