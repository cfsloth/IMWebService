<?php
    include("databaseAcess/databaseAcess.php");
    include("databaseAcess/warningsClass.php");
    
   $method = $_SERVER['REQUEST_METHOD'];
   
   /*GET REQUEST */
   if('GET' == $method){
        $warnings = new WarningsClass();
        $path_splited =  explode("?",explode("=",$_SERVER['REQUEST_URI'])[0]);
        switch($path_splited[1]){
            case 'administrator_email':
                $warnings->getWarningByAdministratorEmail($_GET['administrator_email']);
                break;
            case 'next_administrator':
                $warnings->getTheAdminWithLessWarnings();
                break;
        }
   }
   
   //Post method done
   if('POST' == $method){
       $json = file_get_contents('php://input');
       $warning_info = json_decode($json,true);
       $warnings = new WarningsClass();
       $warnings->postWarning($warning_info);
   }
   
   /*Warning: It is done an delete call from HTTP protocol*/
   if('DELETE' == $method){
        $json = file_get_contents('php://input');
        $id = json_decode($json,true);
        $warnings = new WarningsClass();
        $warnings->deleteWarningById($id);
   }
?>