<?php

namespace CoreWine\ORM\Field\String;

class Schema
{

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
    public function minLength($min_length){
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
    public function maxLength($max_length){
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
    public function match($match){
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