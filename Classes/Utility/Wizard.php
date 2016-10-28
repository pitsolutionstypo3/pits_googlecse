<?php


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Anu Bhuvanendran Nair <anu.bn@pitsolutions.com>, PIT Solutions
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Utility to add the Google CSE Icon to Element Wizard
 *
 * @package Utility
 * @author Anu Bhuvanendran Nair
 */
class Tx_Google_Cse_WizzardIcon
{
    /**
     * Processing the wizard items array
     *
     * @param	array		$wizardItems: The wizard items
     * @return	Modified array with wizard items
     */
    public function proc($wizardItems)
    {
        $llFile = ExtensionManagementUtility::extPath('pits_googlecse').'Resources/Private/Language/locallang.xlf:';

        $wizardItems['plugins_tx_pits_googlecse_pi1'] = array(
            'icon'            => ExtensionManagementUtility::extRelPath('pits_googlecse') . 'Resources/Public/Icons/google_cse_32.png',
            'title'            => LocalizationUtility::translate('tx_googlecse_wizard.title', 'pits_googlecse'),
            'description'    => LocalizationUtility::translate('tx_googlecse_wizard.description', 'pits_googlecse'),
            'params'        => '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=pitsgooglecse_pitsgooglecse'
        );

        return $wizardItems;
    }
}
