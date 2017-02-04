<?php

use Illuminate\Foundation\Testing\TestCase;

use Illuminate\Database\Capsule\Manager as DataBase;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

use CoreWine\ORM\Test\Model\User;

class StringTest extends TestCase{

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        
        $app = require __DIR__.'/../../../../bootstrap/app.php';
        $app -> make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

    }

    public function testBasic(){
    	
        $user = new User();

        $user -> username = "foo";
            
        $this -> assertEquals("foo",$user -> username);

        $user -> save();

        $user -> delete();

    }

    public function testStringfy(){

        $user = User::first();
        $user -> username = 'adminne';
        
        $this -> assertEquals(7,$user -> username -> length());
        $this -> assertEquals(1,$user -> username -> match("/^adminne$/"));
    }

    /**
     * @expectedException CoreWine\ORM\Field\String\Exceptions\TooShortException
     */
    public function testTooShortException(){

        $user = User::first();

        # Invalid length (min: 3)
        $user -> username = "f";

    }

    /**
     * @expectedException CoreWine\ORM\Field\String\Exceptions\TooShortException
     */
    public function testTooLongException(){

        $user = User::first();

        # Invalid length (max:14)
        $user -> username = "fffffffffffffff";
    }

    /**
     * @expectedException CoreWine\ORM\Field\String\Exceptions\InvalidException
     */
    public function testInvalidException(){

        $user = User::first();

        # Invalid match
        $user -> username = "ffffff@."; 
	
    }

}