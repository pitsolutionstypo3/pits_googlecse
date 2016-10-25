<?php

namespace PITS\Pitsgooglecse\Hooks;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Hook into \TYPO3\CMS\Backend\Utility\BackendUtility to change flexform behaviour
 * depending on action selection
 *
 */
class BackendUtility
{
    /**
     * Fields which are removed in results view
     *
     * @var array
     */
    public $removedFieldsInResultsView = [
        'sDEF' => 'flexform.api,flexform.lang,flexform.imagesearch,flexform.theme,flexform.enablethumbs,flexform.autocomplete,flexform.theme,flexform.enablethumbs,flexform.overlayresults',
        'additional' => '',
        'template' => ''
    ];

    /**
     * Hook function of \TYPO3\CMS\Backend\Utility\BackendUtility
     * It is used to change the flexform if it is about google cse
     *
     * @param array &$dataStructure Flexform structure
     * @param array $conf some strange configuration
     * @param array $row row of current record
     * @param string $table table name
     * @return void
     */
    public function getFlexFormDS_postProcessDS(&$dataStructure, $conf, $row, $table)
    {
        if ($table === 'tt_content' && $row['list_type'] === 'pitsgooglecse_pitsgooglecse' && is_array($dataStructure)) {
            $this->updateFlexforms($dataStructure, $row);
        }
    }

    /**
     * Update flexform configuration if a action is selected
     *
     * @param array|string &$dataStructure flexform structure
     * @param array $row row of current record
     * @return void
     */
    protected function updateFlexforms(array &$dataStructure, array $row)
    {
        $selectedView = '';

        // get the first selected action
        if (is_string($row['pi_flexform'])) {
            $flexformSelection = GeneralUtility::xml2array($row['pi_flexform']);
        } else {
            $flexformSelection = $row['pi_flexform'];
        }
        if (is_array($flexformSelection) && is_array($flexformSelection['data'])) {
            $selectedView = $flexformSelection['data']['sDEF']['lDEF']['switchableControllerActions']['vDEF'];
            if (!empty($selectedView)) {
                $actionParts = GeneralUtility::trimExplode(';', $selectedView, true);
                $selectedView = $actionParts[0];
            }
            // new plugin element
        }

        if (!empty($selectedView)) {
            // Modify the flexform structure depending on the first found action
            switch ($selectedView) {
                case 'Search->results':
                    $this->deleteFromStructure($dataStructure, $this->removedFieldsInResultsView);
                    break;
                default:
            }
        }
    }

    /**
     * Remove fields from flexform structure
     *
     * @param array &$dataStructure flexform structure
     * @param array $fieldsToBeRemoved fields which need to be removed
     * @return void
     */
    protected function deleteFromStructure(array &$dataStructure, array $fieldsToBeRemoved)
    {

        foreach ($fieldsToBeRemoved as $sheetName => $sheetFields) {

            $fieldsInSheet = GeneralUtility::trimExplode(',', $sheetFields, true);
            
            foreach ($fieldsInSheet as $fieldName) {
                unset($dataStructure['sheets'][$sheetName]['ROOT']['el']['settings.' . $fieldName]);
            }
        }
        unset($dataStructure['sheets']['theme']);
    }
}