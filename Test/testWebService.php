<?php

include("../databaseAcess/databaseAcess.php");
include("../databaseAcess/warningsClass.php");

$warnings = new WarningsClass();
$warnings_arr = array('user_sending_id'=>1,'user_receiving_id'=>2,'description'=>"Com",'severity'=>"Com",'subject'=>"Com");
$warnings->addWarning($warnings_arr);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
