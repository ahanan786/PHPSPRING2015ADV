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
     
        $emailtype = filter_input(INPUT_POST, 'emailtype');
        
        
        $util = new Util();
        $validator = new Validator();
        
        
        $errors = array();
        
       
        if ($util->isPostRequest())
        {
           
            if (!$validator->emailTypeIsValid($emailtype))
            {
                $errors[] = 'Email type is not valid';
            }
           
        
        if (count($errors) > 0)
        {
            foreach ($errors as $value)
            {
                echo '<p>',$value,'</p>';
            }
            
        }
        else
        {
            
            $emailClass = new emailTypeDB();
            echo $emailClass->addEmail($emailtype);
           
        }
        
    }
        
        ?>
        
        <h3>Add Email Type</h3>
        <form action="#" method="post">
            <label>Email Type:</label>
            <input type="text" name="emailtype" value="<strong<?php echo $emailtype; ?></strong>" />
            <input type="submit" value="Submit" />
        </form>
        
        
        <?php
        
     
        $emailClass = new emailTypeDB();
        $newresult = $emailClass->display();
        
        ?>
    </body>
</html>
