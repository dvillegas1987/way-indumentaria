<?php 

//Cantidad de presupuestos
	
	$resultado=null;
	$fecha=null;
	$mes=null;
	$año=null;

	include "basedatos.php";

	if(isset($_POST['mesdesde']) and (($_POST['mesdesde'])!=0)  and  isset($_POST['aniodesde']) and (($_POST['aniodesde'])!=0) and isset($_POST['meshasta']) and (($_POST['meshasta'])!=0) and isset($_POST['aniohasta']) and (($_POST['aniohasta'])!=0))
	{
		//$fecha=$_POST['fecha'];
		$mesdesde=$_POST['mesdesde'];
		$aniodesde=$_POST['aniodesde'];
		$meshasta=$_POST['meshasta'];
		$aniohasta=$_POST['aniohasta'];
		
		$ultimodiameshasta=date('d',(mktime(0,0,0,$meshasta+1,1,$aniohasta)-1));
		
		$fechadesde=$aniodesde."-".$mesdesde."-01";
		$fechahasta=$aniohasta."-".$meshasta."-".$ultimodiameshasta;
		
		$cant_vent= mysql_query("select count(*) from presupuesto where fecha>='".$fechadesde."' and fecha<='".$fechahasta."'");
		$result = mysql_result($cant_vent, 0);
	 
		echo "<font size=\"2\"><b>".$result."</b></font>";
		echo "<font size=\"1\"><b> presupuestadas</b></font>";
	}
	else
	{
		$query = mysql_query("select count(*) from presupuesto where month(fecha)=".date("n")." and year(fecha)=".date("Y"));
		
		$resultado = mysql_result($query, 0);
		
		echo "<font size=\"2\"><b>".$resultado."</b></font>";
		echo "<font size=\"1\"><b> presupuestadas</b></font>";
		}

	mysql_close();

?>