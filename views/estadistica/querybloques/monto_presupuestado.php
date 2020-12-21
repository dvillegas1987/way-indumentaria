<?php 

	include "basedatos.php";

	if(isset($_POST['mesdesde']) and (($_POST['mesdesde'])!=0)  and  isset($_POST['aniodesde']) and (($_POST['aniodesde'])!=0) and isset($_POST['meshasta']) and (($_POST['meshasta'])!=0) and isset($_POST['aniohasta']) and (($_POST['aniohasta'])!=0))
	{

		$mesdesde=$_POST['mesdesde'];
		$aniodesde=$_POST['aniodesde'];
		$meshasta=$_POST['meshasta'];
		$aniohasta=$_POST['aniohasta'];
		
		$ultimodiameshasta=date('d',(mktime(0,0,0,$meshasta+1,1,$aniohasta)-1));
		
		$fechadesde=$aniodesde."-".$mesdesde."-01";
		$fechahasta=$aniohasta."-".$meshasta."-".$ultimodiameshasta;
		
		
		$monto_presu=mysql_query("select sum((r.preciounitario+r.plus)*i.cantidad)
		FROM presupuesto p, alternativa a, renglonseccion r, itemalternativa i
		where r.itemalternativa=i.codigo and
		  p.codigo=a.presupuesto and
		  i.alternativa=a.codigo and
		  p.fecha>='".$fechadesde."' and
		  p.fecha<='".$fechahasta."'");
		
		$result= mysql_result($monto_presu,0);
	 
		echo "<font size=\"2\"><b>$ ".number_format($result, 2, ",", ".")."</b></font>";
		echo "<font size=\"1\"><b> presupuestado</b></font>";
	}
	else
	{
		
		$monto_presu=mysql_query("select sum((r.preciounitario+r.plus)*i.cantidad)
		FROM presupuesto p, alternativa a, renglonseccion r, itemalternativa i
		where r.itemalternativa=i.codigo and
		  p.codigo=a.presupuesto and
		  i.alternativa=a.codigo and
		  month(p.fecha)=".date("n")." and
		  year(p.fecha)=".date("Y"));
		
		$result= mysql_result($monto_presu,0);
	 
		echo "<font size=\"2\"><b>$ ".number_format($result, 2, ",", ".")."</b></font>";
		echo "<font size=\"1\"><b> presupuestado</b></font>";
		
		}

	mysql_close();

?>