<?php

namespace System\Observer;

/**
 * Trait used by classes that should implement observing
 *
 * Trait Observing
 * @package System\Observer
 */
trait Observing
{
    /**
     * Fires an observable event
     *
     * @param string $observable
     */
    protected function observe($observable)
    {
        if(in_array($observable, static::$observables))
        {
            foreach (static::$observers as $observerClass)
            {
                $observer = new $observerClass;

                if (method_exists($observer, $method = "observe" . ucfirst($observable)));

                $observer->$method($this);
            }
        }
    }
}