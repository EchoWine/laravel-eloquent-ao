<?php

namespace CoreWine\ORM;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

class Model extends EloquentModel{

    /**
     * Class Eloquent Collection.
     *
     * @var string \Illuminate\Database\Eloquent\Collection
     */
    private $collection = 'Illuminate\Database\Eloquent\Collection';

    /**
     * List of all fields
     *
     * @var Array
     */
    protected $fields = [];

    /**
     * Boot fields 
     *
     * @param FieldsBuilder $builder
     */
    protected function bootFields(){
        $builder = new AttributesBuilder();
        $this -> attributes($builder);
        $this -> fields = $builder -> getFields();
    }

    /**
     * Boot fields 
     *
     * @param FieldsBuilder $builder
     */
    protected function attributes(AttributesBuilder $builder){

    }

    /**
     * Get all fields
     *
     * @return array
     */
    public function getFields(){
        return $this -> fields;
    }

    /**
     * Exists the field ? 
     *
     * @param string $name
     */
    public function isField($name){
        return isset($this -> fields[$name]);
    }

    /**
     * Get the field
     *
     * @param string $name
     *
     * @return Field
     */
    public function getField($name){
        return $this -> fields[$name];
    }
  
    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = []){

        $this -> bootFields();
        foreach($this -> getFields() as $field){
            $name = $field -> getName();
            if(!in_array($field -> getName(),$this -> fillable)){
                $this -> fillable[] = $name;
            }
            $field -> setModel($this);
        }

        $this->bootIfNotBooted();

        $this->syncOriginal();


        $this->fill($attributes);


    }


    /**
     * Set the array of model attributes. No checking is done.
     *
     * @param  array  $attributes
     * @param  bool  $sync
     * @return $this
     */
    public function setRawAttributes(array $attributes, $sync = false){
        
        foreach($attributes as $name => $attribute){
            
            if($this -> isField($name)){
                $field = $this -> getField($name);
                $field -> setValue($attribute);
            }
            
        }

        return parent::setRawAttributes($attributes,$sync);

    }

    /**
     * Handle dynamic method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters){

        if($this -> isField($method))
            return $this -> getField($method); 

        return parent::__call($method, $parameters);

    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {   
        $collection = $this -> collection;
        return new $collection($models);
    }

    /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {

        if($this -> isField($key)){

            $object = $this -> getField($key) -> getValue();

            if(is_object($object))
                return $this -> getField($key);

            return $this -> getField($key) -> getValue();
        }

        return parent::getAttribute($key);
    }


    /**
     * Set a given attribute on the model.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return $this
     */
    public function setAttribute($key, $value)
    {

        if($this -> isField($key)){
            $this -> getField($key) -> setValue($value);
            return parent::setAttribute($key, $this -> getField($key) -> getValue());
        }

        return parent::setAttribute($key, $value);
    }
}