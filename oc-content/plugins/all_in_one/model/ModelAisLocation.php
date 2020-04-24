<?php
class ModelAisLocation extends DAO {
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


  public function getTable_City() {
    return DB_TABLE_PREFIX.'t_city';
  }


  public function getTable_CountryMeta() {
    return DB_TABLE_PREFIX.'t_ais_country_meta';
  }


  public function getTable_RegionMeta() {
    return DB_TABLE_PREFIX.'t_ais_region_meta';
  }


  public function uninstall() {
    $this->dao->query('DROP TABLE '.$this->getTable_CountryMeta());
    $this->dao->query('DROP TABLE '.$this->getTable_RegionMeta());
  }


  public function getSampleLocation() {
    $this->dao->select('ct.s_name as country_name, r.s_name as region_name, c.s_name as city_name');
    $this->dao->from( $this->getTable_Country() . ' ct, ' . $this->getTable_Region() . ' r, ' .$this->getTable_City() . ' c' );
    $this->dao->where('r.fk_c_country_code = ct.pk_c_code AND c.fk_i_region_id = r.pk_i_id' );

    $result = $this->dao->get();
    if( !$result ) { return array(); }
    return $result->row();
  }




  // COUNTRY RELATED CODE

  public function getCountryList() {
    $this->dao->select();
    $this->dao->from( $this->getTable_Country() );

    $result = $this->dao->get();
    if( !$result ) { return array(); }
    $prepare = $result->result();
    return $prepare;
  }


  public function findByCountryCode( $country_code, $locale = NULL ) {
    $this->dao->select();
    $this->dao->from( $this->getTable_CountryMeta() );
    $this->dao->where('fk_c_country_code', $country_code );

    if( isset($locale) && $locale <> '' ) {
      $this->dao->where('fk_c_locale_code', $locale );
    } else {
      $this->dao->where('fk_c_locale_code', ais_get_locale() );
    }

    $result = $this->dao->get();
    if( !$result ) { return array(); }
    return $result->row();
  }


  public function findByCountryName( $country_name, $locale = NULL  ) {
    $this->dao->select();
    $this->dao->from( $this->getTable_CountryMeta() . ' m, ' . $this->getTable_Country() . ' r' );
    $this->dao->where('m.fk_c_country_code = r.pk_c_code');
    $this->dao->where('r.s_name', $country_name);

    if( isset($locale) && $locale <> '' ) {
      $this->dao->where('fk_c_locale_code', $locale );
    } else {
      $this->dao->where('fk_c_locale_code', ais_get_locale() );
    }

    $result = $this->dao->get();
    if( !$result ) { return array(); }
    return $result->row();
  }


  public function insertCountryMeta( $country_code, $title, $description ) {
    $aSet = array(
      'fk_c_country_code' => $country_code,
      'fk_c_locale_code' => ais_get_locale(),
      's_title'  => $title,
      's_description'  => $description
    );

    return $this->dao->insert( $this->getTable_CountryMeta(), $aSet);
  }


  public function updateCountryMeta( $country_code, $title, $description ) {
    $aSet = array(
      's_title'  => $title,
      's_description'  => $description
    );

    $aWhere = array( 'fk_c_country_code' => $country_code, 'fk_c_locale_code' => ais_get_locale() );
    return $this->_update($this->getTable_CountryMeta(), $aSet, $aWhere);
  }


  public function deleteCountryMeta( $country_code ) {
    return $this->dao->delete($this->getTable_CountryMeta(), array('fk_c_country_code' => $country_code) ) ;
  }


  


  // REGION RELATED CODE

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


  public function findByRegionId( $region_id, $locale = NULL ) {
    $this->dao->select();
    $this->dao->from( $this->getTable_RegionMeta() );
    $this->dao->where('fk_i_region_id', $region_id );

    if( isset($locale) && $locale <> '' ) {
      $this->dao->where('fk_c_locale_code', $locale );
    } else {
      $this->dao->where('fk_c_locale_code', ais_get_locale() );
    }

    $result = $this->dao->get();
    if( !$result ) { return array(); }
    return $result->row();
  }


  public function findByRegionName( $region_name, $country_name = NULL, $locale = NULL ) {
    $this->dao->select();

    if( isset($country_name) && $country_name <> '' ) {
      $this->dao->from( $this->getTable_RegionMeta() . ' m, ' . $this->getTable_Region() . ' r, ' . $this->getTable_Country() . ' c' );
      $this->dao->where('m.fk_i_region_id = r.pk_i_id');
      $this->dao->where('r.fk_c_country_code = c.pk_c_code');
      $this->dao->where('r.s_name', $region_name);
      $this->dao->where('c.s_name', $country_name);
    } else {
      $this->dao->from( $this->getTable_RegionMeta() . ' m, ' . $this->getTable_Region() . ' r' );
      $this->dao->where('m.fk_i_region_id = r.pk_i_id');
      $this->dao->where('r.s_name', $region_name);
    }

    if( isset($locale) && $locale <> '' ) {
      $this->dao->where('fk_c_locale_code', $locale );
    } else {
      $this->dao->where('fk_c_locale_code', ais_get_locale() );
    }

    $result = $this->dao->get();
    if( !$result ) { return array(); }
    return $result->row();
  }


  public function insertRegionMeta( $region_id, $title, $description ) {
    $aSet = array(
      'fk_i_region_id' => $region_id,
      'fk_c_locale_code' => ais_get_locale(),
      's_title'  => $title,
      's_description'  => $description
    );

    return $this->dao->insert( $this->getTable_RegionMeta(), $aSet);
  }  


  public function updateRegionMeta( $region_id, $title, $description ) {
    $aSet = array(
      's_title'  => $title,
      's_description'  => $description
    );

    $aWhere = array( 'fk_i_region_id' => $region_id, 'fk_c_locale_code' => ais_get_locale() );
    return $this->_update($this->getTable_RegionMeta(), $aSet, $aWhere);
  }


  public function deleteRegionMeta( $region_id ) {
    return $this->dao->delete($this->getTable_RegionMeta(), array('fk_i_region_id' => $region_id) ) ;
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