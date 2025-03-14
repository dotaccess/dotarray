<?php
namespace DotAccess\DotArray;

use ArrayApi\Api as ArrayApi;

/**
 * DotArray
 * 
 * A collection of array functions that use dot notation
 */
class DotApi extends ArrayApi
{
    /**
     * Check if a value exists in an array using dot notation
     * 
     * @param array $array    The array to check
     * @param string $path    The path to the value
     * 
     * @return bool
     */
    public static function has(array &$array, string $path): bool
    {
        return static::get($array, $path) !== null;
    }
    
    /**
     * Get a value from an array using dot notation
     * 
     * @param array $array    The array to get the value from
     * @param string $path    The path to the value
     * @param mixed $default  The default value to return if the path does not exist
     * 
     * @return mixed
     */
    public static function &get(array &$array, string $path, mixed $default = null): mixed
    {
        $current = &$array;

        $path = array_filter(explode('.', $path));

        foreach ($path as $key) {
            if (!is_array($current) || !array_key_exists($key, $current)) {
                return $default;
            }

            $current = &$current[$key];

            if (is_callable($current)) {
                /**
                 @todo: move out
                 */
                //$current = $current();
            }
        }

        return $current;
    }

    /**
     * Set a value in an array using dot notation
     * 
     * @param array $array    The array to set the value in
     * @param string $path    The path to the value
     * @param mixed $value    The value to set
     * 
     * @return void
     */
    public static function set(array &$array, string $path, mixed $value): void
    {
        $path = array_filter(explode('.', $path));
        $current = &$array;

        foreach ($path as $key) {
            if (!is_array($current)) {
                $current = [];
            }

            $current = &$current[$key];
        }

        $current = $value;
    }

    public static function unset(array &$array, string $path): void
    {
        $path = array_filter(explode('.', $path));
        $current = &$array;

        foreach ($path as $key) {
            if (!is_array($current) || !array_key_exists($key, $current)) {
                return;
            }

            $forUnset = &$current;
            $current = &$current[$key];
        }

        unset($forUnset[$key]);
    }

    /**
     * Merge two arrays
     * 
     * @param array $array1   The first array
     * @param array $array2   The second array
     * 
     * @return array
     */
    public static function mergeTo(string $path, array &$array1, array &$array2): void
    {
        $value = &static::get($array1, $path);

        if (is_array($value)) {
            static::merge($value, $array2);
        } else {
            static::set($array1, $path, $array2);
        }
    }

    public static function walk(array &$array, callable $callback, ?string $path = null): void
    {
        foreach ($array as $key => &$value) {

            $callback($value, $key);

            if (is_array($value)) {
                static::walk($value, $callback);
            } else {
                //$callback($value, $key);
            }
        }
    }
}