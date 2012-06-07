PupcakeRespectRoute
===================

Add Contraints to Pupcake Route using Respect/Validation

##Usage:
###Install Pupcake/RespectRoute package via composer
###Hook up to system.routing.route.create event and system.routing.route.matched to return a new Pupcake\RespectRoute instance
###For details please see https://github.com/Respect/Validation
```php
<?php
$app = new Pupcake\Pupcake();
$app->on("system.routing.route.create", function(){
    return new Pupcake\RespectRoute();
});
$app->on("system.routing.route.matched", function($route){
    return $route->matched();
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
$app->get("api/domain/:string", function($string){
    return $string;
})->constraint(array(':string' => '@domain'));

/**
 * match uppercase
 */
$app->get("api/upper/:string", function($string){
    return $string;
})->constraint(array(':string' => '@uppercase'));

/**
 * match regular expression
 */
$app->get("api/oneletter/:string", function($string){
    return $string;
})->constraint(array(':string' => '/^[a-z]$/'));

/**
 * Advance matching using constraint callback
 */
$app->get("api/validate/:token", function($token){
    return $token;
})->constraint(array(
    ':token' => function($value){
       return Respect\Validation\Validator::date('Y-m-d')->between('1980-02-02', 'now')->validate($value);
    }
));

$app->run();
```
