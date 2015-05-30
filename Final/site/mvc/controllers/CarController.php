<?php

namespace APP\controller;

use App\models\interfaces\IController;
use App\models\interfaces\IService;

class CarController extends BaseController implements IController {
   
    protected $service;
    
    public function __construct( IService $CarService  ) {                
        $this->service = $CarService;  
    }
    
    public function execute(IService $scope) {
        $viewPage = 'car';
        
        $this->data['model'] = $this->service->getNewCarModel();
        $this->data['model']->reset();
        
        if ( $scope->util->isPostRequest() ) {
            
            
            if ( $scope->util->getAction() == 'create' ) {

                $this->data['model']->map($scope->util->getPostValues());

                $this->data["errors"] = $this->service->validate($this->data['model']);
                $this->data["saved"] = $this->service->create($this->data['model']);
            }
            
            if ( $scope->util->getAction() == 'edit' ) {
                $viewPage .= 'edit';
                $this->data['model'] = $this->service->read($scope->util->getPostParam('carid'));
                  
            }
            
            if ( $scope->util->getAction() == 'delete' ) {                
                echo "Car Controller in Delete Action";
                
                $this->data["deleted"] = $this->service->delete($scope->util->getPostParam('carid'));
            }
            
             if ( $scope->util->getAction() == 'update'  ) {
                
                 
                 $this->data['model']->map($scope->util->getPostValues());
                
//                $this->data["errors"] = $this->service->validate($this->data['model']);
                
                $this->data["updated"] = $this->service->update($this->data['model']);
                 $viewPage .= 'edit';
            }
            
            
        }
        
        
        $this->data['carTypes'] = $this->service->getAllCarTypes(); 
        $this->data['cars'] = $this->service->getAllCars(); 
        
        $scope->view = $this->data;
        return $this->view($viewPage,$scope);
    }
    
}
