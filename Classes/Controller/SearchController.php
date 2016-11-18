<?php
namespace PITS\PitsGooglecse\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;

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

/**
 * SearchController
 */
class SearchController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * searchRepository
     *
     * @var \PITS\PitsGooglecse\Domain\Repository\SearchRepository
     * @inject
     */
    protected $searchRepository = NULL;

    /**
     * action default
     *
     * @return void
     */
    public function defaultAction() {
        $settings = $this->settings;
        if($settings['flexform']['lang']=='**') {
            $settings['flexform']['lang']='en';
        }
        if(!$settings['flexform']['theme']){
            $settings['flexform']['theme'] = 'google.loader.themes.V2_DEFAULT';
        }
        $style = $settings['flexform']['theme'];
        switch($style){
            case "google.loader.themes.V2_DEFAULT" :
            $this->response->addAdditionalHeaderData('<link rel="stylesheet" type="text/css" href="typo3conf/ext/pits_googlecse/Resources/Public/Css/Default.css" media="all">');
            break;
        }
        $this->view->assign('values', $settings);
    }

    /**
     * action searchbox
     *
     * @return void
     */
    public function searchboxAction() {
        $settings = $this->settings;
        if ($settings['flexform']['lang']=='**') {
            $settings['flexform']['lang']='en';
        }
        if(!$settings['flexform']['theme']){
            $settings['flexform']['theme'] = 'google.loader.themes.V2_DEFAULT';
        }
        $style = $settings['flexform']['theme'];
        switch ($style){
            case "google.loader.themes.V2_DEFAULT" :
            $this->response->addAdditionalHeaderData('<link rel="stylesheet" type="text/css" href="typo3conf/ext/pits_googlecse/Resources/Public/Css/Default.css" media="all">');
            break;
        }
        //Resultant url generation
        $resultid = $this->pickResult();
        $url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        $url = explode('id=',$url);
        $url[1]=strstr($url[1], '&');
        $url = $url[0].'id='.$resultid.$url[1];
        $this->view->assign('values', $settings);
        $this->view->assign('url', $url);
    }

    /**
     * action results
     *
     * @return void
     */
    public function resultsAction() {
        $settings = $this->settings;

        $this->view->assign('values', $settings);
    }

    /**
     * Method for identifying result block page
     * @return void
     */
    public function pickResult() { 
        
        $res1 =$GLOBALS['TYPO3_DB']->sql_query("SELECT uid,pid, pi_flexform FROM tt_content WHERE list_type='pitsgooglecse_pitsgooglecse' AND deleted=0 AND hidden=0");
        while ($obj = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res1)){
            $inarray2[] = $obj;
        }

        $site_root = $GLOBALS['TSFE']->rootLine[0]['uid'];

        foreach ($inarray2 as $key => $value){
            $temp = GeneralUtility::xml2array($value['pi_flexform']);
            $inarray2[$key]['pi_flexform']=$temp['data']['sDEF']['lDEF']['switchableControllerActions']['vDEF'];
            $inarray2[$key]['root'] = $this->isRoot($inarray2[$key]['pid']);
            if ($inarray2[$key]['pi_flexform']!='Search->results' || $inarray2[$key]['root']!=$site_root) {
                unset($inarray2[$key]);
            }
        }

        $inarray2 = array_values($inarray2);
        return $inarray2[0]['pid'];
    }

    /**
     * Method for finding the siteroot recursievely
     * @return void
     */
    public function isRoot($var) {

        $res2 =$GLOBALS['TYPO3_DB']->sql_query("SELECT pid FROM pages WHERE uid=".$var." AND deleted=0 AND hidden=0");
        while ($obj2 = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res2)){
            $res3 =$GLOBALS['TYPO3_DB']->sql_query("SELECT is_siteroot FROM pages WHERE uid=".$obj2['pid']." AND deleted=0 AND hidden=0");
            while ($obj3 = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res3)){
                if ($obj3['is_siteroot']!=1){
                    $this->isRoot($obj2['pid']);
                } else {
                    return $obj2['pid'];
                }
            }
        }
    }
}