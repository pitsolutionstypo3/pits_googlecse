<?php
namespace PITS\PitsGooglecse\Controller;


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
        $style = $settings['flexform']['theme'];
        switch ($style){
            case "google.loader.themes.V2_DEFAULT" :
            $this->response->addAdditionalHeaderData('<link rel="stylesheet" type="text/css" href="typo3conf/ext/pits_googlecse/Resources/Public/Css/Default.css" media="all">');
            break;
        }
        $this->view->assign('values', $settings);
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

}