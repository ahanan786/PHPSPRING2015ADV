<?php

/**
 * Description of PhotoTypeModel
 *
 * @author AHANAN
 */

namespace App\models\services;


class CarTypeModel extends BaseModel {
    
    private $cartypeid;
    private $cartype;
    private $active;
    
    function getCartypeid() {
        return $this->cartypeid;
    }

    function getCartype() {
        return $this->cartype;
    }

    function getActive() {
        return $this->active;
    }

    function setCartypeid($cartypeid) {
        $this->cartypeid = $cartypeid;
    }

    function setCartype($cartype) {
        $this->cartype = $cartype;
    }

    function setActive($active) {
        $this->active = $active;
    }


}
