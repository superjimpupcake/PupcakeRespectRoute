<?php
namespace Pupcake;

class RespectRoute extends Service
{
    public function start($config = array())
    {
        /**
         * When a route object is being created, we add the constraint method 
         * to it and store the constraint into this route object's storage
         */
        $this->on("system.routing.route.create", function($event){
            $route = $event->props('route');
            $route->method('constraint', function($constraint) use($route){
                $route->storageSet('constraint', $constraint);
                return $route; //return the route reference for futher extension
            });
        });

        /**
         * When a route object is initially matched, we add further checking logic 
         * to make sure the constraint is applying toward the route matching process
         */
        $this->on("system.routing.route.matched", function($event){
            $route = $event->props('route');
            $matched = true;
            $constraint = $route->storageGet('constraint');
            $params = $route->getParams();
            if(count($constraint) > 0){
                $validator_params = array();
                foreach($constraint as $token => $validator_name){
                    if(is_string($validator_name)){ //validation pattern
                        if($validator_name[0] == '@'){
                            $validator_name[0] = '';
                            $validator_name = trim($validator_name);
                        }
                        else{
                            $validator_params = array($validator_name); //this is a regex!
                            $validator_name = "regex";
                        }
                        $validator = call_user_func_array("Respect\Validation\Validator::$validator_name", $validator_params);
                        if(!$validator->validate($params[$token])){
                            $matched = false;
                            break;
                        }
                    }
                    else if(is_callable($validator_name)){ //validation callback
                        $matched = $validator_name($params[$token]);
                        if(!$matched){
                            break;
                        }
                    }
                }
            } 
            return $matched;

        });        
    }
}
