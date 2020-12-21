<?php
$MyUsername = "root";  // enter your username for mysql
$MyPassword = "";  // enter your password for mysql
$MyHostname = "localhost:3306";      // this is usually "localhost" unless your database resides on a different server

$dbh = mysql_connect($MyHostname , $MyUsername, $MyPassword);
$selected = mysql_select_db("way3",$dbh); //Enter your database name here 
?>