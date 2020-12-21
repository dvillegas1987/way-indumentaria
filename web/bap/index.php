<!DOCTYPE html>
<html lang="en">
    <?php 
        if (isset($_GET['id']) && $_GET['id']!=""){
            $idBoton=$_GET['id'];
        }else{
            header("Location: error.html");
        }
        include 'includes/bd.php';
        $sql="select * from MUJ_BAP_Denuncia d, MUJ_BAP_Persona p
              where d.Denunciante=p.idPersona and d.idBoton='$idBoton'";
        $existe_id=FALSE;
        foreach ($conexion->query($sql) as $fila) {
            $existe_id=TRUE;
            $id_persona=$fila['idPersona'];
            $nombre=$fila['Apellido'].", ".$fila['Nombre'];
            $dni=$fila['DNI'];
            $foto="./../".$fila['Foto'];
            if ($fila['Foto_Dom_1']==NULL || $fila['Foto_Dom_1']==""){
                $foto1="doc/Default_Dom.jpg";
            }else{
                $foto1="./../".$fila['Foto_Dom_1'];
            }
            if ($fila['Foto_Dom_2']==NULL || $fila['Foto_Dom_2']==""){
                $foto2="doc/Default_Dom.jpg";
            }else{
                $foto2="./../".$fila['Foto_Dom_2'];
            }
            $telefono=$fila['Telefono']." - ".$fila['Telefono_Alternativo'];
            $domicilio=$fila['Direccion_Completa'];
            $domicilio_descripcion=$fila['Descripcion'];
            $estatura=$fila['Estatura']/100;
            $estatura_por=$estatura*100-100;
            $caracteristicas=$fila['Otras_Descripciones'];
        }
        if (!$existe_id){
            header("Location: error.html");
        }
        $contextura_fisica=$fila['Contextura_Fisica'];
        $cutis_tipo=$fila['Cutis_Tipo'];
        $cabello_tipo=$fila['Cabello_Tipo'];
        $cabello_largo=$fila['Cabello_Largo'];
        $cabello_color=$fila['Cabello_Color'];
        $cabello_color_por="33";
        $vello_facial=$fila['Vello_Facial'];
        $vello_facial_por="1";
        $boca_tamano=$fila['Boca_Tamano'];
        $boca_tamano_por="100";
        $ojos_color=$fila['Ojos_Color'];
        $ojos_color_por="17";
        $orejas_tipo=$fila['Orejas_Tipo'];
        $orejas_tipo_por="14";
        $orejas_tamano=$fila['Orejas_Tamano'];
        $orejas_tamano_por="100";
        
        //Cargo barra de contextura física
        $sql="select * from MUJ_BAP_Caracteristica
              where idCaracteristicaTipo=1 order by idCaracteristica";
        $i=1;
        $cant=0;
        foreach ($conexion->query($sql) as $fila) {
            $cant++;
            if ($fila['idCaracteristica']==$contextura_fisica){
                $contextura_fisica=$fila['Valor'];
                $valor=$i;
            }else{
                $i++;
            }
        }
        if ($valor==$cant){
            $contextura_fisica_por="100";
        }else{
            if ($valor==1){
                $contextura_fisica_por="1";
            }else{
                $contextura_fisica_por= intval(100*$valor/$cant);
            }
        }
        
        //Cargo barra de cutis tipo
        $sql="select * from MUJ_BAP_Caracteristica
              where idCaracteristicaTipo=2 order by idCaracteristica";
        $i=1;
        $cant=0;
        foreach ($conexion->query($sql) as $fila) {
            $cant++;
            if ($fila['idCaracteristica']==$cutis_tipo){
                $cutis_tipo=$fila['Valor'];
                $valor=$i;
            }else{
                $i++;
            }
        }
        if ($valor==$cant){
            $cutis_tipo_por="100";
        }else{
            if ($valor==1){
                $cutis_tipo_por="1";
            }else{
                $cutis_tipo_por= intval(100*$valor/$cant);
            }
        }
        
        //Cargo barra de cabello tipo
        $sql="select * from MUJ_BAP_Caracteristica
              where idCaracteristicaTipo=3 order by idCaracteristica";
        $i=1;
        $cant=0;
        foreach ($conexion->query($sql) as $fila) {
            $cant++;
            if ($fila['idCaracteristica']==$cabello_tipo){
                $cabello_tipo=$fila['Valor'];
                $valor=$i;
            }else{
                $i++;
            }
        }
        if ($valor==$cant){
            $cabello_tipo_por="100";
        }else{
            if ($valor==1){
                $cabello_tipo_por="1";
            }else{
                $cabello_tipo_por= intval(100*$valor/$cant);
            }
        }
        
        //Cargo barra de cabello largo
        $sql="select * from MUJ_BAP_Caracteristica
              where idCaracteristicaTipo=4 order by idCaracteristica";
        $i=1;
        $cant=0;
        foreach ($conexion->query($sql) as $fila) {
            $cant++;
            if ($fila['idCaracteristica']==$cabello_largo){
                $cabello_largo=$fila['Valor'];
                $valor=$i;
            }else{
                $i++;
            }
        }
        if ($valor==$cant){
            $cabello_largo_por="100";
        }else{
            if ($valor==1){
                $cabello_largo_por="1";
            }else{
                $cabello_largo_por= intval(100*$valor/$cant);
            }
        }
        
        //Cargo barra de cabello color
        $sql="select * from MUJ_BAP_Caracteristica
              where idCaracteristicaTipo=5 order by idCaracteristica desc";
        $i=1;
        $cant=0;
        foreach ($conexion->query($sql) as $fila) {
            $cant++;
            if ($fila['idCaracteristica']==$cabello_color){
                $cabello_color=$fila['Valor'];
                $valor=$i;
            }else{
                $i++;
            }
        }
        if ($valor==$cant){
            $cabello_color_por="100";
        }else{
            if ($valor==1){
                $cabello_color_por="1";
            }else{
                $cabello_color_por= intval(100*$valor/$cant);
            }
        }
        
        
        //Cargo barra de vello facial
        $sql="select * from MUJ_BAP_Caracteristica
              where idCaracteristicaTipo=6 order by idCaracteristica";
        $i=1;
        $cant=0;
        foreach ($conexion->query($sql) as $fila) {
            $cant++;
            if ($fila['idCaracteristica']==$vello_facial){
                $vello_facial=$fila['Valor'];
                $valor=$i;
            }else{
                $i++;
            }
        }
        if ($valor==$cant){
            $vello_facial_por="100";
        }else{
            if ($valor==1){
                $vello_facial_por="1";
            }else{
                $vello_facial_por= intval(100*$valor/$cant);
            }
        }
        
        //Cargo barra de boca tamaño
        $sql="select * from MUJ_BAP_Caracteristica
              where idCaracteristicaTipo=7 order by idCaracteristica";
        $i=1;
        $cant=0;
        foreach ($conexion->query($sql) as $fila) {
            $cant++;
            if ($fila['idCaracteristica']==$boca_tamano){
                $boca_tamano=$fila['Valor'];
                $valor=$i;
            }else{
                $i++;
            }
        }
        if ($valor==$cant){
            $boca_tamano_por="100";
        }else{
            if ($valor==1){
                $boca_tamano_por="1";
            }else{
                $boca_tamano_por= intval(100*$valor/$cant);
            }
        }
        //Cargo barra de ojos color
        $sql="select * from MUJ_BAP_Caracteristica
              where idCaracteristicaTipo=8 order by idCaracteristica";
        $i=1;
        $cant=0;
        foreach ($conexion->query($sql) as $fila) {
            $cant++;
            if ($fila['idCaracteristica']==$ojos_color){
                $ojos_color=$fila['Valor'];
                $valor=$i;
            }else{
                $i++;
            }
        }
        if ($valor==$cant){
            $ojos_color_por="100";
        }else{
            if ($valor==1){
                $ojos_color_por="1";
            }else{
                $ojos_color_por= intval(100*$valor/$cant);
            }
        }
        //Cargo barra de orejas tipo
        $sql="select * from MUJ_BAP_Caracteristica
              where idCaracteristicaTipo=9 order by idCaracteristica";
        $i=1;
        $cant=0;
        foreach ($conexion->query($sql) as $fila) {
            $cant++;
            if ($fila['idCaracteristica']==$orejas_tipo){
                $orejas_tipo=$fila['Valor'];
                $valor=$i;
            }else{
                $i++;
            }
        }
        if ($valor==$cant){
            $orejas_tipo_por="100";
        }else{
            if ($valor==1){
                $orejas_tipo_por="1";
            }else{
                $orejas_tipo_por= intval(100*$valor/$cant);
            }
        }
        //Cargo barra de orejas tamaño
        $sql="select * from MUJ_BAP_Caracteristica
              where idCaracteristicaTipo=10 order by idCaracteristica";
        $i=1;
        $cant=0;
        foreach ($conexion->query($sql) as $fila) {
            $cant++;
            if ($fila['idCaracteristica']==$orejas_tamano){
                $orejas_tamano=$fila['Valor'];
                $valor=$i;
            }else{
                $i++;
            }
        }
        if ($valor==$cant){
            $orejas_tamano_por="100";
        }else{
            if ($valor==1){
                $orejas_tamano_por="1";
            }else{
                $orejas_tamano_por= intval(100*$valor/$cant);
            }
        }
    ?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Datos de la Denuncia - Perfiles de Denunciante y Denunciado</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
