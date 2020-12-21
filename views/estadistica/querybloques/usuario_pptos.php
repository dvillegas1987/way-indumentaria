<?php 
 include 'basedatos.php';

if(!session_id()) session_start();
$codigo= $_SESSION["codigo"];

				  if(isset($_POST['mesdesde']) and (($_POST['mesdesde'])!=0)  and  isset($_POST['aniodesde']) and (($_POST['aniodesde'])!=0) and isset($_POST['meshasta']) and (($_POST['meshasta'])!=0) and isset($_POST['aniohasta']) and (($_POST['aniohasta'])!=0))
				  { 

				  	 $mesdesde=$_POST['mesdesde'];
				    $aniodesde=$_POST['aniodesde'];
				    $meshasta=$_POST['meshasta'];
				    $aniohasta=$_POST['aniohasta'];
				    
				    $ultimodiameshasta=date('d',(mktime(0,0,0,$meshasta+1,1,$aniohasta)-1));

				    $fechadesde=$aniodesde."-".$mesdesde."-01";
				    $fechahasta=$aniohasta."-".$meshasta."-".$ultimodiameshasta;      


				    $result=mysql_query("select p.Fecha, c.razonSocial, o.direccion,d.path,d.presupuesto
				              from usuario u
				              join presupuesto p on u.vendedor = p.vendedor
				              left join (select presupuesto,path,max(codigo) documento  from documento group by presupuesto) d on d.presupuesto = p.Codigo
				              join cliente c on p.cliente = c.codigo
				              left join  obra o on p.Obra = o.codigo
				              where p.Fecha>='".$fechadesde."' and p.Fecha<='".$fechahasta."' and u.codigo='".$codigo."'
				              order by p.Fecha desc");


				  	?>


<table class="table table-hover" id="dataTable" >


                <tr>
                <th>#</th>
                <th><font size=2>FECHA</font></th>
                <th><font size=2>CLIENTE</font></th>
                <th><font size=2>OBRA</font></th>
                <th><font size=2>PPTO</font></th>
                <th><font size=2>DOC</font></th>
                <th><font size=2>CHECK</font></th>
                </tr>
              
          
                <?php

                $numero=1;
                while($row=mysql_fetch_array($result))
                {
        
                $pdf= '../../../DocumentosAASA/'.$row['path'];
         
                 ?>


                <tr>
                <td><font size=2><?php echo $numero ?></font></td>     
                <td><font size=2><?php echo utf8_encode($row['Fecha']) ?></font></td>
                <td><font size=2><?php echo  utf8_encode($row['razonSocial']) ?></font></td>
                <td><font size=2><?php echo utf8_encode($row['direccion']) ?></font></td>
                <td id="name"><font size=2><?php echo utf8_encode($row['presupuesto']) ?></font></td>
                <td><button type="button" class="btn btn-s-md btn-success" style="min-width:50px;" onclick="window.open('<?php echo $pdf?>')" ><i class="icon-large icon-file"></i>  Ver</button></td>             
  				<td><input type="checkbox" id="IdsPresupuestos[]" name="IdsPresupuestos[]" value="<?php echo utf8_encode($row['presupuesto']) ?>" style=" width: 20px;  height: 20px;"></td>
                </tr>
                 

                
                
                <?php
                  $numero++;
                } 

                mysql_close();
							
                ?>
               

</table>        
           
<?php }

else{



                 $result=mysql_query("select p.Fecha, c.razonSocial, o.direccion,d.path,d.presupuesto
                      from usuario u
                      join presupuesto p on u.vendedor = p.vendedor
                      left join (select presupuesto,path,max(codigo) documento  from documento group by presupuesto) d on d.presupuesto = p.Codigo
                      join cliente c on p.cliente = c.codigo
                      left join  obra o on p.Obra = o.codigo
                      where month(p.Fecha)=".date("m")." and year(p.Fecha)=".date("Y")." and u.codigo='".$codigo."'
             		  order by p.Fecha desc");


	?>

	<table class="table table-hover" id="dataTable" >
       
  
       
  
   		
       
  
                <tr>
                <th>#</th>
                <th><font size=2>FECHA</font></th>
                <th><font size=2>CLIENTE</font></th>
                <th><font size=2>OBRA</font></th>
                <th><font size=2>PPTO</font></th>
                <th><font size=2>DOC</font></th>
                <th><font size=2>CHECK</font></th>
                </tr>
              
                <?php
           

                $numero=1;
                while($row=mysql_fetch_array($result))
                { 

                 $pdf= '../../../DocumentosAASA/'.$row['path']; ?>

                
                  <tr>
                  <td><font size=2><?php echo $numero ?></font></td>
                  <td><font size=2><?php echo utf8_encode($row['Fecha']) ?></font></td>
                  <td><font size=2><?php echo utf8_encode($row['razonSocial']) ?></font></td>
                  <td><font size=2><?php echo utf8_encode($row['direccion']) ?></font></td>
                  <td><font size=2><?php echo utf8_encode($row['presupuesto']) ?></font></td>
                  <td><button type="button" class="btn btn-s-md btn-success" style="min-width:50px;" onclick="window.open('<?php echo $pdf?>')" ><i class="icon-large icon-file"></i>  Ver</button></td>
  				  <td><input type="checkbox" id="IdsPresupuestos[]" name="IdsPresupuestos[]" value="<?php echo utf8_encode($row['presupuesto']) ?>" style=" width: 20px;  height: 20px;"></td>
                  </tr>
               
                  

                 <?php 

                 $numero++;
                 } 

                mysql_close();
               
                ?>
       
                 </table>
            
             <?php }?>
