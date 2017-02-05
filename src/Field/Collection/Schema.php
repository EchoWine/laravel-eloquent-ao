<?php

namespace CoreWine\ORM\Field\Collection;

use CoreWine\ORM\AttributesBuilder;
use CoreWine\ORM\Field\Collection\Exceptions as Exceptions;

class Schema
{

    /**
     * @var Field
     */
    protected $field;

    /**
     * @var string
     */
    protected $type;

    /**
     * Construct
     */
    public function __construct(Field $field){
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
     * Set type
     *
     * @param string $type
     *
     * @return $this
     */
    public function type($type){

        #Convert $type into class 
        if($class = $this->getField()->getAttributesBuilder()->getFieldClass($type))
            $type = $class;

        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType(){
        return $this->type;
    }

    /**
     * Is valid type valyue
     *
     * @param mixed $value
     *
     * @return boolean
     */
    public function validate($value){   

        if($this->getType() !== null){

            $class = "\\".$this->getType();

            if(!($value instanceof $class))
                throw new Exceptions\InvalidTypeValueException("Expected ".$this->getType()." instead of ".get_class($value));
        }
    }
}