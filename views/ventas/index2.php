<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\Categoria;
use app\models\Producto;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\VentasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ventas';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
$this->registerJsFile(
    '@web/js/bootstrap.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>
&nbsp;
<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" href="#collapse1">Panel de control para actualizacion de fecha de venta</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse">
      <div class="panel-body">
      <div class="col-md-3">
                <?php 
                    echo DatePicker::widget([
                        'id' => 'id_nueva_fecha', 
                        'name' => 'check_issue_date', 
                        'value' => date('d-m-Y'),
                        'options' => ['placeholder' => 'Seleccione nueva fecha de venta ...'],
                        'pluginOptions' => [
                            'format' => 'dd-mm-yyyy',
                            'todayHighlight' => true
                        ]
                    ]);
                ?>
                </div>
                <div class="col-md-2">

                    <input type="text" class="form-control" id="id_update_recargo" placeholder="Ingrese recargo en %">

                </div>
                <div class="col-md-3">
                <?php echo Html::button('<i class="glyphicon glyphicon-ok"></i>&nbsp;Actualizar', [ 'class' => 'btn btn-primary',

                    'onclick' => '
                  
                            var strvalue = "";
                            $("input[name=\'selection[]\']:checked").each(function() {
                           
                                   if(strvalue != ""){ 
                                        strvalue = strvalue + ","+this.value;
                                   }
                                    else{
                                        strvalue = this.value;
                                    }
                             
                            });

                            recargo = $("#id_update_recargo").val();
                            fecha = $("#id_nueva_fecha").val();

                            $.post({
                                url:  "index.php?r=ventas/actualizarfecha",
                              
                                data: {keylist2:strvalue,recargo:recargo,nuevafecha:fecha},
                                success: function(data) {
                                 
                                }


                           });
                            $.pjax.reload({container: "#crud-datatable-impagas-pjax"});
                    

                        ' 

                    ]); ?>
            </div>
      
      </div>
    </div>
  </div>
</div>




<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" href="#collapse2">Panel de control para finalizar ventas con regalo</a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">
      <div class="col-lg-2 col-md-2 col-xs-2" style="margin-right:40px;">
                <?php echo Html::button('<i class="glyphicon glyphicon-ok"></i>&nbsp;Enviar a pagas con regalo', [ 'class' => 'btn btn-success',

                    'onclick' => '
                 
                            var cantidad = $("#id_descuento_regalo").val();
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

                            producto = $("#id_prod").val();
                            descuento = $("#id_descuento_regalo").val();

                            $.post({
                                url:  "index.php?r=ventas/finalizar2",
                              
                                data: {keylist2:strvalue,producto:producto,descuento:descuento},
                                success: function(data) {
                                 
                            }


                           });
                            $.pjax.reload({container: "#crud-datatable-impagas-pjax"});
                            }else{
                                alert("Debe ingresar un descuento. Gracias.");
                            }

                        ' 

                    ]); ?>
            </div>
            
            <div class="col-lg-2 col-md-2 col-xs-2">
                <?= 
                    Select2::widget([
                            'name' => 'idProducto',
                            'id' => 'id_prod',
                            'data' => ArrayHelper::map(Producto::find()->orderBy(['descripcion' => SORT_ASC])->all(), 'id', 'descripcion'),
                            'language' => 'es',
                            'options' => [
                            'placeholder' => 'Seleccione producto'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'multiple' => true
                            ],      
                         
                       
                    ]);
                ?>
            </div>

            <div class="col-md-3">

                <input type="text" class="form-control" id="id_descuento_regalo" placeholder="Ingrese descuento por regalo...">

            </div>              
      
      </div>
    </div>
  </div>
</div>






