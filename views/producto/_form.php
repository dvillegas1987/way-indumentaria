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
        <div class="col-md-3">
            <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">

            <?= $form->field($model, 'precio_costo')->widget(MaskMoney::classname(), [
                'pluginOptions' => [
                    'prefix' => '$ ',
                    'suffix' => '', 
                    'affixesStay' => true,
                    'thousands' => ',',
                    'decimal' => '.',
                    'precision' => 2, 
                    'allowZero' => true,
                    'allowNegative' => false,
                ]
            ])->label('Precio de compra'); ?>
        </div>
      
        <div class="col-lg-3">

            <?= $form->field($model, 'precio_unitario')->widget(MaskMoney::classname(), [
                'pluginOptions' => [
                    'prefix' => '$ ',
                    'suffix' => '', 
                    'affixesStay' => true,
                    'thousands' => ',',
                    'decimal' => '.',
                    'precision' => 2, 
                    'allowZero' => true,
                    'allowNegative' => false,
                ]
            ])->label('Precio de venta'); ?>
        </div>
       
 
        <div class="col-lg-3">

            <?= $form->field($model, 'precio_descuento')->widget(MaskMoney::classname(), [
                'pluginOptions' => [
                    'prefix' => '$ ',
                    'suffix' => '', 
                    'affixesStay' => true,
                    'thousands' => ',',
                    'decimal' => '.',
                    'precision' => 2, 
                    'allowZero' => true,
                    'allowNegative' => false,
                ]
            ])->label('Precio de costo'); ?>
        </div>

    </div>

    <div class="row">    


        <div class="col-lg-4">   
            <?= $form->field($model, 'descuento')->textInput(['maxlength' => true]) ?> 
        </div>



        <div class="col-lg-4" style="padding-left: 15px;padding-bottom: 15px;">
                           
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
        <div class="col-lg-4">
         <?php
            $data = null;
            if ($origen == '') {
              $data = ArrayHelper::map(Categoria::find()->where(['categoria_sexo' => $sexo])->orderBy(['descripcion' => SORT_ASC])->all(), 'codigo', 'descripcion');
            }else{
                
                 $data = ArrayHelper::map(Categoria::find()->where([/*'categoria_origen' => $origen, 'categoria_sexo' => $sexo*/])->orderBy(['descripcion' => SORT_ASC])->all(), 'codigo', 'descripcion');
                
            }   


        ?>
            <?= 

                $form->field($model, 'categoria')->widget(Select2::classname(), [

                        'data' => $data,
                        'language' => 'es',
                        'options' => [
                        'placeholder' => 'Seleccione categoría...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],      
                     
                   
                ]);


            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <?php $model->estado = 1; ?>
            <?=
                $form->field($model, 'estado')->dropDownList([ 0 =>'Inactivo', 1 => 'Activo'],['class' => 'form-control input-sm']);
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
<script type="text/javascript">

$( document ).ready(function() {
    $("#producto-precio_costo-disp").keyup(function(){
        var c = $("#producto-precio_costo-disp").val().replace(',','');
        var compra = parseFloat(c.replace('$ ',''));
    

        var calculo_costo = ((120 * compra )/100) + compra;
        $("#producto-precio_descuento").val(calculo_costo.toFixed(2));
        $("#producto-precio_descuento-disp").val(calculo_costo.toFixed(2));


        var calculo_venta =  ((33 * compra )/100)  + compra;
        $("#producto-precio_unitario").val(calculo_venta.toFixed(2));
        $("#producto-precio_unitario-disp").val(calculo_venta.toFixed(2));

   
    });
    
});

</script>