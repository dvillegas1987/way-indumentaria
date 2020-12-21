<?php 
    $ruta=$_SERVER['DOCUMENT_ROOT'];
    if (file_exists($ruta.'/ciudadania')){
        $ruta=$ruta.'/ciudadania';
    }
    include $ruta.'../includes/bd.php';
    $series="data: [";
    $sql="select day(publicacion) dia,COUNT(*) cantidad from CDD_PDC_Noticia where Activo='True' and month(GETDATE())=MONTH(Publicacion) group by day(Publicacion);";
    $dia_cont=1;
    foreach ($conexion->query($sql) as $fila) {
        if ($fila['dia']==1 && $dia_cont==1){
            $series.=$fila['cantidad'].",";
        }else{
            if ($dia_cont==1){
                $series.="0,";   
            }
        }
        
        for ($index = $dia_cont; $index < ($fila['dia']-1); $index++) {
            $series.="0,";
        }
        $series.=$fila['cantidad'].",";
        $dia_cont=$fila['dia'];
    }
    $series=substr($series, 0, -1)."]";
    
    $categories= "categories: ['1'";
    for ($i = 2; $i < (date('d')+1); $i++) {
        $categories.= ",'".$i."'";
    }
    $categories.="]";
    
    $contenido='';
    
    $sql="select COUNT(*) Valor, 'Total de Noticias' Titulo,'Cantidad Total de Noticias' Descripcion from CDD_PDC_Noticia where Activo='True'
            union all
            select cast(3*cast(
							count(*) as decimal(10,2)
						)
						/
						(2*cast(
							datediff(day,Min(Publicacion),GETDATE()) as decimal(10,2)
						)) 
						as decimal (10,2)
					) Valor, 'Promedio Diario' Titulo, 'Promedio de Noticias por Día' Descripcion from CDD_PDC_Noticia Where Activo='True'
			union all
			select cast(cast(sum(Visitas) as decimal(10,2))/cast(COUNT(*) as decimal(10,2)) as decimal(10,2)) Valor, 'Promedio de Visitas' Titulo, 'Cantidad Promedio de Visitas por Noticia' Descripcion from CDD_PDC_Noticia where Activo='True'
			union all
			select COUNT(*) Valor, 'Noticias del Mes' Titulo, 'Cantidad de Noticias Cargadas Este Mes' Descripcion from CDD_PDC_Noticia where Activo='True' and month(GETDATE())=MONTH(Publicacion);";    
    $i=1;
    foreach ($conexion->query($sql) as $fila) {
        switch ($i) {
            case 1:
               $color='#42a8ae';
               break;
            case 2:
               $color='#29788d';
               break;
            case 3:
               $color='#52658c';
               break;
            case 4:
               $color='#7f81bd';
               break;
            default:
                $color='#42a8ae';
                break;
        }
        $valor=$fila['Valor'];
        if (floor($valor)==$valor){
            $valor=floor($valor);
        }
        $titulo=$fila['Titulo'];
        $descripcion=$fila['Descripcion'];
        $contenido.='<div style="color:#f5f5f5;" class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div style="background-color: '.$color.';" class="tile-stats">
                          <div class="icon"><i class="fa fa-check"></i>
                          </div>
                          <div class="count">'.$valor.'</div>
                          <h3>'.$titulo.'</h3>
                          <p>'.$descripcion.'</p>
                        </div>
                      </div>';
        $i++;
    }
    echo $contenido;
?>