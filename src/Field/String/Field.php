<?php

namespace CoreWine\ORM\Field\String;

use CoreWine\ORM\Field\Basic;

use CoreWine\ORM\Field\String\Exceptions;

class Field extends Basic\Field{

	protected $min_length;
	protected $max_length;
	protected $match;

	/**
	 * Set min length
	 *
	 * @param integer $min_length
	 *
	 * @return $this
	 */
	public function setMinLength($min_length){
		$this -> min_length = $min_length;
		return $this;
	}

	/**
	 * Get min length
	 *
	 * @return integer
	 */
	public function getMinLength(){
		return $this->min_length;
	}

	/**
	 * Set max length
	 *
	 * @param integer $max_length
	 *
	 * @return this
	 */
	public function setMaxLength($max_length){
		$this -> max_length = $max_length;
		return $this;
	}

	/**
	 * Get min length
	 *
	 * @return integer
	 */
	public function getMaxLength(){
		return $this->max_length;
	}

	/**
	 * Set match
	 *
	 * @param string $match
	 *
	 * @return void
	 */
	public function setMatch($match){
		$this -> match = $match;
		return $this;
	}

	/**
	 * Get match
	 *
	 * @return integer
	 */
	public function getMatch(){
		return $this->match;
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

    	$this -> validate((string)$value);

    	if($value instanceof Stringy){
    		$this -> value = $value;
    	}

    	$this -> value = Stringy::create($value);

    }

    /**
     * Validate the value
     *
     * @param string value
     *
     * @return void
     */
    public function validate($value){

    	$value = Stringy::create($value);


    	if($value -> length() < $this->getMinLength())
    		throw new Exceptions\TooShortException($value);

    	if($value -> length() > $this->getMaxLength())
    		throw new Exceptions\TooShortException($value);

    	if(!$value -> match($this->getMatch()))
    		throw new Exceptions\InvalidException($value);
    }
}