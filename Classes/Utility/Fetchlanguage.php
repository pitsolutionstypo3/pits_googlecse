<?php  
namespace PITS\Pitsgooglecse\Utility;

use TYPO3\CMS\Backend\Utility\BackendUtility as BackendUtilityCore;
use TYPO3\CMS\Core\Utility\GeneralUtility;
 
class Fetchlanguage {
    var $confArr = array();
    var $PA = array();

    function init($conf) {
		$this->conf = $conf; 
		// Init FlexForm configuration for plugin
	}


    /**
     * Switchable controller actions
     *
     */
    function switchable_decisions(&$params){
        $values = $this->getContentElementRow($params['row']['uid']);
        $flexformConfig = GeneralUtility::xml2array($values['pi_flexform']);

    	if (isset($flexformConfig['data']['sDEF']['lDEF']['switchableControllerActions']['vDEF'])) {
            $selectedActionList = $flexformConfig['data']['sDEF']['lDEF']['switchableControllerActions']['vDEF'];
            if($selectedActionList === 'Search->results'){
                unset($params['items']);
            }
        }
    }

    /**
     * Renders theme layouts inside plugin options
     *
     */
    function render_layouts($PA, $fObj){
        $formField = '<div class="pits_googlecse"><table><tr><td><label><img src="../typo3conf/ext/pits_googlecse/Resources/Public/Images/minimalist.png" style="cursor:pointer;">';
        $formField.= '<input type="radio" name="'.$PA['itemFormElName'].'"';
        $formField.= 'value="google.loader.themes.MINIMALIST"';
        $formField.= '/></label></td>';
        $formField.= '<td><label><img src="../typo3conf/ext/pits_googlecse/Resources/Public/Images/espresso.png" style="cursor:pointer;">';
		$formField.= '<input type="radio" name="'.$PA['itemFormElName'].'"';        
		$formField.= 'value="google.loader.themes.ESPRESSO"';
        $formField.= '/></label></td>';
        $formField.= '<td><label><img src="../typo3conf/ext/pits_googlecse/Resources/Public/Images/greensky.png" style="cursor:pointer;">';
		$formField.= '<input type="radio" name="'.$PA['itemFormElName'].'"';        
		$formField.= 'value="google.loader.themes.GREENSKY"';
        $formField.= '/></label></td>';
        $formField.= '<td><label><img src="../typo3conf/ext/pits_googlecse/Resources/Public/Images/bubblegum.png" style="cursor:pointer;">';
		$formField.= '<input type="radio" name="'.$PA['itemFormElName'].'"';        
		$formField.= 'value="google.loader.themes.BUBBLEGUM"';
        $formField.= '/></label></td>';
        $formField.= '<td><label><img src="../typo3conf/ext/pits_googlecse/Resources/Public/Images/shiny.png" style="cursor:pointer;">';
		$formField.= '<input type="radio" name="'.$PA['itemFormElName'].'"';        
		$formField.= 'value="google.loader.themes.SHINY"';
        $formField.= '/></label></td>';
        $formField.= '<td><label><img src="../typo3conf/ext/pits_googlecse/Resources/Public/Images/classic.png" style="cursor:pointer;">';
		$formField.= '<input type="radio" name="'.$PA['itemFormElName'].'"';        
		$formField.= 'value="google.loader.themes.CLASSIC"';
        $formField.= '/></label></td>';
        $formField.= '<td><label><img src="../typo3conf/ext/pits_googlecse/Resources/Public/Images/default.png" style="cursor:pointer;">';
		$formField.= '<input type="radio" name="'.$PA['itemFormElName'].'"';        
		$formField.= 'value="google.loader.themes.V2_DEFAULT"';
        $formField.= '/></label></td></tr></table></div>';
        return $formField;
    }

    /**
     * Renders selector boxes for language selection inside plugin options
     *
     */
    function render_languages(&$params){
        $language = array( 	'**'		=>  'Default',
                            'bg'        =>  'Bulgarian',
                            'ar'		=>	'Arabic',				
                            'km'		=>	'Cambodian',
                            'ca'		=>	'Catalan',
                            'hr'		=>	'Croatian',
                            'cs'		=>	'Czech',
                            'da'		=>	'Danish',
                            'nl'		=>	'Dutch',
                            'en'		=>	'English',
                            'tl'		=>	'Filipino',
                            'fi'		=>	'Finnish',
                            'fr'		=>	'French',
                            'de'		=>	'German',
                            'el'		=>	'Greek',
                            'iw'		=>	'Hebrew',
                            'hi'		=>	'Hindi',
                            'hu'		=>	'Hungarian',
                            'id'		=>	'Indonesian',
                            'it'		=>	'Italian',
                            'ja'		=>	'Japanese',
                            'ko'		=>	'Korean',
                            'lv'		=>	'Latvian',
                            'lt'		=>	'Lithuanian',
                            'no'		=>	'Norwegian',
                            'pl'		=>	'Polish',
                            'pt' 		=>	'Portuguese',
                            'ro'		=>	'Romanian',
                            'ru'		=>	'Russian',
                            'sr'		=>	'Serbian',
                            'zh-CN'     =>  'Simplified Chinese',
                            'sk'		=>	'Slovak',
                            'sl'		=>	'Slovenian',
                            'es'		=>	'Spanish',
                            'sv'		=>	'Swedish',
                            'th'		=>	'Thai',
                            'zh-TW'		=>	'Traditional Chinese',
                            'tr'		=>	'Turkish',
                            'uk'		=>	'Ukrainian',
                            'vi'		=>	'Vietnamese',
                            );
        $i=0;
        foreach($language as $key=>$value){
            $params['items'][$i][0]=$value;
            $params['items'][$i][1]=$key;
            $i++;
        }
    }

    /**
     * Get tt_content record
     *
     * @param int $uid
     * @return array
     */
    protected function getContentElementRow($uid)
    {
        return BackendUtilityCore::getRecord('tt_content', $uid);
    }

}

?>