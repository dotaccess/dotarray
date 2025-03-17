<?php
namespace DotAccess\DotArray;

use ArrayAccess;

interface DotArrayInterface extends ArrayAccess
{
    /**
     * Get the array by reference
     * 
     * @return array
     */
    public function &array(): array;

    /**
     * @synonym array()
     * Get the array by reference
     * 
     * @return array
     */
    public function &reference(): array;

    /**
     * Get a copy of the array
     * 
     * @return array
     */
    public function copy(): array;
}