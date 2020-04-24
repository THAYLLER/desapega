<?php
class ModelAisPage extends DAO {
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


  public function getTable_Page() {
    return DB_TABLE_PREFIX.'t_pages';
  }


  public function getTable_PageMeta() {
    return DB_TABLE_PREFIX.'t_ais_pages_meta' ;
  }


  public function getEmailPages() {
    $this->dao->select('pk_i_id');
    $this->dao->from( $this->getTable_Page() );
    $this->dao->where('s_internal_name like "ais_%"');

    $result = $this->dao->get();

    if( !$result ) { return array(); }
    $prepare = $result->result();
    return $prepare;
  }


  public function uninstall() {
    $this->dao->query('DROP TABLE '. $this->getTable_PageMeta());
  }
          

  public function findByPageId( $page_id, $locale = NULL ) {
    $this->dao->select();
    $this->dao->from( $this->getTable_PageMeta() );
    $this->dao->where('fk_i_page_id', $page_id );

    if( isset($locale) && $locale <> '' ) {
      $this->dao->where('fk_c_locale_code', $locale );
    } else {
      $this->dao->where('fk_c_locale_code', ais_get_locale() );
    }

    $result = $this->dao->get();
    if( !$result ) { return array(); }
    return $result->row();
  }


  public function insertPageMeta( $page_id, $title, $description ) {
    $aSet = array(
      'fk_i_page_id' => $page_id,
      'fk_c_locale_code' => ais_get_locale(),
      's_title'  => $title,
      's_description'  => $description
    );

    return $this->dao->insert( $this->getTable_PageMeta(), $aSet);
  }
          

  public function updatePageMeta( $page_id, $title, $description ) {
    $aSet = array(
      's_title'  => $title,
      's_description'  => $description
    );

    $aWhere = array( 'fk_i_page_id' => $page_id, 'fk_c_locale_code' => ais_get_locale() );
    return $this->_update($this->getTable_PageMeta(), $aSet, $aWhere);
  }
          

  public function deletePageMeta( $page_id ) {
    return $this->dao->delete($this->getTable_PageMeta(), array('fk_i_page_id' => $page_id) ) ;
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