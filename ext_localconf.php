<?php

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

\FluidTYPO3\Flux\Core::registerProviderExtensionKey('VMFDS.VmfdsSermons', 'Content');


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('TYPO3\\VmfdsSermons\\Property\\TypeConverters\\PersistentSermonConverter');
