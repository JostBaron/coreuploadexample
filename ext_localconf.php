<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'JostBaron.' . $_EXTKEY,
    'ResourceExample',
    array(
        'Example' => 'list, show, new, create, edit, update, delete',
    ),
    // non-cacheable actions
    array(
        'Example' => 'list, show, new, create, edit, update, delete',
    )
);