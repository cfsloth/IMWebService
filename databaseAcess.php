<?php
    class Database{
        /**
             * 
             * @return type dbhandle
             */
            function __construct() {
               
            }
            
            function openConection(){
                $con = mysqli_connect("localhost","root","") 
                        or die("Could not to mysqlDatabase");
                mysqli_select_db($con,"IM");
                return $con;
            }
            
            /**
             * 
             * @param type $dbhandle from constructor
             * @param type $query SQL
             * @return type associtiveArray with results
             */
            function getData($dbhandle,$query){
               $result = mysqli_query($dbhandle,$query);
               if(empty($result)){
                    die("Could not return any data");
               }
               return mysqli_fetch_array($result); 
            }
            /**
             * 
             * @param type $dbhandle from constructor
             * @param type $query SQL
             * @return int 1 if success
             */
            function setData($dbhandle,$query){
                $result = mysqli_query($dbhandle,$query);
                if(!$result){
                    die("Could not update/delete/insert any data!");
                }
                return 1;
            }
    }
?>