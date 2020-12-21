<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Actualización de usuario';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

  $this->registerJsFile(
        '@web/js/bootstrap.min.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
    );
?>


<?= $this->render('_form', [
    'model' => $model,
]) ?>
