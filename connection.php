<?php 


$DBServer="localhost";
$DBUser ="luzion";
$DBPass ="123123";
$DBName ="db_wsw";

 $db=new mysqLi($DBServer,$DBUser,$DBPass,$DBName);
	 if ($db->connect_error) {
	 trigger_error("Database connection failed: ". $db->connect_error, E_USER_ERROR);
	 }


?>