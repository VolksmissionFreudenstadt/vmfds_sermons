<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'TYPO3.' . $_EXTKEY,
	'Sermons',
	array(
		'Sermon' => 'list, show, byLatestSeries, previewNext',
		'Series' => 'list, show, latest',
		'Preacher' => 'list, show',
		
	),
	// non-cacheable actions
	array(
		'Preacher' => 'update',
		
	)
);

?>