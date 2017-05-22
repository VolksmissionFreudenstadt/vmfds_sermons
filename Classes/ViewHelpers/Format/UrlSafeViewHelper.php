<?php

namespace TYPO3\VmfdsSermons\ViewHelpers\Format;

class UrlSafeViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Return a url-safe string
     */
    public function render()
    {
        return \TYPO3\VmfdsSermons\Utility\SyncUtility::convertToSafeString($this->renderChildren());
    }

}
