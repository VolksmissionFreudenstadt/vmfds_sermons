<?php

namespace TYPO3\VmfdsSermons\Utility;

class SyncUtility
{

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
                            $title = $o->getTitle();
                            $title = strtolower(str_replace(' ', '-', $title));
                        }
                        $uid = $o->getUid();
                        if ($content == '')
                            $a[$property] = str_replace('###TITLE###', $title, str_replace('###UID###', $uid, $prefix[$property]['dynamic']));
                    } else {
                        $a[$property] = $prefix[$property] . $content;
                    }
                }
            }
        }
        return $a;
    }

}
