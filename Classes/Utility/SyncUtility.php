<?php

namespace TYPO3\VmfdsSermons\Utility;

class SyncUtility
{

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
                        $a[$property] = ($content ? $prefix[$property] . $content : '');
                    }
                }
            }
        }
        return $a;
    }

}
