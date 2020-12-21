<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Regalo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="regalo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idProducto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cantidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'importe')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vendedor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_venta')->textInput() ?>

    <?= $form->field($model, 'importe_unitario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <?= $form->field($model, 'fecha_carga')->textInput() ?>

    <?= $form->field($model, 'tipo_venta')->textInput() ?>

    <?= $form->field($model, 'caracter')->textInput() ?>

    <?= $form->field($model, 'carga_venta')->textInput() ?>

    <?= $form->field($model, 'forma_pago')->textInput() ?>

    <?= $form->field($model, 'descuento_aplicado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'folio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_antigua')->textInput() ?>

    <?= $form->field($model, 'regalo')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
