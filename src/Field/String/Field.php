<?php

namespace CoreWine\ORM\Field\String;

use CoreWine\ORM\Field\Basic;

use CoreWine\ORM\Field\String\Exceptions;

class Field extends Basic\Field{


    /**
     * Initialize schema
     *
     * @return void
     */
    public function iniSchema(){
        $this->schema = new Schema();
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

    	$this -> getSchema() -> validate((string)$value);

    	if($value instanceof Stringy){
    		$this -> value = $value;
    	}

    	$this -> value = Stringy::create($value);

    }

}