<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Temperatura */

$this->title = 'Update Temperatura: ' . $model->idtemperatura;
$this->params['breadcrumbs'][] = ['label' => 'Temperaturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtemperatura, 'url' => ['view', 'id' => $model->idtemperatura]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="temperatura-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
