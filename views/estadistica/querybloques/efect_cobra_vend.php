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

		
		$query= mysql_query("select sum(formapago.importe)-
			  (select ifnull(sum(formapagoventa.importe),0) from formapagoventa where formapagoventa.formapago=formapago.codigo and chequerechazado is not null)-
			  (select ifnull(sum(importe),0) from formapago where fecha>='".$fechadesde."' and fecha<='".$fechahasta."' and padre is not null and tipo=3) cant_cobran
			   from formapago where padre is null and fecha>='".$fechadesde."' and fecha<='".$fechahasta."' and tipo<>3");
		
		$resultado= mysql_result($query, 0);
		
		
		$result= mysql_query("select TV.totalventa - TNC.totalcredito + TND.totaldebito + TRI.totalrecint total_mes
	from (select if(sum(iv.importe) is null, 0.0,sum(iv.importe))-if(v.descuento is null,0,v.descuento)+if(v.recargo is null,0,v.recargo) totalventa
      from itemVenta iv, venta v
      where iv.venta = v.codigo and
        v.activa = 1 and v.presupuesto is not null and
        v.fecha>='".$fechadesde."' and
        v.fecha<='".$fechahasta."') TV,
     (select if(sum(nc.total) is null, 0.0,sum(nc.total)) totalcredito
      from notacredito nc, venta v
      where nc.venta = v.codigo and
        v.activa = 1 and v.presupuesto is not null and
        v.fecha>='".$fechadesde."' and
        v.fecha<='".$fechahasta."') TNC,
     (select if(sum(nd.total) is null, 0.0,sum(nd.total)) totaldebito
      from notadebito nd, venta v
      where nd.venta = v.codigo and
        v.activa = 1 and v.presupuesto is not null and
        v.fecha>='".$fechadesde."' and
        v.fecha<='".$fechahasta."') TND,
     (select sum(if(v.recargo is null,0.0,v.recargo)-if(v.descuento is null,0.0,v.descuento)) totalrecint
      from venta v
      where v.activa = 1 and v.presupuesto is not null and
        v.fecha>='".$fechadesde."' and
        v.fecha<='".$fechahasta."') TRI");	
		
		
		$resultado2 = mysql_result($result, 0);
		
		if($resultado2 != 0)
		{
			$efectividad= ($resultado/$resultado2)*100;
			echo "<font size=\"2\"><b>".number_format($efectividad, 2, ",", ".")." % de efectividad</b></font>";
			
		}
		else {
		
			echo "<font size=\"2\"><b>sin ventas</b></font>";
		}
		
		
	}
	else
	{
		$query= mysql_query("select sum(formapago.importe)-
			  (select ifnull(sum(formapagoventa.importe),0) from formapagoventa where formapagoventa.formapago=formapago.codigo and chequerechazado is not null)-
			  (select ifnull(sum(importe),0) from formapago where month(fecha)=".date("n")." and year(fecha)=".date("Y")." and padre is not null and tipo=3) cant_cobran
			   from formapago where padre is null and month(fecha)=".date("n")." and year(fecha)=".date("Y")." and tipo<>3");
		
		$resultado = mysql_result($query, 0);
		
		
		
		$query= mysql_query("select TV.totalventa - TNC.totalcredito + TND.totaldebito + TRI.totalrecint total_mes
	from (select if(sum(iv.importe) is null, 0.0,sum(iv.importe))-if(v.descuento is null,0,v.descuento)+if(v.recargo is null,0,v.recargo) totalventa
      from itemVenta iv, venta v
      where iv.venta = v.codigo and
        v.activa = 1 and v.presupuesto is not null and
        month(v.fecha)=".date("n")." and
        year(v.fecha)=".date("Y").") TV,
     (select if(sum(nc.total) is null, 0.0,sum(nc.total)) totalcredito
      from notacredito nc, venta v
      where nc.venta = v.codigo and
        v.activa = 1 and v.presupuesto is not null and
        month(v.fecha)=".date("n")." and
        year(v.fecha)=".date("Y").") TNC,
     (select if(sum(nd.total) is null, 0.0,sum(nd.total)) totaldebito
      from notadebito nd, venta v
      where nd.venta = v.codigo and
        v.activa = 1 and v.presupuesto is not null and
        month(v.fecha)=".date("n")." and
        year(v.fecha)=".date("Y").") TND,
     (select sum(if(v.recargo is null,0.0,v.recargo)-if(v.descuento is null,0.0,v.descuento)) totalrecint
      from venta v
      where v.activa = 1 and v.presupuesto is not null and
        month(v.fecha)=".date("n")." and
        year(v.fecha)=".date("Y").") TRI");	
		
		
		$resultado2 = mysql_result($query, 0);
		
		if($resultado2 != 0)
		{
			$efectividad= ($resultado/$resultado2)*100;
			echo "<font size=\"2\"><b>".number_format($efectividad, 2, ",", ".")." % de efectividad</b></font>";
		}
		else {
		
			echo "<font size=\"2\"><b>sin ventas</b></font>";
		}

	}

	mysql_close();



?>