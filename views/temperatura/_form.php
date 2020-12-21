<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Temperatura */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="temperatura-form">

    <?php $form = ActiveForm::begin(['method' => 'get',]); ?>

    <?= $form->field($model, 'fecha_hora')->textInput() ?>

    <?= $form->field($model, 'distorsion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'voltaje')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'temperatura')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
