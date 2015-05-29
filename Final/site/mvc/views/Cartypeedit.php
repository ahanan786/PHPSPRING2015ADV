<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <?php
            
        
        if ( isset($scope->view['updated']) ) {
            if( $scope->view['updated'] ) {        
                 echo 'Car Updated';
            } else {
                 echo 'Car NOT Updated';
            }                 
        }
        
         $carType = $scope->view['model']->getCartype();
         $active = $scope->view['model']->getActive();
         $cartypeid = $scope->view['model']->getCartypeid();
        ?>
        
        
         <h3>Edit car type</h3>
        <form action="#" method="post">
            <label>Car Type:</label> 
            <input type="text" name="cartype" value="<?php echo $carType; ?>" placeholder="" />
            <input type="number" max="1" min="0" name="Active" value="<?php echo $active; ?>" />
            <input type="hidden"  name="cartypeid" value="<?php echo $cartypeid; ?>" />
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
         
         if ( count($scope->view['CarTypes']) <= 0 ) {
            echo '<p>No Data</p>';
        } else {
            
            
             echo '<table border="1" cellpadding="5"><tr><th>Car Type</th><th>Active</th><th></th><th></th></tr>';
             foreach ($scope->view['CarTypes'] as $value) {
                echo '<tr>';
                echo '<td>', $value->getCartype(),'</td>';
                echo '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>';
                echo '<td><form action="#" method="post"><input type="hidden"  name="cartypeid" value="',$value->getCartypeid(),'" /><input type="hidden" name="action" value="edit" /><input type="submit" value="EDIT" /> </form></td>';
                echo '<td><form action="#" method="post"><input type="hidden"  name="cartypeid" value="',$value->getCartypeid(),'" /><input type="hidden" name="action" value="delete" /><input type="submit" value="DELETE" /> </form></td>';
                echo '</tr>' ;
            }
            echo '</table>';
            
        }
         
         
         ?>
         
    </body>
</html>
