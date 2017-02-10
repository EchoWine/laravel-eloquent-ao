Laravel ORM - Attribute as an Object
=====
Treat your attributes as they deserve, as objects!

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
            
    	$builder -> boolean('active');
       
        $builder -> number('points') -> range(0,99);
    }

}

```
Boolean
------------
Starting with the easiest one, only two values accepted (true,false) 

```php
    $user = User::first();
    $user -> active = "true"; // true
    $user -> active = "false"; // false
    $user -> active = true; // true
    $user -> active = 1; // true
```
Number
------------
```php
    $user = User::first();
    $user -> points = 10;
```
###Methods

Method                                                 | Description
-------------------------------------------------------| -------------
range(int $min, int $max)                              | Minimum and maximum at once
min(int $min)                                          | Minimum value
max(int $max)                                          | Maximum value

###Exceptions

Exception                                              | Description
-------------------------------------------------------| -------------
CoreWine\ORM\Field\Number\Exceptions\TooSmallException | The value is too small
CoreWine\ORM\Field\Number\Exceptions\TooBigException   | The value is too big

String
------------
Thanks to magic methods editing the value of an attribute remains the same 

```php
    $user = User::first();
    $user -> username = "Admin";
    $user -> save();
```

But i told you, attributes are objects!

```php
    $user -> username -> toLowerCase(); // "admin"
    $user -> username -> length(); // 5
```

###Methods

Method                                                 | Description
-------------------------------------------------------| -------------
match(string\|closure $match)                           | A regular expression or a closure that define the correct value
minLength(int $min)                                    | Minimum length
maxLength(int $max)                                    | Maximum length

###Exceptions

Exception                                              | Description                                 
------------------------------------------------------ | -------------                                  
CoreWine\ORM\Field\Number\Exceptions\TooShortException | The value is too short 
CoreWine\ORM\Field\Number\Exceptions\TooLongException  | The value is too long 
CoreWine\ORM\Field\Number\Exceptions\InvalidException  | The value doesn't match with the regex/closure 

The string field is currently using Stringy\Stringy, check all methods available here [danielstjules/Stringy][stringy]


[stringy]:  https://github.com/danielstjules/Stringy
