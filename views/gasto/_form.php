<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Gasto_categoria;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Gasto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gasto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'importe')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoria')
        ->dropDownList(
        ArrayHelper::map(Gasto_categoria::find()->orderBy(['descripcion' => SORT_ASC])->all(), 'idcategoriagastos', 'descripcion'))
    ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
