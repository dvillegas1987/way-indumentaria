

<table class="table table-striped" id="dataTable">
						   
							  <tr>
								<th>#</th>
								<th><font size=2>FECHA</font></th>
								<th><font size=2>CLIENTE</font></th>
								<th><font size=2>OBRA</font></th>
								<th><font size=2>ADJUNTO</font></th>
							  </tr>
							

<?php
	include 'basedatos.php';

	$codigo=2;

	if(isset($_POST['mesdesde']) and (($_POST['mesdesde'])!=0)  and  isset($_POST['aniodesde']) and (($_POST['aniodesde'])!=0) and isset($_POST['meshasta']) and (($_POST['meshasta'])!=0) and isset($_POST['aniohasta']) and (($_POST['aniohasta'])!=0))
	{
		$mesdesde=$_POST['mesdesde'];
		$aniodesde=$_POST['aniodesde'];
		$meshasta=$_POST['meshasta'];
		$aniohasta=$_POST['aniohasta'];


		
		$ultimodiameshasta=date('d',(mktime(0,0,0,$meshasta+1,1,$aniohasta)-1));
		
		$fechadesde=$aniodesde."-".$mesdesde."-01";
		$fechahasta=$aniohasta."-".$meshasta."-".$ultimodiameshasta;			

	
		

		$result=mysql_query("select p.Fecha, c.razonSocial, o.direccion,d.path
							from usuario u
							join presupuesto p on u.vendedor = p.vendedor
							left join (select presupuesto,path,max(codigo) documento  from documento group by presupuesto) d on d.presupuesto = p.Codigo
							join cliente c on p.cliente = c.codigo
							left join  obra o on p.Obra = o.codigo
							where p.Fecha>='".$fechadesde."' and p.Fecha<='".$fechahasta."' and u.codigo='".$codigo."'
							order by p.Fecha desc;");

		}
							
								$numero=1;

								while($row=mysql_fetch_array($result))
								{

								$pdf= '../../../DocumentosAASA/'.$row['path'];
								$presupuesto= $row['presupuesto']; 

								?>

								<form id="formulario2" name="formulario2" action="" method="POST">
								<tr>
									<td><font size=2><?php echo $numero  ?></font></td>
									<td><font size=2><?php echo utf8_encode($row['Fecha']) ?></font></td>
									<td><font size=2><? echo utf8_encode($row['razonSocial']) ?></font></td>
									<td><font size=2><?php echo utf8_encode($row['direccion']) ?></font></td>
									<td > <input type="hidden" id="id" name="id" value="<?php echo utf8_encode($row['presupuesto']);?>" /></td>
									<td><button type="submit" class="btn btn-s-md btn-success" style="min-width:50px;" onclick=window.open('".$pdf."') ><i class="icon-plus"></i> Add</button>
									<button type="submit" class="btn btn-sm btn-primary" name="actualizar" id="actualizar">
									<i class="icon-large icon-refresh"</i></button></td>
								 </tr>
								</form>
								  

								<?  $numero++; }

								if (isset($_POST['actualizar'])){ 

									$presupuesto=$_POST['id'];
									$result = mysql_query("update presupuesto set vendedor=10 where codigo='".$presupuesto."'") ;


									} ?>

			</table>

