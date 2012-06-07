<?php
namespace Pupcake;

class RespectRoute extends Route
{
    private $route_constraint;

    public function constraint($route_constraint = array())
    {
        $this->route_constraint = $route_constraint;
    }

    public function getConstraint()
    {
        return $this->route_constraint;
    }

    public function matched(){
        $matched = true;
        $constraint = $this->getConstraint();
        $params = $this->getParams();
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
                }
            }
        } 
        return $matched;
    }
}
