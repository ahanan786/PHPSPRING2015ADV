<?php

/**
 * Description of PhoneModel
 *
 * @author AHANAN
 */

namespace App\models\services;


class CarModel extends BaseModel {
    
   
    private $carid;
    private $year;
    private $make;
    private $model;
    private $platenum;
    private $condition;
    private $vin;
    private $price;
    private $typeId;
    
    
    function getCarTypeId(){
        return $this->typeId;
    }
    
    function getCarid() {
        return $this->carid;
    }

    function getYear() {
        return $this->year;
    }

    function getMake() {
        return $this->make;
    }
    
     function getModel() {
        return $this->model;
    }

    function getPlatenum() {
        return $this->platenum;
    }

    function getCondition() {
        return $this->condition;
    }

    function getVin() {
        return $this->vin;
    }

    function getPrice() {
        return $this->price;
    }
    
    function setCatTypeId($carTypeId)
    {
        $this->type = $carTypeId;
    }
    
    function setCarid($phoneid) {
        $this->carid = $carid;
    }

    function setYear($year) {
        $this->year = $year;
    }

    function setMake($make) {
        $this->make = $make;
    }

    function setModel($model) {
        $this->model = $model;
    }

    function setPlatenum($phonetypeactive) {
        $this->platenum = $platenum;
    }
    
    function setCondition($condition) {
        $this->condition = $condition;
    }

    function setVin($vin) {
        $this->vin = $vin;
    }

    function setPrice($price) {
        $this->price = $price;
    }
    
}
