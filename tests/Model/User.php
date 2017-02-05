<?php

namespace CoreWine\ORM\Test\Model;

use CoreWine\ORM\Model;
use CoreWine\ORM\AttributesBuilder;

class User extends Model{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tests_users';

    /**
     * List of all your attributes.
     *
     * @param AttributesBuilder $builder
     *
     * @return void
     */
    protected function attributes(AttributesBuilder $builder){
    	
    	$builder -> string('username')
    		-> minLength(3)
    		-> maxLength(10)
    		-> match("/^([a-zA-Z0-9])*$/");

    	$builder -> boolean('active');

        $builder -> number('points') -> range(0,99);

    }

}

?>