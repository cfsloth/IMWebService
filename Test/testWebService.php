<?php

include("../databaseAcess/databaseAcess.php");
include("../databaseAcess/warningsClass.php");

$warnings = new WarningsClass();
$warnings->getWarningByAdministratorEmail('claudiofilipesilvagoncalves@gmail.com');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
