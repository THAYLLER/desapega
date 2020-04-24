<?php
class ModelSeoLink extends DAO {
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
    return DB_TABLE_PREFIX.'t_links_seo' ;
  }
  
  public function getTable_SeoRec() {
    return DB_TABLE_PREFIX.'t_links_rec_seo' ;
  }

  public function getTable_Page() {
    return DB_TABLE_PREFIX.'t_pages';
  }

  public function import($file) {
    $path = osc_plugin_resource($file) ;
    $sql = file_get_contents($path);

    if(! $this->dao->importSQL($sql) ){
      throw new Exception( "Error importSQL::ModelSeoLink<br>".$file ) ;
    }
  }

  public function uninstall() {
    $this->dao->query('DROP TABLE '. $this->getTable_SeoAttr());
    $this->dao->query('DROP TABLE '. $this->getTable_SeoRec());
  }

  public function getPages() {
    $this->dao->select('pk_i_id');
    $this->dao->from( $this->getTable_Page() );
    $this->dao->where('s_internal_name like "seo_%"');

    $result = $this->dao->get();

    if( !$result ) { return array(); }
    $prepare = $result->result();
    return $prepare;
  }
          
  public function getAllLinks() {
    $this->dao->select();
    $this->dao->from( $this->getTable_SeoAttr() );

    $result = $this->dao->get();
    if( !$result ) { return array(); }
    $prepare = $result->result();
    return $prepare;
  }
  
  public function getAllRecLinks() {
    $this->dao->select();
    $this->dao->from( $this->getTable_SeoRec() );

    $result = $this->dao->get();
    if( !$result ) { return array(); }
    $prepare = $result->result();
    return $prepare;
  }

  public function getAttrByLinkId( $link_id ) {
    $this->dao->select();
    $this->dao->from( $this->getTable_SeoAttr() );
    $this->dao->where('seo_link_id', $link_id );

    $result = $this->dao->get();
    if( !$result ) { return array(); }
    return $result->row();
  }
  
  public function getRecLinkById( $link_id ) {
    $this->dao->select();
    $this->dao->from( $this->getTable_SeoRec() );
    $this->dao->where('seo_link_id', $link_id );

    $result = $this->dao->get();
    if( !$result ) { return array(); }
    return $result->row();
  }

  public function insertAttr( $link_id, $title, $href, $footer, $rel ) {
    $aSet = array(
      'seo_title'  => $title,
      'seo_href'  => $href,
      'seo_footer'  => $footer,
      'seo_rel'  => $rel,
      'seo_link_id' => $link_id
    );

    return $this->dao->insert( $this->getTable_SeoAttr(), $aSet);
  }
  
  public function insertRec( $link_id, $href_to, $href_from, $contact, $status = NULL ) {
    $aSet = array(
      'seo_link_id'  => $link_id,
      'seo_href_to'  => $href_to,
      'seo_href_from'  => $href_from,
      'seo_contact'  => $contact,
      'seo_status'  => $status
    );

    return $this->dao->insert( $this->getTable_SeoRec(), $aSet);
  }

  public function updateAttr( $link_id, $title, $href, $footer, $rel ) {
    $aSet = array(
      'seo_title'  => $title,
      'seo_href'  => $href,
      'seo_footer'  => $footer,
      'seo_rel'  => $rel,
      'seo_link_id' => $link_id
    );

    $aWhere = array( 'seo_link_id' => $link_id);
    return $this->_update($this->getTable_SeoAttr(), $aSet, $aWhere);
  }

  public function updateRec( $link_id, $href_to, $href_from, $contact ) {
    $aSet = array(
      'seo_link_id'  => $link_id,
      'seo_href_to'  => $href_to,
      'seo_href_from'  => $href_from,
      'seo_contact'  => $contact
    );

    $aWhere = array( 'seo_link_id' => $link_id);
    return $this->_update($this->getTable_SeoRec(), $aSet, $aWhere);
  }

  public function updateRecStatus( $link_id, $status ) {
    $aSet = array('seo_status'  => $status);
    $aWhere = array( 'seo_link_id' => $link_id);
    return $this->_update($this->getTable_SeoRec(), $aSet, $aWhere);
  }

  public function deleteLink( $link_id ) {
    return $this->dao->delete($this->getTable_SeoAttr(), array('seo_link_id' => $link_id) ) ;
  }
  
  public function deleteLinkRec( $link_id ) {
    return $this->dao->delete($this->getTable_SeoRec(), array('seo_link_id' => $link_id) ) ;
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