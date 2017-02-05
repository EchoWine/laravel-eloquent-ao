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
        echo "\n\rCollection:";
        print_r($this->getValue()->toJson());
        echo "\n\r";
        return (string)$this->getValue()->toJson();
    }

}