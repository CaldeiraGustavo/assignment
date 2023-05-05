<?php

namespace App\Utils;

class Converter
{
    public static function convertMemorySize($strSize)
    {
        $unity = substr($strSize, -2);
        $number = intval(substr($strSize, 0, -2));
        switch ($unity) {
            case 'MB':
                return $number * 10;
            case 'GB':
                return $number * 100;
            case 'TB':
                return $number * 1000;
            default:
                return null;
        }
    }
}