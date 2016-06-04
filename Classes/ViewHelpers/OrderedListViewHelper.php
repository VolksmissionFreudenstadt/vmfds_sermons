<?php

/*
 * @package vmfds_sermons
 * @copyright Copyright (c) 2012-2016 Volksmission Freudenstadt
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License v3 or later
 * @site http://open.vmfds.de
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
 *
 * Example
 * {namespace s=TYPO3\VmfdsSermons\ViewHelpers}
 * <s:orderedList length="7" />
 *
 * @package TYPO3
 * @subpackage vmfds_sermons
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class OrderedListViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Renders a text as an ordered list (one item per line)
     *
     * @param string $list The number of characters of the dummy content
     * @validate $length StringValidator
     * @param string $underlineMode
     * @param string $listStyle
     * @param string $itemStyle
     * @param string $breakAfter
     * @return string as ordered list
     * @author Christoph Fischer <christoph.fischer@volksmission.de>
     */
    public function render($list = NULL, $underlineMode = 'html5', $listStyle = '', $itemStyle = '', $breakAfter = FALSE)
    {
        if (!$list)
            $list = $this->renderChildren();
        $list = str_replace(['<u>', '</u>'], ['[', ']'], $list);
        switch ($underlineMode) {
            case 'blank':
                $list = str_replace(['[', ']'], ['<span style="color: white; border-bottom: solid 1px black">', '</span>'], $list);
                break;
            case 'html5':
                $list = str_replace(['[', ']'], ['<span style="text-decoration: underline;">', '</span>'], $list);
                break;
            case 'remove':
                $list = str_replace(['[', ']'], ['', ''], $list);
                break;
        }
        $items = explode("\r", $list);
        if (is_array($items)) {
            return '<ol ' . ($listStyle ? 'style="' . $listStyle . '"' : '') . '><li ' . ($itemStyle ? 'style="' . $itemStyle . '"' : '') . '>' . join('</li><li ' . ($itemStyle ? 'style="' . $itemStyle . '"' : '') . '>', $items) . ($breakAfter ? '<br />' : '') . '</li></ol>';
        } else {
            return $list;
        }
    }

}

?>
