<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        
        
         if ( isset($scope->view['updated']) ) {
            if( $scope->view['updated'] ) {        
                 echo 'Car Updated';
            } else {
                 echo 'Car NOT Updated';
            }                 
        }
        
            $carid = $scope->view['model']->getCarid();
            $car = $scope->view['model']->getCar();
            $active = $scope->view['model']->getActive();
            $carTypeid = $scope->view['model']->getCartypeid();
        ?>
        
        <h3>Add car</h3>
        <form action="#" method="post">
            
            <label>Car:</label>            
            <input type="text" name="car" value="<?php echo $car; ?>" placeholder="" />
            
            
            
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            
            <br /><br />
            <label>Car Type:</label>
            <select name="cartypeid">
            <?php 
                foreach ($scope->view['carTypes'] as $value) {
                    if ( $value->getCartypeid() == $carTypeid ) {
                        echo '<option value="',$value->getCartypeid(),'" selected="selected">',$value->getCartype(),'</option>';  
                    } else {
                        echo '<option value="',$value->getCartypeid(),'">',$value->getCartype(),'</option>';
                    }
                }
            ?>
            </select>
            
             <br /><br />
             <input type="hidden"  name="carid" value="<?php echo $carid; ?>" />
            <input type="hidden" name="action" value="update" />
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
                echo '<table border="1" cellpadding="5"><tr><th>Car</th><th>Car Type</th><th>Last updated</th><th>Logged</th><th>Active</th><th></th><th></th></tr>'; 
                 foreach ($scope->view['cars'] as $value) {
                    echo "<td>$value->getYear()</td>";
                    
                    echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>';
                     echo '<td><form action="#" method="post"><input type="hidden"  name="carid" value="',$value->getCarid(),'" /><input type="hidden" name="action" value="edit" /><input type="submit" value="EDIT" /> </form></td>';
                    echo '<td><form action="#" method="post"><input type="hidden"  name="carid" value="',$value->getCarid(),'" /><input type="hidden" name="action" value="delete" /><input type="submit" value="DELETE" /> </form></td>';
               
                    echo '</tr>' ;
                }
                echo '</table>';
            }
           
           

         ?>
            
    </body>
</html>
