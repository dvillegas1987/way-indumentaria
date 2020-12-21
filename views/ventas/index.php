<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Categoria;
use app\models\Producto;
use app\models\Ventas;
use app\models\Stock;
use app\models\Vendedor;
use app\models\Cliente;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\widgets\Pjax;
use kartik\touchspin\TouchSpin;
use kartik\money\MaskMoney;
/* @var $this yii\web\View */
/* @var $searchModel app\models\VentasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ventas';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

  

?>


<div class="ventas-form">

    <?php $form = ActiveForm::begin(['id' => 'form-ventas']); ?>

    <div class="row">
        <div class="col-md-2">
            <?=
                $form->field($model, 'caracter')->dropDownList([ 0 =>'Convencional', 1 => 'Regalos'],['class' => 'form-control input-sm']);
            ?>
        </div>
        <div class="col-md-2" style="padding-left: 15px;padding-bottom: 15px;">
            <?=

              $form->field($model, 'codigo_laser')->textInput(['class' => 'form-control input-sm',
                'onchange' => '   

                                                                       
                                                ',
                ])->label('Codigo de barras')

            ?>
     
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
            <button id="btnagregar" class="btn btn-primary" style="margin-top: 22px;">Agregar</button>
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
                        <?php //$model->vendedor = 1; ?>
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
                        <?php $model->cliente = 1; ?>
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
                        <div class="col-lg-6"  style="display: none;">
      

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

                        <div class="col-lg-6"  style="display: none;">
                            

            
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
                        <div class="col-lg-2"  style="display: none;">

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
                        <div class="col-lg-2" style="display: none;">

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
                       

                        <div class="col-md-2">
                            <?=
                                $form->field($model, 'tipo_venta')->dropDownList([ 0 =>'Vendedor', 1 => 'particular'],['class' => 'form-control input-sm']);
                            ?>
                        </div>

                         <div class="col-md-2">
                         <?php $model->forma_pago = 1; ?>
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

    

    <?php ActiveForm::end(); ?>
    
</div>
















<div class="ventas-index">
&nbsp;
    <div id="ajaxCrudDatatable2">
        <?php /*GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
             'pjaxSettings'       => [
            'options' => [
                'enablePushState' => false,
            ]
        ],
          
            'columns' => require(__DIR__.'/_columns.php'),
            'rowOptions' => function ($model, $key, $index, $grid) {

                 $codigo = $model->idProducto;
                 $stock = null;
                if($codigo != ''){
                   $stock = Stock::find()->where(['codigo' => $codigo])->one();
       
                }
                


                if($model['caracter'] == 1 ){
                    return ['style' => 'background-color:rgba(255, 115, 115, 0.55);color:#B9264F;font-weight:bold;'];
                }

                if($model->cantidad > $stock->cantidad ){
                     return ['style' => 'background-color:#E6E6E6;color:#A4A4A4;font-weight:bold;'];
                }

                if($model['caracter'] == 0 ){
                    return ['style' => 'background-color:rgba(119, 221, 119, 0.61);color:#59955C;font-weight:bold;'];
                }

                if($model->cantidad > $stock->cantidad ){
                   return ['style' => 'background-color:#E6E6E6;color:#A4A4A4;font-weight:bold;'];
                }
              
            },
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="fa fa-fw fa-file-pdf-o" ></i> Reporte', ['ventas/pdfall','id' => ''] , [
                                            'class'=>'btn btn-primary', 
                                            'target'=>'_blank', 
                                            'data-toggle'=>'tooltip',
                                            'data-pjax'=>"0" ,
                                            //'style' => 'padding:0px',
                                            'title' => Yii::t('app', 'View'),
                                ]).
                   /* .Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                    ['role'=>'modal-remote','title'=> 'Create new Ventas','class'=>'btn btn-default']).*/
                   /* Html::a('<i class="glyphicon glyphicon-repeat"></i> Refescar', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Refescar'])/*.
                    '{toggleData}'.
                    '{export}'*/
              //  ],
          //  ],          
           /* 'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'default', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Nueva venta',
                'before'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Quitar',
                                ["bulkdelete"] ,
                                [
                                    "class"=>"btn btn-danger btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Eliminar',
                                    'data-confirm-message'=>'Está seguro de quitar este item?'
                                ]).Html::a('<i class="glyphicon glyphicon-ok"></i>&nbsp; Cargar y finalizar',
                                ["bulkcargar","id" => ''] ,
                                [
                                    "class"=>"btn btn-success btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Carga de ventas',
                                    'data-confirm-message'=>'Está seguro de cargar las ventas?'
                                ]),
                        ]).'<div class="clearfix"></div>',
               // 'after'=>,
            ],
            'showFooter'=>true,
            'showPageSummary' => true
        ])*/?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    'size'=>'modal-lg',
    "footer"=>"",// always need it for jquery plugin
    'options' => [
       
        'tabindex' => false
    ],
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => false] ,
])?>
<?php Modal::end(); ?>

