<?php

use yii\helpers\Html;
  $this->registerJsFile(
        '@web/js/bootstrap.min.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
    );

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Nuevo usuario';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
