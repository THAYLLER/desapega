DROP TABLE IF EXISTS /*TABLE_PREFIX*/t_ais_item_meta;
CREATE TABLE /*TABLE_PREFIX*/t_ais_item_meta (
fk_i_item_id INT UNSIGNED NOT NULL,
fk_c_locale_code CHAR(5) NOT NULL,
s_title VARCHAR(500),
s_description VARCHAR(800),

PRIMARY KEY (fk_i_item_id, fk_c_locale_code)
) ENGINE=InnoDB DEFAULT CHARACTER SET 'UTF8' COLLATE 'UTF8_GENERAL_CI';



DROP TABLE IF EXISTS /*TABLE_PREFIX*/t_ais_pages_meta;
CREATE TABLE /*TABLE_PREFIX*/t_ais_pages_meta (
fk_i_page_id INT UNSIGNED NOT NULL,
fk_c_locale_code CHAR(5) NOT NULL,
s_title VARCHAR(500),
s_description VARCHAR(800),

PRIMARY KEY (fk_i_page_id, fk_c_locale_code)
) ENGINE=InnoDB DEFAULT CHARACTER SET 'UTF8' COLLATE 'UTF8_GENERAL_CI';



DROP TABLE IF EXISTS /*TABLE_PREFIX*/t_ais_category_meta;
CREATE TABLE /*TABLE_PREFIX*/t_ais_category_meta (
fk_i_category_id INT UNSIGNED NOT NULL,
fk_c_locale_code CHAR(5) NOT NULL,
s_title VARCHAR(500),
s_description VARCHAR(800),

PRIMARY KEY (fk_i_category_id, fk_c_locale_code)
) ENGINE=InnoDB DEFAULT CHARACTER SET 'UTF8' COLLATE 'UTF8_GENERAL_CI';



DROP TABLE IF EXISTS /*TABLE_PREFIX*/t_ais_country_meta;
CREATE TABLE /*TABLE_PREFIX*/t_ais_country_meta (
fk_c_country_code CHAR(2) NOT NULL,
fk_c_locale_code CHAR(5) NOT NULL,
s_title VARCHAR(500),
s_description VARCHAR(800),

PRIMARY KEY (fk_c_country_code, fk_c_locale_code)
) ENGINE=InnoDB DEFAULT CHARACTER SET 'UTF8' COLLATE 'UTF8_GENERAL_CI';



DROP TABLE IF EXISTS /*TABLE_PREFIX*/t_ais_region_meta;
CREATE TABLE /*TABLE_PREFIX*/t_ais_region_meta (
fk_i_region_id INT UNSIGNED NOT NULL,
fk_c_locale_code CHAR(5) NOT NULL,
s_title VARCHAR(500),
s_description VARCHAR(800),

PRIMARY KEY (fk_i_region_id, fk_c_locale_code)
) ENGINE=InnoDB DEFAULT CHARACTER SET 'UTF8' COLLATE 'UTF8_GENERAL_CI';



DROP TABLE IF EXISTS /*TABLE_PREFIX*/t_ais_back_links;
CREATE TABLE /*TABLE_PREFIX*/t_ais_back_links (
pk_i_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
s_title VARCHAR(500),
s_url VARCHAR(800),
i_footer INT(1),
i_nofollow INT(1),

PRIMARY KEY (pk_i_id)
) ENGINE=InnoDB DEFAULT CHARACTER SET 'UTF8' COLLATE 'UTF8_GENERAL_CI';



DROP TABLE IF EXISTS /*TABLE_PREFIX*/t_ais_reciprocal_links;
CREATE TABLE /*TABLE_PREFIX*/t_ais_reciprocal_links (
pk_i_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
s_your_url VARCHAR(500),
s_link_url VARCHAR(500),
s_email VARCHAR(100),
i_status INT(1),

PRIMARY KEY (pk_i_id)
) ENGINE=InnoDB DEFAULT CHARACTER SET 'UTF8' COLLATE 'UTF8_GENERAL_CI';
