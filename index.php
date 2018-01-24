<?php
    class Database{
        
        function __construct() {
            //echo "Connecting to MySQL";
            return mysqli_connect("localhost", "root", "","IM") 
                    or die("Couldn't connect to Mysql");
        }
        
        /**
         * 
         * @param object $dbhandle - return from the constructor
         * @param string $query - SQL
         * @return AssociativeArray results
         */
        function getData($dbhandle,$query){
            $result = mysqli_query($dbhandle, $query);
            if(empty($result)){
                die("The query performance could not return any data");
            }
            return mysqli_fetch_array($result);
        }
        
        function setData($dbhandle,$query){
            $result = mysqli($dbhandle,$query);
            if(!$result){
                die("The query performance could not change any data");
            }
            return 1;
        }
        
    }
    
