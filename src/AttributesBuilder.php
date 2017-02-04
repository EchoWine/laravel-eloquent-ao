<?php

namespace CoreWine\ORM;

class AttributesBuilder{

    /**
     * List of all fields
     *
     * @var Array
     */
    protected $fields = [];

    /**
     * List of all classes fields
     *
     * @var Array
     */
    protected $classes = [
        'string' => \CoreWine\ORM\Field\String\Field::class,
        'boolean' => \CoreWine\ORM\Field\Boolean\Field::class,
    ];

    public function __construct(){}

    public function isFieldClass($class){
        return isset($this -> classes[$class]);
    }

    public function getFieldClass($class){
        return $this -> classes[$class];
    }

    public function getFields(){
        return $this -> fields;
    }

    public function addField($field){
        $this -> fields[$field -> getName()] = $field;
    }

    public function __call($method,$attributes){
        if(!$this -> isFieldClass($method)){
            throw new Exception("Field not recognized");
            return;
        }
        
        $class = $this -> getFieldClass($method);

        $field = new $class(...$attributes);

        $this -> addField($field);

        return $field->getSchema() ? $field->getSchema() : $field;

    }
}