<?php

namespace CoreWine\ORM\Field\Collection;

use Illuminate\Support\Collection as BaseCollection;


class Collection extends BaseCollection
{   

    /**
     * @var Field
     */
    protected $field;

    /**
     * Set field
     *
     * @param Field $field
     *
     * @return $this
     */
    public function setField(Field $field){
        $this->field = $field;
    }

    /**
     * Get field
     *
     * @return Field
     */
    public function getField(){
        return $this->field;
    }

    /**
     * Add a value
     *
     * @param mixed $value
     *
     * @return void
     */
    public function add($value){
        $this[] = $value;
    }

    /**
     * Set the item at a given offset.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @return void
     */
    public function offsetSet($key, $value)
    {	 
        $this->getField()->getSchema()->validate($value);
        parent::offsetSet($key, $value);
    }

    /**
     * Get raw object
     *
     * @return mixed
     */
    public function getRaw(){
        return $this;
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString(){

        return parent::__toString();
    }
}