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
    private $carcondition;
    private $vin;
    private $price;
    private $cartypeid;
    private $cartype;
    
    
    function getCarTypeId(){
        return $this->cartypeid;
    }
    function getCartype()
    {
        return $this->cartype;
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

    function getCarcondition() {
        return $this->carcondition;
    }

    function getVin() {
        return $this->vin;
    }

    function getPrice() {
        return $this->price;
    }
    
    function setCartype($cartype)
    {
        $this->cartype = $cartype;
    }
    
    function setCarTypeId($carTypeId)
    {
        $this->cartypeid = $carTypeId;
    }
    
    function setCarid($carid) {
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

    function setPlatenum($platenum) {
        $this->platenum = $platenum;
    }
    
    function setCarcondition($carcondition) {
        $this->carcondition = $carcondition;
    }
    

    function setVin($vin) {
        $this->vin = $vin;
    }

    function setPrice($price) {
        $this->price = $price;
    }
    
}
