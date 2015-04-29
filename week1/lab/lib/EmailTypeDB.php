<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailTypeDB
 *
 * @author HANAN
 */
class EmailTypeDB {
public function addEmail($emailtype)
    {
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=phpadvspring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
            );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype");
            
            $values = array(":emailtype"=>$emailtype);
            
            if ($stmt->execute($values) && $stmt->rowCount() > 0)
            {
                return 'Email Type Added';
            }
            else
            {
                return 'Error: please try again.';
            }
            
    }
    
    
    
  
    public function display()
    {
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=phpadvspring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
            );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        $emailtypes[] = array();
        $stmt = $db->prepare("SELECT * FROM emailtype");
        
        if ($stmt->execute() && $stmt->rowCount() > 0)
        {
            //fetchAll gets al the values and fetch gets one row
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            //Results are return as a assoc array
            foreach($results as $value)
            {
                //$emailtypes[] = $value['emailtype'];
                echo '<p><strong>', $value['emailtype'], '</strong></p>';
            }
            
        }
        else
        {
            echo '<p>No Data</p>';
        }
        
      
        return 0;
    }
}

