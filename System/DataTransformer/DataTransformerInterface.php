<?php

namespace System\DataTransformer;

/**
 * Declares the methods needed to be implemented by a data transformer class
 *
 * Interface DataTransformerInterface
 * @package System\DataTransformer
 */
interface DataTransformerInterface
{
    /**
     * Turns an array to some specific format of data
     *
     * @param array $data
     * @return mixed
     */
    public function transform(array $data);
}
