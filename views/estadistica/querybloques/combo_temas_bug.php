<?php
	require "../clases/basedatos.php";

		$bd = new BaseDatos();
		$bd->Iniciar();

		$bd->Ejecutar("select * from temabug t");

	?>
	<option selected="selected" value="0" ></option>
	<?php
	$numero=1;
	while($row1=$bd->Registro())
	{ 

		if($row1->codigo > 0){
		?>
	 	
		<option value="<?php echo $row1->codigo ?>" ><?php echo utf8_encode($row1->descripcion) ?></option> 	

	<?php
		}
	}
?>




