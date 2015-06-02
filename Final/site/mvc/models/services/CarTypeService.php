<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CarTypeService
 *
 * @author User
 */
/**
     * Generate link.
     * @CARtypeService dao string $pad target page
     * @SetModel just returning model into priavate and public.
     * class of CartYPERSERVICE setting up all the servicews  of car.
     * @function getallcar types basically load all the cars 
     * @getDoa setDoa making sure the types or email are getting into the databases
     * @CRUD making sure everythiing is being create than read, update and delete
     */
namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IService;
use App\models\interfaces\IModel;

class CarTypeService implements IService {
    
     protected $DAO;
     protected $validator;
     protected $model;
             
     function getValidator() {
         return $this->validator;
     }

     function setValidator($validator) {
         $this->validator = $validator;
     }

     function getModel() {
         return $this->model;
     }

     function setModel(IModel $model) {
         $this->model = $model;
     }
     
     
     function getDAO() {
         return $this->DAO;
     }

     function setDAO(IDAO $DAO) {
         $this->DAO = $DAO;
     }

    public function __construct( IDAO $CarTypeDAO, IService $validator,IModel $model  ) {
        $this->setDAO($CarTypeDAO);
        $this->setValidator($validator);
        $this->setModel($model);
    }
    
    
    public function getAllRows($limit = "", $offset = "") {
        return $this->getDAO()->getAllRows($limit, $offset);
    }
    
    public function idExist($id) {
        return $this->getDAO()->idExisit($id);
    }
    
    public function read($id) {
        return $this->getDAO()->read($id);
    }
    
    public function delete($id) {
        return $this->getDAO()->delete($id);
    }
    
    public function create(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getDAO()->create($model);
        }
        return false;
    }
    
    public function update(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getDAO()->update($model);
        }
        return false;
    }
    
    public function validate( IModel $model ) {
        $errors = array();
        if ( !$this->getValidator()->carTypeIsValid($model->getCartype()) ) {
            $errors[] = 'Car Type is invalid';
        }
               
        if ( !$this->getValidator()->activeIsValid($model->getActive()) ) {
            $errors[] = 'Car active is invalid';
        }
       
        
        return $errors;
    }
    
    
    public function getNewCarTypeModel() {
        return clone $this->getModel();
    }
    
    
}
