<?php
include "basedatos.php";



if($_POST['IdsPresupuestos'])
{
 
 	
	foreach( $_POST['IdsPresupuestos'] as $IdPresupuesto) {

		if($IdPresupuesto != 0){

		$result1=mysql_query('update presupuesto set vendedor=10 where codigo='.$IdPresupuesto);

		 echo "Actualización exitosa";
		}

		else{

			echo "Error al actualizar. Verificar que posea presupuestos.";
		}
	}
	
}


?>