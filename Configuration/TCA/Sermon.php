<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$TCA['tx_vmfdssermons_domain_model_sermon'] = array(
    'ctrl' => $TCA['tx_vmfdssermons_domain_model_sermon']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, subtitle, preached, description, notes_header, keypoints, questions, further_reading, prep, reference, keywords, image, image_source, no_handout, handout, audiorecording, videorecording, hashtags, cclicense, preacher, series, syncuid',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, subtitle, preached, description, --div--;Studienmaterial, reference, notes_header, keypoints, questions, further_reading, keywords,--div--;Vorbereitung, prep, --div--;Ressourcen, cclicense, image, image_source, no_handout, handout, audiorecording, videorecording, hashtags,--div--;Prediger, preacher,--div--;Reihe, series,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime, syncuid'),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
    'columns' => array(
        'sys_language_uid' => array(
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
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_vmfdssermons_domain_model_sermon',
                'foreign_table_where' => 'AND tx_vmfdssermons_domain_model_sermon.pid=###CURRENT_PID### AND tx_vmfdssermons_domain_model_sermon.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
        't3ver_label' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            )
        ),
        'hidden' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        'endtime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        'title' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.title',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'subtitle' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.subtitle',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'preached' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.preached',
            'config' => array(
                'type' => 'input',
                'size' => 7,
                'eval' => 'date',
                'checkbox' => 1,
                'default' => time()
            ),
        ),
        'description' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.description',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ),
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
        ),
        'notes_header' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.notes_header',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'keypoints' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.keypoints',
            'config' => array(
                'type' => 'text',
                'cols' => 80,
                'rows' => 5,
                'eval' => 'trim',
            ),
        ),
        'questions' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.questions',
            'config' => array(
                'type' => 'text',
                'cols' => 80,
                'rows' => 5,
                'eval' => 'trim',
            ),
        ),
        'further_reading' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.further_reading',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ),
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
        ),
        'prep' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.prep',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ),
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
        ),
        'reference' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.reference',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'keywords' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.keywords',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'image' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.image',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'file',
                'uploadfolder' => 'predigten/Titelbilder',
                'show_thumbs' => 1,
                'size' => 5,
                'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
                'disallowed' => '',
            ),
        ),
        'image_source' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.image_source',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'no_handout' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.no_handout',
            'config' => array(
                'type' => 'check',
                'default' => 0,
            ),
        ),
        'handout' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.handout',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'file',
                'uploadfolder' => 'predigten/Predigtzettel',
                'allowed' => 'pdf',
                'disallowed' => '',
                'size' => 5,
            ),
        ),
        'audiorecording' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.audiorecording',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'file_reference',
                'uploadfolder' => 'predigten/Aufnamen',
                'allowed' => 'mp3',
                'disallowed' => '',
                'size' => 5,
            ),
        ),
        'videorecording' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.videorecording',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'file_reference',
                'uploadfolder' => 'uploads/tx_vmfdssermons',
                'allowed' => '*',
                'disallowed' => 'php',
                'size' => 5,
            ),
        ),
        'hashtags' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.hashtags',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'cclicense' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.cclicense',
            'config' => array(
                'type' => 'check',
                'default' => 1,
            ),
        ),
        'preacher' => array(
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
        ),
        'series' => array(
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
        ),
        'syncuid' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.syncuid',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
    ),
);
?>