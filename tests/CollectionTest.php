<?php

use Illuminate\Foundation\Testing\TestCase;

use CoreWine\ORM\Test\Model\User;
use CoreWine\ORM\Test\Model\Gallery;

class CollectionTest extends TestCase{

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
        $user -> gallery = ['main' => ['weight' => 1,'file' => 'my_path']];
        $user -> gallery = collect(['main' => ['weight' => 1,'file' => 'my_path']]);
        $user -> save();
        $user -> delete();

    }

    /**
     * Test methods of object.
     *
     * @return void
     */
    public function testObjectSimple(){

        $user = User::first();


        $gallery_1 = new \stdClass;
        $gallery_1 -> weight = 1;
        $gallery_1 -> file = "my_path1";

        $gallery_2 = new \StdClass;
        $gallery_2 -> weight = 2;
        $gallery_2 -> file = "my_path2";

        $user -> gallery = [];

        $user -> gallery -> add($gallery_1);
        $user -> gallery = $user -> gallery -> merge([$gallery_2]);

        $index = $user -> gallery -> search(function($item, $key){
            return $item -> weight == 1;
        });

        $user -> gallery -> get($index);
        $user -> gallery -> pull($index); 
        $user -> gallery -> add($gallery_1);
        $user -> gallery -> count();

        $user -> save();

    }


    /**
     * Test methods of object.
     *
     * @return void
     */
    public function testObjectModel(){

        $user = User::first();

        $gallery_1 = new Gallery();
        $gallery_1 -> weight = 1;
        $gallery_1 -> file = "my_path1";

        $gallery_2 = new Gallery();
        $gallery_2 -> weight = 2;
        $gallery_2 -> file = "my_path2";

        $user -> gallery_model = [];
        $user -> gallery_model -> add($gallery_1);

        $user -> gallery_model = $user -> gallery_model -> merge([$gallery_2]);

        $index = $user -> gallery_model -> search(function($item, $key){

            return $item -> weight == 1;
        });

        $user -> gallery_model -> get($index);
        $user -> gallery_model -> pull($index); 

        $user -> gallery_model -> add($gallery_1);

        $this -> assertEquals(2,$user -> gallery_model -> count());
        $this -> assertEquals(collect([1 => $gallery_2,2 => $gallery_1]) -> toArray(),$user -> gallery_model -> toArray());

        $user -> save();

        $user = User::first();

        foreach($user -> gallery_model as $k){
        }
    }


    /**
     * @expectedException CoreWine\ORM\Field\Collection\Exceptions\InvalidTypeValueException
     */
    public function testUnexpectedValueException(){

        $user = User::first();

        $gallery_1 = new \stdClass;
        $gallery_1 -> weight = 1;
        $gallery_1 -> file = "my_path1";

        # Class type is different
        $user -> gallery_model -> add($gallery_1);

    }
}