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
return array(
    'ctrl' => $TCA['tx_vmfdssermons_domain_model_slide']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, presentation_title, presentation_font_size, image, image_source, story, bible_text, preacher_notes, tech_notes',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, presentation_title, presentation_font_size, image, image_source, story, bible_text, preacher_notes, tech_notes'),
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
                'foreign_table' => 'tx_vmfdssermons_domain_model_slide',
                'foreign_table_where' => 'AND tx_vmfdssermons_domain_model_slide.pid=###CURRENT_PID### AND tx_vmfdssermons_domain_model_slide.sys_language_uid IN (-1,0)',
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
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_slide.title',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'presentation_title' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_slide.presentation_title',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'presentation_font_size' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_slide.presentation_font_size',
            'config' => array(
                'type' => 'input',
                'default' => '40',
                'size' => 30,
                'eval' => 'trim,int'
            ),
        ),
        'image' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_slide.image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('image', array('maxitems' => 1), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
        ),
        'image_source' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_slide.image_source',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'story' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_slide.story',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ),
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
        ),
        'bible_text' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_slide.bible_text',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ),
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
        ),
        'preacher_notes' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_slide.preacher_notes',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ),
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
        ),
        'tech_notes' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_slide.tech_notes',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ),
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
        ),
    ),
);

