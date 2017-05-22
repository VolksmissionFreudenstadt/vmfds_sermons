<?php

/*
 * @package vmfds_sermons
 * @copyright Copyright (c) 2012-2016 Volksmission Freudenstadt
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License v3 or later
 * @site http://open.vmfds.de
 * @file StrftimeViewHelper.php
 * @author Christoph Fischer <chris@toph.de>
 * @date 2016-06-04
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

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
            } catch (\Exception $exception) {
                throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('"' . $date . '" was DateTime and could not be converted to UNIX-Timestamp by DateTime.', 200000001);
            }
        }
        return strftime($format, (int) strtotime($date));
    }

}
