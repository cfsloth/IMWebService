<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include("databaseAcess.php");
   
   $method = $_SERVER['REQUEST_METHOD'];
   
   /*GET REQUEST */
   if(isset($_GET['administrator_email'])){
        $json = "";
        $database = new Database();
        $connection = $database->openConection();
        $data = $database->getData($connection, 
               sprintf("SELECT c.information_warning_id, b.email as send_user, "
                       . "c.description, c.severity, c.subject "
                       . "FROM users a, users b, information_warnings c "
                       . "WHERE a.id_user = c.user_receiving_id "
                       . "AND c.user_sending_id = b.id_user "
                       . "AND a.email = '%s'"
                       , $_GET['administrator_email']));
        echo json_encode($data);
   }
   
   if(isset($_POST['send_user_email']) && isset($_POST['received_user_id']) 
           && isset($_POST['severity']) && POST['description']){
       
   }
   
     /*Warning: It is done an delete call from HTTP protocol*/
   if('DELETE' == $method){
        parse_str(file_get_contents('php://input'),$_DEL);
        $email = json_decode($_DEL['id'],true); 
        $database = new Database();
        $connection = $database->openConection();
        $data = $database->setData($connection, 
                sprintf("DELETE FROM information_warnings "
                        . "WHERE information_warnings.information_warning_id = '%s'"
                        ,$id["id"]));
        //echo $_DEL['email'];
        if($data == 1){
            echo "SUCESS";
        }
        echo "Hello World!";
   }
   
?>