<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\DashboardAsset;
use app\models\Complejo;
use app\models\users;
use app\models\Caracteristica;
use app\models\Caracteristica_tipo;


DashboardAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Indumentaria</title>
    <link type="image/x-icon" href="icon/seguridad.png" rel="icon" />
    <link rel="shortcut icon" href="icon/seguridad.png">


    <?php $this->head() ?>
</head>
<body class="nav-md">
<?php $this->beginBody() ?>

    <div class="container body">
        
        <div class="main_container">
           
             <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                  <div class="navbar nav_title" style="border: 0;">
                    <a href="index.php?r=ventas" class="site_title"><img class="img-circle" src="uploads/way2.png"   alt="User Image"> <span>WAY</span></a>
                  </div>
                  <div class="clearfix"></div>


                  <!-- menu prile quick info -->
                  <div class="profile">
                    <div class="profile_pic">
                    
                        <?php  $foto = Yii::$app->user->identity->foto_perfil; ?>
                        <?php  if($foto == ''): ?>
                            <img src="uploads/foto_perfil/foto_default.jpg" class="img-circle profile_img" alt="User Image">
                        <?php else: ?>
                            <img src="<?= $foto; ?>" class="img-circle profile_img" alt="User Image">
                        <?php endif; ?>
                     
                    </div>
                    <div class="profile_info">
                      <span>Bienvenido</span>
                      <h2><?= Yii::$app->user->identity->nombre.', '.Yii::$app->user->identity->apellido;  ?></h2>
                    </div>
                  </div>
                  <!-- /menu prile quick info -->

                  <br />

                  <!-- sidebar menu -->
                  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" >

                    <div class="menu_section">
                      <h3>General</h3>
                      <ul class="nav side-menu">
                        
                        <li><a><i class="fa fa-table"></i> Categorias <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu" style="display: none">
                            <li><a href="index.php?r=categoria/index&origen=&sexo=1&descripcion=Hombre"><i class="fa fa-table"></i> Hombre <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu" style="display: none">
                               <li><a href="index.php?r=categoria/index&origen=0&sexo=1&descripcion=Hombre - Buenos Aires">Buenos aires</a></li>
                                <li><a href="index.php?r=categoria/index&origen=1&sexo=1&descripcion=Hombre - Chile">Chile</a></li>
                                <li><a href="index.php?r=categoria/index&origen=2&sexo=1&descripcion=Hombre - Outlet">Oulet</a></li>

                              </ul>
                            </li>
                            <li><a href="index.php?r=categoria/index&origen=&sexo=0&descripcion=Mujer"><i class="fa fa-table"></i> Mujer <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu" style="display: none">
                               <li><a href="index.php?r=categoria/index&origen=0&sexo=0&descripcion=Mujer - Buenos Aires">Buenos aires</a></li>
                                <li><a href="index.php?r=categoria/index&origen=1&sexo=0&descripcion=Mujer - Chile">Chile</a></li>
                                <li><a href="index.php?r=categoria/index&origen=2&sexo=0&descripcion=Mujer - Outlet">Oulet</a></li>
                              </ul>
                            </li>
                          </ul>
                        </li>


                        <li><a ><i class="fa fa-table"></i> Productos <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu" style="display: none">
                            <li class="active"><a href="index.php?r=producto/indexhombre"><i class="fa fa-table"></i> Hombre <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu" style="display: none">
                                <li><a href="index.php?r=producto/indexhba">Buenos aires</a></li>
                                <li><a href="index.php?r=producto/indexhchile">Chile</a></li>
                                <li><a href="index.php?r=producto/indexhoulet">Oulet</a></li>

                              </ul>
                            </li>
                            <li><a href="index.php?r=producto/indexmujer"><i class="fa fa-table"></i> Mujer <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu" style="display: none">
                                <li><a href="index.php?r=producto/indexmba">Buenos aires</a></li>
                                <li><a href="index.php?r=producto/indexmchile">Chile</a></li>
                                <li><a href="index.php?r=producto/indexmoulet">Oulet</a></li>
                              </ul>
                            </li>
                          </ul>
                        </li>


                        <li><a><i class="fa fa-table"></i> Configuracion<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu" style="display: none">
  
                            <li><a href="index.php?r=categoria/index&origen=2&sexo=0&descripcion=General">Categoria</a></li>
                            <li><a href="index.php?r=producto/index&origen=2&sexo=0&descripcion=General">Producto</a></li>
                            <li><a href="index.php?r=stock/index">Stock</a></li>
                            <li><a href="index.php?r=vendedor/index">Vendedor</a></li>
                            <li><a href="index.php?r=cliente/index">Cliente</a></li>

                          </ul>
                        </li>

                        <li><a><i class="fa fa-table"></i> Ventas <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu" style="display: none">

                            <li><a href="index.php?r=ventas/index">Nueva venta</a></li>
                            <!--<li><a href="index.php?r=ventas/index1">Ventas pendientes</a></li>-->
                            <li><a href="index.php?r=ventas/index2">Ventas impagas</a></li>
                            <li><a href="index.php?r=ventas/index3">Ventas pagas</a></li>
                            <li><a href="index.php?r=regalo/index">Ventas regalos</a></li>
                            <li><a href="index.php?r=historial/">Historial</a></li>
                     

                          </ul>
                        </li>
                        <li><a><i class="fa fa-table"></i> Gastos <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu" style="display: none">

                            <li><a href="index.php?r=gasto/index">Lista de gatos</a></li>
                            <li><a href="index.php?r=gasto_categoria/index">Categoria de gastos</a></li>
                            <li><a href="index.php?r=viaje_items/index">Viaje</a></li>
  

                          </ul>
                        </li>
                        <li><a href="http://dashway.tech-test.com.ar/pages/index.php" ><i class="fa fa-table"></i> Estadísticas <span class="fa fa-chevron-down"></span></a>

                        </li>


                        <!--<li><a><i class="fa fa-table"></i> Estadísticas <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu" style="display: none">

                            <li><a href="index.php?r=ventas/index">Ventas por vendedor</a></li>
                            <li><a href="index.php?r=ventas/index2">Ventas totales</a></li>
                            <li><a href="index.php?r=ventas/index2">Ranking de ventas</a></li>
                     

                          </ul>
                        </li>-->


                       <!-- <li><a><i class="fa fa-table"></i> Transporte <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu" style="display: none">
                            <li><a href="index.php?r=transporte/index">Transporte</a>
                            </li>
                            <li><a href="index.php?r=transporte_tipo/index">Tipo de transporte</a>
                            </li>
                          </ul>
                        </li>

                        <li><a><i class="fa fa-table"></i> Lugar <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu" style="display: none">
                            <li><a href="index.php?r=lugar/index">Lugar</a>
                            </li>
                            <li><a href="index.php?r=lugar_tipo/index">Tipo de lugar</a>
                            </li>
                          </ul>
                        </li>


                        <li><a href="index.php?r=denuncia/index"><i class="fa fa-table"></i> Denuncia </a>
                         
                        </li>

                        <li><a  href="index.php?r=caracteristica/index"><i class="fa fa-table"></i> Caracterisitica </a>
                          
                        </li>-->


                      </ul>
                    </div>
                   <!-- <div class="menu_section">
                      <h3>UTILIDADES</h3>
                      <ul class="nav side-menu">

                       
                        <li><a href="index.php?r=profesional"><i class="fa fa-edit"></i> Profesional </a></li>
                        <li><a href="index.php?r=profesion"><i class="fa fa-edit"></i> Profesion </a></li>
                        <li><a href="index.php?r=novedades"><i class="fa fa-edit"></i> Novedades </a></li>

                      </ul>
                    </div>-->

                  </div>
                  <!-- /sidebar menu -->

                  <!-- /menu footer buttons -->
                  <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                      <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                      <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                      <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout">
                      <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                  </div>
                  <!-- /menu footer buttons -->
                </div>
              </div>

            <!-- top navigation -->
              <div class="top_nav">

                <div class="nav_menu">
                  <nav class="" role="navigation">
                    <div class="nav toggle">
                      <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                      <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          
                           <?php  $foto = Yii::$app->user->identity->foto_perfil; ?>
                            <?php  if($foto == ''): ?>
                                <img src="uploads/foto_perfil/foto_default.jpg" class="img-circle" alt="User Image">
                            <?php else: ?>
                                <img src="<?= $foto; ?>" class="img-circle" alt="User Image">
                            <?php endif; ?>
                          <?= Yii::$app->user->identity->username;  ?>   
                        
                          <span class=" fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">

                          <li>
                                <?php
                                    $id = Yii::$app->user->identity->id;    
                                    //echo  Html::a( '<i class="glyphicon glyphicon-user pull-right"></i> Perfil', ['users/view', 'id' => $id]) ;

                                ?>
                                 <?= Html::a('<i class="glyphicon glyphicon-user pull-right"></i> Perfil', ['/users/view', 'id' =>  $id ],
                                 ['data-pjax'=>1]) ?>
                          </li>
                          <li>
                            <?=
                                Yii::$app->user->isGuest ?
                                Html::a('<i class="fa fa-sign-out pull-right"></i> Ingresar', ['/site/login']) :
                                Html::a('<i class="fa fa-sign-out pull-right"></i> Cerrar sesión', ['/site/logout'])
                            ?>

                          </li>
                        </ul>
                      </li>

                      <li role="presentation" class="dropdown">
                        <!--href="javascript:;"-->
                         <!--  class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false"-->
                  
                        <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="true">
                            <i class="fa fa-sign-in"></i>
                            <span class="badge bg-green">1</span>
                        </a>
                   
                 
                        <!--<ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                          <li>
                            <a>
                              <span class="image">
                                                <img src="images/img.jpg" alt="Profile Image" />
                                            </span>
                              <span>
                                                <span>usuario</span>
                              <span class="time">3 mins ago</span>
                              </span>
                              <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were where...
                                            </span>
                            </a>
                          </li>
                          <li>
                            <a>
                              <span class="image">
                                                <img src="images/img.jpg" alt="Profile Image" />
                                            </span>
                              <span>
                                                <span>John Smith</span>
                              <span class="time">3 mins ago</span>
                              </span>
                              <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were where...
                                            </span>
                            </a>
                          </li>
                          <li>
                            <a>
                              <span class="image">
                                                <img src="images/img.jpg" alt="Profile Image" />
                                            </span>
                              <span>
                                                <span>John Smith</span>
                              <span class="time">3 mins ago</span>
                              </span>
                              <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were where...
                                            </span>
                            </a>
                          </li>
                          <li>
                            <a>
                              <span class="image">
                                                <img src="images/img.jpg" alt="Profile Image" />
                                            </span>
                              <span>
                                                <span>John Smith</span>
                              <span class="time">3 mins ago</span>
                              </span>
                              <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were where...
                                            </span>
                            </a>
                          </li>
                          <li>
                            <div class="text-center">
                              <a>
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                              </a>
                            </div>
                          </li>
                        </ul>-->
                      </li>

                    </ul>
                  </nav>
                </div>

              </div>
              <!-- /top navigation -->

              <!-- page content -->
              <div class="right_col" role="main">

                <br />
                <div class="">
                    <?= $content ?>
                </div>
                
                <!-- footer content -->
                <footer>
                  <div align="center" >
                    <a href="#"> WAY Indumentaria</a>
                  </div>
                  <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->

              </div>
              <!-- /page content -->

        </div>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
