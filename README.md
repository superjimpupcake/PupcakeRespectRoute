PupcakeRespectRoute
===================

Add Contraints to Pupcake Route using Respect/Validation

##Usage:
###Install Pupcake/RespectRoute package via composer
###get plugin Pupcake\RespectRoute
###This requires Respect/Valiation package,see https://github.com/Respect/Validation
```php
<?php

//Assiming this is public/index.php and the composer vendor directory is ../vendor

require_once __DIR__.'/../vendor/autoload.php';

$app = new Pupcake\Pupcake();
$app->usePlugin("Pupcake\RespectRoute");


/**
 * match email address
 */
$app->get("api/email/:string", function($req, $res){
    $res->send($req->params('string'));
})->constraint(array('string' => '@email'));

/**
 * match ip address
 */
$app->get("api/ip/:string", function($req, $res){
    $res->send($req->params('string'));
})->constraint(array('string' => '@ip'));

/**
 * match prime number
 */
$app->get("api/prime/:string", function($req, $res){
    $res->send($req->params('string'));
})->constraint(array('string' => '@primeNumber'));

/**
 * match domain
 */
$app->get("api/domain/:string", function($req, $res){
    $res->send($req->params('string'));
})->constraint(array('string' => '@domain'));

/**
 * match uppercase
 */
$app->get("api/upper/:string", function($req, $res){
    $res->send($req->params('string'));
})->constraint(array('string' => '@uppercase'));

/**
 * match regular expression
 */
$app->get("api/oneletter/:string", function($req, $res){
    $res->send($req->params('string'));
})->constraint(array('string' => '/^[a-z]$/'));

/**
 * Advance matching using constraint callback
 */
$app->get("api/validate/:token", function($req, $res){
    $res->send($req->params('token'));
})->constraint(array(
    'token' => function($value){
       return Respect\Validation\Validator::date('Y-m-d')->between('1980-02-02', 'now')->validate($value);
    }
));

$app->run();

```
