<?php

class TwoFA {
    public $code;

    function __construct(){
        $this->code = TwoFA::getRandomString(6);
    }

    static function getRandomString($n){
        return bin2hex(random_bytes($n / 2));
    }
}

?>