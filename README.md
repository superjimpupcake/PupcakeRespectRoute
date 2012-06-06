PupcakeRespectRoute
===================

Add Contraints to Pupcake Route using Respect/Validation

##Usage:
Install Pupcake/RespectRoute package via composer
Hook up to system.routing.route.create event and system.routing.route.matched event
```php
<?php
$app = new Pupcake\Pupcake();
$app->on("system.routing.route.create", function(){
    return new Pupcake\RespectRoute();
});
$app->on("system.routing.route.matched", function($route){
    return $route->matched();
});
$app->get("hello/:string", function($string){
    return $string;
})->constraint(array(':string' => '@email'));

$app->run();
```
