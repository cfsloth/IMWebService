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
        $database = new Database();
        $connection = $database->openConection();
        $data = $database->getData($connection, 
               sprintf(""
                       , $_GET['administrator_email']));
        if(!isset($data[0]["firstName"])){ //To make sure only pass one row
            $array_to_json = array(''=>$data['']
                    ,''=>$data[''],''=>$data[''],
                ''=>$data['']);
            echo json_encode($array_to_json);
        }
   }
    ?>