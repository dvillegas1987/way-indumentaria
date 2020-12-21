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
<body style="background:#F7F7F7;"  class="hold-transition login-page">
<?php $this->beginBody() ?>


<div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
      <div id="login" class="animate form">
        <section class="login_content">
         
            <h2>Recupera tu contraseña ingresando tu mail</h2>
    
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