<?php 

Modal::begin([
    'header' => '<h4>Atención!</h4>',
    'id' => 'mensaje_stock',
    'size' => 'modal-sm'
]);
echo  'No puede insertar cantidades destinadas a impagas o devueltas a stock, que superen la cantidad asignada en la venta.';

Modal::end();

?>

<?php


$this->registerJs(
    '
        
    $("#btnagregar").click(function(){
             $.post("index.php?r=ventas/agregar&codigo='.'"+$("#ventas-codigo_laser").val()+"&cantidad='.'"+$("#ventas-cantidad").val()+"&vendedor='.'"+$("#ventas-vendedor").val()+"&caracter='.'"+$("#ventas-caracter").val()+"&fecha_venta='.'"+$("#ventas-fecha_venta").val()+"&cliente='.'"+$("#ventas-cliente").val()+"&forma_pago='.'"+$("#ventas-forma_pago").val(), function(data){
                $.pjax.defaults.timeout = true;  
             
                $.pjax.reload({container: data});
                                                        
              
               
                $("#ventas-codigo_laser").val("");
                $("#ventas-codigo_laser").focus();

                localStorage.setItem("vendedor",$("#ventas-vendedor").val());
            });  

            return false;
    });




        $( document ).ready(function() {
           $("#ventas-codigo_laser").focus();
           $("input[type=\'text\']").click(function () {
               $(this).select();
            });
        });

        document.onkeypress=function(e){
        var esIE=(document.all);
        var esNS=(document.layers);
        tecla=(esIE) ? event.keyCode : e.which;
        if(tecla==13){
            
             $.post("index.php?r=ventas/agregar&codigo='.'"+$("#ventas-codigo_laser").val()+"&cantidad='.'"+$("#ventas-cantidad").val()+"&vendedor='.'"+$("#ventas-vendedor").val()+"&caracter='.'"+$("#ventas-caracter").val()+"&fecha_venta='.'"+$("#ventas-fecha_venta").val()+"&cliente='.'"+$("#ventas-cliente").val()+"&forma_pago='.'"+$("#ventas-forma_pago").val(), function(data){
                $.pjax.defaults.timeout = true;  
             
                $.pjax.reload({container: data});
                                                        
              
               
                $("#ventas-codigo_laser").val("");
                $("#ventas-codigo_laser").focus();
            });  
            return false;
          }
        }



    '
   
);

/*$.pjax.reload({container: "#crud-datatable-pjax"}).done(function () {
                    $.pjax.reload({container: data});
                });         */
?>






    
<?php $active = 'active'; ?>
<div id="tabid">
<ul class="nav nav-tabs">
<?php $i=0; $vendedor = Vendedor::find()->all();?>
    <?php foreach ($vendedor as $ven): ?>
        <?php $count = Ventas::find()->where(['estado' => 2,'vendedor' =>$ven->id])->count(); ?>
        <?php if($count > 0): ?>
      <?php $i=$ven->id; ?>
      <?php $id = '#'.$i; ?>
      <li class="<?php echo $active?>"><a data-toggle="tab" href="<?php echo $id; ?>"><?= $ven->nombre ?></a></li>
      <?php $active = ''; ?>
      <?php $i++; ?>

       <?php endif; ?>
    <?php endforeach; ?>

</ul>
</div>
<?php $panel_active = 'tab-pane fade in active'; ?>
<div class="tab-content">
&nbsp;
<div class="row">
        <div class="col-md-1" style="margin-right:70px;">
            <?php echo Html::button('<i class="glyphicon glyphicon-ok"></i>&nbsp;Aplicar descuento', [ 'class' => 'btn btn-primary',

                'onclick' => '
                    var cantidad = $("#cant").val();
                        if(cantidad != ""){ 
                            var strvalue = "";
                            $("input[name=\'selection[]\']:checked").each(function() {
                           
                                   if(strvalue != ""){ 
                                        strvalue = strvalue + ","+this.value;
                                   }
                                    else{
                                        strvalue = this.value;
                                    }
                             
                                });
                                cantidad = $("#cant").val();
                                var id = null;
                                $.post({
                                    url:  "index.php?r=ventas/descuento",
                                  
                                    data: {keylist:strvalue,cant:cantidad },
                                    success: function(data) {
                                      
                                  
                                    }


                               });
                               
                                 $.pjax.reload({container: "#tabid"});
                        }else{
                            alert("Debe ingresar una cantidad para llevar a cabo esta operación. Gracias.");
                        }        
                    ' 

                ]); ?>
        </div>
        
        <div class="col-md-2">

            <input type="text" class="form-control" id="cant" placeholder="Ingrese descuento...">

        </div>

