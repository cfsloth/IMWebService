<?php
   include("databaseAcess.php");

   //GET
   if(isset($_GET['email'])){
        $database = new Database();
        $connection = $database->openConection();
        $data = $database->getData($connection, 
               sprintf("SELECT firstName,lastName FROM users WHERE email = '%s'"
                       , $_GET['email']));
        if(!isset($data[0]["firstName"])){ //To make sure only pass one row
            $array_to_json = array('firstName'=>$data['firstName']
                    ,'lastName'=>$data['lastName']);
            header('Content-type: application/json');
            echo json_encode($array_to_json);
        }
   }
?>
