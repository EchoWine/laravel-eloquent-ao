<?php

namespace CoreWine\ORM\Field\Collection;

use CoreWine\ORM\Field\Basic\Field as FieldBase;

class Field extends FieldBase{


    /**
     * Initialize schema
     *
     * @return void
     */
    public function iniSchema(){
        $this->schema = new Schema($this);
    }

    /**
     * Get value
     *
     * @return mixed
     */
    public function getValue(){
        return $this -> value;
    }

    /**
     * Set value
     *
     * @param mixed $value
     */
    public function setValue($value){

        if(is_string($value)){
            $value = json_decode($value);

            if(json_last_error() != JSON_ERROR_NONE){
                throw new \Exception("JSOn failed parsing");
            }

            $value = (array)$value;

            $class = $this->getSchema()->getType();

            if($class !== null){
                $value_casted = [];


                # Casting values
                foreach($value as $n => $attributes){
                    $l = new $class();
                    foreach($attributes as $name => $attribute){
                        $l -> {$name} = $attribute;
                    }
                    $value_casted[$n] = $l;
                }

                $value = $value_casted;
            }
        }

        if($value instanceof Collection){


            foreach($value as $element){
                $this->getSchema()->validate($element);
            }

        }

        if (empty($value)) {
            $this->value = new Collection();
            $this->value->setField($this);
            return;
        }

    	$this->value = new Collection($value);

        $this->value->setField($this);
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString(){
        return $this->getValue()->toJson();
    }


}