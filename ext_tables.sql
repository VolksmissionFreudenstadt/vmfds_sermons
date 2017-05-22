/* 
 * @package vmfds_sermons
 * @copyright Copyright (c) 2012-2016 Volksmission Freudenstadt
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License v3 or later
 * @site http://open.vmfds.de
 * @author Christoph Fischer <chris@toph.de>
 * @date 2016-06-06
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */


#
# Table structure for table 'tx_vmfdssermons_domain_model_sermon'
#
CREATE TABLE tx_vmfdssermons_domain_model_sermon (

  uid              INT(11)                         NOT NULL AUTO_INCREMENT,
  pid              INT(11) DEFAULT '0'             NOT NULL,

  title            VARCHAR(255) DEFAULT ''         NOT NULL,
  subtitle         TEXT                            NOT NULL,
  preached         INT(11) DEFAULT '0'             NOT NULL,
  description      TEXT                            NOT NULL,
  notes_header     VARCHAR(255) DEFAULT ''         NOT NULL,
  keypoints        TEXT                            NOT NULL,
  questions        TEXT                            NOT NULL,
  further_reading  TEXT                            NOT NULL,
  prep             TEXT                            NOT NULL,
  reference        VARCHAR(255) DEFAULT ''         NOT NULL,
  bible_text       TEXT                            NOT NULL,
  keywords         VARCHAR(255) DEFAULT ''         NOT NULL,
  image            TEXT                            NOT NULL,
  image_preview    TEXT                            NOT NULL,
  image_source     VARCHAR(255) DEFAULT ''         NOT NULL,
  no_handout       TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  handout          TEXT                            NOT NULL,
  audiorecording   TEXT                            NOT NULL,
  remote_audio     VARCHAR(255) DEFAULT ''         NOT NULL,
  videorecording   TEXT                            NOT NULL,
  cclicense        TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  hashtags         VARCHAR(255) DEFAULT ''         NOT NULL,
  slides           INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  preacher         INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  series           INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  syncuid          VARCHAR(255) DEFAULT ''         NOT NULL,
  church           VARCHAR(255) DEFAULT ''         NOT NULL,
  church_url       VARCHAR(255) DEFAULT ''         NOT NULL,
  remote_url       VARCHAR(255) DEFAULT ''         NOT NULL,
  transcription    TEXT                            NOT NULL,

  tstamp           INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  crdate           INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  cruser_id        INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  deleted          TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  hidden           TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  starttime        INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  endtime          INT(11) UNSIGNED DEFAULT '0'    NOT NULL,

  t3ver_oid        INT(11) DEFAULT '0'             NOT NULL,
  t3ver_id         INT(11) DEFAULT '0'             NOT NULL,
  t3ver_wsid       INT(11) DEFAULT '0'             NOT NULL,
  t3ver_label      VARCHAR(255) DEFAULT ''         NOT NULL,
  t3ver_state      TINYINT(4) DEFAULT '0'          NOT NULL,
  t3ver_stage      INT(11) DEFAULT '0'             NOT NULL,
  t3ver_count      INT(11) DEFAULT '0'             NOT NULL,
  t3ver_tstamp     INT(11) DEFAULT '0'             NOT NULL,
  t3ver_move_id    INT(11) DEFAULT '0'             NOT NULL,

  t3_origuid       INT(11) DEFAULT '0'             NOT NULL,
  sys_language_uid INT(11) DEFAULT '0'             NOT NULL,
  l10n_parent      INT(11) DEFAULT '0'             NOT NULL,
  l10n_diffsource  MEDIUMBLOB,

  PRIMARY KEY (uid),
  KEY parent (pid),
  KEY t3ver_oid (t3ver_oid, t3ver_wsid),
  KEY language (l10n_parent, sys_language_uid)

);

