<?php
/**
 * Description of PhoneDAO
 *
 * @author AHANAN
 */

namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IModel;
use App\models\interfaces\ILogging;
use \PDO;


class CarDAO extends BaseDAO implements IDAO {
        
     public function __construct( PDO $db, IModel $model, ILogging $log ) {        
        $this->setDB($db);
        $this->setModel($model);
        $this->setLog($log);
    }
    
    
    public function idExisit($id) {
                
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT Car_ID FROM cars WHERE Car_ID = :Car_ID");
         
        if ( $stmt->execute(array(':Car_ID' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        }
         return false;
    }
    
    public function read($id) {
         
         $model = clone $this->getModel();
         
         $db = $this->getDB();
         
         $stmt = $db->prepare("SELECT cars.Car_ID, cars.Year, cars.Make, cars.platenum, cars.condition1,cartype.cartype"
                 . " FROM cars LEFT JOIN carypes on cars.cartypeid = cartype.cartypeid WHERE Car_ID = :carid");
         
        if ( $stmt->execute(array(':carid' => $id)) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetch(PDO::FETCH_ASSOC);
             $model->map($results);
        }
         
        return $model;
         
        
    }
    
    
    public function create(IModel $model) {
                 
         $db = $this->getDB();
         
         $binds = array( ":typeid" => $model->getCarTypeId(),
                         ":year"=>$model->getYear(),
                         ":make"=>$model->getMake(),
                         ":model"=>$model->getModel(),
                         ":platenum"=>$model->getPlatenum(),
                         ":condition"=>$model->getCondition(),
                         ":vin"=>$model->getVin(),
                         ":price"=>$model->getPrice(),
                    );
                         
         if ( !$this->idExisit($model->getCarid()) ) {
             
             $stmt = $db->prepare("INSERT INTO cars SET  cartypeid = :typeid,"
                     . " year = :year, make = :make , model = :model, platenum = :platenum,"
                     .  "condition1 = :condition, vin = :vin, price = :price,"
                     . " lastupdated = now()");
             
             if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                return true;
             }
         }
                  
         
         return false;
    }
    
    
     public function update(IModel $model) {
                 
         $db = $this->getDB();
         
        $binds = array( ":carid"=>$model->getCarId(),
                         ":typeid" => $model->getCarTypeId(),
                         ":year"=>$model->getYear(),
                         ":make"=>$model->getMake(),
                         ":model"=>$model->getModel(),
                         ":platenum"=>$model->getPlatenum(),
                         ":condition"=>$model->getCondition(),
                         ":vin"=>$model->getVin(),
                         ":price"=>$model->getPrice(),
                    );
         
                
         if ( $this->idExisit($model->getCarid()) ) {
            
             $stmt = $db->prepare("Update cars SET cartypeid = :typeid," 
                     ."year = :year, make = :make , model = :model, platenum = :platenum,"
                     .  "condition1 = :condition, vin = :vin, price = :price, "
                     . " lastupdated = now() WHERE Car_ID = :carid");
             
             if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                return true;
             } else {
                 $error = implode(",", $db->errorInfo());
                 $this->getLog()->logError($error);
             }
             
         } 
         
         return false;
    }
    
    public function delete($id) {
          
        $db = $this->getDB();         
        $stmt = $db->prepare("Delete FROM cars WHERE Car_ID = :carid");

        if ( $stmt->execute(array(':carid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        } else {
            $error = implode(",", $db->errorInfo());
            $this->getLog()->logError($error);
        }
         
         return false;
    }
    
    public function getAllRows() {
       $db = $this->getDB();
       $values = array();
       
        $stmt = $db->prepare("SELECT cars.Car_ID, cars.Year, cars.Make, cars.platenum, cars.condition1 ,cartype.cartype"
                 . " FROM cars LEFT JOIN carypes on cars.cartypeid = cartype.cartypeid");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $value) {
               $model = clone $this->getModel();
               $model->reset()->map($value);
               $values[] = $model;
            }
        }
        
        $stmt->closeCursor();
         return $values;
    }
    
    
}
