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

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'TYPO3.' . $_EXTKEY, 'Sermons', array(
    'Sermon' => 'show, list, showLatest, byLatestSeries, previewNext, audioUploadWelcome, audioUploadDone, byDate, presentation, edit, update',
    'Series' => 'show, list, latest',
    'Preacher' => 'show, list, feed, admin, edit, update',
    'Slide' => 'show, list',
        ),
        // non-cacheable actions
        array(
    'Sermon' => 'audioUploadWelcome, audioUploadDone, update',
    'Preacher' => 'update',
        )
);



\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('TYPO3\\VmfdsSermons\\Property\\TypeConverters\\PersistentSermonConverter');


// CLI Command
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'TYPO3\VmfdsSermons\Command\SermonCommandController';


