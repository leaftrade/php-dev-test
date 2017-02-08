<?php

/**
 * ArrayTools: Contains helpful static array utilities
 *
 */

namespace LeafTrade;

class ArrayUtils
{
    /*
     * Takes a string, strips non-alphanumeric characters, and reverses the resulting array of words
     *
     * @param (string) The string to be manipulated
     * @return (reversedArray) The resulting flipped array of words
     */
    public static function reverseArray($string)
    {
        $strippedString = preg_replace("/[^A-Za-z0-9 ]/", "", $string);
        $arrOfWords = explode(' ', $strippedString);
        return array_reverse($arrOfWords);
    }
}