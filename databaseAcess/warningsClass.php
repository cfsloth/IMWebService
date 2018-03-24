<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of warningsClass
 *
 * @author Claudio
 */
class WarningsClass {
    
    function __construct(){
        
    }
    
    function getWarningByAdministratorEmail($administrator_email){
        $database = new Database();
        $connection = $database->openConection();
        $data = $database->getData($connection, 
               sprintf("SELECT c.information_warning_id, b.email as send_user, "
                       . "c.description, c.severity, c.subject "
                       . "FROM users a, users b, information_warnings c "
                       . "WHERE a.id_user = c.user_receiving_id "
                       . "AND c.user_sending_id = b.id_user "
                       . "AND a.email = '%s'"
                       , $administrator_email));
        echo json_encode($data);
    }
    
    function addWarning($warning){
        $database = new Database();
        $connection = $database->openConection();
        $data = $database->setData($connection, 
                sprintf("INSERT INTO information_warnings(information_warning_id,"
                        . "user_sending_id,user_receiving_id,description,severity,"
                        . "subject) VALUES (NULL,'%d','%d','%s','%s','%s')",
                        $warning['user_sending_id'],$warning['user_receiving_id'],
                        $warning['description'],$warning['severity'],$warning['subject']));
        if($data == 1){
            echo "SUCESS";
        }
    }
 
    function deleteWarningById($id){
        $database = new Database();
        $connection = $database->openConection();
        $data = $database->setData($connection, 
                sprintf("DELETE FROM information_warnings "
                        . "WHERE information_warnings.information_warning_id = '%s'"
                        ,$id["id"]));
        if($data == 1){
            echo "SUCESS";
        }
    }
}