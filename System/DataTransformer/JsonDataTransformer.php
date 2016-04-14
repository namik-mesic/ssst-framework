<?php

namespace System\DataTransformer;

/**
 * Class used to transform arrays of data to JSON
 *
 * Class JsonDataTransformer
 * @package System\DataTransformer
 */
class JsonDataTransformer implements DataTransformerInterface
{
    /**
     * Turns an array to JSON
     *
     * @param array $data
     * @return mixed
     */
    public function transform(array $data)
    {
        return json_encode($data);
    }
}