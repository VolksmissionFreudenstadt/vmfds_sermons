#
# Table structure for table 'tx_vmfdssermons_domain_model_sermon'
#
CREATE TABLE tx_vmfdssermons_domain_model_sermon (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	subtitle text NOT NULL,
	preached int(11) DEFAULT '0' NOT NULL,
	description text NOT NULL,
	notes_header varchar(255) DEFAULT '' NOT NULL,
	keypoints text NOT NULL,
	questions text NOT NULL,
	further_reading text NOT NULL,
	prep text NOT NULL,
	reference varchar(255) DEFAULT '' NOT NULL,
	keywords varchar(255) DEFAULT '' NOT NULL,
	image text NOT NULL,
	image_source varchar(255) DEFAULT '' NOT NULL,
        no_handout tinyint(4) unsigned DEFAULT '0' NOT NULL,
	handout text NOT NULL,
	audiorecording text NOT NULL,
	videorecording text NOT NULL,
	cclicense tinyint(4) unsigned DEFAULT '0' NOT NULL,
        hashtags varchar(255) DEFAULT '' NOT NULL,
        slides int(11) unsigned DEFAULT '0' NOT NULL,
	preacher int(11) unsigned DEFAULT '0' NOT NULL,
	series int(11) unsigned DEFAULT '0' NOT NULL,
        syncuid varchar(255) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_vmfdssermons_domain_model_preacher'
#
CREATE TABLE tx_vmfdssermons_domain_model_preacher (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,
	first_name varchar(255) DEFAULT '' NOT NULL,
	last_name varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	organization varchar(255) DEFAULT '' NOT NULL,
	url varchar(255) DEFAULT '' NOT NULL,
	blog varchar(255) DEFAULT '' NOT NULL,
	facebook_id varchar(255) DEFAULT '' NOT NULL,
        twitter varchar(255) DEFAULT '' NOT NULL,
	about text NOT NULL,
	image text NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_vmfdssermons_domain_model_series'
#
CREATE TABLE tx_vmfdssermons_domain_model_series (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	subtitle text NOT NULL,
	startdate int(11) DEFAULT '0' NOT NULL,
	enddate int(11) DEFAULT '0' NOT NULL,
	description text NOT NULL,
	image text NOT NULL,
        hashtags varchar(255) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_vmfdssermons_sermon_preacher_mm'
#
CREATE TABLE tx_vmfdssermons_sermon_preacher_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_vmfdssermons_sermon_series_mm'
#
CREATE TABLE tx_vmfdssermons_sermon_series_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);


#
# Table structure for table 'tx_vmfdssermons_domain_model_slide'
#
CREATE TABLE tx_vmfdssermons_domain_model_slide (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

        sermon_id INT(11) DEFAULT '0' NOT NULL,
        sorting INT(11) DEFAULT '0' NOT NULL,
        title varchar(255) DEFAULT '' NOT NULL,
	image text NOT NULL,
        image_source varchar(255) DEFAULT '' NOT NULL,
        bible_text text NOT NULL,
        preacher_notes text NOT NULL,
        tech_notes text NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)
);