</div>
    <?php  $id_table = null;$id = null; ?>
    <?php foreach ($vendedor as $ven): ?>

        <?php $count = Ventas::find()->where(['estado' => 2,'vendedor' => $ven->id])->count(); ?>
        <?php if($count > 0): ?>

            <?php $i=$ven->id; ?>
            <?php $id = $ven->id; ?>

            <?php $searchModel->vendedor = $ven->id;

            $dataProvider = $searchModel->search(Yii::$app->request->queryParams); 
            $dataProvider->pagination  = false;
            $id_table = 'crud-datatable'.$i;

            ?>

        <?php endif; ?>

  <div id="<?php echo $id;?>" class="<?php echo $panel_active; ?>">

   

    <?=GridView::widget([
            'id'=> $id_table,
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'floatHeader'=>true,
            //'floatHeaderOptions'=>['scrollingTop'=>'200'],
            'pjax'=>true,
             'pjaxSettings'       => [
            'options' => [
                'enablePushState' => false,
            ]
        ],
          
            'columns' => require(__DIR__.'/_columns.php'),
            'rowOptions' => function ($model, $key, $index, $grid) {

                $codigo = $model->idProducto;
                $stock = null;
                
                if($codigo != ''){
                   $stock = Stock::find()->where(['codigo' => $codigo])->one();
       
                }

                $ventas = Ventas::find()->where(['estado' => 2,'idProducto' => $model->idProducto])->all();
                $cant_total = 0;
                foreach ($ventas as $v) {
                    $cant_total += $v->cantidad;
                }
                
                if($model['caracter'] == 1 ){
                    return ['style' => 'background-color:rgba(255, 115, 115, 0.55);color:#B9264F;font-weight:bold;'];
                }

                if($stock)
                {
                    if($cant_total > $stock->cantidad ){
                        return ['style' => 'background-color:#E6E6E6;color:#A4A4A4;font-weight:bold;'];
                   }
                }
               

                if($model['caracter'] == 0 ){
                    return ['style' => 'background-color:rgba(119, 221, 119, 0.61);color:#59955C;font-weight:bold;'];
                }

                if($cant_total > $stock->cantidad ){
                   return ['style' => 'background-color:#E6E6E6;color:#A4A4A4;font-weight:bold;'];
                }
              
            },
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="fa fa-fw fa-file-pdf-o" ></i> Reporte A4', ['ventas/pdfall','id' => $ven->id] , [
                                            'class'=>'btn btn-primary', 
                                            'target'=>'_blank', 
                                            'data-toggle'=>'tooltip',
                                            'data-pjax'=>"0" ,
                                            //'style' => 'padding:0px',
                                            'title' => Yii::t('app', 'View') ]).
                     Html::a('<i class="fa fa-fw fa-file-pdf-o" ></i> Reporte CARTA', ['ventas/pdfall_letter','id' => $ven->id] , [
                                            'class'=>'btn btn-primary', 
                                            'target'=>'_blank', 
                                            'data-toggle'=>'tooltip',
                                            'data-pjax'=>"0" ,
                                            //'style' => 'padding:0px',
                                            'title' => Yii::t('app', 'View') ]).
                                           
                   /*.Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                    ['role'=>'modal-remote','title'=> 'Create new Ventas','class'=>'btn btn-default']).*/
                    Html::a('<i class="glyphicon glyphicon-repeat"></i> Refrescar', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']),/*.
                    '{toggleData}'.
                    '{export}'*/
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'default', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Nueva venta',
                'before'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Quitar',
                                ["bulkdelete"],
                                [
                                    "class"=>"btn btn-danger btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Eliminar',
                                    'data-confirm-message'=>'Está seguro de quitar este item?'
                                ])/*.Html::a('<i class="glyphicon glyphicon-ok"></i>&nbsp; Enviar a pendientes',
                                ["bulkenviarapendientes","id" => $ven->id] ,
                                [
                                    "class"=>"btn btn-primary btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Carga de ventas',
                                    'data-confirm-message'=>'Está seguro de cargar las ventas?'
                                ])*/,
                        ]).'<div class="clearfix"></div>',

               'after'=>/*Html::a('<i class="glyphicon glyphicon-ok"></i>&nbsp;Finalizar',
                        ["movimientos","id" => $ven->id] ,
                        [
                            "class"=>"btn btn-success btn-md pull-right",
                            'role'=>'modal-remote-bulk',
                            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                            'data-request-method'=>'post',
                            'data-confirm-title'=>'Carga de ventas',
                            'data-confirm-message'=>'Está seguro de cargar las ventas?'
                        ])*/Html::button('<i class="glyphicon glyphicon-ok"></i>&nbsp;Finalizar', [ 'class' => 'btn btn-success pull-right',

                                'onclick' => '
                               
                                    var strvalue = "";var impagas = ""; var devueltas = "";
                                    $("input[name=\'selection[]\']:checked").each(function() {
                                        if(strvalue != ""){ 
                                            strvalue = strvalue + ","+this.value;
                                        }
                                        else{
                                            strvalue = this.value;
                                        }
                            
                                        if(impagas != ""){ 
                                            var imp = null;
                                            if($("#"+this.value+"i").val() != ""){
                                                imp = $("#"+this.value+"i").val();
                                            }else
                                            {
                                                imp = 0;
                                            }

                                            impagas = impagas + ","+imp;
                                        }
                                        else{
                                            impagas = $("#"+this.value+"i").val();

                                        }
                            
                            
                                        if(devueltas != ""){ 
                                            var dev = null;
                                            if($("#"+this.value+"d").val() != ""){
                                                dev = $("#"+this.value+"d").val();
                                            }else{
                                                dev = 0;
                                            }

                                            devueltas = devueltas + ","+dev;
                                        }
                                        else{
                                            devueltas = $("#"+this.value+"d").val();
                                        }
                            
                                    });
                                   
                                    $.post({
                                        url:  "index.php?r=ventas/movimientos",
                                        data: {keylist:strvalue,impagas:impagas,devueltas:devueltas},
                                        success: function(data){
                                            //alert(data);
                                   
                                            $.pjax.reload({container: data});
                                        }
                                    });
                                    
                                    
                                
                                    //$.pjax.defaults.timeout = true;
                                    //$.pjax.reload({container: data});

                                ' 

                            ]).
                                      
                '<div class="clearfix"></div>',
            ],
            'showFooter'=>true,
            'showPageSummary' => true
        ])?>
  </div>
  
  <?php $panel_active = 'tab-pane fade'; ?>
  <?php $i++; ?>
