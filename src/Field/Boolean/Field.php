<?php

namespace CoreWine\ORM\Field\Boolean;

use CoreWine\ORM\Field\Basic;

class Field extends Basic\Field{

    /**
     * Set value
     *
     * @param mixed $value
     */
    public function setValue($value){

        if($value === 'true')
            $value = true;

        if($value === 'false')
            $value = false;

        $this->value = (boolean)$value == true;
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString(){
        return $this->getValue() ? 1 : 0;
    }

}