<?php
class ModelSeo extends DAO {
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
          
  public function getTable_SeoAttr() {
    return DB_TABLE_PREFIX.'t_item_seo';
  }


  public function import($file) {
    $path = osc_plugin_resource($file) ;
    $sql = file_get_contents($path);
    if(!$this->dao->importSQL($sql)){ throw new Exception("Error importSQL::ModelSeo<br>".$file.'<br>'.$path.'<br><br>Please check your database for tables t_item_seo, t_pages_seo, t_categories_seo, t_links_seo, t_region_seo, t_country_seo. <br>If any of those tables exists in your database, delete them!');}
  }


  public function uninstall() {
    $this->dao->query('DROP TABLE '.$this->getTable_SeoAttr());
  }


  public function getAttrByItemId( $item_id ) {
    $this->dao->select();
    $this->dao->from( $this->getTable_SeoAttr() );
    $this->dao->where('seo_item_id', $item_id );

    $result = $this->dao->get();
    if( !$result ) { return array(); }
              
    return $result->row();
  }


  public function insertAttr( $item_id, $title, $desc, $keywords ) {
    $aSet = array(
      'seo_title'  => $title,
      'seo_desc'  => $desc,
      'seo_keywords' => $keywords,
      'seo_item_id' => $item_id
    );

    return $this->dao->insert( $this->getTable_SeoAttr(), $aSet);
  }
          

  public function updateAttr( $item_id, $title, $desc, $keywords ) {
    $aSet = array(
      'seo_title'  => $title,
      'seo_desc'  => $desc,
      'seo_keywords' => $keywords,
      'seo_item_id' => $item_id
    );

    $aWhere = array( 'seo_item_id' => $item_id);

    return $this->_update($this->getTable_SeoAttr(), $aSet, $aWhere);
  }

       
  public function deleteItem( $item_id ) {
    return $this->dao->delete($this->getTable_SeoAttr(), array('seo_item_id' => $item_id) );
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