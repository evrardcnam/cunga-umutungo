<?php

/*
===========================================
         Notice
===========================================
# You are free to run the software as you wish
# You are free to help yourself study the source code and change to do what you wish
# You are free to help your neighbor copy and distribute the software
# You are free to help community create and distribute modified version as you wish

We promote Open Source Software by educating developers (Beginners)
 
===========================================
         For more information contact
=========================================== 
Kigali - Rwanda
Tel : (250)788802332 / (250)728802332
E-mail : info@code.rw
Website : www.code.rw

*/


//========== Database connection==============================================

$server = "localhost";  //Your serve name
$user = "root";  // Name of user
$password = "";   // Password 
$dname = "cunga_umutungo_db"; //Database name


$sqlconnection = mysql_connect($server, $user, $password);
mysql_select_db($dname, $sqlconnection) or die ("Unable to connect to the database");


?>