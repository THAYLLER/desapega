<?php
  $detail = ModelAisItem::newInstance()->findByItemId($item_id); 

  $title = isset($detail['s_title']) ? $detail['s_title'] : '';
  $description = isset($detail['s_description']) ? $detail['s_description'] : '';
?>


<h2><?php _e('Meta Tags', 'all_in_one') ; ?></h2>

<div class="control-group">
  <label class="control-label" for="ais_meta_title"><?php _e('Meta Title', 'all_in_one');?></label>
  <div class="controls">
    <input type="text" name="ais_meta_title" id="ais_meta_title" value="<?php echo ( $title <> '' ? $title : Params::getParam('ais_meta_title') ); ?>" size="30" />
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="ais_meta_description"><?php _e('Meta Description', 'all_in_one');?></label>
  <div class="controls">
    <input type="text" name="ais_meta_description" id="ais_meta_description" value="<?php echo ( $description <> '' ? $description : Params::getParam('ais_meta_description') ); ?>" size="30" />
  </div>
</div>