#
# Table structure for table 'tx_vmfdssermons_domain_model_preacher'
#
CREATE TABLE tx_vmfdssermons_domain_model_preacher (

  uid              INT(11)                         NOT NULL AUTO_INCREMENT,
  pid              INT(11) DEFAULT '0'             NOT NULL,

  name             VARCHAR(255) DEFAULT ''         NOT NULL,
  first_name       VARCHAR(255) DEFAULT ''         NOT NULL,
  last_name        VARCHAR(255) DEFAULT ''         NOT NULL,
  email            VARCHAR(255) DEFAULT ''         NOT NULL,
  organization     VARCHAR(255) DEFAULT ''         NOT NULL,
  url              VARCHAR(255) DEFAULT ''         NOT NULL,
  blog             VARCHAR(255) DEFAULT ''         NOT NULL,
  facebook_id      VARCHAR(255) DEFAULT ''         NOT NULL,
  twitter          VARCHAR(255) DEFAULT ''         NOT NULL,
  about            TEXT                            NOT NULL,
  image            TEXT                            NOT NULL,
  user_id          INT(11)                         NULL     DEFAULT NULL,
  mic              VARCHAR(255) DEFAULT ''         NOT NULL,
  pulpit           TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  ppt              TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  laptop           TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  travel_cost      VARCHAR(255) DEFAULT ''         NOT NULL,
  account_holder   VARCHAR(255) DEFAULT ''         NOT NULL,
  iban             VARCHAR(255) DEFAULT ''         NOT NULL,
  bic              VARCHAR(255) DEFAULT ''         NOT NULL,

  tstamp           INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  crdate           INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  cruser_id        INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  deleted          TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  hidden           TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  starttime        INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  endtime          INT(11) UNSIGNED DEFAULT '0'    NOT NULL,

  t3ver_oid        INT(11) DEFAULT '0'             NOT NULL,
  t3ver_id         INT(11) DEFAULT '0'             NOT NULL,
  t3ver_wsid       INT(11) DEFAULT '0'             NOT NULL,
  t3ver_label      VARCHAR(255) DEFAULT ''         NOT NULL,
  t3ver_state      TINYINT(4) DEFAULT '0'          NOT NULL,
  t3ver_stage      INT(11) DEFAULT '0'             NOT NULL,
  t3ver_count      INT(11) DEFAULT '0'             NOT NULL,
  t3ver_tstamp     INT(11) DEFAULT '0'             NOT NULL,
  t3ver_move_id    INT(11) DEFAULT '0'             NOT NULL,

  t3_origuid       INT(11) DEFAULT '0'             NOT NULL,
  sys_language_uid INT(11) DEFAULT '0'             NOT NULL,
  l10n_parent      INT(11) DEFAULT '0'             NOT NULL,
  l10n_diffsource  MEDIUMBLOB,

  PRIMARY KEY (uid),
  KEY parent (pid),
  KEY t3ver_oid (t3ver_oid, t3ver_wsid),
  KEY language (l10n_parent, sys_language_uid)

);

#
# Table structure for table 'tx_vmfdssermons_domain_model_series'
#
CREATE TABLE tx_vmfdssermons_domain_model_series (

  uid              INT(11)                         NOT NULL AUTO_INCREMENT,
  pid              INT(11) DEFAULT '0'             NOT NULL,

  title            VARCHAR(255) DEFAULT ''         NOT NULL,
  subtitle         TEXT                            NOT NULL,
  startdate        INT(11) DEFAULT '0'             NOT NULL,
  enddate          INT(11) DEFAULT '0'             NOT NULL,
  description      TEXT                            NOT NULL,
  image            TEXT                            NOT NULL,
  image_preview    TEXT                            NOT NULL,
  image_source     VARCHAR(255) DEFAULT ''         NOT NULL,
  hashtags         VARCHAR(255) DEFAULT ''         NOT NULL,

  tstamp           INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  crdate           INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  cruser_id        INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  deleted          TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  hidden           TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  starttime        INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  endtime          INT(11) UNSIGNED DEFAULT '0'    NOT NULL,

  t3ver_oid        INT(11) DEFAULT '0'             NOT NULL,
  t3ver_id         INT(11) DEFAULT '0'             NOT NULL,
  t3ver_wsid       INT(11) DEFAULT '0'             NOT NULL,
  t3ver_label      VARCHAR(255) DEFAULT ''         NOT NULL,
  t3ver_state      TINYINT(4) DEFAULT '0'          NOT NULL,
  t3ver_stage      INT(11) DEFAULT '0'             NOT NULL,
  t3ver_count      INT(11) DEFAULT '0'             NOT NULL,
  t3ver_tstamp     INT(11) DEFAULT '0'             NOT NULL,
  t3ver_move_id    INT(11) DEFAULT '0'             NOT NULL,

  t3_origuid       INT(11) DEFAULT '0'             NOT NULL,
  sys_language_uid INT(11) DEFAULT '0'             NOT NULL,
  l10n_parent      INT(11) DEFAULT '0'             NOT NULL,
  l10n_diffsource  MEDIUMBLOB,

  PRIMARY KEY (uid),
  KEY parent (pid),
  KEY t3ver_oid (t3ver_oid, t3ver_wsid),
  KEY language (l10n_parent, sys_language_uid)

);

