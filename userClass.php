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
               sprintf("SELECT firstName,lastName,password,usertypes_id_type,"
                       . "department,position,email FROM users WHERE email = '%s'"
                       , $email ));
        if(!isset($data[1]["firstName"])){ //To make sure only pass one row
        $json = array("firstName"=>$data[0]['firstName'],"lastName"=>$data[0]['lastName'],
            "password"=>$data[0]['password'],"userTypes_id_type"=>$data[0]['usertypes_id_type'],
            "department"=>$data[0]['department'],"position"=>$data[0]['position'],
            "email"=>$data[0]['email']);
        echo json_encode($json);
        }
    }
    
    function createUser($first_name,$last_name,$password,$email){
        $database = new Database();
        $connection = $database->openConection();
        $data = $database->setData($connection,
               sprintf("INSERT INTO USERS(firstName,lastName,password,email)"
                       . " VALUES('%s','%s','%s','%s')",$first_name,$last_name
               ,$password,$email));
        if($data == 1){
            echo "SUCCESS";
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
