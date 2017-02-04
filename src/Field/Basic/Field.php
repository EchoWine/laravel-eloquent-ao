<?php

namespace CoreWine\ORM\Field\Basic;

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
    	$this -> name = $name;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName(){
    	return $this -> name;
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
     * Alias @getValue
     */
    public function get(){
        return $this -> getValue();
    }

    /**
     * Set value
     *
     * @param mixed $value
     */
    public function setValue($value){
    	$this -> value = $value;
    }

    /**
     * to string
     *
     * @return string
     */
    public function __toString(){
        return (string)$this -> getValue();
    }

    public function setModel($model){
        $this -> model = $model;
    }

    public function getModel(){
        return $this -> model;
    }
}