<?php

namespace App\Model;

use System\Model\Model;

/**
 * Class ModelObserver
 * @package App\Model
 */
class ModelObserver
{
    public function observeBeforeSave(Model $model)
    {
        //echo "Model observer before save has been triggered";
    }

    public function observeAfterSave(Model $model)
    {
        //echo "Model observer after save has been triggered";
    }
}