<?php
//Need to put this in classes 
   include("databaseAcess.php");
   include("userClass.php");
   
   $method = $_SERVER['REQUEST_METHOD'];
   
   /*GET user by email*/
   if(isset($_GET['email'])){
        $user =  new UserClass();
        $user->getUserByEmail($_GET['email']);
   }
   
    /*Post request done */
    if('POST' == $method){
       $json = file_get_contents('php://input');
       $user_info = json_decode($json,true);
       $user = new UserClass();
       $user->createUser($user_info);
    }
   
    /*PUT request done */
    if('PUT' == $method){
        $json = file_get_contents('php://input');
        $user_info = json_decode($json,true);
        //TODO: need to choose the way of updating
        $user = new UserClass();
        $user->updatingUserPassword($user_info);
   } 
   
   /*Warning: It is done an delele call from HTTP protocol, but the user will only be disabled*/
   if('DELETE' == $method){
        $json = file_get_contents('php://input');
        $user_info = json_decode($json,true);
        //TODO: need to choose a way of deleting
        $user = new UserClass();
        $user->deletingUserByEmail($user_info);
   }
?>
