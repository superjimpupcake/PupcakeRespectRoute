PupcakeRespectRoute
===================

Add Contraints to Pupcake Route using Respect/Validation

##Usage:
###Install Pupcake/RespectRoute package via composer
###Hook up to system.routing.route.create event to return a new Pupcake\RespectRoute instance
```php
<?php
$app = new Pupcake\Pupcake();
$app->on("system.routing.route.create", function(){
    return new Pupcake\RespectRoute();
});
$app->get("api/hello/:string", function($string){
    return $string;
})->constraint(array(':string' => '@email'));
$app->get("api/hello/:string", function($string){
    return $string;
})->constraint(array(':string' => '/^[a-z]$/'));

$app->run();
```
