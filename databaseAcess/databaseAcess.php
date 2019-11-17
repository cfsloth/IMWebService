<?php
    
    /*
     *drop table users;
      drop table information_warning;
      drop table usertype;

    CREATE TABLE usertype(
	id_type int PRIMARY KEY AUTO_INCREMENT,
        type_name varchar(50),
        description varchar(50)
    );
    CREATE TABLE users (
        id_user int PRIMARY KEY AUTO_INCREMENT,
        firstName varchar(50),
        lastName varchar(50),
        PASSWORD varchar(50),
        usertype_id_type INT,
        department varchar(50),
        POSITION varchar(50),
        email varchar(50),
        deleted int,
        CONSTRAINT fk_usertype_user
        FOREIGN KEY (usertype_id_type) REFERENCES usertype(id_type)
    )
    
    CREATE TABLE information_warning(
	information_warning_id int PRIMARY KEY AUTO_INCREMENT,
        user_sendind_id int,
        user_receiving_id int,
        description varchar(150),
	severity int,
        subject varchar(50),
        CONSTRAINT fk_information_warning_users_sending
        FOREIGN KEY (user_sendind_id)
        REFERENCES users(id_user),
	CONSTRAINT fk_information_warning_users_receiving
        FOREIGN KEY (user_receiving_id)
        REFERENCES users(id_user)
    ) 
     */


    class Database{
        
        static $remote_host = "remotemysql.com";
        static $database_name = "QBLxoTXcdJ";
        static $username = "QBLxoTXcdJ";
        static $password = "1IIaQpert9";
        
        /**
             * 
             * @return type dbhandle
             */
            function __construct() {
               
            }
            
            function openConection(){
                $con = mysqli_connect($remote_host,$username,$password) 
                        or die("Could not to mysqlDatabase");
                mysqli_select_db($con,$databasename);
                return $con;
            }
            
            /**
             * 
             * @param type $dbhandle from constructor
             * @param type $query SQL
             * @return type associtiveArray with results
             */
            function getData($dbhandle,$query){
               $return = array();
               $result = mysqli_query($dbhandle,$query);
               if(empty($result)){
                    die("Could not return any data");
               }
               while($row = mysqli_fetch_array($result)){
                   array_push($return,$row);
               }
               return $return; 
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