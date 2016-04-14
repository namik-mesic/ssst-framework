<?php

namespace System\DataTransformer;

use SimpleXMLElement;

/**
 * Class designed to turn an array of data to XML
 *
 * Class XMLDataTransformer
 * @package System\DataTransformer
 */
class XMLDataTransformer implements DataTransformerInterface
{
    /**
     * Random internet implementation (not bad)
     *
     * @param array $data
     * @param SimpleXMLElement $xml
     */
    protected function arrayToXml(array $data, SimpleXMLElement &$xml)
    {
        foreach ($data as $key => $value)
        {
            if (is_array($value))
            {
                if (is_numeric($key))
                    $key = "item{$key}";

                $node = $xml->addChild($key);
                $this->arrayToXml($value, $node);
            }

            else
                $xml->addChild($key, htmlspecialchars($value));
        }
    }

    /**
     * Turns an array to XML
     *
     * @param array $data
     * @return string
     */
    public function transform(array $data)
    {
        $xml = new SimpleXMLElement('<root/>');

        $this->arrayToXml($data, $xml);

        return $xml->asXML();
    }
}