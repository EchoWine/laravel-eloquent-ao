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


        if(empty($value)){
            $this -> value = new Collection();
            return;
        }
            

    	$this -> value = new Collection($value);

    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString(){
        return (string)$this->getValue()->toJson();
    }

}