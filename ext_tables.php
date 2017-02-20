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

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        $_EXTKEY, 'Sermons', 'Sermons'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Sermons');


foreach (['sermon', 'preacher', 'series', 'slide', 'feed'] as $model) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_vmfdssermons_domain_model_'.$model, 'EXT:vmfds_sermons/Resources/Private/Language/locallang_csh_tx_vmfdssermons_domain_model_'.$model.'.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_vmfdssermons_domain_model_'.$model);
}

$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = 'vmfdssermons_sermons';

$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:vmfds_sermons/Configuration/FlexForms/flexform_sermons.xml');