</head>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div role="main">
        <div class="">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Datos de la Denuncia <small>Perfiles de Denunciante y Denunciado</small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="col-lg-6">
                  <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                    <img style="width: 100%;" src="<?php echo $foto; ?>" alt="Avatar">
                    <h3><?php echo $nombre; ?></h3>

                    <ul class="list-unstyled user_data">
                      <li><i style="width: 2em;" class="fa fa-vcard-o user-profile-icon"></i>DNI: <?php echo $dni; ?></li>
                      <li><i style="width: 2em;" class="fa fa-power-off user-profile-icon"></i>Id Botón: <?php echo $idBoton; ?></li>
                      <li><i style="width: 2em;" class="fa fa-phone user-profile-icon"></i><?php echo $telefono; ?></li>
                      <li><i style="width: 2em;" class="fa fa-map-o user-profile-icon"></i>Domicilio: <?php echo $domicilio; ?></li>
                      <li><?php echo $domicilio_descripcion; ?></li>
                    </ul>

                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Denunciante</a></li>
                        <li><a href="../index.php?r=persona%2Fview&id=<?php echo $id_persona;?>" id="profile-tab" aria-expanded="false" target="_blank">Detalle</a></li>
                        <!--<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Lugares/Vehículos</a></li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Entorno Familiar</a></li>-->
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="x_panel">
                                <div class="x_title">
                                  <h2>Características Físicas<small> anexo fotos de ubicación</small></h2>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="col-lg-12">
                                      <ul class="list-unstyled user_data">
                                        <li>
                                          <div class="col-lg-6" style="padding-left:0px;"><p>Estatura<p></div><div class="col-lg-6" align="right"style="padding-right:0px;"><p><b><?php echo $estatura; ?></b></p></div>
                                          <div class="progress progress_sm">
                                            <div class="progress-bar bg-estatura" role="progressbar" data-transitiongoal="<?php echo $estatura_por; ?>"></div>
                                          </div>
                                        </li>
                                      </ul>
                                    </div>
                                    <div class="col-lg-6">
                                      <ul class="list-unstyled user_data">
                                        <li>
                                          <div class="col-lg-6" style="padding-left:0px;"><p>Contextura Física<p></div><div class="col-lg-6" align="right"style="padding-right:0px;"><p><b><?php echo $contextura_fisica; ?></b></p></div>
                                          <div class="progress progress_sm">
                                            <div class="progress-bar bg-cutis" role="progressbar" data-transitiongoal="<?php echo $contextura_fisica_por; ?>"></div>
                                          </div>
                                        </li>
                                        <li>
                                          <div class="col-lg-6" style="padding-left:0px;"><p>Cutis Tipo<p></div><div class="col-lg-6" align="right" style="padding-right:0px;"><p><b><?php echo $cutis_tipo; ?></b></p></div>
                                          <div class="progress progress_sm">
                                            <div class="progress-bar bg-cutis" role="progressbar" data-transitiongoal="<?php echo $cutis_tipo_por; ?>"></div>
                                          </div>
                                        </li>
                                        <li>
                                          <div class="col-lg-6" style="padding-left:0px;"><p>Cabello Tipo<p></div><div class="col-lg-6" align="right" style="padding-right:0px;"><p><b><?php echo $cabello_tipo; ?></b></p></div>
                                          <div class="progress progress_sm">
                                            <div class="progress-bar bg-cabello" role="progressbar" data-transitiongoal="<?php echo $cabello_tipo_por; ?>"></div>
                                          </div>
                                        </li>
                                        <li>
                                          <div class="col-lg-6" style="padding-left:0px;"><p>Cabello Largo<p></div><div class="col-lg-6" align="right" style="padding-right:0px;"><p><b><?php echo $cabello_largo; ?></b></p></div>
                                          <div class="progress progress_sm">
                                            <div class="progress-bar bg-cabello" role="progressbar" data-transitiongoal="<?php echo $cabello_largo_por; ?>"></div>
                                          </div>
                                        </li>
                                        <li>
                                          <div class="col-lg-6" style="padding-left:0px;"><p>Cabello Color<p></div><div class="col-lg-6" align="right" style="padding-right:0px;"><p><b><?php echo $cabello_color; ?></b></p></div>
                                          <div class="progress progress_sm">
                                            <div class="progress-bar bg-cabello" role="progressbar" data-transitiongoal="<?php echo $cabello_color_por; ?>"></div>
                                          </div>
                                        </li>
                                      </ul>
                                    </div>
                                    <div class="col-lg-6">
                                      <ul class="list-unstyled user_data">
                                        <li>
                                          <div class="col-lg-6" style="padding-left:0px;"><p>Vello Facial<p></div><div class="col-lg-6" align="right" style="padding-right:0px;"><p><b><?php echo $vello_facial; ?></b></p></div>
                                          <div class="progress progress_sm">
                                            <div class="progress-bar bg-facial" role="progressbar" data-transitiongoal="<?php echo $vello_facial_por; ?>"></div>
                                          </div>
                                        </li>
                                        <li>
                                          <div class="col-lg-6" style="padding-left:0px;"><p>Boca Tamaño<p></div><div class="col-lg-6" align="right" style="padding-right:0px;"><p><b><?php echo $boca_tamano; ?></b></p></div>
                                          <div class="progress progress_sm">
                                            <div class="progress-bar bg-facial" role="progressbar" data-transitiongoal="<?php echo $boca_tamano_por; ?>"></div>
                                          </div>
                                        </li>
                                        <li>
                                          <div class="col-lg-6" style="padding-left:0px;"><p>Ojos Color<p></div><div class="col-lg-6" align="right" style="padding-right:0px;"><p><b><?php echo $ojos_color; ?></b></p></div>
                                          <div class="progress progress_sm">
                                            <div class="progress-bar bg-ojos" role="progressbar" data-transitiongoal="<?php echo $ojos_color_por; ?>"></div>
                                          </div>
                                        </li>
                                        <li>
                                          <div class="col-lg-6" style="padding-left:0px;"><p>Orejas Tipo<p></div><div class="col-lg-6" align="right" style="padding-right:0px;"><p><b><?php echo $orejas_tipo; ?></b></p></div>
                                          <div class="progress progress_sm">
                                            <div class="progress-bar bg-orejas" role="progressbar" data-transitiongoal="<?php echo $orejas_tipo_por; ?>"></div>
                                          </div>
                                        </li>
                                        <li>
                                          <div class="col-lg-6" style="padding-left:0px;"><p>Orejas Tamaño<p></div><div class="col-lg-6" align="right" style="padding-right:0px;"><p><b><?php echo $orejas_tamano; ?></b></p></div>
                                          <div class="progress progress_sm">
                                            <div class="progress-bar bg-orejas" role="progressbar" data-transitiongoal="<?php echo $orejas_tamano_por; ?>"></div>
                                          </div>
                                        </li>
                                      </ul>
                                    </div>
                                    <div class="col-lg-12">
                                          <p class="text-muted well well-sm no-shadow">Otras Características: <?php echo $caracteristicas; ?></p>
                                    </div>
                                    <div class="col-lg-6">
                                        <img style="width: 100%;" src="<?php echo $foto1;?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <img style="width: 100%;" src="<?php echo $foto2;?>">
                                    </div>

                                      <!-- end of skills -->

                                  </div></div></div></div></div>
                                  
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          <!-- start user projects -->
                            <div class="col-lg-12" role="main">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="x_panel">
                                        <div class="x_title">
                                          <h2>Datos Familia/Pareja <small> + Datos de Contacto</small></h2>
                                          <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                          <section class="content invoice">
                                            <!-- title row -->
                                            <div class="row">
                                              <div class="col-xs-12 invoice-header">
                                                <h4>Pareja Actual: Carlos Ibarra</h4>
                                              </div>
                                              <!-- /.col -->
                                            </div>
                                            <!-- info row -->
                                            <div class="row invoice-info">
                                              <div class="col-sm-3 invoice-col">
                                                DNI
                                                <address>
                                                    <strong>26456844</strong>
                                                </address>
                                              </div>
                                              <!-- /.col -->
                                              <div class="col-sm-3 invoice-col">
                                                Edad
                                                <address>
                                                    <strong>38 años</strong>
                                                </address>
                                              </div>
                                              <!-- /.col -->
                                              <div class="col-sm-3 invoice-col">
                                                Teléfono
                                                <address>
                                                    <strong>299-1558844</strong>
                                                </address>
                                              </div>
                                              <!-- /.col -->
                                              <div class="col-sm-3 invoice-col">
                                                Convive
                                                <address>
                                                    <strong>Si</strong>
                                                </address>
                                              </div>
                                            </div>
                                            <!-- /.row -->

                                            <!-- Table row -->
                                            <div class="row">
                                              <div class="col-xs-12 invoice-header">
                                                <h4>Hijos/as</h4>
                                              </div>
                                              <div class="col-xs-12 table">
                                                <table class="table table-striped">
                                                  <thead>
                                                    <tr>
                                                      <th>Apellido y Nombre</th>
                                                      <th style="width: 10%;">DNI</th>
                                                      <th style="width: 10%;">Edad</th>
                                                      <th style="width: 10%;">Teléfono</th>
                                                      <th style="width: 20%;">Vive con Ud?</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <tr>
                                                      <td>Ludmila Agustina Celeste</td>
                                                      <td>48013682</td>
                                                      <td>9</td>
                                                      <td>02994777958</td>
                                                      <td>Si</td>
                                                    </tr>
                                                    <tr>
                                                      <td>Ludmila Agustina Celeste</td>
                                                      <td>48013682</td>
                                                      <td>9</td>
                                                      <td>02994777958</td>
                                                      <td>Si</td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </div>
                                              <!-- /.col -->
                                            </div>
                                            <!-- /.row -->

                                            <div class="row">
                                              <!-- accepted payments column -->
                                              <div class="col-xs-12">
                                                <h4>Otros Datos</h4>
                                                <div class="table-responsive">
                                                  <table class="table">
                                                    <tbody>
                                                      <tr>
                                                        <th style="width:50%">Lugar de Trabajo:</th>
                                                        <td>La Anónima</td>
                                                      </tr>
                                                      <tr>
                                                        <th>Domicilio Laboral:</th>
                                                        <td>Obreros Argentinos 138</td>
                                                      </tr>
                                                      <tr>
                                                        <th>Obra Social:</th>
                                                        <td>OSDE</td>
                                                      </tr>
                                                      <tr>
                                                        <th>Teléfono de Obra Social:</th>
                                                        <td>442-48898</td>
                                                      </tr>
                                                      <tr>
                                                        <th>Servicio de Emergencias:</th>
                                                        <td>Sancor Seguros</td>
                                                      </tr>
                                                      <tr>
                                                        <th>Teléfono de Emergencias:</th>
                                                        <td>442-48896</td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                              </div>
                                              <!-- /.col -->
                                            </div>
                                            <!-- /.row -->

                                            <!-- this row will not appear when printing -->
                                          </section>
                                        </div>
                                      </div>
                                    </div>
                                </div>

                                <!-- footer content -->
                                
                              </div>
                          <!-- end user projects -->

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                          <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                            photo booth letterpress, commodo enim craft beer mlkshk </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php 
                    $sql="select * from MUJ_BAP_Denuncia d, MUJ_BAP_Persona p
                          where d.Denunciado=p.idPersona and d.idBoton='$idBoton'";
                    foreach ($conexion->query($sql) as $fila) {
                        $nombre=$fila['Apellido'].", ".$fila['Nombre'];
                        $dni=$fila['DNI'];
                        $foto="./../".$fila['Foto'];
                        if ($fila['Foto_Dom_1']==NULL || $fila['Foto_Dom_1']==""){
                            $foto1="doc/Default_Dom.jpg";
                        }else{
                            $foto1="./../".$fila['Foto_Dom_1'];
                        }
                        if ($fila['Foto_Dom_2']==NULL || $fila['Foto_Dom_2']==""){
                            $foto2="doc/Default_Dom.jpg";
                        }else{
                            $foto2="./../".$fila['Foto_Dom_2'];
                        }
                        $telefono=$fila['Telefono']." - ".$fila['Telefono_Alternativo'];
                        $domicilio=$fila['Direccion_Completa'];
                        $domicilio_descripcion=$fila['Descripcion'];
                        $estatura=$fila['Estatura']/100;
                        $estatura_por=$estatura*100-100;
                        $caracteristicas=$fila['Otras_Descripciones'];
                    }
                    
                    $contextura_fisica=$fila['Contextura_Fisica'];
                    $cutis_tipo=$fila['Cutis_Tipo'];
                    $cabello_tipo=$fila['Cabello_Tipo'];
                    $cabello_largo=$fila['Cabello_Largo'];
                    $cabello_color=$fila['Cabello_Color'];
                    $cabello_color_por="33";
                    $vello_facial=$fila['Vello_Facial'];
                    $vello_facial_por="1";
                    $boca_tamano=$fila['Boca_Tamano'];
                    $boca_tamano_por="100";
                    $ojos_color=$fila['Ojos_Color'];
                    $ojos_color_por="17";
                    $orejas_tipo=$fila['Orejas_Tipo'];
                    $orejas_tipo_por="14";
                    $orejas_tamano=$fila['Orejas_Tamano'];
                    $orejas_tamano_por="100";

                    //Cargo barra de contextura física
                    $sql="select * from MUJ_BAP_Caracteristica
                          where idCaracteristicaTipo=1 order by idCaracteristica";
                    $i=1;
                    $cant=0;
                    foreach ($conexion->query($sql) as $fila) {
                        $cant++;
                        if ($fila['idCaracteristica']==$contextura_fisica){
                            $contextura_fisica=$fila['Valor'];
                            $valor=$i;
                        }else{
                            $i++;
                        }
                    }
                    if ($valor==$cant){
                        $contextura_fisica_por="100";
                    }else{
                        if ($valor==1){
                            $contextura_fisica_por="1";
                        }else{
                            $contextura_fisica_por= intval(100*$valor/$cant);
                        }
                    }

                    //Cargo barra de cutis tipo
                    $sql="select * from MUJ_BAP_Caracteristica
                          where idCaracteristicaTipo=2 order by idCaracteristica";
                    $i=1;
                    $cant=0;
                    foreach ($conexion->query($sql) as $fila) {
                        $cant++;
                        if ($fila['idCaracteristica']==$cutis_tipo){
                            $cutis_tipo=$fila['Valor'];
                            $valor=$i;
                        }else{
                            $i++;
                        }
                    }
                    if ($valor==$cant){
                        $cutis_tipo_por="100";
                    }else{
                        if ($valor==1){
                            $cutis_tipo_por="1";
                        }else{
                            $cutis_tipo_por= intval(100*$valor/$cant);
                        }
                    }

                    //Cargo barra de cabello tipo
                    $sql="select * from MUJ_BAP_Caracteristica
                          where idCaracteristicaTipo=3 order by idCaracteristica";
                    $i=1;
                    $cant=0;
                    foreach ($conexion->query($sql) as $fila) {
                        $cant++;
                        if ($fila['idCaracteristica']==$cabello_tipo){
                            $cabello_tipo=$fila['Valor'];
                            $valor=$i;
                        }else{
                            $i++;
                        }
                    }
                    if ($valor==$cant){
                        $cabello_tipo_por="100";
                    }else{
                        if ($valor==1){
                            $cabello_tipo_por="1";
                        }else{
                            $cabello_tipo_por= intval(100*$valor/$cant);
                        }
                    }

                    //Cargo barra de cabello largo
                    $sql="select * from MUJ_BAP_Caracteristica
                          where idCaracteristicaTipo=4 order by idCaracteristica";
                    $i=1;
                    $cant=0;
                    foreach ($conexion->query($sql) as $fila) {
                        $cant++;
                        if ($fila['idCaracteristica']==$cabello_largo){
                            $cabello_largo=$fila['Valor'];
                            $valor=$i;
                        }else{
                            $i++;
                        }
                    }
                    if ($valor==$cant){
                        $cabello_largo_por="100";
                    }else{
                        if ($valor==1){
                            $cabello_largo_por="1";
                        }else{
                            $cabello_largo_por= intval(100*$valor/$cant);
                        }
                    }

                    //Cargo barra de cabello color
                    $sql="select * from MUJ_BAP_Caracteristica
                          where idCaracteristicaTipo=5 order by idCaracteristica desc";
                    $i=1;
                    $cant=0;
                    foreach ($conexion->query($sql) as $fila) {
                        $cant++;
                        if ($fila['idCaracteristica']==$cabello_color){
                            $cabello_color=$fila['Valor'];
                            $valor=$i;
                        }else{
                            $i++;
                        }
                    }
                    if ($valor==$cant){
                        $cabello_color_por="100";
                    }else{
                        if ($valor==1){
                            $cabello_color_por="1";
                        }else{
                            $cabello_color_por= intval(100*$valor/$cant);
                        }
                    }


                    //Cargo barra de vello facial
                    $sql="select * from MUJ_BAP_Caracteristica
                          where idCaracteristicaTipo=6 order by idCaracteristica";
                    $i=1;
                    $cant=0;
                    foreach ($conexion->query($sql) as $fila) {
                        $cant++;
                        if ($fila['idCaracteristica']==$vello_facial){
                            $vello_facial=$fila['Valor'];
                            $valor=$i;
                        }else{
                            $i++;
                        }
                    }
                    if ($valor==$cant){
                        $vello_facial_por="100";
                    }else{
                        if ($valor==1){
                            $vello_facial_por="1";
                        }else{
                            $vello_facial_por= intval(100*$valor/$cant);
                        }
                    }

                    //Cargo barra de boca tamaño
                    $sql="select * from MUJ_BAP_Caracteristica
                          where idCaracteristicaTipo=7 order by idCaracteristica";
                    $i=1;
                    $cant=0;
                    foreach ($conexion->query($sql) as $fila) {
                        $cant++;
                        if ($fila['idCaracteristica']==$boca_tamano){
                            $boca_tamano=$fila['Valor'];
                            $valor=$i;
                        }else{
                            $i++;
                        }
                    }
                    if ($valor==$cant){
                        $boca_tamano_por="100";
                    }else{
                        if ($valor==1){
                            $boca_tamano_por="1";
                        }else{
                            $boca_tamano_por= intval(100*$valor/$cant);
                        }
                    }
                    //Cargo barra de ojos color
                    $sql="select * from MUJ_BAP_Caracteristica
                          where idCaracteristicaTipo=8 order by idCaracteristica";
                    $i=1;
                    $cant=0;
                    foreach ($conexion->query($sql) as $fila) {
                        $cant++;
                        if ($fila['idCaracteristica']==$ojos_color){
                            $ojos_color=$fila['Valor'];
                            $valor=$i;
                        }else{
                            $i++;
                        }
                    }
                    if ($valor==$cant){
                        $ojos_color_por="100";
                    }else{
                        if ($valor==1){
                            $ojos_color_por="1";
                        }else{
                            $ojos_color_por= intval(100*$valor/$cant);
                        }
                    }
                    //Cargo barra de orejas tipo
                    $sql="select * from MUJ_BAP_Caracteristica
                          where idCaracteristicaTipo=9 order by idCaracteristica";
                    $i=1;
                    $cant=0;
                    foreach ($conexion->query($sql) as $fila) {
                        $cant++;
                        if ($fila['idCaracteristica']==$orejas_tipo){
                            $orejas_tipo=$fila['Valor'];
                            $valor=$i;
                        }else{
                            $i++;
                        }
                    }
                    if ($valor==$cant){
                        $orejas_tipo_por="100";
                    }else{
                        if ($valor==1){
                            $orejas_tipo_por="1";
                        }else{
                            $orejas_tipo_por= intval(100*$valor/$cant);
                        }
                    }
                    //Cargo barra de orejas tamaño
                    $sql="select * from MUJ_BAP_Caracteristica
                          where idCaracteristicaTipo=10 order by idCaracteristica";
                    $i=1;
                    $cant=0;
                    foreach ($conexion->query($sql) as $fila) {
                        $cant++;
                        if ($fila['idCaracteristica']==$orejas_tamano){
                            $orejas_tamano=$fila['Valor'];
                            $valor=$i;
                        }else{
                            $i++;
                        }
                    }
                    if ($valor==$cant){
                        $orejas_tamano_por="100";
                    }else{
                        if ($valor==1){
                            $orejas_tamano_por="1";
                        }else{
                            $orejas_tamano_por= intval(100*$valor/$cant);
                        }
                    }
                ?>
                <div class="col-lg-6">
                  <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                    <img style="width: 100%;" src="<?php echo $foto; ?>" alt="Avatar">
                    <h3><?php echo $nombre; ?></h3>

                    <ul class="list-unstyled user_data">
                      <li><i style="width: 2em;" class="fa fa-vcard-o user-profile-icon"></i>DNI: <?php echo $dni; ?></li>
                      <li><i style="width: 2em;" class="fa fa-power-off user-profile-icon"></i>Id Botón: <?php echo $idBoton; ?></li>
                      <li><i style="width: 2em;" class="fa fa-phone user-profile-icon"></i><?php echo $telefono; ?></li>
                      <li><i style="width: 2em;" class="fa fa-map-o user-profile-icon"></i>Domicilio: <?php echo $domicilio; ?></li>
                      <li><?php echo $domicilio_descripcion; ?></li>
                    </ul>

                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Denunciado</a></li>
                        <!--<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Lugares/Vehículos</a></li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Entorno Familiar</a></li>-->
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                          <!-- start recent activity -->
                          <h4>Características Físicas</h4>
                          <div class="col-lg-12">
                            <ul class="list-unstyled user_data">
                              <li>
                                <div class="col-lg-6" style="padding-left:0px;"><p>Estatura<p></div><div class="col-lg-6" align="right"style="padding-right:0px;"><p><b><?php echo $estatura; ?></b></p></div>
                                <div class="progress progress_sm">
                                  <div class="progress-bar bg-estatura" role="progressbar" data-transitiongoal="<?php echo $estatura_por; ?>"></div>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <div class="col-lg-6">
                            <ul class="list-unstyled user_data">
                              <li>
                                <div class="col-lg-6" style="padding-left:0px;"><p>Contextura Física<p></div><div class="col-lg-6" align="right"style="padding-right:0px;"><p><b><?php echo $contextura_fisica; ?></b></p></div>
                                <div class="progress progress_sm">
                                  <div class="progress-bar bg-cutis" role="progressbar" data-transitiongoal="<?php echo $contextura_fisica_por; ?>"></div>
                                </div>
                              </li>
                              <li>
                                <div class="col-lg-6" style="padding-left:0px;"><p>Cutis Tipo<p></div><div class="col-lg-6" align="right" style="padding-right:0px;"><p><b><?php echo $cutis_tipo; ?></b></p></div>
                                <div class="progress progress_sm">
                                  <div class="progress-bar bg-cutis" role="progressbar" data-transitiongoal="<?php echo $cutis_tipo_por; ?>"></div>
                                </div>
                              </li>
                              <li>
                                <div class="col-lg-6" style="padding-left:0px;"><p>Cabello Tipo<p></div><div class="col-lg-6" align="right" style="padding-right:0px;"><p><b><?php echo $cabello_tipo; ?></b></p></div>
                                <div class="progress progress_sm">
                                  <div class="progress-bar bg-cabello" role="progressbar" data-transitiongoal="<?php echo $cabello_tipo_por; ?>"></div>
                                </div>
                              </li>
                              <li>
                                <div class="col-lg-6" style="padding-left:0px;"><p>Cabello Largo<p></div><div class="col-lg-6" align="right" style="padding-right:0px;"><p><b><?php echo $cabello_largo; ?></b></p></div>
                                <div class="progress progress_sm">
                                  <div class="progress-bar bg-cabello" role="progressbar" data-transitiongoal="<?php echo $cabello_largo_por; ?>"></div>
                                </div>
                              </li>
                              <li>
                                <div class="col-lg-6" style="padding-left:0px;"><p>Cabello Color<p></div><div class="col-lg-6" align="right" style="padding-right:0px;"><p><b><?php echo $cabello_color; ?></b></p></div>
                                <div class="progress progress_sm">
                                  <div class="progress-bar bg-cabello" role="progressbar" data-transitiongoal="<?php echo $cabello_color_por; ?>"></div>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <div class="col-lg-6">
                            <ul class="list-unstyled user_data">
                              <li>
                                <div class="col-lg-6" style="padding-left:0px;"><p>Vello Facial<p></div><div class="col-lg-6" align="right" style="padding-right:0px;"><p><b><?php echo $vello_facial; ?></b></p></div>
                                <div class="progress progress_sm">
                                  <div class="progress-bar bg-facial" role="progressbar" data-transitiongoal="<?php echo $vello_facial_por; ?>"></div>
                                </div>
                              </li>
                              <li>
                                <div class="col-lg-6" style="padding-left:0px;"><p>Boca Tamaño<p></div><div class="col-lg-6" align="right" style="padding-right:0px;"><p><b><?php echo $boca_tamano; ?></b></p></div>
                                <div class="progress progress_sm">
                                  <div class="progress-bar bg-facial" role="progressbar" data-transitiongoal="<?php echo $boca_tamano_por; ?>"></div>
                                </div>
                              </li>
                              <li>
                                <div class="col-lg-6" style="padding-left:0px;"><p>Ojos Color<p></div><div class="col-lg-6" align="right" style="padding-right:0px;"><p><b><?php echo $ojos_color; ?></b></p></div>
                                <div class="progress progress_sm">
                                  <div class="progress-bar bg-ojos" role="progressbar" data-transitiongoal="<?php echo $ojos_color_por; ?>"></div>
                                </div>
                              </li>
                              <li>
                                <div class="col-lg-6" style="padding-left:0px;"><p>Orejas Tipo<p></div><div class="col-lg-6" align="right" style="padding-right:0px;"><p><b><?php echo $orejas_tipo; ?></b></p></div>
                                <div class="progress progress_sm">
                                  <div class="progress-bar bg-orejas" role="progressbar" data-transitiongoal="<?php echo $orejas_tipo_por; ?>"></div>
                                </div>
                              </li>
                              <li>
                                <div class="col-lg-6" style="padding-left:0px;"><p>Orejas Tamaño<p></div><div class="col-lg-6" align="right" style="padding-right:0px;"><p><b><?php echo $orejas_tamano; ?></b></p></div>
                                <div class="progress progress_sm">
                                  <div class="progress-bar bg-orejas" role="progressbar" data-transitiongoal="<?php echo $orejas_tamano_por; ?>"></div>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <div class="col-lg-12">
                                <p class="text-muted well well-sm no-shadow">Otras Características: <?php echo $caracteristicas; ?></p>
                          </div>
                          <div class="col-lg-6">
                              <img style="width: 100%;" src="<?php echo $foto1;?>">
                          </div>
                          <div class="col-lg-6">
                              <img style="width: 100%;" src="<?php echo $foto2;?>">
                          </div>
                            <!-- end of skills -->

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                          <!-- start user projects -->
                          <table class="data table table-striped no-margin">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Project Name</th>
                                <th>Client Company</th>
                                <th class="hidden-phone">Hours Spent</th>
                                <th>Contribution</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>New Company Takeover Review</td>
                                <td>Deveint Inc</td>
                                <td class="hidden-phone">18</td>
                                <td class="vertical-align-mid">
                                  <div class="progress">
                                    <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td>New Partner Contracts Consultanci</td>
                                <td>Deveint Inc</td>
                                <td class="hidden-phone">13</td>
                                <td class="vertical-align-mid">
                                  <div class="progress">
                                    <div class="progress-bar progress-bar-danger" data-transitiongoal="15"></div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>3</td>
                                <td>Partners and Inverstors report</td>
                                <td>Deveint Inc</td>
                                <td class="hidden-phone">30</td>
                                <td class="vertical-align-mid">
                                  <div class="progress">
                                    <div class="progress-bar progress-bar-success" data-transitiongoal="45"></div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>4</td>
                                <td>New Company Takeover Review</td>
                                <td>Deveint Inc</td>
                                <td class="hidden-phone">28</td>
                                <td class="vertical-align-mid">
                                  <div class="progress">
                                    <div class="progress-bar progress-bar-success" data-transitiongoal="75"></div>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <!-- end user projects -->

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                          <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                            photo booth letterpress, commodo enim craft beer mlkshk </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- footer content -->
        <?php include 'includes/footer.php';?>
        <!-- /footer content -->

      </div>
      <!-- /page content -->
    </div>

  </div>

  <script src="js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>
  <script src="js/custom.js"></script>
  <!-- image cropping -->
  <script src="js/cropping/cropper.min.js"></script>
  <script src="js/cropping/main.js"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="js/moment/moment.min.js"></script>
  <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
  <!-- chart js -->
  <script src="js/chartjs/chart.min.js"></script>
  <!-- moris js -->
  <script src="js/moris/raphael-min.js"></script>
  <script src="js/moris/morris.min.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>  
</body>
</html>