<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_vmfdssermons_domain_model_sermon'] = array(
	'ctrl' => $TCA['tx_vmfdssermons_domain_model_sermon']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, subtitle, preached, description, keypoints, questions, further_reading, reference, keywords, image, image_source, handout, audiorecording, videorecording, preacher, series',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, subtitle, preached, description, --div--;Studienmaterial, reference, keypoints, questions, further_reading, keywords,--div--;Ressourcen, image, image_source, handout, audiorecording, videorecording,--div--;Prediger, preacher,--div--;Reihe, series,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
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
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
			'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
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
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
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
		'preacher' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.preacher',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vmfdssermons_domain_model_preacher',
				'MM' => 'tx_vmfdssermons_sermon_preacher_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_vmfdssermons_domain_model_preacher',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'series' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vmfds_sermons/Resources/Private/Language/locallang_db.xlf:tx_vmfdssermons_domain_model_sermon.series',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vmfdssermons_domain_model_series',
				'MM' => 'tx_vmfdssermons_sermon_series_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_vmfdssermons_domain_model_series',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
	),
);

?>