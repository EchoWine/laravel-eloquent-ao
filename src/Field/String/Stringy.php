<?php

namespace CoreWine\ORM\Field\String;

use Stringy\Stringy as BaseStringy;

class Stringy extends BaseStringy
{

    /**
     * Match the string with the pattern
     *
     * @param string $pattern
     *
     * @return boolean
     */
    public function match($pattern){
        return preg_match($pattern,$this->str);
    }
}