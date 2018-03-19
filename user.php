<?php
   include("databaseAcess.php");
   
   $method = $_SERVER['REQUEST_METHOD'];
   
   /*GET REQUEST */
   if(isset($_GET['email'])){
        $database = new Database();
        $connection = $database->openConection();
        $data = $database->getData($connection, 
               sprintf("SELECT firstName,lastName,password,usertypes_id_type,"
                       . "department,position,email FROM users WHERE email = '%s'"
                       , $_GET['email']));
        if(!isset($data[1]["firstName"])){ //To make sure only pass one row
        $json = array("firstName"=>$data[0]['firstName'],"lastName"=>$data[0]['lastName'],
            "password"=>$data[0]['password'],"userTypes_id_type"=>$data[0]['usertypes_id_type'],
            "department"=>$data[0]['department'],"position"=>$data[0]['position'],
            "email"=>$data[0]['email']);
        echo json_encode($json);
        }
   }
   
   /*POST REQUEST */
   if(isset($_POST['email']) && isset($_POST['firstName'])
            && isset($_POST['lastName']) && isset($_POST['password'])){
        $database = new Database();
        $connection = $database->openConection();
        $data = $database->setData($connection,
               sprintf("INSERT INTO USERS(firstName,lastName,password,email)"
                       . " VALUES('%s','%s','%s','%s')",$_POST['firstName'],$_POST['lastName']
               ,$_POST['password'],$_POST['email']));
        if($data == 1){
            echo "SUCCESS";
        }
    }
   
   /* */
   if('PUT' == $method){
        $json = file_get_contents('php://input');
        $user_info = json_decode($json,true);
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
   
   /*Warning: It is done an delele call from HTTP protocol, but the user will only be disabled*/
   if('DELETE' == $method){
        $json = file_get_contents('php://input');
        $user_info = json_decode($json,true);
        $database = new Database();
        $connection = $database->openConection();
        $data = $database->setData($connection, 
                sprintf("UPDATE users SET users.deleted = 1 WHERE users.email = '%s'",$user_info["email"]));
        if($data == 1){
            echo "SUCESS";
        }
   }
?>
