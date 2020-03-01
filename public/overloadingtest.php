<?php
// https://stackoverflow.com/questions/4697705/php-function-overloading 
// https://www.php.net/manual/fr/control-structures.switch.php 
// https://www.tutorialspoint.com/what-is-method-overloading-in-php 
// https://www.php.net/manual/fr/function.call-user-func-array.php 
class OverloadingTest {
    public function __call($name, $arguments) {
        if($name == 'method') {
            switch(count($arguments)) {
                case 1 : 
                    return call_user_func_array(array($this, 'methodOneArg'), $arguments); //Callback
                    break;
                case 2 : 
                    return call_user_func_array(array($this, 'methodTwoArgs'), $arguments); //Callback
                    break;
                default:
                    return "Method unknow";
                    break;
            }
        }
    }
    
    public function methodOneArg($a) {
        echo "Hello $a<br>";
    }
    
    public function methodTwoArgs($a, $b) {
        echo "Hello $a $b<br>";
    }
}

$obj = new OverloadingTest;
$obj->method("Johny");
$obj->method("Johny", "Depp");