<div class="row"  style="z-index: 1;position: fixed;margin-bottom:20px;margin-bottom:50px;background:#2A3F54;padding-top:15px;opacity:1;border-radius:5px;">
    
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
       <div class="input-group">
            <span class="input-group-btn">
            <?php echo Html::button('<i class="glyphicon glyphicon-ok"></i>&nbsp;Devolver stock', [ 'class' => 'btn btn-danger',

            'onclick' => '
                var cantidad = $("#cant1").val();
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
             
                    $.post({
                        url:  "index.php?r=ventas/devolver",
                    
                        data: {keylist2:strvalue,cant2:cantidad,index:"index2"},
                        success: function(data) {
                        if(data == 1){
                            alert("no hay stock");
                        }
                    }


                });
                    $.pjax.reload({container: "#crud-datatable-impagas-pjax"});
                }else{
                    alert("Debe ingresar una cantidad para llevar a cabo esta operación. Gracias.");
                }

                ' 

            ]); ?>
            </span>
        <input type="text" class="form-control" id="cant1" placeholder="Cantidad...">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
       <div class="input-group">
            <span class="input-group-btn">
            <?php echo Html::button('<i class="glyphicon glyphicon-ok"></i>&nbsp;Enviar a nueva venta', [ 'class' => 'btn btn-success',
                'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                'onclick' => '
                    var cantidad = $("#cant0").val();
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
                 
                                $.post({
                                    url:  "index.php?r=ventas/enviar_anuevaventa",
                                    data: {keylist:strvalue,cant:cantidad,index:"index2",estado_venta_desde:"desde_impagas",estado_venta_destino:2, tipo_envio:"nueva_venta"},

                                    success: function(data) {
                                 
                                  
                                }


                               });
                               $.pjax.reload({container: "#crud-datatable-impagas-pjax"});
                        }else{
                            alert("Debe ingresar una cantidad para llevar a cabo esta operación. Gracias.");
                        }        
                    ' 

                ]); ?>
            </span>
        <input type="text" class="form-control" id="cant0" placeholder="Cantidad...">
        </div>
    </div>
</div>


<div class="ventas-index" style="margin-top:80px;">
&nbsp;
    <div id="ajaxCrudDatatable2">
        <?=GridView::widget([
            'id'=>'crud-datatable-impagas',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns2.php'),
            'rowOptions' => function ($model, $key, $index, $grid) {

                if($model['estado'] == 0 ){
                    return ['style' => 'background-color:rgba(255, 115, 115, 0.55);color:#B9264F;font-weight:bold;'];
                }

                if($model['estado'] == 1 ){
                    return ['style' => 'background-color:rgba(119, 221, 119, 0.61);color:#59955C;font-weight:bold;'];
                }
              
            },
            'toolbar'=> [
                ['content'=>
                    /*Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                    ['role'=>'modal-remote','title'=> 'Create new Ventas','class'=>'btn btn-default']).*/
                  
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index2'],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Refrecar']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'danger', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Ventas impagas',
                'before'=>/*BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Dividir',
                                ["bulkdividir", 'id' => '#crud-datatable-pjax'] ,
                                [
                                    "class"=>"btn btn-danger btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Division',
                                    'data-confirm-message'=>'Está seguro de dividir esta venta?'
                                ]).*/Html::a('<i class="glyphicon glyphicon-ok"></i>&nbsp; Enviar a pagas sin regalo',
                                ["bulkfinalizar"] ,
                                [
                                    "class"=>"btn btn-success btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Finalizar venta como paga',
                                    'data-confirm-message'=>'Está seguro de finalizar las ventas?'
                                ])/*.Html::a('<i class="glyphicon glyphicon-ok"></i>&nbsp; Enviar a carga',
                                ["bulkenviaracarga", 'cant' => 2] ,
                                [
                                    "class"=>"btn btn-primary btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Envío a carga',
                                    'data-confirm-message'=>'Está seguro de enviar grilla cargas?'
                                ])."<input type='hidden' name='cant'/>",
                        ]).'<div class="clearfix"></div>'*/
               // 'after'=>,
            ],
            'showFooter'=>true,
            'showPageSummary' => true
        ])?>
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


