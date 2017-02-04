Laravel ORM - Attribute as an Object
=====
Treat your attributes as their deserve, as objects!

Installation
------------
Modify your composer.json and run `composer update`

``` json
{
    "require": {
        "echowine/laravel-orm-ao":"@dev"
    }
}
```

Defining a Model
------------


```php

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
    		-> minLength(3
