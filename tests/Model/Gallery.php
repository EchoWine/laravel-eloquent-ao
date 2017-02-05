<?php

namespace CoreWine\ORM\Test\Model;

use CoreWine\ORM\Model;
use CoreWine\ORM\AttributesBuilder;

class Gallery{

    public $file;
    public $weight;
    
    /**
     * List of all your attributes.
     *
     * @param AttributesBuilder $builder
     *
     * @return void
     */
    protected function attributes(AttributesBuilder $builder){
    	
    	$builder -> string('file');
        $builder -> number('weight');
    }

    public function __toString(){
        return ['file' => $this->file,'weight' => $this->weight];
    }
}

?>