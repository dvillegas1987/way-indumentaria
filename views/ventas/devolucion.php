<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Categoria;
use app\models\Producto;
use app\models\Vendedor;
use app\models\Cliente;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\widgets\Pjax;
use kartik\touchspin\TouchSpin;
use kartik\money\MaskMoney;
/* @var $this yii\web\View */
/* @var $model app\models\Ventas */
/* @var $form yii\widgets\ActiveForm */

    $this->registerJsFile(
        '@web/js/bootstrap.min.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
    );
?>

<div class="ventas-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-2">
             <?= $form->field($model, 'cantidad')->textInput(['maxlength' => true])->label('cantidad'); ?>
        </div>
    </div>

</div>

    

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Devolucion' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>



