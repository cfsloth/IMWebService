<?php
include("databaseAcess.php");
include("warningsClass.php");

   $method = $_SERVER['REQUEST_METHOD'];
   
   /*GET REQUEST */
   if(isset($_GET['administrator_email'])){
       $warnings = new WarningsClass();
       $warnings->getWarningByAdministratorEmail($_GET['administrator_email']);
   }
   
   if(isset($_POST['send_user_email']) && isset($_POST['received_user_id']) 
           && isset($_POST['severity']) && POST['description']){
       
   }
   
   /*Warning: It is done an delete call from HTTP protocol*/
   if('DELETE' == $method){
        $json = file_get_contents('php://input');
        $id = json_decode($json,true);
        $warnings = new WarningsClass();
        $warnings->deleteWarningById($id);
   }
?>