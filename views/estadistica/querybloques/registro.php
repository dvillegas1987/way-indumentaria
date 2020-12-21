<?php

	
	include 'basedatos.php';

	
	if(isset($_POST['mesdesde']) and (($_POST['mesdesde'])!=0)  and  isset($_POST['aniodesde']) and (($_POST['aniodesde'])!=0) and isset($_POST['meshasta']) and (($_POST['meshasta'])!=0) and isset($_POST['aniohasta']) and (($_POST['aniohasta'])!=0))
	{
		$mesdesde=$_POST['mesdesde'];
		$aniodesde=$_POST['aniodesde'];
		$meshasta=$_POST['meshasta'];
		$aniohasta=$_POST['aniohasta'];
		
		$ultimodiameshasta=date('d',(mktime(0,0,0,$meshasta+1,1,$aniohasta)-1));
		
		$fechadesde=$aniodesde."-".$mesdesde."-01";
		$fechahasta=$aniohasta."-".$meshasta."-".$ultimodiameshasta;			

	$result5 = mysql_query("select ven.apellido,(select sum(T.total) 
	from (select v.vendedor, if(sum(iv.importe) is null, 0.0,sum(iv.importe)) total
	from itemVenta iv, venta v
	where iv.venta = v.codigo and
		  v.activa = 1 and  v.presupuesto is not null and
		  v.fecha>='".$fechadesde."' and
		  v.fecha<='".$fechahasta."'
	group by vendedor

	union all

	select v.vendedor,-if(sum(nc.total) is null, 0.0,sum(nc.total)) total
	from notacredito nc, venta v
	where nc.venta = v.codigo and
		  v.activa = 1 and  v.presupuesto is not null and
		  v.fecha>='".$fechadesde."' and
		  v.fecha<='".$fechahasta."'
	group by vendedor

	union all

	select v.vendedor,if(sum(nd.total) is null, 0.0,sum(nd.total)) total
	from notadebito nd, venta v
	where nd.venta = v.codigo and
	v.activa = 1 and  v.presupuesto is not null and
	v.fecha>='".$fechadesde."' and
	v.fecha<='".$fechahasta."'
	group by vendedor

	union all

	select v.vendedor,sum(if(v.recargo is null,0.0,v.recargo)-if(v.descuento is null,0.0,v.descuento)) total
	from venta v
	where v.activa = 1 and v.presupuesto is not null and
	v.fecha>='".$fechadesde."' and
	v.fecha<='".$fechahasta."'
	group by v.vendedor) T
	where ven.codigo=T.vendedor) imp
	from vendedor ven
	where ven.activo=1
	group by ven.codigo
	order by ven.apellido Asc");


	//presupuestos por vendedor
	$result2= mysql_query("select v.apellido, (select count(p.codigo)
	from presupuesto p
	where v.codigo=p.vendedor and p.fecha>='".$fechadesde."' and p.fecha<='".$fechahasta."') pptado
	from vendedor v
	where v.activo=1
	group by (v.codigo)
	order by v.apellido asc");

	//clientes activos 
	$result1= mysql_query("select apellido from vendedor where activo=1 order by apellido asc");

	//monto presupuestado
	$result3= mysql_query("select v.apellido,(select sum((r.preciounitario+r.plus)*i.cantidad)
	from presupuesto p, alternativa a, renglonseccion r, itemalternativa i
	where r.itemalternativa=i.codigo and
		  p.codigo=a.presupuesto and
		  i.alternativa=a.codigo and
		  v.codigo=p.vendedor  and
		  p.fecha>='".$fechadesde."' and
		  p.fecha<='".$fechahasta."'
	 order by p.Vendedor) montpptado
	from vendedor v
	where v.activo=1
	group by (v.codigo)
	order by v.apellido asc");

	//cantidad de ventas
	$result4= mysql_query("select v.apellido, (select count(ve.codigo)
	from venta ve
	where v.codigo= ve.vendedor and ve.fecha>='".$fechadesde."' and ve.fecha<='".$fechahasta."' and ve.activa = 1 and ve.presupuesto is not null) cantvent
	from vendedor v
	where v.activo=1
	group by (v.codigo)
	order by v.apellido asc");





	echo "<table class='table table-striped' >
						   
							  <tr>
								<th>#</th>
								<th><font size=1>VENDEDOR</font></th>
								<th><font size=1>PPTOS</font></th>
								<th><font size=1>MONTO PPTADO</font></th>
								<th><font size=1>VTAS</font></th>
								<th><font size=1>IMPORTES  </font></th>
								<th><font size=1>EF. CANT.</font></th>
								<th><font size=1>EF. PESOS</font></th>
							  </tr>";
							
								/*todos los registros */
								$numero=1;
								while($row1=mysql_fetch_array($result1) and $row2=mysql_fetch_array($result2) and $row3=mysql_fetch_array($result3)  
								and $row4=mysql_fetch_array($result4) and $row5=mysql_fetch_array($result5))
								{
								
								echo "<tr>";
									echo "<td><font size=1>" . $numero . "</font></td>";
									echo "<td><font size=1>" . utf8_encode($row1['apellido']) . "</font></td>";
									echo "<td><font size=1>" . utf8_encode($row2['pptado']) . "</font></td>";
									echo "<td><font size=1>$ " . utf8_encode(number_format($row3['montpptado'], 2, ",", ".")) . "</font></td>";
									echo "<td><font size=1>" . utf8_encode(($row4['cantvent'])) . "</td>";
									echo "<td><font size=1>$ " . utf8_encode(number_format($row5['imp'], 2, ",", ".")) . "</font></td>";
									if (($row2['pptado']) != 0) {
										echo "<td><font size=1>" .utf8_encode(number_format(((($row4['cantvent'])/($row2['pptado']))*100), 2, ",", ".")) . " %</font></td>";
									} else {
										echo "<td><font size=1>0,00 %</font></td>";
									}	
									if (($row3['montpptado']) != 0) {
										echo "<td><font size=1>" .utf8_encode(number_format(((($row5['imp'])/($row3['montpptado']))*100), 2, ",", ".")) . " %</font></td>";
									} else {
										echo "<td><font size=1>0,00 %</font></td>";
									}
								  echo "</tr>";
								 
								  $numero++;
								}
								 echo "</table>";
			
	}
	else
	{
		//ventas por vendedor				

	$result5 = mysql_query("select ven.apellido,(select sum(T.total) 
	from (select v.vendedor, if(sum(iv.importe) is null, 0.0,sum(iv.importe)) total
	from itemVenta iv, venta v
	where iv.venta = v.codigo and
		  v.activa = 1 and  v.presupuesto is not null and
		  month(v.fecha)=".date("n")." and
			year(v.fecha)=".date("Y")."
	group by vendedor

	union all

	select v.vendedor,-if(sum(nc.total) is null, 0.0,sum(nc.total)) total
	from notacredito nc, venta v
	where nc.venta = v.codigo and
		  v.activa = 1 and  v.presupuesto is not null and
		 month(v.fecha)=".date("n")." and
			year(v.fecha)=".date("Y")."
	group by vendedor

	union all

	select v.vendedor,if(sum(nd.total) is null, 0.0,sum(nd.total)) total
	from notadebito nd, venta v
	where nd.venta = v.codigo and
	v.activa = 1 and  v.presupuesto is not null and
	month(v.fecha)=".date("n")." and
			year(v.fecha)=".date("Y")."
	group by vendedor

	union all

	select v.vendedor,sum(if(v.recargo is null,0.0,v.recargo)-if(v.descuento is null,0.0,v.descuento)) total
	from venta v
	where v.activa = 1 and v.presupuesto is not null and
	month(v.fecha)=".date("n")." and
			year(v.fecha)=".date("Y")."
	group by v.vendedor) T
	where ven.codigo=T.vendedor) imp
	from vendedor ven
	where ven.activo=1
	group by ven.codigo
	order by ven.apellido Asc");


	//presupuestos por vendedor
	$result2= mysql_query("select v.apellido, (select count(p.codigo)
	from presupuesto p
	where v.codigo=p.vendedor and month(p.fecha)=".date("n")." and year(p.fecha)=".date("Y").") pptado
	from vendedor v
	where v.activo=1
	group by (v.codigo)
	order by v.apellido asc");

	//clientes activos 
	$result1= mysql_query("select apellido from vendedor where activo=1 order by apellido asc");

	//monto presupuestado
	$result3= mysql_query("select v.apellido,(select sum((r.preciounitario+r.plus)*i.cantidad)
	from presupuesto p, alternativa a, renglonseccion r, itemalternativa i
	where r.itemalternativa=i.codigo and
		  p.codigo=a.presupuesto and
		  i.alternativa=a.codigo and
		  v.codigo=p.vendedor  and
		  month(p.fecha)=".date("n")." and
		  year(p.fecha)=".date("Y")."
	 order by p.Vendedor) montpptado
	from vendedor v
	where v.activo=1
	group by (v.codigo)
	order by v.apellido asc");

	//cantidad de ventas
	$result4= mysql_query("select v.apellido, (select count(ve.codigo)
	from venta ve
	where v.codigo= ve.vendedor and month(ve.fecha)=".date("n")." and year(ve.fecha)=".date("Y")." and ve.activa = 1 and ve.presupuesto is not null) cantvent
	from vendedor v
	where v.activo=1
	group by (v.codigo)
	order by v.apellido asc");





	echo "<table class='table table-striped'>
						   
							  <tr>
								<th>#</th>
								<th><font size=1>VENDEDOR</font></th>
								<th><font size=1>PPTOS</font></th>
								<th><font size=1>MONTO PPTADO</font></th>
								<th><font size=1>VTAS</font></th>
								<th><font size=1>IMPORTES</font></th>
								<th><font size=1>EF. CANT.</font></th>
								<th><font size=1>EF. PESOS</font></th>
							  </tr>";
				  
								/*todos los registros */
								$numero=1;
								while($row1=mysql_fetch_array($result1) and $row2=mysql_fetch_array($result2) and $row3=mysql_fetch_array($result3)  
								and $row4=mysql_fetch_array($result4) and $row5=mysql_fetch_array($result5))
								{
								 echo "<tr>";
									echo "<td><font size=1>" . $numero . "</font></td>";
									echo "<td><font size=1>" . utf8_encode($row1['apellido']) . "</font></td>";
									echo "<td><font size=1>" . utf8_encode($row2['pptado']) . "</font></td>";
									echo "<td><font size=1>$ " . utf8_encode(number_format($row3['montpptado'], 2, ",", ".")) . "</font></td>";
									echo "<td><font size=1>" . utf8_encode(($row4['cantvent'])) . "</td>";
									echo "<td><font size=1>$ " . utf8_encode(number_format($row5['imp'], 2, ",", ".")) . "</font></td>";
									if (($row2['pptado']) != 0) {
										echo "<td><font size=1>% " .utf8_encode(number_format(((($row4['cantvent'])/($row2['pptado']))*100), 2, ",", ".")) . "</font></td>";
									} else {
										echo "<td><font size=1>% 0,00</font></td>";
									}	
									if (($row3['montpptado']) != 0) {
										echo "<td><font size=1>% " .utf8_encode(number_format(((($row5['imp'])/($row3['montpptado']))*100), 2, ",", ".")) . "</font></td>";
									} else {
										echo "<td><font size=1>% 0,00</font></td>";
									}
								  echo "</tr>";
								  $numero++;
								}
								 echo "</table>";
		
	}

	mysql_close();


?>				  