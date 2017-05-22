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

namespace TYPO3\VmfdsSermons\Utility;

class SyncUtility
{

    /**
     * Convert a title to a safe url part
     * @param string $string Title string
     * @param string $spaceCharacter Replace spaces with this character
     * @return string Converted string
     */
    public static function convertToSafeString($string, $spaceCharacter = '-')
    {
        $processedTitle = $GLOBALS['TSFE']->csConvObj->conv_case('utf-8', $string, 'toLower');
        $processedTitle = strip_tags($processedTitle);
        $processedTitle = preg_replace('/[ \-+_]+/', $spaceCharacter, $processedTitle);
        $processedTitle = $GLOBALS['TSFE']->csConvObj->specCharsToASCII('utf-8', $processedTitle);
        $processedTitle = preg_replace('/[^\p{L}0-9' . preg_quote($spaceCharacter) . ']/u', '', $processedTitle);
        $processedTitle = preg_replace('/' . preg_quote($spaceCharacter) . '{2,}/', $spaceCharacter, $processedTitle);
        $processedTitle = trim($processedTitle, $spaceCharacter);
        $processedTitle = strtolower($processedTitle);
        return $processedTitle;
    }

    /**
     * Recursively build object(s) from data array
     * @param array $o Object data
     * @param array $prefix Configuration
     * @param bool $traverse Treat highest level as traversable array of objects
     * @return object
     */
    public static function convertObject($o, $prefix = [], $traverse = FALSE)
    {
        $a = [];
        if ($traverse) {
            foreach ($o as $obj) {
                $a[] = self::convertObject($obj, $prefix);
            }
        } else {
            $allMethods = get_class_methods($o);
            foreach ($allMethods as $method) {
                if (strpos($method, "get") === 0) {
                    $properties[lcfirst(substr($method, 3))] = $method;
                }
            }
            foreach ($properties as $property => $propertyGetter) {
                $content = $o->$propertyGetter();
                if (!is_object($content)) {
                    if (isset($prefix[$property]['dynamic'])) {
                        if (method_exists($o, 'getTitle')) {
                            $title = self::convertToSafeString($o->getTitle());
                        }
                        $uid = $o->getUid();
                        if ($content == '')
                            $a[$property] = str_replace('###TITLE###', $title, str_replace('###UID###', $uid, $prefix[$property]['dynamic']));
                    } else {
                        $a[$property] = str_replace('&quot;', '"', ($content ? $prefix[$property] . $content : ''));
                    }
                }
            }
        }
        return $a;
    }

}
