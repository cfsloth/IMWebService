<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userClass
 *
 * @author Claudio
 */
class UserClass {
    //put your code here
    
    function __construct(){
        
    }
    
    function getUserByEmail($email){
        $database = new Database();
        $connection = $database->openConection();
        $data = $database->getData($connection, 
               sprintf("SELECT id_user,firstName,lastName,password,usertypes_id_type,"
                       . "department,position,email,deleted FROM users WHERE email = '%s'"
                       , $email));
        if(!isset($data[1]["firstName"])){ //To make sure only pass one row
        $json = array("id_user"=>$data[0]['id_user'],"firstName"=>$data[0]['firstName'],"lastName"=>$data[0]['lastName'],
            "password"=>$data[0]['password'],"userTypes_id_type"=>$data[0]['usertypes_id_type'],
            "department"=>$data[0]['department'],"position"=>$data[0]['position'],
            "email"=>$data[0]['email'],"deleted"=>$data[0]['deleted']);
        echo json_encode($json);
        }
    }
    
    function createUser($user_info){
        $database = new Database();
        $connection = $database->openConection();
        $data = $database->setData($connection,
               sprintf("INSERT INTO USERS(firstName,lastName,password,email,"
                       . "userTypes_id_type,department,position)"
                       . " VALUES('%s','%s','%s','%s','%s','%s','%s')",$user_info['firstName']
                       ,$user_info['lastName'],$user_info['password']
                       ,$user_info['email'],$user_info['userTypes_id_type']
                       ,$user_info['department'],$user_info['position']));
        if($data == 1){
            echo "SUCESS";
        }
    }
    
    function updatingUserPassword($user_info){
        $database = new Database();
        $connection = $database->openConection();
        //Update password
        $data = $database->setData($connection, 
                sprintf("UPDATE users SET users.password = '%s' WHERE users.email = '%s'"
                        ,$user_info['password'],$user_info['email']));
       if($data == 1){
           echo "SUCESS";
       }
    }
    
    function deletingUserByEmail($user_info){
        $database = new Database();
        $connection = $database->openConection();
        $data = $database->setData($connection, 
                sprintf("UPDATE users SET users.deleted = 1 WHERE users.email = '%s'",$user_info["email"]));
        if($data == 1){
            echo "SUCESS";
        }
    }
    
}