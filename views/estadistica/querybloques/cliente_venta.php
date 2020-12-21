<?php

include "basedatos.php";

if(isset($_POST['postname']) and $_POST['postname'] != null)
{
	
	$text = $_POST['postname'];

	$query1=mysql_query("select numero from venta v where v.Numero ='".$text."'");

	$result1= mysql_fetch_object($query1);

	if( $result1 != null)
	{

		$query2 = mysql_query("select c.razonSocial from venta v, cliente c  where  v.Cliente = c.codigo and v.Numero='".$text."'");
		$result2= mysql_result($query2,0);

		echo "<font size=\"2\"><b>".$result2."</b></font>";
	}

	else{

		echo "<font size=\"2\"><b>código de venta incorrecto</b></font>";

	}
}

else{

	echo "<font size=\"2\"><b>Debe ingresar codigo de venta</b></font>";

}


mysql_close();
?>