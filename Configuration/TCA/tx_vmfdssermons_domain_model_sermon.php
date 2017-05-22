<?php

/*
 * @package vmfds_sermons
 * @copyright Copyright (c) 2012-2016 Volksmission Freudenstadt
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License v3 or later
 * @site http://open.vmfds.de
 * @author Christoph Fischer <chris@toph.de>
 * @date 2016-06-04
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


if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$TCA['tx_vmfdssermons_domain_model_sermon'] = [
    'ctrl' => [
        'title' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY preached DESC',
        'dividers2tabs' => true,
        'versioningWS' => 2,
        'versioning_followPages' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,subtitle,preached,description,notes_header,keypoints,questions,further_reading,prep,reference,bible_text,keywords,image,image_preview,image_source,handout,audiorecording,videorecording,cclicense,preacher,series,syncuid,transcription',
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, subtitle, preached, description, notes_header, keypoints, questions, further_reading, prep, reference, bible_text, keywords, image, image_preview, image_source, no_handout, handout, audiorecording, remote_audio, videorecording, hashtags, cclicense, preacher, series, syncuid, slides, church, church_url, remote_url,transcription',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, subtitle, preached, description, --div--;Studienmaterial, reference, bible_text, notes_header, keypoints, questions, further_reading, keywords,--div--;Vorbereitung, prep, --div--;Ressourcen, cclicense, image, image_preview, image_source, no_handout, handout, audiorecording, remote_audio, videorecording, hashtags,--div--;Folien, slides, --div--;Prediger und Reihe, preacher, series,--div--;Mitschrift, transcription,--div--;Sync,syncuid, church, church_url, remote_url,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ],
                ],
                'default' => 0,
            ]
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_vmfdssermons_domain_model_sermon',
                'foreign_table_where' => 'AND tx_vmfdssermons_domain_model_sermon.pid=###CURRENT_PID### AND tx_vmfdssermons_domain_model_sermon.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ]
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'title' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'subtitle' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.subtitle',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'preached' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.preached',
            'config' => [
                'type' => 'input',
                'size' => 7,
                'eval' => 'date',
                'checkbox' => 1,
                'default' => time()
            ],
        ],
        'description' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ],
            'defaultExtras' => 'richtext[]',
        ],
        'notes_header' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.notes_header',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'keypoints' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.keypoints',
            'config' => [
                'type' => 'text',
                'cols' => 80,
                'rows' => 5,
                'eval' => 'trim',
            ],
        ],
        'questions' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.questions',
            'config' => [
                'type' => 'text',
                'cols' => 80,
                'rows' => 5,
                'eval' => 'trim',
            ],
        ],
        'further_reading' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.further_reading',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ],
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
        ],
        'prep' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.prep',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ],
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
        ],
        'reference' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.reference',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'bible_text' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.bible_text',
            'config' => [
                'type' => 'text',
                'cols' => 80,
                'rows' => 5,
                'eval' => 'trim',
            ],
        ],
        'keywords' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.keywords',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'image' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.image',
            'config' => [
                'type' => 'group',
                'internal_type' => 'file',
                'uploadfolder' => 'predigten/Titelbilder',
                'show_thumbs' => 1,
                'size' => 5,
                'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
                'disallowed' => '',
            ],
        ],
        'image_preview' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.image_preview',
            'config' => [
                'type' => 'group',
                'internal_type' => 'file',
                'uploadfolder' => 'predigten/Titelbilder',
                'show_thumbs' => 1,
                'size' => 5,
                'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
                'disallowed' => '',
            ],
        ],
        'image_source' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.image_source',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'no_handout' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.no_handout',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'handout' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.handout',
            'config' => [
                'type' => 'group',
                'internal_type' => 'file',
                'uploadfolder' => 'predigten/Predigtzettel',
                'allowed' => 'pdf',
                'disallowed' => '',
                'size' => 5,
            ],
        ],
        'audiorecording' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.audiorecording',
            'config' => [
                'type' => 'group',
                'internal_type' => 'file_reference',
                'uploadfolder' => 'predigten/Aufnamen',
                'allowed' => 'mp3',
                'disallowed' => '',
                'size' => 5,
            ],
        ],
        'remote_audio' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.remote_audio',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'videorecording' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.videorecording',
            'config' => [
                'type' => 'group',
                'internal_type' => 'file_reference',
                'uploadfolder' => 'uploads/tx_vmfdssermons',
                'allowed' => '*',
                'disallowed' => 'php',
                'size' => 5,
            ],
        ],
        'hashtags' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.hashtags',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'cclicense' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.cclicense',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'slides' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.slides',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_vmfdssermons_domain_model_slide',
                'foreign_field' => 'sermon_id',
                'foreign_sortby' => 'sorting',
                'appearance' => [
                    'collapseAll' => 1,
                ],
            ],
        ],
        'preacher' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.preacher',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_vmfdssermons_domain_model_preacher',
                'foreign_table' => 'tx_vmfdssermons_domain_model_preacher',
                'size' => 5,
                'minitems' => 0,
                'maxitems' => 3,
                'MM' => 'tx_vmfdssermons_sermon_preacher_mm',
                'wizards' => [
                    'suggest' => [
                        'type' => 'suggest',
                        'default' => [
                            'searchWholePhrase' => true
                        ]
                    ],
                ],
            ],
        ],
        'series' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.series',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_vmfdssermons_domain_model_series',
                'foreign_table' => 'tx_vmfdssermons_domain_model_series',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
                'MM' => 'tx_vmfdssermons_sermon_series_mm',
                'wizards' => [
                    'suggest' => [
                        'type' => 'suggest',
                        'default' => [
                            'searchWholePhrase' => true
                        ]
                    ],
                ],
            ],
        ],
        'syncuid' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.syncuid',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'church' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.church',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'church_url' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.church_url',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'remote_url' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.remote_url',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'transcription' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.transcription',
	        'config' => [
		        'type' => 'text',
		        'cols' => 40,
		        'rows' => 15,
		        'eval' => 'trim',
	        ],
	        'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
        ],
    ],
];

return $TCA['tx_vmfdssermons_domain_model_sermon'];