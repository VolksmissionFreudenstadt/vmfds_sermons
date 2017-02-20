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

//defined('TYPO3_MODE') or die('Access denied.');

$TCA['tx_vmfdssermons_domain_model_feed'] = [
    'ctrl' => [
        'title' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_feed',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
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
        'searchFields' => 'title,url,church,church_url',
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, url, church, church_url',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, url, church, church_url,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'],
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
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1
                    ],
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.default_value',
                        0
                    ]
                ],
            ],
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
                'foreign_table' => 'tx_vmfdssermons_domain_model_feed',
                'foreign_table_where' => 'AND tx_vmfdssermons_domain_model_feed.pid=###CURRENT_PID### AND tx_vmfdssermons_domain_model_feed.sys_language_uid IN (-1,0)',
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
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_feed.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'url' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_feed.url',
            'config' => [
                'type' => 'input',
                'size' => 120,
            ],
        ],
        'church' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_feed.church',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'church_url' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_feed.churchUrl',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
    ],
];

return $TCA['tx_vmfdssermons_domain_model_feed'];