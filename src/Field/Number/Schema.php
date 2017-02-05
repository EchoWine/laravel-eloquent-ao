<?php

namespace CoreWine\ORM\Field\Number;

use CoreWine\ORM\Field\Number\Exceptions as Exceptions;

class Schema
{

	/**
	 * @var float
	 */
	protected $min;

	/**
	 * @var float
	 */
	protected $max;

	/**
	 * Set min value
	 *
	 * @param float $min
	 *
	 * @return $this
	 */
	public function min($min){
		$this->min = $min;
		return $this;
	}

	/**
	 * Set max value
	 *
	 * @param float $max
	 *
	 * @return $this
	 */
	public function max($max){
		$this->max = $max;
		return $this;
	}

	/**
	 * Set min and max value
	 *
	 * @param float $min
	 * @param float $max
	 *
	 * @return $this
	 */
	public function range($min, $max){
		$this->min($min);
		$this->max($max);
		return $this;
	}

	/**
	 * Get min value
	 *
	 * @return float
	 */
	public function getMin(){
		return $this->min;
	}

	/**
	 * Get max value
	 *
	 * @return float
	 */
	public function getMax(){
		return $this->max;
	}

	/**
	 * Validate the value
	 *
	 * @param float $value
	 */
	public function validate($value){

		if($this->getMin() !== null && $value < $this->getMin())
			throw new Exceptions\TooSmallException();

		if($this->getMax() !== null && $value > $this->getMax())
			throw new Exceptions\TooBigException();
	}

}