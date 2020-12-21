<?php


	$resultado=null;

	include "basedatos.php";

		$result= mysql_query("select e.Nombre,e.Apellido,mi.Descripcion,a.observaciones
		from  empleado e
		inner join asistencia a on  e.Codigo=a.empleado
		inner join itemhorario i on a.itemHorario=i.codigo
		inner join motivoinasistencia mi on a.motivo=mi.Codigo
		where a.tipo=0 and a.motivo<>0 and year(a.fecha)=".date("Y")." and month(a.fecha)=".date("n")." and day(a.fecha)=".date("d")." and hour(i.HoraDesde)>12");


		 echo "<table class='table table-striped'>
               
                  <tr>
                    <th>#</th>
                    <th><font size=2>EMPLEADO</font></th>
					<th><font size=2>MOTIVO</font></th>
                  </tr>";
      
					/*todos los registros */
					$numero=1;
					while($row=mysql_fetch_array($result))
					{
					 echo "<tr>";
						echo "<td><font size=2>" . $numero . "</td>";
						echo "<td><font size=2>" . utf8_encode($row['Apellido']).", ".utf8_encode($row['Nombre']) . "</font></td>";
						echo "<td><font size=2>" . utf8_encode($row['Descripcion']).": ".utf8_encode($row['observaciones']) ."</font></td>";						
						echo "</tr>";
					  $numero++;
					}
                
					  echo "</table>";

	mysql_close();


					  
?>