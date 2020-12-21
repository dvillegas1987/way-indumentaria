<?php

    include "basedatos.php";

if(isset($_POST['mesdesde']) and (($_POST['mesdesde'])!=0)  and  isset($_POST['aniodesde']) and (($_POST['aniodesde'])!=0) and isset($_POST['meshasta']) and (($_POST['meshasta'])!=0) and isset($_POST['aniohasta']) and (($_POST['aniohasta'])!=0))
	{
		$mesdesde=$_POST['mesdesde'];
		$aniodesde=$_POST['aniodesde'];
		$meshasta=$_POST['meshasta'];
		$aniohasta=$_POST['aniohasta'];	
		$ultimodiameshasta=date('d',(mktime(0,0,0,$meshasta+1,1,$aniohasta)-1));
	} else {
		$mesdesde=date('n');
		$aniodesde=date('Y');
		$meshasta=date('n');
		$aniohasta=date('Y');	
		$ultimodiameshasta=date('d',(mktime(0,0,0,$meshasta+1,1,$aniohasta)-1));
	}
		
	$fechadesde=$aniodesde."-".$mesdesde."-01";
	$fechahasta=$aniohasta."-".$meshasta."-".$ultimodiameshasta;
        
	$query= mysql_query("select sum(importeT) from
                                    (select sum(importe*ifnull(tipocambio,1)) importeT from formapago where padre is null and tipo<>3 and fecha>='".$fechadesde."' and fecha<='".$fechahasta."'
                                    union
                                    select -sum(importe*ifnull(tipocambio,1)) importeT from formapago where padre is not null and tipo=3 and fecha>='".$fechadesde."' and fecha<='".$fechahasta."'
                                    union
                                    select -sum(fp.importe*ifnull(fp.tipocambio,1)) from formapago fp,formapagoventa fpv where fp.codigo=fpv.formapago and
                                    fpv.chequerechazado is not null and fp.fecha>='".$fechadesde."' and fp.fecha<='".$fechahasta."') T;");
		
		$cant_cobran = mysql_result($query, 0);
	 
		echo "<font size=\"5\"><b>$ ".number_format($cant_cobran, 2, ",", ".")."</b></font>";
		
	mysql_close();
?>