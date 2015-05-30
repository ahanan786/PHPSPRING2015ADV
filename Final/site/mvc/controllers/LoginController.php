<?php

namespace APP\controller;

use App\models\interfaces\IController;
use App\models\interfaces\IService;

class LoginController extends BaseController implements IController {
  
    public function __construct( ) {        
    }


    public function execute(IService $scope) {                  
        
        $this->data["cool"] = 'testing';
        $scope->view = $this->data;
        return $this->view('login',$scope);
    }
    
}
