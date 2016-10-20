<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'PITS.' . $_EXTKEY,
	'Pitsgooglecse',
	'Google CSE'
);

$pluginSignature = str_replace('_','',$_EXTKEY) . '_pitsgooglecse';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_pitsgooglecse.xml');

$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['Tx_Google_Cse_WizzardIcon'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Classes/Utility/Wizard.php';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Google CSE');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_pitsgooglecse_domain_model_search', 'EXT:pits_googlecse/Resources/Private/Language/locallang_csh_tx_pitsgooglecse_domain_model_search.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pitsgooglecse_domain_model_search');

//\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . "Classes/Utility/Fetchlanguage.php";

//Adding custom style sheets to the backend

$GLOBALS['TBE_STYLES']['skins'][$_EXTKEY] = array(
        'name' => 'Skin',
        'stylesheetDirectories' => array(
            'css' => 'EXT:pits_googlecse/Resources/Public/Css/'
        )
    );