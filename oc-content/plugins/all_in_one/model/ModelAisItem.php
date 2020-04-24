<?php
class ModelAisItem extends DAO {
  private static $instance ;

  public static function newInstance() {
    if( !self::$instance instanceof self ) {
      self::$instance = new self ;
    }
    return self::$instance ;
  }

  function __construct() {
   parent::__construct();
  }
     

  public function getTable_Item() {
    return DB_TABLE_PREFIX.'t_item';
  }

     
  public function getTable_ItemMeta() {
    return DB_TABLE_PREFIX.'t_ais_item_meta';
  }


  public function import($file) {
    $path = osc_plugin_resource($file) ;
    $sql = file_get_contents($path);
    if(!$this->dao->importSQL($sql)){ throw new Exception("Error importSQL::ModelAisItem<br>".$file.'<br>'.$path.'<br><br>Please check your database for tables t_ais_item_meta, t_ais_pages_meta, t_ais_category_meta, t_ais_back_link, t_ais_reciprocal_link, t_ais_region_meta, t_ais_country_meta. <br>If any of those tables exists in your database, delete them!');}
  }


  public function uninstall() {
    $this->dao->query('DROP TABLE ' . $this->getTable_ItemMeta());
  }


  public function getLastItemId() {
    $this->dao->select('pk_i_id');
    $this->dao->from( $this->getTable_Item() );

    $result = $this->dao->get();
    if( !$result ) { return array(); }
    return $result->row();
  }


  public function findByItemId( $item_id, $locale = NULL ) {
    $this->dao->select();
    $this->dao->from( $this->getTable_ItemMeta() );
    $this->dao->where( 'fk_i_item_id', $item_id );

    if( isset($locale) && $locale <> '' ) {
      $this->dao->where('fk_c_locale_code', $locale );
    } else {
      $this->dao->where('fk_c_locale_code', osc_current_user_locale() );
    }

    $result = $this->dao->get();
    if( !$result ) { return array(); }
    return $result->row();
  }


  public function insertItemMeta( $item_id, $title, $description ) {
    $aSet = array(
      'fk_i_item_id' => $item_id,
      'fk_c_locale_code' => osc_current_user_locale(),
      's_title'  => $title,
      's_description'  => $description
    );

    return $this->dao->insert( $this->getTable_ItemMeta(), $aSet);
  }
          

  public function updateItemMeta( $item_id, $title, $description ) {
    $aSet = array(
      's_title'  => $title,
      's_description'  => $description
    );

    $aWhere = array( 'fk_i_item_id' => $item_id, 'fk_c_locale_code' => osc_current_user_locale() );

    return $this->_update($this->getTable_ItemMeta(), $aSet, $aWhere);
  }

       
  public function deleteItemMeta( $item_id ) {
    return $this->dao->delete($this->getTable_ItemMeta(), array('fk_i_item_id' => $item_id) );
  }

          
  // update
  function _update($table, $values, $where) {
    $this->dao->from($table);
    $this->dao->set($values);
    $this->dao->where($where);
    return $this->dao->update();
  }
}
?>