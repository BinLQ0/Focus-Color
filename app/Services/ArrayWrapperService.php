<?php

namespace App\Services;

class ArrayWrapperService
{
    /**
     * @var array
     */
    public $array;


    /**
     * Join two arrays, 
     * making the first array be a key, 
     * and the second array be a value
     * 
     * @param array $array1
     * @param array $array2
     * @param string $key2
     * @param array $array3
     * @param string $key3
     * @param int $min
     * @return App\Services\ArrayWrapperService
     */
    public function wrap(array $array1, array $array2, string $key2, array $array3, string $key3, int $min = 1)
    {
        for ($i = 0; $i < count($array1) - $min; $i++) {
            $this->array[$array1[$i]] = [$key2 => $array2[$i], $key3 => $array3[$i]];
        }
        return $this;
    }

    /**
     * @return Illuminate\Support\Collection
     */
    public function toCollection()
    {
        return collect($this->array);
    }
}
