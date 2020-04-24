<?php
class ModelSeoCategory extends DAO {
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
    return DB_TABLE_PREFIX.'t_categories_seo' ;
  }

          
  public function import($file) {
    $path = osc_plugin_resource($file) ;
    $sql = file_get_contents($path);

    if(! $this->dao->importSQL($sql) ){
      throw new Exception( "Error importSQL::ModelSeoCategory<br>".$file ) ;
    }
  }

          
  public function uninstall() {
    $this->dao->query('DROP TABLE '. $this->getTable_SeoAttr());
  }


  public function getAttrByCategoryId( $category_id ) {
    $this->dao->select();
    $this->dao->from( $this->getTable_SeoAttr() );
    $this->dao->where('seo_category_id', $category_id );

    $result = $this->dao->get();
              
     if( !$result ) { return array(); }
              
    return $result->row();
  }


  public function insertAttr( $category_id, $title, $desc, $keywords ) {
    $aSet = array(
      'seo_title'  => $title,
      'seo_desc'  => $desc,
      'seo_keywords' => $keywords,
      'seo_category_id' => $category_id
    );

    return $this->dao->insert( $this->getTable_SeoAttr(), $aSet);
  }
          

  public function updateAttr( $category_id, $title, $desc, $keywords ) {
    $aSet = array(
      'seo_title'  => $title,
      'seo_desc'  => $desc,
      'seo_keywords' => $keywords,
      'seo_category_id' => $category_id
    );

    $aWhere = array( 'seo_category_id' => $category_id);

    return $this->_update($this->getTable_SeoAttr(), $aSet, $aWhere);
  }
          

  public function deleteCategory( $category_id ) {
    return $this->dao->delete($this->getTable_SeoAttr(), array('seo_category_id' => $category_id) ) ;
  }
          
  // update
  function _update($table, $values, $where)   {
    $this->dao->from($table) ;
    $this->dao->set($values) ;
    $this->dao->where($where) ;
    return $this->dao->update() ;
  }
}
?>