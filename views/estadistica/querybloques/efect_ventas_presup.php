<?php

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
		
		//ventas
		$cant_vent= mysql_query("select count(*) from venta where fecha>='".$fechadesde."' and fecha<='".$fechahasta."'");
		$result = mysql_result($cant_vent, 0);
		
		//presupuetadas
		$cant_vent= mysql_query("select count(*) from presupuesto where fecha>='".$fechadesde."' and fecha<='".$fechahasta."'");
		$result2 = mysql_result($cant_vent, 0);
	 
		if($result2 != 0)
		{
			$efectividad= ($result/$result2)*100;
			echo "<font size=\"2\"><b>".number_format($efectividad, 2, ",", ".")." % de efectividad</b></font>";
		}
		else {
		
			echo "<font size=\"2\"><b>sin presupuestos</b></font>";
		}
	}
	else
	{
		$query = mysql_query("select count(*) from venta where month(fecha)=".date("n")." and year(fecha)=".date("Y"));
		
		$resultado = mysql_result($query, 0);
	
		
		$query = mysql_query("select count(*) from presupuesto where month(fecha)=".date("n")." and year(fecha)=".date("Y"));
		
		$resultado2 = mysql_result($query, 0);
		
		if($resultado2 != 0)
		{
			$efectividad= ($resultado/$resultado2)*100;
			echo "<font size=\"2\"><b>".number_format($efectividad, 2, ",", ".")." % de efectividad</b></font>";
		}
		else{
			
			echo "<font size=\"2\"><b>sin presupuestos</b></font>";
			
		}
		
	
			
		}
	

	mysql_close();
	

?>