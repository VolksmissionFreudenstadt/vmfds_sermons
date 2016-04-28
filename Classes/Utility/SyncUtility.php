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
                if (!is_object($content))
                    $a[$property] = $prefix[$property] . $content;
            }
        }
        return $a;
    }

}
