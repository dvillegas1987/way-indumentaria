<?php
// Datos para la conexion
$host = 'localhost';
$database = 'aberturas';
$username = 'root';
$password = '12qwaszx';

// Conectarse a MySQL
$con = mysql_connect($host, $username, $password);
if (!$con) {
    die('Error al conectarse a mysql: ' . mysql_error());
}

// Seleccionar base de datos
$db_selected = mysql_select_db($database, $con);
if (!$db_selected) {
    die ( mysql_error());
	 echo " 
          <script language='JavaScript'> 
           alert('Error de conexion'); 
          </script>";
}

?>