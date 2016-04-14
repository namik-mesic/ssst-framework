<?php

namespace System\Model;

use App\Model\ModelObserver;
use App\Model\UserObserver;
use System\Database\MySQL\Builder;
use System\Observer\Observing;

/**
 * Class Model
 * @package System\Model
 */
abstract class Model
{
    use Observing;

    /**
     * Observable events
     *
     * @var array
     */
    protected static $observables = [
        'beforeSave',
        'afterSave',
        'beforeDelete',
        'afterDelete'
    ];

    protected static $observers = [];

    /**
     * The name of the associated table
     *
     * @var string
     */
    protected $table = null;

    /**
     * The identifier of the current record
     *
     * @var int
     */
    protected $id;

    /**
     * The array of fields in the database (excluding id)
     *
     * @var array
     */
    protected $fields = [];

    /**
     * Builder instance used for query building
     *
     * @var Builder
     */
    protected $builder;

    /**0
     * The array of current values for the model
     *
     * @var array
     */
    protected $values = [];

    /**
     * Set local values
     * @param array $values
     */
    public function __construct(array $values = [])
    {
        $this->setValues($values);

        $this->builder = $this->getDefaultBuilder();
    }

    /**
     * Returns the array of observable events in the class
     *
     * @return array
     */
    public static function getObservables()
    {
        return static::$observables;
    }

    /**
     * Return the array of classes that may be observing the observable events
     *
     * @return array
     */
    public static function getObservers()
    {
        return static::$observers;
    }

    /**
     * @param $observerClass
     */
    public static function addObserver($observerClass)
    {
        static::$observers[] = $observerClass;
    }

    /**
     * Override default php set field method for fields that do not exist
     *
     * @param $field
     * @param $value
     */
    public function __set($field, $value)
    {
        if (in_array($field, $this->fields))
            $this->values[$field] = $value;
    }

    /**
     * Override default php get field method for fields that do not exist
     *
     * @param $field
     * @return null
     */
    public function __get($field)
    {
        if (isset($this->values[$field]))
            return $this->values[$field];

        else
            return null;
    }

    /**
     * Creates default builder instance
     *
     * @return Builder
     */
    protected function getDefaultBuilder()
    {
        return new Builder;
    }

    /**
     * Get the current builder instance
     *
     * @return Builder
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * Set the current builder instance
     *
     * @param Builder $builder
     */
    public function setBuilder($builder)
    {
        $this->builder = $builder;
    }

    /**
     * Get current values
     *
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Set current values
     *
     * @param array $values
     */
    public function setValues($values)
    {
        foreach ($values as $field => $value)
            if (in_array($field, $this->fields))
                $this->values[$field] = $value;
    }

    /**
     * Get the identifier value of the current instance
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Save the current record to the database and return success status
     *
     * @return bool
     */
    public function save()
    {
        $this->observe('beforeSave');

        if ($this->id)
            $result = $this->update();

        else
            $result = $this->store();

        $this->observe('afterSave');

        return $result;
    }

    /**
     * Update the currently loaded record with values
     *
     * @return bool
     * @throws ModelNotLoadedException
     */
    public function update()
    {
        if (!$this->getId())
            throw new ModelNotLoadedException;

        else
            return $this->builder->update($this->getTable(), $this->getValues(), $this->getId());
    }

    /**
     * Saves a new record and populates the id field
     *
     * @return bool
     */
    public function store()
    {
        if ($insertId = $this->builder->insert($this->getTable(), $this->getValues()))
        {
            $this->id = $insertId;

            return true;
        }

        else
            return false;
    }

    /**
     * Deletes the currently loaded record
     *
     * @return bool
     * @throws ModelNotLoadedException
     */
    public function delete()
    {
        if (!$this->getId())
            throw new ModelNotLoadedException;

        else
        {
            $this->observe('beforeDelete');

            $result = $this->builder->delete($this->getTable(), $this->getId());

            $this->addObserver('afterDelete');

            return $result;
        }
    }

    /**
     * Get the name of the associated table
     *
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Creates an instance of the model base on values given
     *
     * @param array $values
     * @return static
     */
    public static function create(array $values)
    {
        $model = new static($values);

        $model->save();

        return $model;
    }
}