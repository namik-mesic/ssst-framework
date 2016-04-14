<?php

namespace App;

use System\Container\Container;
use System\DataTransformer\DataTransformerInterface;

/**
 * Plain and simple data storage class with interface for transformation
 *
 * Class DataClass
 * @package App
 */
class DataClass
{
    /**
     * Some data
     *
     * @var array
     */
    protected $values;

    /**
     * The data transformer instance
     *
     * @var DataTransformerInterface
     */
    protected $dataTransformer;

    /**
     * Returns the default transformer implementation instance
     *s
     * @return DataTransformerInterface
     */
    protected function getDefaultTransformer()
    {
        return Container::get(DataTransformerInterface::class);
    }

    /**
     * DataClass constructor - Sets values
     * @param array $values
     * @param DataTransformerInterface $dataTransformerInterface
     */
    public function __construct(array $values = [], DataTransformerInterface $dataTransformerInterface = null)
    {
        $this->values = $values;

        $this->dataTransformer = $dataTransformerInterface ?: $this->getDefaultTransformer();
    }

    /**
     * Returns an encoded string of data
     *
     * @return mixed
     */
    public function transform()
    {
        return $this->dataTransformer->transform($this->values);
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param array $values
     */
    public function setValues($values)
    {
        $this->values = $values;
    }
}