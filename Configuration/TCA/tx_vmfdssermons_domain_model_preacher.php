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


defined('TYPO3_MODE') or die('Access denied.');


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_vmfdssermons_domain_model_preacher', 'EXT:vmfds_sermons/Resources/Private/Language/locallang_csh_tx_vmfdssermons_domain_model_preacher.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_vmfdssermons_domain_model_preacher');

$TCA['tx_vmfdssermons_domain_model_preacher'] = [
    'ctrl' => [
        'title' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher',
        'label' => 'name',
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
        'searchFields' => 'name,first_name,last_name,email,organization,url,blog,facebook_id,about,image,',
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, first_name, last_name, email, organization, url, blog, facebook_id, twitter, about, image, user_id, mic, pulpit, ppt, laptop, travel_cost, account_holder, iban, bic',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, first_name, last_name, email, organization, url, blog, facebook_id, twitter, about, image,--div--;Administration,user_id,--div--;Technik,mic, pulpit, ppt, laptop, --div--;Buchhaltung,travel_cost, account_holder, iban, bic,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'],
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
                'foreign_table' => 'tx_vmfdssermons_domain_model_preacher',
                'foreign_table_where' => 'AND tx_vmfdssermons_domain_model_preacher.pid=###CURRENT_PID### AND tx_vmfdssermons_domain_model_preacher.sys_language_uid IN (-1,0)',
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
        'name' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'first_name' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.first_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'last_name' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.last_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'email' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.email',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'organization' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.organization',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'url' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.url',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'blog' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.blog',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'facebook_id' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.facebook_id',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'twitter' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.twitter',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'about' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.about',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ],
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
        ],
        'image' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.image',
            'config' => [
                'type' => 'group',
                'internal_type' => 'file',
                'uploadfolder' => 'uploads/tx_vmfdssermons',
                'show_thumbs' => 1,
                'size' => 5,
                'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
                'disallowed' => '',
            ],
        ],
        'user_id' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.user_id',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [['', 0]],
                'foreign_table' => 'fe_users',
                'minitems' => 0,
                'maxitems' => 1,
                'appearance' => [
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],
        ],
        'mic' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.mic',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'pulpit' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.pulpit',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'ppt' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.ppt',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'laptop' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.laptop',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'travel_cost' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.travel_cost',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'account_holder' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.account_holder',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'iban' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.iban',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'bic' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_preacher.bic',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
    ],
];

return $TCA['tx_vmfdssermons_domain_model_preacher'];