<?php endforeach; ?>
<input type="hidden" id="id_vendedor" >
</div>

<script>



function cambios_input(id1,id2,key,cantidad){
    var sumatoria = parseInt($('#'+key+'d').val()) +  parseInt($('#'+key+'i').val());

    if(sumatoria > cantidad){
        //$( "#"+id1 ).prop( "disabled", true );
        //$( "#"+id2 ).prop( "disabled", false );

        var re = cantidad - parseInt($( "#"+id2 ).val());
        //alert('No puede superar la cantidad con la que cuenta la venta');
        $("#mensaje_stock").modal('show');
        $( "#"+id1 ).val(re); 
        
    }
    /*if(sumatoria < cantidad){
        $( "#"+id ).prop( "disabled", false );
        $( "#"+id2 ).prop( "disabled", false );
       

    }*/
    //alert('probando');
}
</script>
<?php
$script = <<< JS
$(function(){
var id = localStorage.getItem('vendedor');
$("#ventas-vendedor").val(id).trigger("change");
//alert(localStorage.getItem('vendedor'));
//document.getElementById('ventas-vendedor').value =  localStorage.getItem('vendedor');
});
/*function cambios_input(id,key,cantidad){
    var sumatoria = parseInt($('#'+key+'d').val()) +  parseInt($('#'+key+'i').val());

    if(sumatoria > cantidad){
        $( "#"+id ).prop( "disabled", true );
    }
    alert('probando');
}*/
/*$("#btn_finalizar").click(function(){ 
  
        var strvalue = "";var impagas = ""; var devueltas = "";
        $("input[name=\'selection[]\']:checked").each(function() {
            if(strvalue != ""){ 
                strvalue = strvalue + ","+this.value;
            }
            else{
                strvalue = this.value;
            }

            if(impagas != ""){ 
                var valori = $("#"+this.value+"i").val();
                impagas = impagas + ","+valori;
            }
            else{
                impagas = $("#"+this.value+"i").val();
            }


            if(devueltas != ""){ 
                var valord = $("#"+this.value+"d").val();
                devueltas = devueltas + ","+valord;
            }
            else{
                devueltas = $("#"+this.value+"d").val();
            }

        });
        $.post({
            url:  "index.php?r=ventas/movimientos",
            data: {keylist:strvalue,cant:cantidad,index:index,estado_venta_desde:estado_venta_desde,estado_venta_destino:estado_venta_destino, tipo_envio:tipo_envio},
            success: function(data){}
        });
        $.pjax.reload({container: "#crud-datatable5-pjax"});
   
});*/

JS;
$this->registerJs($script);
?>