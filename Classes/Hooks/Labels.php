<?php

namespace TYPO3\VmfdsSermons\Hooks;

use TYPO3\CMS\Backend\Utility\BackendUtility as BackendUtilityCore;
use TYPO3\CMS\Core\Resource\Exception\FolderDoesNotExistException;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Labels
{

    public function getSlideLabel(array &$params)
    {
        $title = '<b>' . $params['row']['title'] . '</b> [' . $params['row']['sorting'] . ']';
        if (!empty($params['row']['image'])) {
            $params['row']['image'] = $this->splitFileName($params['row']['image']);
            try {
                $params['title'] = BackendUtilityCore::thumbCode($params['row'], 'tx_vmfdssermons_domain_model_slide', 'image', $GLOBALS['BACK_PATH'], '', null, 0, '', '', false)
                        . '&nbsp;' . htmlspecialchars($params['row']['title']);
            } catch (FolderDoesNotExistException $exception) {
                $params['title'] = htmlspecialchars($params['row']['title']);
            }
        } else {
            $params['title'] = htmlspecialchars($params['row']['title']);
        }
    }

    /**
     * Split the filename
     *
     * @param string $title
     * @return string
     */
    protected function splitFileName($title)
    {
        $split = explode('|', $title);
        if (count($split) === 2 && $split[0] === $split[1]) {
            $title = $split[0];
        }

        return $title;
    }

}
