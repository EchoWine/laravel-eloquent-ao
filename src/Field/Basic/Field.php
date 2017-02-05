<?php

namespace CoreWine\ORM\Field\Basic;

use CoreWine\ORM\AttributesBuilder;

class Field{

    /**
     * Name
     *
     * @var string
     */
    public $name;

    /**
     * Value
     *
     * @var mixed
     */
    protected $value;

    /**
     * Schema instance.
     *
     * @var Schema
     */
    protected $schema;

    /**
     * Builder instance.
     *
     * @var AttributesBuilder
     */
    protected $attributes_builder;

    /**
     * Model
     *
     * @var mixed
     */
    public $model;


    /**
     * Construct
     *
     * @param string $name
     */
    public function __construct($name){
    	$this->name = $name;
        $this->iniSchema();
    }

    /**
     * Initialize schema
     *
     * @return void
     */
    public function iniSchema(){
        // $this->schema = new Schema();
    }

    /**
     * Get schema
     *
     * @return Schema
     */
    public function getSchema(){
        return $this->schema;
    }

    /**
     * Set builder
     *
     * @param AttributesBuilder $attributes_builder
     *
     * @return $this
     */
    public function setAttributesBuilder(AttributesBuilder $attributes_builder){
        $this->attributes_builder = $attributes_builder;
    }

    /**
     * Get attributes builder
     *
     * @return AttributesBuilder
     */
    public function getAttributesBuilder(){
        return $this->attributes_builder;
    }


    /**
     * Get 
    /**
     * Get the name
     *
     * @return string
     */
    public function getName(){
    	return $this->name;
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
     * Alias @getValue
     */
    public function get(){
        return $this->getValue()->getRaw();
    }

    /**
     * Set value
     *
     * @param mixed $value
     */
    public function setValue($value){
    	$this->value = $value;
    }

    /**
     * to string
     *
     * @return string
     */
    public function __toString(){
        return (string)$this->getValue();
    }

    public function setModel($model){
        $this->model = $model;
    }

    public function getModel(){
        return $this->model;
    }

    public function __call($method,$arguments){
        return call_user_func_array([$this->getValue(),$method],$arguments);
    }

}