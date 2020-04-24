<?php
class ModelSeoLocation extends DAO {
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

  public function getTable_Country() {
    return DB_TABLE_PREFIX.'t_country';
  }

  public function getTable_Region() {
    return DB_TABLE_PREFIX.'t_region';
  }

  public function getTable_SeoCountry() {
    return DB_TABLE_PREFIX.'t_country_seo';
  }

  public function getTable_SeoRegion() {
    return DB_TABLE_PREFIX.'t_region_seo';
  }


  public function uninstall() {
    $this->dao->query('DROP TABLE '.$this->getTable_SeoCountry());
    $this->dao->query('DROP TABLE '.$this->getTable_SeoRegion());
  }


  public function getCountryList() {
    $this->dao->select();
    $this->dao->from( $this->getTable_Country() );

    $result = $this->dao->get();
    if( !$result ) { return array(); }

    $prepare = $result->result();
    return $prepare;
  }


  public function getRegionList($country_code = NULL) {
    $this->dao->select();
    $this->dao->from( $this->getTable_Region() );

    if($country_code <> '') {
      $this->dao->where( 'fk_c_country_code', $country_code );
    }

    $result = $this->dao->get();
    if( !$result ) { return array(); }

    $prepare = $result->result();
    return $prepare;
  }

  public function getAttrByCountryCode( $country_code ) {
    $this->dao->select();
    $this->dao->from( $this->getTable_SeoCountry() );
    $this->dao->where('seo_country_code', $country_code );

    $result = $this->dao->get();
              
     if( !$result ) { return array(); }
              
    return $result->row();
  }

  public function getAttrByRegionId( $region_id ) {
    $this->dao->select();
    $this->dao->from( $this->getTable_SeoRegion() );
    $this->dao->where('seo_region_id', $region_id );

    $result = $this->dao->get();
              
     if( !$result ) { return array(); }
              
    return $result->row();
  }

  public function deleteCountry( $country_code ) {
    return $this->dao->delete($this->getTable_SeoCountry(), array('seo_country_code' => $country_code) ) ;
  }

  public function deleteRegion( $region_id ) {
    return $this->dao->delete($this->getTable_SeoRegion(), array('seo_region_id' => $region_id) ) ;
  }

  public function insertCtrAttr( $country_code, $title, $desc, $keywords ) {
    $aSet = array(
      'seo_title'  => $title,
      'seo_desc'  => $desc,
      'seo_keywords' => $keywords,
      'seo_country_code' => $country_code
    );

    return $this->dao->insert( $this->getTable_SeoCountry(), $aSet);
  }
  
  public function insertRegAttr( $region_id, $title, $desc, $keywords ) {
    $aSet = array(
      'seo_title'  => $title,
      'seo_desc'  => $desc,
      'seo_keywords' => $keywords,
      'seo_region_id' => $region_id
    );

    return $this->dao->insert( $this->getTable_SeoRegion(), $aSet);
  }  

  public function updateCtrAttr( $country_code, $title, $desc, $keywords ) {
    $aSet = array(
      'seo_title'  => $title,
      'seo_desc'  => $desc,
      'seo_keywords' => $keywords,
      'seo_country_code' => $country_code
    );

    $aWhere = array( 'seo_country_code' => $country_code);

    return $this->_update($this->getTable_SeoCountry(), $aSet, $aWhere);
  }
  
  public function updateRegAttr( $region_id, $title, $desc, $keywords ) {
    $aSet = array(
      'seo_title'  => $title,
      'seo_desc'  => $desc,
      'seo_keywords' => $keywords,
      'seo_region_id' => $region_id
    );

    $aWhere = array( 'seo_region_id' => $region_id);

    return $this->_update($this->getTable_SeoRegion(), $aSet, $aWhere);
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