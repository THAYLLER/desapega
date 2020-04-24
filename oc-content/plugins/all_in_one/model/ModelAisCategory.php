<?php
class ModelAisCategory extends DAO {
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
      
  
  public function getTable_Category() {
    return DB_TABLE_PREFIX.'t_category' ;
  }


  public function getTable_CategoryMeta() {
    return DB_TABLE_PREFIX.'t_ais_category_meta' ;
  }


  public function uninstall() {
    $this->dao->query('DROP TABLE '. $this->getTable_CategoryMeta());
  }


  public function getLastCategoryId() {
    $this->dao->select('pk_i_id');
    $this->dao->from( $this->getTable_Category() );

    $result = $this->dao->get();      
    if( !$result ) { return array(); }
    return $result->row();
  }


  public function findByCategoryId( $category_id, $locale = NULL ) {
    $this->dao->select();
    $this->dao->from( $this->getTable_CategoryMeta() );
    $this->dao->where('fk_i_category_id', $category_id );

    if( isset($locale) && $locale <> '' ) {
      $this->dao->where('fk_c_locale_code', $locale );
    } else {
      $this->dao->where('fk_c_locale_code', ais_get_locale() );
    }

    $result = $this->dao->get();      
    if( !$result ) { return array(); }
    return $result->row();
  }


  public function insertCategoryMeta( $category_id, $title, $description ) {
    $aSet = array(
      'fk_i_category_id' => $category_id,
      'fk_c_locale_code' => ais_get_locale(),
      's_title' => $title,
      's_description' => $description
    );

    return $this->dao->insert( $this->getTable_CategoryMeta(), $aSet);
  }


  public function updateCategoryMeta( $category_id, $title, $description ) {
    $aSet = array(
      's_title'  => $title,
      's_description' => $description
    );

    $aWhere = array( 'fk_i_category_id' => $category_id, 'fk_c_locale_code' => ais_get_locale() );
    return $this->_update($this->getTable_CategoryMeta(), $aSet, $aWhere);
  }
 

  public function deleteCategoryMeta( $category_id ) {
    return $this->dao->delete($this->getTable_CategoryMeta(), array('fk_i_category_id' => $category_id) ) ;
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