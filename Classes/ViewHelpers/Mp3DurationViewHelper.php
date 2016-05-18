<?php

namespace TYPO3\VmfdsSermons\ViewHelpers;

/**
 *
 * Example
 * {namespace s=TYPO3\VmfdsSermons\ViewHelpers}
 * <s:mp3Duration file="myfile.mp3" />
 *
 * @package TYPO3
 * @subpackage vmfds_sermons
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Mp3DurationViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Renders a text as an ordered list (one item per line)
     *
     * @param string $file The file to analyze
     * @return string Duration
     * @author Christoph Fischer <christoph.fischer@volksmission.de>
     */
    public function render($file)
    {
        $utility = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\VmfdsSermons\\Utility\\Mp3Utility');
        $utility->setFileName(PATH_site . $file);
        $duration = $utility->getDuration();
        return $utility->formatTime($duration);
    }

}

?>
