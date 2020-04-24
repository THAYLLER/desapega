<?php
class ModelAisLink extends DAO {
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

  public function getTable_BackLinks() {
    return DB_TABLE_PREFIX.'t_ais_back_links' ;
  }
  
  public function getTable_RecLinks() {
    return DB_TABLE_PREFIX.'t_ais_reciprocal_links' ;
  }


  public function uninstall() {
    $this->dao->query('DROP TABLE '. $this->getTable_BackLinks());
    $this->dao->query('DROP TABLE '. $this->getTable_RecLinks());
  }



  // BACKLINKS SECTION       
  public function getAllBackLinks() {
    $this->dao->select();
    $this->dao->from( $this->getTable_BackLinks() );

    $result = $this->dao->get();
    if( !$result ) { return array(); }
    $prepare = $result->result();
    return $prepare;
  }


  public function findBackLinkById( $link_id ) {
    $this->dao->select();
    $this->dao->from( $this->getTable_BackLinks() );
    $this->dao->where('pk_i_id', $link_id );

    $result = $this->dao->get();
    if( !$result ) { return array(); }
    return $result->row();
  }


  public function insertBackLink( $title, $url, $footer, $nofollow = NULL ) {
    $aSet = array(
      's_title'  => $title,
      's_url'  => $url,
      'i_footer'  => $footer,
      'i_nofollow'  => $nofollow
    );

    return $this->dao->insert( $this->getTable_BackLinks(), $aSet);
  }


  public function updateBackLink( $link_id, $title, $url, $footer, $nofollow ) {
    $aSet = array(
      's_title'  => $title,
      's_url'  => $url,
      'i_footer'  => $footer,
      'i_nofollow'  => $nofollow
    );

    $aWhere = array( 'pk_i_id' => $link_id );
    return $this->_update($this->getTable_BackLinks(), $aSet, $aWhere);
  }


  public function deleteBackLink( $link_id ) {
    return $this->dao->delete($this->getTable_BackLinks(), array('pk_i_id' => $link_id) ) ;
  }

  


  // RECIPROCAL LINKS SECTION
  public function getAllRecLinks() {
    $this->dao->select();
    $this->dao->from( $this->getTable_RecLinks() );

    $result = $this->dao->get();
    if( !$result ) { return array(); }
    $prepare = $result->result();
    return $prepare;
  }

  
  public function getRecLinkById( $link_id ) {
    $this->dao->select();
    $this->dao->from( $this->getTable_RecLinks() );
    $this->dao->where('pk_i_id', $link_id );

    $result = $this->dao->get();
    if( !$result ) { return array(); }
    return $result->row();
  }

  
  public function insertRecLink( $your_url, $link_url, $owner_email) {
    $aSet = array(
      's_your_url'  => $your_url,
      's_link_url'  => $link_url,
      's_email'  => $owner_email
    );

    return $this->dao->insert( $this->getTable_RecLinks(), $aSet);
  }


  public function updateRecLink( $link_id, $your_url, $link_url, $owner_email) {
    $aSet = array(
      's_your_url'  => $your_url,
      's_link_url'  => $link_url,
      's_email'  => $owner_email
    );

    $aWhere = array('pk_i_id' => $link_id);
    return $this->_update($this->getTable_RecLinks(), $aSet, $aWhere);
  }


  public function updateRecLinkStatus( $link_id, $status ) {
    $aSet = array('i_status'  => $status);
    $aWhere = array('pk_i_id' => $link_id);
    return $this->_update($this->getTable_RecLinks(), $aSet, $aWhere);
  }

  
  public function deleteRecLink( $link_id ) {
    return $this->dao->delete($this->getTable_RecLinks(), array('pk_i_id' => $link_id) ) ;
  }
       

   
  // update
  function _update($table, $values, $where) {
    $this->dao->from($table) ;
    $this->dao->set($values) ;
    $this->dao->where($where) ;
    return $this->dao->update() ;
  }
}
?>