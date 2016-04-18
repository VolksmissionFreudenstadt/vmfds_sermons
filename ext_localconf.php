<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'TYPO3.' . $_EXTKEY, 'Sermons', array(
    'Sermon' => 'show, list, showLatest, byLatestSeries, previewNext, audioUploadWelcome, audioUploadDone, byDate',
    'Series' => 'show, list, latest',
    'Preacher' => 'show, list, feed',
        ),
        // non-cacheable actions
        array(
    'Sermon' => 'audioUploadWelcome, audioUploadDone',
    'Preacher' => 'update',
        )
);

\FluidTYPO3\Flux\Core::registerProviderExtensionKey('VMFDS.VmfdsSermons', 'Content');
