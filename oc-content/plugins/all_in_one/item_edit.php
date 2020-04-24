<?php 
  $detail = ModelSeo::newInstance()->getAttrByItemId($item_id); 
?>

<style>
  .add_item .s-minus {background: url('<?php echo osc_base_url();?>oc-content/plugins/all_in_one/css/icons.png') no-repeat;background-position:-432px -95px;width: 15px;height: 14px;float: left;margin-left: 0px;margin-top: 0px;margin-right: 5px;margin-bottom:0px}
  .add_item .s-plus {background: url('<?php echo osc_base_url();?>oc-content/plugins/all_in_one/css/icons.png') no-repeat;background-position:-407px -95px;width: 15px;height: 14px;float: left;margin-left: 0px;margin-top: 0px;margin-right: 5px;margin-bottom:0px}
  .seo_info {padding: 6px 0 0 0;color:#aaa;font-style:italic;}

  #show_hide_seo {cursor:pointer;}
  #seo_table, #seo_table table, #seo_table table tr {width:100%;float:left;clear:both;}
  #seo_table table tr {margin:3px 0;}
  #seo_table td.lab {max-width:25%;width:auto;float:left;min-width:100px}
  #seo_table td.inp {width:40%;float:left;margin:0 2%}
  #seo_table td.des {width:34%;float:left;margin-left:1%;font-size:12px;}
  #seo_table input {width:100%;max-width:100%;float:left;padding: 6px 5px}
  #seo_table label {width:100%;max-width:100%;float:left;padding: 3px 0 0 0;margin:0;}
</style>

<div style="clear:both"></div>
<div class="box"></div>
<h2 id="show_hide_seo"><div id="ic" class="s-plus"></div><span><?php _e('Meta Options (advanced)', 'all_in_one') ; ?></span></h2>
<div style="clear:both"></div>
<div id="seo_table">
<table>
  <tr>
    <td class="lab"><label for="seo_title"><?php _e('Title', 'all_in_one'); ?></label></td>
    <td class="inp">
      <input type="text" style="float:left;" name="seo_title" id="seo_title" value="<?php if($detail['seo_title'] != ''){echo $detail['seo_title']; } else { echo Params::getParam('seo_title'); } ?>" size="30" />
    </td>
    <td class="des"><div class="seo_info"><?php _e('Maximum 100 characters', 'all_in_one');?></div></td>
  </tr>
  <tr>
    <td class="lab"><label for="seo_desc"><?php _e('Description', 'all_in_one'); ?></label></td>
    <td class="inp">
      <input type="text" style="float:left;" name="seo_desc" id="seo_desc" value="<?php if($detail['seo_desc'] != ''){echo $detail['seo_desc']; } else { echo Params::getParam('seo_desc'); } ?>" size="30" />
    </td>
    <td class="des"><div class="seo_info"><?php _e('Maximum 500 characters', 'all_in_one');?></div></td>
  </tr>
  <tr>
    <td class="lab"><label for="seo_keywords"><?php _e('Keywords', 'all_in_one'); ?></label></td>
    <td class="inp">
      <input type="text" style="float:left;" name="seo_keywords" id="seo_keywords" value="<?php if($detail['seo_keywords'] != ''){echo $detail['seo_keywords']; } else { echo Params::getParam('seo_keywords'); } ?>" size="30" />
    </td>
    <td class="des"><div class="seo_info"><?php _e('Separate with comma', 'all_in_one');?></div></td>
  </tr>
</table>
</div>

<script type="text/javascript"> 
$(document).ready(function(){ 
  $("#seo_table").hide();
  $('#show_hide_seo').click(function(){
    if($('#show_hide_seo #ic').attr('class') == 's-minus') {
      $('#show_hide_seo #ic').addClass('s-plus').removeClass('s-minus');
    } else {
      $('#show_hide_seo #ic').addClass('s-minus').removeClass('s-plus');
    }
    $("#seo_table").slideToggle();
  }); 

  $('#show_hide_seo').click();
}); 
</script>

