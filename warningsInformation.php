<?php
include("../databaseAcess/databaseAcess.php");
include("../databaseAcess/warningsClass.php");

   $method = $_SERVER['REQUEST_METHOD'];
   
   /*GET REQUEST */
   if(isset($_GET['administrator_email'])){
       $warnings = new WarningsClass();
       $warnings->getWarningByAdministratorEmail($_GET['administrator_email']);
   }
   
   if('POST' == $method){
       
   }
   
   /*Warning: It is done an delete call from HTTP protocol*/
   if('DELETE' == $method){
        $json = file_get_contents('php://input');
        $id = json_decode($json,true);
        $warnings = new WarningsClass();
        $warnings->deleteWarningById($id);
   }
?>