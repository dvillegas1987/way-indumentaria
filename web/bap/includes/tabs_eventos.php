<?php
    $ruta=$_SERVER['DOCUMENT_ROOT'];
    if (file_exists($ruta.'/ciudadania')){
        $ruta=$ruta.'/ciudadania';
    }
    include '../includes/bd.php';
    $contenido='<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">';
    
    for ($mes = 1; $mes < 13; $mes++) {
        $expanded="false";
        $class="";
        switch ($mes) {
            case 1:
                $mes_nombre= "Enero";
                $expanded="true";
                $class="active";
                break;
            case 2:
                $mes_nombre= "Febrero";
                break;
            case 3:
                $mes_nombre= "Marzo";
                break;
            case 4:
                $mes_nombre= "Abril";
                break;
            case 5:
                $mes_nombre= "Mayo";
                break;
            case 6:
                $mes_nombre= "Junio";
                break;
            case 7:
                $mes_nombre= "Julio";
                break;
            case 8:
                $mes_nombre= "Agosto";
                break;
            case 9:
                $mes_nombre= "Septiembre";
                break;
            case 10:
                $mes_nombre= "Octubre";
                break;
            case 11:
                $mes_nombre= "Noviembre";
                break;
            case 12:
                $mes_nombre= "Diciembre";
                break;
        }
        $sql="select count(*) cant from CDD_PDC_Evento where month(fecha)=$mes;";
        foreach ($conexion->query($sql) as $fila) {
            if($fila['cant']!=0){
                $mes_nombre='<b>'.$mes_nombre.' ('.$fila['cant'].')</b>';
            }
        }
        $contenido.='<li role="presentation" class="'.$class.'"><a href="#mes_'.$mes.'" id="'.$mes.'-tab" role="tab" data-toggle="tab" aria-expanded="'.$expanded.'">'.$mes_nombre.'</a></li>';
    }
    
    $contenido.='</ul>
                 <div id="myTabContent" class="tab-content">';
    for ($index = 1; $index < 13; $index++) {
        $active='';
        if ($index==1){$active='active in';}
        $contenido.='<div role="tabpanel" class="tab-pane fade '.$active.'" id="mes_'.$index.'" aria-labelledby="home-tab">
                        <div class="x_panel">
                            <div class="x_content">
                                <div class="col-xs-12">
                                <div class="tab-content">
                                  <div class="tab-pane active" id="home">
                                    <div class="x_content">
                                        <div class="row">';
        $sql="select * from CDD_PDC_Evento where month(fecha)=$index order by Fecha;";
        $e=0;
        foreach ($conexion->query($sql) as $fila) {
            $e=1;
            $carpeta=$fila['Carpeta'];
            $directory="eventos/$carpeta";
            $dirint = dir($directory);
            $i=0;
            while (($archivo = $dirint->read()) !== false)
            {
                $i++;
                if ($i==3){break;}
            }
            $dirint->close();
            $contenido.='<div class="col-md-3" align="center"><b>
                            '.$fila['Descripcion'].'</b>
                            <div class="thumbnail">
                              <div class="image view view-first">
                                <img style="width: 100%; display: block;" src="eventos/'.$carpeta.'/'.$archivo.'" alt="image">
                                <div class="mask">
                                  <p>'.$fila['Descripcion'].'</p>
                                  <div class="tools tools-bottom">
                                    <a href="galeria/evento.php?evento='.$fila['idEvento'].'" target="_blank"><i class="fa fa-search"></i></a>
                                  </div>
                                </div>
                              </div>

                            </div>
                          </div>';
        }
        if ($e==0){$contenido.='<div class="col-md-12"><b>No hay eventos para el mes seleccionado</b></div>';};
        $contenido.='</div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                          </div>
                      </div>';
    }
    $contenido.='</div>';
    echo $contenido;