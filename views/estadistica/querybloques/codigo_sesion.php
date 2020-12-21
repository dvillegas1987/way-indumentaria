<?php
include "querybloques/basedatos.php";
session_start();
 $codigo= $_SESSION["codigo"];
 echo $codigo;
?>