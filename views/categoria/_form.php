<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-form">

    <?php $form = ActiveForm::begin(); ?>

    


    <div class="row">
        <div class="col-md-12">
            
        	<?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            
        	<?php $model->estado = 1; ?>
            <?=
                $form->field($model, 'estado')->dropDownList([ 0 =>'Inactivo', 1 => 'Activo'],['class' => 'form-control input-sm']);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            
          
            <?=
                $form->field($model, 'categoria_origen')->dropDownList([ 0 =>'Buenos Aires', 1 => 'Chile', 2 => 'Oulet'],['class' => 'form-control input-sm']);
            ?>
        </div>
        <div class="col-md-6">
            
         
            <?=
                $form->field($model, 'categoria_sexo')->dropDownList([ 0 =>'Mujer', 1 => 'Hombre'],['class' => 'form-control input-sm']);
            ?>
        </div>
    </div>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
