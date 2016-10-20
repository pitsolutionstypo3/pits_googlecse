<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'PITS.' . $_EXTKEY,
    'Pitsgooglecse',
    array(
        'Search' => 'default, searchbox, results',

    ),
    // non-cacheable actions
    array(
        'Search' => '',

    )
);

// Modify flexform values
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_befunc.php']['getFlexFormDSClass']['pits_googlecse'] = 
    \PITS\Pitsgooglecse\Hooks\BackendUtility::class;