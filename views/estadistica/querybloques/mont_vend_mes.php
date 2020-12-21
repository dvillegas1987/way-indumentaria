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
		
		$result= mysql_query("select TV.totalventa - TNC.totalcredito + TND.totaldebito + TRI.totalrecint total_mes
	from (select if(sum(iv.importe) is null, 0,sum(iv.importe)) totalventa
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
		
		
		$total_mes = mysql_result($result, 0);
	 
		echo "<font size=\"5\"><b>$ ".number_format($total_mes, 2, ",", ".")."</b></font>";
		
	}
	else
	{
		$query= mysql_query("select TV.totalventa - TNC.totalcredito + TND.totaldebito + TRI.totalrecint total_mes
	from (select if(sum(iv.importe) is null, 0.0,sum(iv.importe)) totalventa
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
		
		
		$resultado = mysql_result($query, 0);
		
		echo "<font size=\"5\"><b>$ ".number_format($resultado, 2, ",", ".")."</b></font>";
		}

		mysql_close();

?>