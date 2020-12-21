<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TemperaturaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="temperatura-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idtemperatura') ?>

    <?= $form->field($model, 'fecha_hora') ?>

    <?= $form->field($model, 'distorsion') ?>

    <?= $form->field($model, 'voltaje') ?>

    <?= $form->field($model, 'temperatura') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
