<?php

namespace System\DataTransformer;

/**
 * Class designed to transform arrays of data to url encoded data
 *
 * Class UrlEncodeDataTransformer
 * @package System\DataTransformer
 */
class UrlEncodeDataTransformer implements DataTransformerInterface
{
    /**
     * Turns an array to url encoded data
     *
     * @param array $data
     * @return mixed
     */
    public function transform(array $data)
    {
        return http_build_query($data);
    }
}