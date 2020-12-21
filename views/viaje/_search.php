<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ViajeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="viaje-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idviaje') ?>

    <?= $form->field($model, 'pasajes') ?>

    <?= $form->field($model, 'hospedaje') ?>

    <?= $form->field($model, 'comestibles') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
