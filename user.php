<?php
   include("databaseAcess.php");
   
   $method = $_SERVER['REQUEST_METHOD'];
   
   /*GET REQUEST */
   if(isset($_GET['email'])){
        $database = new Database();
        $connection = $database->openConection();
        $data = $database->getData($connection, 
               sprintf("SELECT firstName,lastName FROM users WHERE email = '%s'"
                       , $_GET['email']));
        if(!isset($data[0]["firstName"])){ //To make sure only pass one row
            $array_to_json = array('firstName'=>$data['firstName']
                    ,'lastName'=>$data['lastName']);
            echo json_encode($array_to_json);
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
    
   if('PUT' == $method){
       parse_str(file_get_contents('php://input'), $_PUT);
       var_dump($_PUT);
       trim($_PUT, "/n");
       
   } 
       
?>
