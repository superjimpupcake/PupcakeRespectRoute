PupcakeRespectRoute
===================

Add Contraints to Pupcake Route using Respect/Validation

##Usage:
###Install Pupcake/RespectRoute package via composer
###Hook up to system.routing.route.create event to return a new Pupcake\RespectRoute instance
###For details please see https://github.com/Respect/Validation
```php
$app = new Pupcake\Pupcake();
$app->on("system.routing.route.create", function(){
    return new Pupcake\RespectRoute();
});

/**
 * match email address
 */
$app->get("api/email/:string", function($string){
    return $string;
})->constraint(array(':string' => '@email'));

/**
 * match ip address
 */
$app->get("api/ip/:string", function($string){
    return $string;
})->constraint(array(':string' => '@ip'));

/**
 * match prime number
 */
$app->get("api/prime/:string", function($string){
    return $string;
})->constraint(array(':string' => '@primeNumber'));

/**
 * match domain
 */
$app->get("api/prime/:string", function($string){
    return $string;
})->constraint(array(':string' => '@domain'));

/**
 * match regular expression
 */
$app->get("api/oneletter/:string", function($string){
    return $string;
})->constraint(array(':string' => '/^[a-z]$/'));

$app->run();
```
