<?php
    class Database{
            public  $servername = "localhost:81";
            public  $username = "username";
            public  $password = "password";
            
            function __construct() {
                print "In BaseClass constructor\n";
                if (!$link) {
                    die('Could not connect: ' . mysql_error());
                }
                echo 'Connected successfully';
                mysql_close($link);
            }
    }
?>