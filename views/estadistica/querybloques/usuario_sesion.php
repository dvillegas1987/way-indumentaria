<?php
include "querybloques/basedatos.php";
if(!session_id()) session_start();

  if (!isset($_COOKIE["codigo"]) && !isset($_SESSION["codigo"])){

  }

 $codigo= $_SESSION["codigo"];
 $query = mysql_query("select concat_ws(', ',nombre, apellido) as persona from usuario where codigo='".$codigo."'");  
 $result= mysql_result($query, 0);

 echo $result;
?>