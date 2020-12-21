<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\DashboardAsset;

DashboardAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body style="background:#F7F7F7;" class="hold-transition login-page">
<?php $this->beginBody() ?>

<!--<div class="row">
    <div class="col-md-6" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);-webkit-transform: translate(-50%, -50%);">
        <div class="login-logo">
            <a><b>Admin</b> FINANZAS</a>
        </div>
        <div class="box box-default" >
            <div class="box box-success"  style="border-top-color:#4258A9;">
                <div class="box-header with-border">
                <h3 class="box-title">Registrarme</h3>
                </div>
                <div class="box-body">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>
</div>-->


<div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
          <div id="login" class="animate form">
            <section class="login_content">
             
                <h2>Regristrarme</h2>
        
                    <?= $content ?>
                
                <div class="clearfix"></div>
                <div class="separator">

                  <!--<p class="change_link">New to site?
                    <a href="#toregister" class="to_register"> Create Account </a>
                  </p>-->
                  <div class="clearfix"></div>
                  <br />
                  <div>
                    <h1><i class="fa fa-home" style="font-size: 26px;"></i> Alquileres Web</h1>

                    <p>©2016 Tech-Test. Desarrollado con Yii Framework.</p>
                  </div>
                </div>
             
              <!-- form -->
            </section>
            <!-- content -->
          </div>
        </div>
      </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>



