<?php 
    $ruta=$_SERVER['DOCUMENT_ROOT'];
    if (file_exists($ruta.'/ciudadania')){
        $ruta=$ruta.'/ciudadania';
    }
    $contenido='<div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="demo-container">
                      <div id="container" class="demo-placeholder"></div>
                    </div>
                    
                  </div>';
    include $ruta.'../includes/bd.php';
    $sql="select top 4 idNoticia,Titulo,day(Publicacion)dia, MONTH(Publicacion) mes, Visitas from CDD_PDC_Noticia order by Visitas desc;";    
    $contenido.='<div class="col-md-3 col-sm-12 col-xs-12">
                    <div>
                        <div class="x_title">
                        <h2>Noticias Más Leídas</h2>
                        <div class="clearfix"></div>
                      </div>
                      <ul class="list-unstyled top_profiles scroll-view">';
    $i=1;
    foreach ($conexion->query($sql) as $fila) {
        $titulo=$fila['Titulo'];
        $idNoticia=$fila['idNoticia'];
        $fecha=$fila['dia'].'/'.$fila['mes'];
        $visitas=$fila['Visitas'];
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
        $contenido.='<li class="media event" style="color: white; background-color: '.$color.';">
                          <a style="color: white; " class="pull-left border-aero profile_thumb" href="../noticia.php?noticia='.$idNoticia.'">
                            <i class="fa fa-arrow-right"></i>
                          </a>
                          <div class="media-body">
                            <a style="color: white;" class="title" href="../noticia.php?noticia='.$idNoticia.'">'.$titulo.'</a>
                            <p><strong>Publicada el '.$fecha.' </strong> <small>('.$visitas.' Visitas)</small> </p>
                          </div>
                        </li>';
        if ($i<4){
            $contenido.='<br>';
        }
        $i++;
    }
    $contenido.='</ul>
                    </div>
                  </div>';
    echo $contenido;
?>




