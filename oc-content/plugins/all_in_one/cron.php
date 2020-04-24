<?php
  define( 'ABS_PATH', dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/' ) ;
  require_once( ABS_PATH . 'oc-load.php' ) ;
  require_once( osc_content_path() . 'plugins/all_in_one/sitemap_generator.php' ) ;

  $done = ais_generate_sitemap();
  echo __('Sitemap generated in', 'all_in_one') . ' ' . $done . ' ' . __('seconds', 'all_in_one');
?>