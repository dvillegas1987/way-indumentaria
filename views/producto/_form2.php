<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Categoria;
use kartik\select2\Select2;
use yii\widgets\Pjax;
use kartik\touchspin\TouchSpin;
use kartik\money\MaskMoney;
/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">    
       
        <div class="col-lg-12" style="padding-left: 15px;padding-bottom: 15px;">
                           
            <label class="control-label">Stock</label>

            <?=  TouchSpin::widget([
                  'model' => $model,
                    'attribute' => 'stock',
                    'pluginOptions' => [
                    'initval' => 0,
                    'min' => 0,
                    'max' => 1000,
                ]
            ]);?>
        </div>   
    
    </div>

  

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
