<?php include 'is-logged-in.php'; ?>
<!DOCTYPE html>
<html>
    
    <head>
       
       
        <link href="app.css" rel="stylesheet" type="text/css"/>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
                
         if ( $scope->util->isPostRequest() ) {
             
             if ( isset($scope->view['errors']) ) {
                print_r($scope->view['errors']);
             }
             
             if ( isset($scope->view['saved']) && $scope->view['saved'] ) {
                  echo 'Car Added';
             }
             
             if ( isset($scope->view['deleted']) && $scope->view['deleted'] ) {
                  echo 'Car deleted';
             }
             
         }
            $carTypeid = $scope->view['model']->getCarTypeId();
            $carid = $scope->view['model']->getCarid();
            $year= $scope->view['model']->getYear();
            $make= $scope->view['model']->getMake();
            $model= $scope->view['model']->getModel();
            $platenum= $scope->view['model']->getPlatenum();
            $carcondition= $scope->view['model']->getCarcondition();
            $vin= $scope->view['model']->getVin();
            $price= $scope->view['model']->getPrice();
        ?>
        
        <h3>Add car</h3>
        <form action="#" method="post">
            <label>Year:</label>            
            <input type="text" name="year" value="<?php echo $year; ?>" placeholder="" />
            <br /><br />
            <label>Make:</label>
         <input type="text" name="make" value="<?php echo $make; ?>" placeholder="" />
            
             <label>Model:</label>            
            <input type="text" name="model" value="<?php echo $model; ?>" placeholder="" />
            <br /><br />
            <label>Plate Number:</label>
             <input type="text" name="platenum" value="<?php echo $platenum; ?>" placeholder="" />
            
             <label>Car Condition:</label>            
            <input type="text" name="carcondition" value="<?php echo $carcondition; ?>" placeholder="" />
            <br /><br />
            <label>Vin Number:</label>
           <input type="text" name="vin" value="<?php echo $vin; ?>" placeholder="" />
            
             <label>Price:</label>            
            <input type="text" name="price" value="<?php echo $price; ?>" placeholder="" />
            <br /><br />
           
            <label>Car Type:</label>
            <select name="cartypeid">
            <?php 
                foreach ($scope->view['carTypes'] as $value) {
                    if ( $value->getCarTypeId() == $carTypeid ) {
                        echo '<option value="',$value->getCarTypeId(),'" selected="selected">',$value->getCarType(),'</option>';  
                    } else {
                        echo '<option value="',$value->getCarTypeId(),'">',$value->getCarType(),'</option>';
                    }
                }
            ?>
            </select>
            
             <br /><br />
            <input type="hidden" name="action" value="create" />
            <input type="submit" value="Submit" />
        </form>
        
        
        
         <br />
         <br />
         
        <form action="#" method="post">
            <input type="hidden" name="action" value="add" />
            <input type="submit" value="ADD Page" /> 
        </form>
        
         <?php 
         
          if ( count($scope->view['cars']) <= 0 ) {
                echo '<p>No Data</p>';
            } else {
                echo '<table border="1" cellpadding="5">';
                 echo'<tr>';
                echo '<th>Year</th><th>Make</th><th>Model</th><th>Platenum</th><th>Condition</th><th>Price</th><th>Vin</th><th>Car Type</th>';
                 echo '</tr>';
                 
                foreach ($scope->view['cars'] as $value) {
                    echo "<tr>";

                    
                    echo "<td>". $value->getYear()."</td>";
                   echo '<td>'. $value->getVin().'</td>';
                    echo '<td>'. $value->getMake().'</td>';
                    echo '<td>'. $value->getModel().'</td>';
                    echo '<td>'. $value->getPlatenum().'</td>';
                    echo '<td>'. $value->getCarcondition().'</td>';
                    echo '<td>'. $value->getPrice().' </td>';
                    echo '<td>'. $value->getCartype().' </td>';
                    
                    echo '<td><form action="#" method="post"><input type="hidden"  name="carid" value="',$value->getCarid(),'" /><input type="hidden" name="action" value="edit" /><input type="submit" value="EDIT" /> </form></td>';
                    echo '<td><form action="#" method="post"><input type="hidden"  name="carid" value="',$value->getCarid(),'" /><input type="hidden" name="action" value="delete" /><input type="submit" value="DELETE" /> </form></td>';
               
                    echo '</tr>' ;
                }
                echo '</table>';
            }
           
           

         ?>
            
    </body>
</html>
