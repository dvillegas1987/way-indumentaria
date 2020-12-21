
<?php 

	$resultado=null;
	$fecha=null;
	$mes=null;
	$año=null;
	
	include "basedatos.php";


	if(isset($_POST['fecha']) and ($_POST['fecha']) != 0)
	{
		$fecha=$_POST['fecha'];
		
		$mes=date("m", strtotime($fecha));
		$año=date("Y", strtotime($fecha));
		
		$cant_vent= mysql_query("select count(*) from presupuesto_pedido where month(fecha)=".$mes." and year(fecha)=".$año);
		$presu_ped = mysql_result($cant_vent, 0);
	 
		echo "<font size=\"1\"><b>Resultado de ".$presu_ped." solicitudes</b></font>";
		
	}
	else
	{
		$sql = mysql_query("select count(*) from presupuesto_pedido where month(fecha)=".date("n")." and year(fecha)=".date("Y"));
		
		$resultado = mysql_result($sql, 0);
	
			echo "<font size=\"1\"><b>Resultado de ".$resultado." solicitudes</b></font>";
		}

	mysql_close();
	



?>