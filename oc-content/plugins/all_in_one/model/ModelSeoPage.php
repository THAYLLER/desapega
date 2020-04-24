<?php
class ModelSeoPage extends DAO {
  private static $instance ;

  public static function newInstance() {
    if( !self::$instance instanceof self ) {
      self::$instance = new self;
    }
    return self::$instance ;
  }


  function __construct() {
    parent::__construct();
  }
          

  public function getTable_SeoAttr() {
    return DB_TABLE_PREFIX.'t_pages_seo' ;
  }


  public function import($file) {
    $path = osc_plugin_resource($file) ;
    $sql = file_get_contents($path);

    if(! $this->dao->importSQL($sql) ){
      throw new Exception( "Error importSQL::ModelSeoPage<br>".$file ) ;
    }
  }


  public function uninstall() {
    $this->dao->query('DROP TABLE '. $this->getTable_SeoAttr());
  }
          

  public function getAttrByPageId( $page_id ) {
    $this->dao->select();
    $this->dao->from( $this->getTable_SeoAttr() );
    $this->dao->where('seo_page_id', $page_id );

    $result = $this->dao->get();
              
     if( !$result ) { return array(); }
              
    return $result->row();
  }


  public function insertAttr( $page_id, $title, $desc, $keywords ) {
    $aSet = array(
      'seo_title'  => $title,
      'seo_desc'  => $desc,
      'seo_keywords' => $keywords,
      'seo_page_id' => $page_id
    );

    return $this->dao->insert( $this->getTable_SeoAttr(), $aSet);
  }
          

  public function updateAttr( $page_id, $title, $desc, $keywords ) {
    $aSet = array(
      'seo_title'  => $title,
      'seo_desc'  => $desc,
      'seo_keywords' => $keywords,
      'seo_page_id' => $page_id
    );

    $aWhere = array( 'seo_page_id' => $page_id);

    return $this->_update($this->getTable_SeoAttr(), $aSet, $aWhere);
  }
          

  public function deletePage( $page_id ) {
    return $this->dao->delete($this->getTable_SeoAttr(), array('seo_page_id' => $page_id) ) ;
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