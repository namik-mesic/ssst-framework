<?php

namespace App;

/**
 * The same simple class that has some extended functionality
 *
 * Class DataClassExtended
 * @package App
 */
class DataClassExtended extends DataClass
{
    /**
     * Gets a single value form the array
     *
     * @param $key
     * @return mixed
     */
    public function value($key)
    {
        if (isset($this->values[$key]))
            return $this->values[$key];

        else
            return null;
    }

    /**
     * Transform only a single value with the transformer interface
     *
     * @param $key
     * @return mixed|null
     */
    public function singleTransform($key)
    {
        if (isset($this->values[$key]))
            return $this->dataTransformer->transform([
                $key => $this->values[$key]
            ]);

        else
            return null;
    }
}