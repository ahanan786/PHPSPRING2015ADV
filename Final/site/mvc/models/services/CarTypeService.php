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
// class of car type which has everything 
class CarTypeService implements IService {
    
     protected $DAO;
     protected $validator;
     protected $model;
             // to get the validator
     function getValidator() {
         return $this->validator;
     }
// to set the validator
     function setValidator($validator) {
         $this->validator = $validator;
     }
// function to get and set model
     function getModel() {
         return $this->model;
     }

     function setModel(IModel $model) {
         $this->model = $model;
     }
     
    // get and set of  doa 
     function getDAO() {
         return $this->DAO;
     }

     function setDAO(IDAO $DAO) {
         $this->DAO = $DAO;
     }
// construct function which has car type DOA. Service validator
    public function __construct( IDAO $CarTypeDAO, IService $validator,IModel $model  ) {
        $this->setDAO($CarTypeDAO);
        $this->setValidator($validator);
        $this->setModel($model);
    }
    
    // getting get all rowss
    public function getAllRows($limit = "", $offset = "") {
        return $this->getDAO()->getAllRows($limit, $offset);
    }
    // making sure if the id is exist
    public function idExist($id) {
        return $this->getDAO()->idExisit($id);
    }
    // CRUD FUNCTION READING THE DATABASE
    public function read($id) {
        return $this->getDAO()->read($id);
    }
    // DEELETING THE DATABASE
    public function delete($id) {
        return $this->getDAO()->delete($id);
    }
    // CREATE FUNCTION
    public function create(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getDAO()->create($model);
        }
        return false;
    }
    // UPDATE FUCTION
    public function update(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getDAO()->update($model);
        }
        return false;
    }
    // making sure its validation no validaton tho because nothing is there to validate
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
   // geetting new car type model 
    
    public function getNewCarTypeModel() {
        return clone $this->getModel();
    }
    
    
}
