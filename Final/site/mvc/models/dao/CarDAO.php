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
        $stmt = $db->prepare("SELECT CarID FROM cars WHERE CarID = :CarID");
         
        if ( $stmt->execute(array(':CarID' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        }
         return false;
    }
    
    public function read($id) {
         
         $model = clone $this->getModel();
         
         $db = $this->getDB();
           
         $stmt = $db->prepare("SELECT cars.carid, cars.Year, cars.Make, cars.platenum,cars.model,cars.carcondition,  "
                 . "cars.vin, cars.price, cartypes.cartype FROM cars "
                 . "LEFT JOIN cartypes on cars.cartypeid = cartypes.cartypeid WHERE CarID =:carid");
         
        if ( $stmt->execute(array(':carid' => $id)) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetch(PDO::FETCH_ASSOC);
             $model->map($results);
        }
         
        return $model;
         
        
    }
    
    
    public function create(IModel $model) {
         $db = $this->getDB();
         
         $binds = array( 
                         ":typeid" => $model->getCarTypeId(),
                         ":year"=>$model->getYear(),
                         ":make"=>$model->getMake(),
                         ":model"=>$model->getModel(),
                         ":platenum"=>$model->getPlatenum(),
                         ":condition"=>$model->getCarcondition(),
                         ":vin"=>$model->getVin(),
                         ":price"=>$model->getPrice(),
                    );
         
                         
         if ( !$this->idExisit($model->getCarid()) ) {
             $stmt = $db->prepare("INSERT INTO cars SET price =:price,cartypeid=:typeid,"
                     . " year = :year, make = :make , model = :model, platenum = :platenum,"
                     .  " carcondition = :condition, vin = :vin");
             
             if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                 return true;
             }
         }
                  
         echo "<br/>Returning Fals<br/>";
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
                         ":condition"=>$model->getCarcondition(),
                         ":vin"=>$model->getVin(),
                         ":price"=>$model->getPrice(),
                    );
      
              if ( $this->idExisit($model->getCarid()) ) {
           
            
             $stmt = $db->prepare("Update cars SET cartypeid = :typeid," 
                     ."year = :year, make = :make , model = :model, platenum = :platenum,"
                     .  "carcondition = :condition, vin = :vin, price = :price "
                     . "  WHERE CarID = :carid");
             
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
        echo 'Deeleting</br>';
        echo $id;
        echo "<br/>";   
          
        $db = $this->getDB();         
        $stmt = $db->prepare("Delete FROM cars WHERE CarID = :carid");

        if ( $stmt->execute(array(':carid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        } else {
            $error = implode(",", $db->errorInfo());
            $this->getLog()->logError($error);
        }
         
         return false;
    }
    
    public function getAllRows() {
       echo "Getting all rows";
        $db = $this->getDB();
       $values = array();
       
        $stmt = $db->prepare("SELECT cars.carid, cars.Year, cars.Make,cars.Model, cars.platenum,cars.vin,cars.price, cars.carcondition ,cartypes.cartype cartype FROM cars LEFT JOIN cartypes on cars.cartypeid = cartypes.cartypeid");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           // var_dump($results);
            echo $stmt->rowCount();
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
