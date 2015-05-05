<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
       $dbConfig = array(
                    "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=phpadvspring2015',
                    "DB_USER"=>'root',
                    "DB_PASSWORD"=>''
                );

           $pdo = new DB($dbConfig);
            $db = $pdo->getDB();
                              
            // get values from URL
            $emailid = filter_input(INPUT_GET, 'emailid');
            
            if ( NULL !== $emailid ) {
               $emailDAO = new EmailDAO($db);
               
               if ( $emailDAO->delete($emailid) ) {
                   echo 'Email  was deleted';
                   
               }
               else{
                   echo "problem Deleting\n";
               }               
        
            }
            echo $emailid;
          
             echo '<p><a href="',filter_input(INPUT_SERVER, 'HTTP_REFERER'),'">Go back</a></p>';
        
        ?>
    </body>
</html>
