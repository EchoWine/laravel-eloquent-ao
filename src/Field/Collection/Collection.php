<?php

namespace CoreWine\ORM\Field\Collection;

use Illuminate\Support\Collection as BaseCollection;


class Collection extends BaseCollection
{

    public function add($value){
        $this[] = $value;
    }

    public function getRaw(){
        return $this;
    }

    public function __toString(){

    	return parent::__toString();
    }
}