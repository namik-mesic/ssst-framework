<?php

namespace System\DataTransformer;

/**
 * Returns the default array of data
 *
 * Class ArrayDataTransformer
 * @package System\DataTransformer
 */
class ArrayDataTransformer implements DataTransformerInterface
{

    /**
     * Turns an array to some specific format of data
     *
     * @param array $data
     * @return array
     */
    public function transform(array $data)
    {
        return $data;
    }
}