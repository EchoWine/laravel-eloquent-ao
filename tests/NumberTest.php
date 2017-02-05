<?php

use Illuminate\Foundation\Testing\TestCase;

use CoreWine\ORM\Test\Model\User;

class NumberTest extends TestCase{

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

        $user -> points = 10;
            
        $this -> assertEquals(10,$user -> points);

        $user -> save();

        $user -> delete();

    }

    /**
     * @expectedException CoreWine\ORM\Field\Number\Exceptions\TooSmallException
     */
    public function testTooSmallException(){

        $user = User::first();

        # Invalid value (min: 0)
        $user -> points = -20;

    }

    /**
     * @expectedException CoreWine\ORM\Field\Number\Exceptions\TooBigException
     */
    public function testTooBigException(){

        $user = User::first();

        # Invalid value (max: 99)
        $user -> points = 200;
    }

}