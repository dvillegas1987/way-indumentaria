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
    <title>Línea 148</title>
    <link type="image/x-icon" href="icon/seguridad.png" rel="icon" />
    <link rel="shortcut icon" href="icon/seguridad.png">

    <link rel="apple-touch-icon" sizes="57x57" href="icon/homemac57x58.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="icon/homemac72x73.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="icon/homemac114x115.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="icon/homemac144x145.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="icon/home180x182.png" />

    <?php $this->head() ?>
</head>
<body style="background:#F7F7F7;">
<?php $this->beginBody() ?>


<!--<div class="login-box">

    <div class="login-logo">
        <a><b>Admin</b> FINANZAS</a>
    </div>

    <div class="box box-success"  style="border-top-color:#4258A9;">
        <div class="box-header with-border">
             <h3 class="box-title">Ingreso al Sistema</h3>
        </div>
        
        <div class="box-body">
            <?= $content ?>

          
        </div>
   
        <div class="form-group has-feedback" align="right" style="margin-right:5px;">
              <?= Html::a( '<span>¿ Olvidaste tu contraseña?</span>', ['site/recoverpass'/*, 'id' => $model->id*/]) ?>
        </div>
        <div class="box-body" align="center">
            <div class="form-group has-feedback">
              <?= Html::a( '<span><u>Crear cuenta</u></span>', ['site/register'/*, 'id' => $model->id*/]) ?>
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
             
                <h2>Ingreso al Sistema</h2>
        
                    <?= $content ?>
                
                <div class="clearfix"></div>
                <div class="separator">

                  <!--<p class="change_link">New to site?
                    <a href="#toregister" class="to_register"> Create Account </a>
                  </p>-->
                  <div class="clearfix"></div>
                  <br />
                  <div>
                    <h1><img  class="img-circle" style="width: 15%;" src="uploads/way2.png"  alt="User Image"> WAY</h1>

                    <p>@<?= date('Y'); ?> Way Indumentaria</p>
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




 
