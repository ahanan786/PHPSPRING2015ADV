<?php
/**
 * Description of CarService
 *
 * @author AHANAN
 */

namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IService;
use App\models\interfaces\IModel;

class CarService implements IService {
    
    protected $carDAO;
    protected $carTypeService;
    protected $validator;
    protected $model;
                function getValidator() {
        return $this->validator;
    }
    /**
     * Generate link.
     * @CAR dao string $pad target page
     * @Set validatr setting upp all the validation values
     * function get car and set car is basically setting up both values of car
     * @function getallcar types basically load all the cars 
     * @validator making sure the year, make , model is setting up all the values
     * @CRUD making sure everythiing is being create than read, update and delete
     */

    function setValidator($validator) {
        $this->validator = $validator;
    }                
     
    function getCarDAO() {
        return $this->carDAO;
    }

    function setCarDAO(IDAO $DAO) {
        $this->carDAO = $DAO;
    }
    
    function getCarTypeService() {
        return $this->carTypeService;
    }

    function setCarTypeService(IService $service) {
        $this->carTypeService = $service;
    }
    
    
    function getModel() {
        return $this->model;
    }

    function setModel(IModel $model) {
        $this->model = $model;
    }

        public function __construct( IDAO $carDAO, IService $carTypeService, IService $validator, IModel $model  ) {
        $this->setCarDAO($carDAO);
        $this->setCarTypeService($carTypeService);
        $this->setValidator($validator);
        $this->setModel($model);
    }
    
    
    public function getAllCarTypes() {       
        return $this->getCarTypeService()->getAllRows();   
        
    }
    
     public function getAllCars() {       
        return $this->getCarDAO()->getAllRows();   
        
    }
    
    public function create(IModel $model) {
        if ( count($this->validate($model)) === 0 ) {
            return $this->getCarDAO()->create($model);
        }
        return false;
    }
    
    
    public function validate( IModel $model ) {
        $errors = array();
        
        if (!$this->getValidator()->carYearIsValid($model->getYear()))
        {
            echo 'Car year has to be from 1950 to '.'</br>';   
           
        }
          if (!$this->getValidator()->carMakeIsValid($model->getMake()))
        {
            echo 'Car Make is blank'.'</br>';   
           
        }
          if (!$this->getValidator()->carModelIsValid($model->getModel()))
        {
            $errors[] = "Car Model is empty";
        }

        
        return $errors;
    }
    
    
    public function read($id) {
        return $this->getCarDAO()->read($id);
    }
    
    public function delete($id) {
        echo 'in service';
       echo "<br/>".$id."<br/>";
        return $this->getCarDAO()->delete($id);
        
    }
   
    
     public function update(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getCarDAO()->update($model);
        }
        return false;
    }
    
    
     public function getNewCarModel() {
        return clone $this->getModel();
    }
    
    
}
