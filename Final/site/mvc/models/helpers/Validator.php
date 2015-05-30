<?php

namespace App\models\services;

use App\models\interfaces\IService;

class Validator implements IService {
    
    
    
    //A method to check if an email is valid
    public function carYearIsValid($year) {
        return ( !empty($year) && $year > 1950 && $year <= 2015 );
        //return ( !empty($year));
    }
    public function carModelIsValid($model) {
       
        return ( !empty($model));
    }
    public function carMakeIsValid($make) {
       
        return ( !empty($make));
    }
     
    
    
    //A method to check if a email type is valid
   
    
    //A method to check if a email type is valid
    public function activeIsValid($type) {
        return ( is_string($type) && preg_match("/^[0-1]$/", $type) );
    }
}
