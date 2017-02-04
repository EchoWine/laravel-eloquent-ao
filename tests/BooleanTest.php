<?php

use Illuminate\Foundation\Testing\TestCase;

use CoreWine\ORM\Test\Model\User;

class BooleanTest extends TestCase{

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

    /**
     * Test basic setting/getting value.
     *
     * @return void
     */
    public function testBasic(){
        
        $user = new User();

        $user -> active = 0;

        $this -> assertEquals(false,$user -> active);

        $user -> active = "true";

        $this -> assertEquals(true,$user -> active);

        $user -> active = false;

        $this -> assertEquals(false,$user -> active);
    }

    /**
     * Test methods of object.
     *
     * @return void
     */
    public function testObject(){

        $user = User::first();
        
        
        if($user -> active){

        }
        
    }

 

}