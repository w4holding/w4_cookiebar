CREATE TABLE tt_content (
  w4_cookiebar_position varchar(6) DEFAULT 'top' NOT NULL,
  w4_cookiebar_text varchar(510) DEFAULT '' NOT NULL,
  w4_cookiebar_button_text varchar(255) DEFAULT '' NOT NULL,
  w4_cookiebar_datenschutz_text varchar(255) DEFAULT '' NOT NULL,
  w4_cookiebar_datenschutz_link varchar(255) DEFAULT '' NOT NULL,
  w4_cookiebar_edit int(1) unsigned DEFAULT '0' NOT NULL,
  w4_cookiebar_wrapper_options varchar(100) DEFAULT 'marketing' NOT NULL,
);
