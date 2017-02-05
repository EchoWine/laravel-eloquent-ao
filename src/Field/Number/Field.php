<?php

namespace CoreWine\ORM\Field\Number;

use CoreWine\ORM\Field\Basic;

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
        return $this->value;
    }

    /**
     * Set value
     *
     * @param mixed $value
     *
     * @return void
     */
    public function setValue($value){
        $this->getSchema()->validate($value); 
    	$this->value = $value;
    }
}