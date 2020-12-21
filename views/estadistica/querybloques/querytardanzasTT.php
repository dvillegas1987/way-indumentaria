<?php

	$resultado=null;

	include "basedatos.php";

	
		$result= mysql_query("select e.Nombre,e.Apellido
		from  empleado e
		inner join asistencia a on  e.Codigo=a.empleado
		inner join itemhorario i on a.itemHorario=i.codigo

		where a.tipo=2 and year(a.fecha)=".date("Y")." and month(a.fecha)=".date("n")." and day(a.fecha)=".date("d")." and hour(i.HoraDesde)<12");

		echo "<table class='table table-striped'>
               
                  <tr>
                    <th><font size=2>#</font></th>
                    <th><font size=2>EMPLEADO</font></th>
					<th><font size=2>MOTIVO</font></th>
                  </tr>";
      
					/*todos los registros */
					$numero=1;
					while($row=mysql_fetch_array($result))
					{
					 echo "<tr>";
						echo "<td><font size=2>" . $numero . "</font></td>";
						echo "<td><font size=2>" . utf8_encode($row['Apellido']).", ".utf8_encode($row['Nombre']) . "</font></td>";
						echo "<td><font size=2>-</font></td>";;						
						echo "</tr>";
					  $numero++;
					}
                
					  echo "</table>";
	
	mysql_close();

?>