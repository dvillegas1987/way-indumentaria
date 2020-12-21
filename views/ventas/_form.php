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
            <?=
                $form->field($model, 'caracter')->dropDownList([ 0 =>'Convencional', 1 => 'Regalos'],['class' => 'form-control input-sm']);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class = "panel panel-default">
               
               <div class = "panel-heading" style="padding-top:4px;padding-bottom:4px;" >
                  Datos
               </div>
               
               <div class = "panel-body">
                    <div class="row">
                        
                        <div class="col-lg-4">
                        <?= 

                            $form->field($model, 'vendedor')->widget(Select2::classname(), [

                                    'data' => ArrayHelper::map(Vendedor::find()->orderBy(['apellido' => SORT_ASC])->all(), 'id', function($model, $defaultValue) {
                                                                                    return $model['apellido'].', '.$model['nombre'];}),
                                    'language' => 'es',
                                    'options' => [
                                    'placeholder' => 'Seleccione vendedor...'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],      
                                 
                               
                            ]);


                        ?>
                    </div>

                    <div class="col-lg-4">
                        <?= 

                            $form->field($model, 'cliente')->widget(Select2::classname(), [

                                    'data' => ArrayHelper::map(Cliente::find()->orderBy(['apellido' => SORT_ASC])->all(), 'id', function($model, $defaultValue) {
                                                                                    return $model['apellido'].', '.$model['nombre'];}),
                                    'language' => 'es',
                                    'options' => [
                                    'placeholder' => 'Seleccione cliente...'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],      
                                 
                               
                            ]);


                        ?>
                    </div>

                    <div class="col-lg-4">
                        <?= $form->field($model, 'fecha_venta')->widget(DatePicker::ClassName(), [
                                'name' => 'check_issue_date',
                                'options' => ['value' => date('Y-m-d')],
                                //'disabled' => true,
                                'pluginOptions' => [
                                    'value' => date('Y-m-d'),
                                    'format' => 'yyyy-mm-dd',
                                    'todayHighlight' => true
                                ]
                            ]);
                        ?>
                    </div>

                    </div>
               </div>

            </div>
            <div class = "panel panel-default">
               
               <div class = "panel-heading" style="padding-top:4px;padding-bottom:4px; ">
                  Producto
               </div>
               
               <div class = "panel-body">

                    <div class="row">    
                        <div class="col-lg-6">
      

                                <?= 

                                    $form->field($model, 'categoria')->widget(Select2::classname(), [

                                                'data' => ArrayHelper::map(Categoria::find()->where(['estado' => 1])->orderBy(['descripcion' => SORT_ASC])->all(), 'codigo', 'descripcion'),
                                                'language' => 'es',
                                                'options' => [
                                                'placeholder' => 'Seleccione categoria...',
                                                'onchange' => '   

                                                        $.post("index.php?r=producto/lists&id='.'"+$(this).val(), function(data){
                                                            $("select#ventas-idproducto").html(data);

                                                        });                     
                                                ',

                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],      
                                       
                                    ]);


                                ?>
                        </div>

                        <div class="col-lg-6">
                            

            
                            <?= 

                                $form->field($model, 'idProducto')->widget(Select2::classname(), [

                                        'data' => ArrayHelper::map(Producto::find()->orderBy(['descripcion' => SORT_ASC])->all(), 'id', 'descripcion'),
                                        'language' => 'es',
                                        'options' => [
                                        'placeholder' => 'Seleccione producto'],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],      
                                     
                                   
                                ]);


                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">

                            <?= $form->field($model, 'importe')->widget(MaskMoney::classname(), [
                                'pluginOptions' => [
                                    'prefix' => '$ ',
                                    'suffix' => '', 
                                    'affixesStay' => true,
                                    //'thousands' => '.',
                                    'decimal' => '.',
                                    'precision' => 2, 
                                    'allowZero' => true,
                                    'allowNegative' => false,
                                ]
                            ]); ?>
                        </div>
                        <div class="col-lg-2">

                            <?= $form->field($model, 'importe_unitario')->widget(MaskMoney::classname(), [
                                'pluginOptions' => [
                                    'prefix' => '$ ',
                                    'suffix' => '', 
                                    'affixesStay' => true,
                                   // 'thousands' => '.',
                                    'decimal' => '.',
                                    'precision' => 2, 
                                    'allowZero' => true,
                                    'allowNegative' => false,
                                ]
                            ]); ?>
                        </div>
                        <div class="col-md-2" style="padding-left: 15px;padding-bottom: 15px;">
                           
                            <label class="control-label">Cantidad</label>
               
                            <?=  TouchSpin::widget([
                                  'model' => $model,
                                    'attribute' => 'cantidad',
                                    'pluginOptions' => [
                                    'initval' => 1,
                                    'min' => 1,
                                    'max' => 1000,
                                ]
                            ]);?>
                        </div>

                        <div class="col-md-2">
                            <?=
                                $form->field($model, 'tipo_venta')->dropDownList([ 0 =>'Vendedor', 1 => 'particular'],['class' => 'form-control input-sm']);
                            ?>
                        </div>

                         <div class="col-md-2">
                            <?=
                                $form->field($model, 'forma_pago')->dropDownList([ 0 =>'Tarjeta', 1 => 'Efectivo'],['class' => 'form-control input-sm']);
                            ?>
                        </div>
                      
                    </div>  

                    


                    
               </div>

            </div>

        </div>




        <?php $model->fecha_carga = date('Y-m-d'); ?>
        <?= $form->field($model, 'fecha_carga')->hiddenInput(['maxlength' => true])->label(false); ?>

        <?php $model->estado = 2; ?>
        <?= $form->field($model, 'estado')->hiddenInput(['maxlength' => true])->label(false); ?>

        <?php $model->carga_venta = 0; ?>
        <?= $form->field($model, 'carga_venta')->hiddenInput(['maxlength' => true])->label(false); ?>










    </div>

    









  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>



