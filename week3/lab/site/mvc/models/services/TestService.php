<?php

namespace App\models\services;

use App\models\interfaces\IService;


class TestService implements IService{
    
    
    public function validateForm($email) {
        
        if ( !empty($email) ) {
            return true;
        }
        return false;
        
    }
    
}
