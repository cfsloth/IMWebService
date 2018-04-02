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
               sprintf("SELECT c.information_warning_id as warnindId, b.email as userEmailSend, "
                       . "c.description, c.severity, c.subject, c.date "
                       . "FROM users a, users b, information_warnings c "
                       . "WHERE a.id_user = c.user_receiving_id "
                       . "AND c.user_sending_id = b.id_user "
                       . "AND a.email = '%s'",$administrator_email));
        echo json_encode($data);
    }
    
    function getTheAdminWithLessWarnings(){
        $database = new Database();
        $connection = $database->openConection();
        //Gets admins that didn't receive requests
        $data = $database->getData($connection,"SELECT DISTINCT id_user FROM users,information_warnings "
                        . "WHERE users.id_user != information_warnings.user_receiving_id "
                        . "AND users.userTypes_id_type = 1 LIMIT 1");
        if(isset($data[0])){
            echo json_encode(array('user_receiving_id'=>$data[0]['id_user']));
        }else{
            //Gets admin with less requests
            $data = $database->getData($connection,"SELECT information_warnings.user_receiving_id "
                    . "FROM information_warnings,users WHERE information_warnings.user_receiving_id = users.id_user "
                    . "AND users.userTypes_id_type = 1 GROUP BY user_receiving_id LIMIT 1");
            echo json_encode(array('user_receiving_id'=>$data[0]['user_receiving_id']));
        }
    }
    
    function postWarning($warning){
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
