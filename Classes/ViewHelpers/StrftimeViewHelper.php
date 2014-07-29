<?php

namespace TYPO3\VmfdsSermons\ViewHelpers;

/**
 * Formats a Timestamp or DateTime-Object in strftime()
 * @api
 */
class StrftimeViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Render the supplied DateTime object as a formatted date using strftime.
     *
     * @param mixed $date either a DateTime object or a string (UNIX-Timestamp)
     * @param string $format Format String which is taken to format the Date/Time
     * @return string Formatted date
     * @api
     */
    public function render($date = NULL, $format = '%A, %d. %B %Y')
    {
        if ($date === NULL) {
            $date = $this->renderChildren();
            if ($date === NULL) {
                return '';
            }
        }
        if ($date instanceof \DateTime) {
            try {
                return strftime($format, $date->getTimestamp());
            } catch (Exception $exception) {
                throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('"' . $date . '" was DateTime and could not be converted to UNIX-Timestamp by DateTime.', 200000001);
            }
        }
        return strftime($format, (int) strtotime($date));
    }

}
