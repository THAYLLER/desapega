<?php

$pluginInfo = osc_plugin_get_info('all_in_one/index.php');

// Get web domain, check also if there is subdomain
function get_domain($url) {
  $pieces = parse_url($url);
  $domain = isset($pieces['host']) ? $pieces['host'] : '';
  if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
    return $regs['domain'];
  }
  return false;
}

$web_url = 'http://www.' . get_domain(osc_base_url());

if ($web_url == osc_base_url()) { $sub_url = ''; } else { $sub_url = osc_base_url();}
?>

<div id="settings_form">
  <?php echo config_menu(); ?>

  <fieldset class="round3">
    <legend class="dark-red round2"><?php _e('Web Info','all_in_one'); ?></legend>
    <div class="left"><?php _e('Web Domain', 'all_in_one'); ?>:</div>
    <div class="right"><?php echo $web_url; ?></div>
    <div class="clear"></div>

    <?php if( $sub_url <> '' ) { ?>
      <div class="left"><?php _e('Sub Domain', 'all_in_one'); ?>:</div>
      <div class="right"><?php echo $sub_url; ?></div>
      <div class="clear"></div>
    <?php } ?>

    <div class="clear"></div>
    <br /><br /><br />

    <div class="title"><i class="fa fa-google"></i>&nbsp;<?php _e('Google', 'all_in_one'); ?></div>
    <div class="del"></div>
    
    <div class="tit"><?php _e('Info for domain', 'all_in_one'); ?> (<?php echo $web_url; ?>)</div>
    <div class="clear"></div><br />

    <div class="left"><?php _e('PageRank', 'all_in_one'); ?>:</div>
    <div class="right"><?php $pr = new PR(); echo $pr->get_google_pagerank($web_url); ?></div>
    <div class="clear"></div>

    <div class="left"><?php _e('BackLinks', 'all_in_one'); ?>:</div>
    <div class="right"><?php echo GoogleBL($web_url); ?></div>
    <div class="clear"></div>

    <div class="left"><?php _e('Indexed Pages', 'all_in_one'); ?>:</div>
    <div class="right"><?php echo GoogleIP($web_url); ?></div>
    <div class="clear"></div>

    <br /><br />

    <?php if( $sub_url <> '' ) { ?>
      <div class="tit"><?php _e('Info for subdomain', 'all_in_one'); ?> (<?php echo $sub_url; ?>)</div>
      <div class="clear"></div><br />

      <div class="left"><?php _e('PageRank', 'all_in_one'); ?>:</div>
      <div class="right"><?php $pr = new PR(); echo $pr->get_google_pagerank($sub_url); ?></div>
      <div class="clear"></div>

      <div class="left"><?php _e('BackLinks', 'all_in_one'); ?>:</div>
      <div class="right"><?php echo GoogleBL($sub_url); ?></div>
      <div class="clear"></div>

      <div class="left"><?php _e('Indexed Pages', 'all_in_one'); ?>:</div>
      <div class="right"><?php echo GoogleIP($sub_url); ?></div>
      <div class="clear"></div>
    <?php } ?>
    
    <?php
      // alexa rank
      $xml = simplexml_load_file('http://data.alexa.com/data?cli=10&dat=snbamz&url=' . $web_url);
      $rank = isset($xml->SD[1]->POPULARITY) ? $xml->SD[1]->POPULARITY->attributes()->TEXT : 0;
      $backlink=isset($xml->SD[0]->LINKSIN) ? (int)$xml->SD[0]->LINKSIN->attributes()->NUM : 0;
    ?>  
    
    <div class="clear"></div>
    <br /><br /><br />

    <div class="title"><i class="fa fa-dashboard"></i>&nbsp;<?php _e('Alexa', 'all_in_one'); ?></div>
    <div class="del"></div>
    
    <div class="left"><?php _e('Alexa Rank', 'all_in_one'); ?>:</div>
    <div class="right"><?php echo $rank_web; ?></div>
    <div class="clear"></div>

    <div class="left"><?php _e('BackLinks', 'all_in_one'); ?>:</div>
    <div class="right"><?php echo $backlink; ?></div>
    <div class="clear"></div>

    <?php 
      $obj=new shareCount($web_url);  //Use your website or URL
    ?>
    
    <div class="clear"></div>
    <br /><br /><br />

    <div class="title"><i class="fa fa-share-alt"></i>&nbsp;<?php _e('Social', 'all_in_one'); ?></div>
    <div class="del"></div>

    <div class="left"><?php _e('Tweets', 'all_in_one'); ?>:</div>
    <div class="right"><?php echo $obj->get_tweets(); ?></div>
    <div class="clear"></div>

    <div class="left"><?php _e('Facebook', 'all_in_one'); ?>:</div>
    <div class="right"><?php echo $obj->get_fb(); ?></div>
    <div class="clear"></div>

    <div class="left"><?php _e('LinkedIN', 'all_in_one'); ?>:</div>
    <div class="right"><?php echo $obj->get_linkedin(); ?></div>
    <div class="clear"></div>

    <div class="left"><?php _e('Google Plus', 'all_in_one'); ?>:</div>
    <div class="right"><?php echo $obj->get_plusones(); ?></div>
    <div class="clear"></div>

    <div class="left"><?php _e('Delicious', 'all_in_one'); ?>:</div>
    <div class="right"><?php echo $obj->get_delicious(); ?></div>
    <div class="clear"></div>

    <div class="left"><?php _e('Stumble', 'all_in_one'); ?>:</div>
    <div class="right"><?php echo $obj->get_stumble(); ?></div>
    <div class="clear"></div>

    <div class="clear"></div>
    <br /><br /><br />

    <div class="title"><i class="fa fa-share-alt"></i>&nbsp;<?php _e('Bot Detector', 'all_in_one'); ?></div>
    <div class="del"></div>
    <div class="clear"></div>

    <?php if (!botDetect()) { _e('Your site is not crawled by any spider (bot).', 'all_in_one'); } else { _e('Your site is crawled by <strong>', 'all_in_one') . botDetect() . '</strong>';} ?>

  </fieldset>

  <div class="clear"></div>
  <br /><br />

  <div class="warn"><?php _e('If your website is not running on subdomain, details for subdomain will be hidden.', 'all_in_one'); ?></div>
  <div class="warn"><?php _e('Numbers & Ranks shown here may be lower than are in real, therefore you should not believe it on 100%, it is just to give you orientation how your website is going.', 'all_in_one'); ?></div>
  <div class="warn"><?php _e('Parsing/getting values may sometimes fail (usually in rush hours), it means you will see only blank space instead of number. This is usually caused when scripts managing values are overloaded.', 'all_in_one'); ?></div>


</div>

<div class="clear"></div>
<br /><br />

<?php echo $pluginInfo['plugin_name'] . ' | ' . __('Version','all_in_one') . ' ' . $pluginInfo['version'] . ' | ' . __('Author','all_in_one') . ': ' . $pluginInfo['author'] . ' | Cannot be redistributed | &copy; ' . date('Y') . ' <a href="' . $pluginInfo['plugin_uri'] . '" target="_blank">MB Themes</a>'; ?>             

<?php
function botDetect() {
  $bots_list=array(
    "Google"=>"Googlebot",
    "Yahoo"=>"Slurp",
    "Bing"=>"bingbot"
  );

  $regexp='/'.  implode("|", $bots_list).'/';
  $ua=$_SERVER['HTTP_USER_AGENT'];
  if(preg_match($regexp, $ua,$matches)) {
    $bot=  array_search($matches[0], $bots_list);
    return $bot;
  } else {
    return false;
  }
}

?>