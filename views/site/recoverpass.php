<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
 
<h5><?= $msg ?></h5>
<?php $form = ActiveForm::begin([
    'method' => 'post',
    'enableClientValidation' => true,
]);
?>
 
<div class="form-group">
 <?= $form->field($model, "email")->input("email") ?>  
</div>
 
<?= Html::submitButton("Recuperar", ["class" => "btn btn-primary pull-right"]) ?>
 
<?php $form->end() ?>