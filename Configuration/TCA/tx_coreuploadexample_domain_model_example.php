<?php
$_EXTKEY = 'coreuploadexample';
return array(
	'ctrl' => array(
		'title'	=> 'Core upload example - domain model',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/tx_coreuploadexample_domain_model_example.php'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, image',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, image,image_collection,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(

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
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'Title',
			'config' => array(
				'type' => 'input',
				'max' => 20,
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'image' => array(
			'exclude' => 0,
			'label' => 'Image',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('image', array(
				'maxitems' => 1,
				// custom configuration for displaying fields in the overlay/reference table
				// to use the imageoverlayPalette instead of the basicoverlayPalette
				'foreign_match_fields' => array(
					'fieldname' => 'image',
					'tablenames' => 'tx_coreuploadexample_domain_model_example',
					'table_local' => 'sys_file',
				),
			), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'])
		),
		'image_collection' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:coreuploadexample/Resources/Private/Language/locallang_db.xlf:tx_uploadexample_domain_model_example.image_collection',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('image_collection', array(
				// custom configuration for displaying fields in the overlay/reference table
				// to use the imageoverlayPalette instead of the basicoverlayPalette
				'foreign_match_fields' => array(
					'fieldname' => 'image_collection',
					'tablenames' => 'tx_coreuploadexample_domain_model_example',
					'table_local' => 'sys_file',
				),
			), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'])
		),
	),
);
