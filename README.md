Laravel ORM - Attribute as an Object
=====
Treat your attribute as their deserve, as objects!

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
    		-> minLength(3)
    		-> maxLength(10)
    		-> match("/^([a-zA-Z0-9])*$/");
    }

}
```

String
------------
Thanks to magic methods editing the value of an attribute remains the same 

```php
    $user = User::first();
    $user -> username = "Admin";
    $user -> save();
```

But i told you, the attributes are objects!

```php
    $user -> username -> toLoweCase(); // "admin"
    $user -> username -> length(); // 5
```

The string field is currently using Stringy\Stringy so all methods is available
