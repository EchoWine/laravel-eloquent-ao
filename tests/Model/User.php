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

        $builder -> string('role') -> match(function($value){
            return in_array($value,['ADMIN','USER']);
        });

    	$builder -> boolean('active');

        $builder -> number('points') -> range(0,99);
        
        /*
        $builder -> collection('roles') -> strict(function(AttributesBuilder $builder){
            $builder -> enum('role') -> values(['ADMIN','USER','GUETS']);
        });*/

        $builder -> collection('gallery');

        $builder -> collection('gallery_model') -> type(Gallery::class);
        
        return;

        $builder -> collection('gallery_builder') -> builder(function(AttributesBuilder $builder){
            $builder -> string('file');
            $builder -> string('weight');
        });

    	/*
    	$builder -> number('points')
    		-> min(0)
    		-> max(999)
    		-> step(0.1)
    		-> format(function($value){
    			return number_format($value,2,",",".");
    		});

    	*/
    }

}

?>