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

    /*
     * Takes an array of strings, parses them as floats or integers, then sorts them in ascending order
     *
     * @param (arr) The array of numbers as strings in any order
     * @return (arrayOfNumbers) The resulting ordered array of numbers
     */
    public static function parseAndSort(array $arr)
    {
        $sortedArray = array_map(function ($string) {
            return ((intval($string) == $string)) ? intval($string) : floatval($string);
        }, $arr);
        sort($sortedArray);
        return $sortedArray;
    }

    /*
     * Takes two arrays and returns the array of elements that are in the first but not the second
     *
     * @param (arr1) An array
     * @param (arr2) An array
     * @return (arrDiff) The resulting array containing all elements in arr1 that are not in arr2
     */
    public static function getDiff(array $arr1, array $arr2)
    {
        // Filter out the elements of $arr1 that are not in $arr2
        $arrDiff = array_filter($arr1, function ($val) use ($arr2) {
            if (in_array($val, $arr2)) {
                return false;
            }
            return true;
        });

        // Resets the array's index
        return array_values($arrDiff);
    }
}