#
# Table structure for table 'tx_vmfdssermons_sermon_preacher_mm'
#
CREATE TABLE tx_vmfdssermons_sermon_preacher_mm (
  uid_local       INT(11) UNSIGNED DEFAULT '0' NOT NULL,
  uid_foreign     INT(11) UNSIGNED DEFAULT '0' NOT NULL,
  sorting         INT(11) UNSIGNED DEFAULT '0' NOT NULL,
  sorting_foreign INT(11) UNSIGNED DEFAULT '0' NOT NULL,

  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_vmfdssermons_sermon_series_mm'
#
CREATE TABLE tx_vmfdssermons_sermon_series_mm (
  uid_local       INT(11) UNSIGNED DEFAULT '0' NOT NULL,
  uid_foreign     INT(11) UNSIGNED DEFAULT '0' NOT NULL,
  sorting         INT(11) UNSIGNED DEFAULT '0' NOT NULL,
  sorting_foreign INT(11) UNSIGNED DEFAULT '0' NOT NULL,

  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_vmfdssermons_domain_model_slide'
#
CREATE TABLE tx_vmfdssermons_domain_model_slide (

  uid                    INT(11)                         NOT NULL AUTO_INCREMENT,
  pid                    INT(11) DEFAULT '0'             NOT NULL,

  sermon_id              INT(11) DEFAULT '0'             NOT NULL,
  sorting                INT(11) DEFAULT '0'             NOT NULL,
  title                  VARCHAR(255) DEFAULT ''         NOT NULL,
  presentation_title     VARCHAR(255) DEFAULT ''         NOT NULL,
  presentation_font_size INT(11) UNSIGNED DEFAULT '60'   NOT NULL,
  image                  TEXT                            NOT NULL,
  image_source           VARCHAR(255) DEFAULT ''         NOT NULL,
  bible_text             TEXT                            NOT NULL,
  story                  TEXT                            NOT NULL,
  preacher_notes         TEXT                            NOT NULL,
  tech_notes             TEXT                            NOT NULL,

  tstamp                 INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  crdate                 INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  cruser_id              INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  deleted                TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  hidden                 TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  starttime              INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  endtime                INT(11) UNSIGNED DEFAULT '0'    NOT NULL,

  t3ver_oid              INT(11) DEFAULT '0'             NOT NULL,
  t3ver_id               INT(11) DEFAULT '0'             NOT NULL,
  t3ver_wsid             INT(11) DEFAULT '0'             NOT NULL,
  t3ver_label            VARCHAR(255) DEFAULT ''         NOT NULL,
  t3ver_state            TINYINT(4) DEFAULT '0'          NOT NULL,
  t3ver_stage            INT(11) DEFAULT '0'             NOT NULL,
  t3ver_count            INT(11) DEFAULT '0'             NOT NULL,
  t3ver_tstamp           INT(11) DEFAULT '0'             NOT NULL,
  t3ver_move_id          INT(11) DEFAULT '0'             NOT NULL,

  t3_origuid             INT(11) DEFAULT '0'             NOT NULL,
  sys_language_uid       INT(11) DEFAULT '0'             NOT NULL,
  l10n_parent            INT(11) DEFAULT '0'             NOT NULL,
  l10n_diffsource        MEDIUMBLOB,

  PRIMARY KEY (uid),
  KEY parent (pid),
  KEY t3ver_oid (t3ver_oid, t3ver_wsid),
  KEY language (l10n_parent, sys_language_uid)
);

#
# Table structure for table 'tx_vmfdssermons_domain_model_feed'
#
CREATE TABLE tx_vmfdssermons_domain_model_feed (

  uid              INT(11)                         NOT NULL AUTO_INCREMENT,
  pid              INT(11) DEFAULT '0'             NOT NULL,

  title            VARCHAR(255) DEFAULT ''         NOT NULL,
  url              VARCHAR(255) DEFAULT ''         NOT NULL,
  church           VARCHAR(255) DEFAULT ''         NOT NULL,
  church_url       VARCHAR(255) DEFAULT ''         NOT NULL,

  tstamp           INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  crdate           INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  cruser_id        INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  deleted          TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  hidden           TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  starttime        INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  endtime          INT(11) UNSIGNED DEFAULT '0'    NOT NULL,

  t3ver_oid        INT(11) DEFAULT '0'             NOT NULL,
  t3ver_id         INT(11) DEFAULT '0'             NOT NULL,
  t3ver_wsid       INT(11) DEFAULT '0'             NOT NULL,
  t3ver_label      VARCHAR(255) DEFAULT ''         NOT NULL,
  t3ver_state      TINYINT(4) DEFAULT '0'          NOT NULL,
  t3ver_stage      INT(11) DEFAULT '0'             NOT NULL,
  t3ver_count      INT(11) DEFAULT '0'             NOT NULL,
  t3ver_tstamp     INT(11) DEFAULT '0'             NOT NULL,
  t3ver_move_id    INT(11) DEFAULT '0'             NOT NULL,

  t3_origuid       INT(11) DEFAULT '0'             NOT NULL,
  sys_language_uid INT(11) DEFAULT '0'             NOT NULL,
  l10n_parent      INT(11) DEFAULT '0'             NOT NULL,
  l10n_diffsource  MEDIUMBLOB,

  PRIMARY KEY (uid),
  KEY parent (pid),
  KEY t3ver_oid (t3ver_oid, t3ver_wsid),
  KEY language (l10n_parent, sys_language_uid)

);
