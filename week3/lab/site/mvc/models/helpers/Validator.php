<?php

namespace App\models\services;

use App\models\interfaces\IService;

class Validator implements IService {
    
    
    
    //A method to check if an email is valid
    public function emailIsValid($email) {
        return ( is_string($email) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false );
    }
    
    
    //A method to check if a email type is valid
    public function emailTypeIsValid($type) {
        return ( is_string($type) && preg_match("/^[a-zA-Z]+$/", $type) );
    }
    
    //A method to check if a email type is valid
    public function activeIsValid($type) {
        return ( is_string($type) && preg_match("/^[0-1]$/", $type) );
    }
}
