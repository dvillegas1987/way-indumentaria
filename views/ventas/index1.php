<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use app\models\Ventas;
use app\models\Stock;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\VentasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ventas pagas';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
$this->registerJsFile(
    '@web/js/bootstrap.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>
&nbsp;


<div class="row">
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
                            $.pjax.reload({container: "#crud-datatable5-pjax"});
                    

                        ' 

                    ]); ?>
            </div>               
      </div>
    </div>
  </div>
</div>





<div class="row"  style="z-index: 1;position: fixed;margin-bottom:20px;margin-bottom:50px;background:#2A3F54;padding-top:15px;opacity:1;border-radius:5px;">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
       <div class="input-group">
            <span class="input-group-btn">
            <?php echo Html::button('<i class="glyphicon glyphicon-ok"></i>&nbsp;Quitar venta', [ 'class' => 'btn btn-danger',
            'data-confirm'=>false, 'data-method'=>false,'data-request-method'=>'post','id'=> 'id_quitar_venta_pendiente']); ?>
        </span>
        <input type="text" class="form-control" id="cant0" placeholder="Cantidad...">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
       <div class="input-group">
            <span class="input-group-btn">
            <?php echo Html::button('<i class="glyphicon glyphicon-ok"></i>&nbsp;Enviar a nueva venta', [ 'class' => 'btn btn-success',
            'data-confirm'=>false, 'data-method'=>false,'data-request-method'=>'post','id'=> 'id_nueva_venta']); ?>
        </span>
        <input type="text" class="form-control" id="cant1" placeholder="Cantidad...">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <div class="input-group">
            <span class="input-group-btn">
            <?php echo Html::button('<i class="glyphicon glyphicon-ok"></i>&nbsp;Enviar a impagas',['class' => 'btn btn-warning','id'=> 'id_impagas']); ?>
            </span>
            <input type="text" class="form-control" id="cant2" placeholder="Cantidad...">
        </div>
    </div>
</div>














<div class="ventas-index" style="margin-top:60px;">
&nbsp;
    <div id="ajaxCrudDatatable5">
        <?=GridView::widget([
            'id'=>'crud-datatable5',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'rowOptions' => function ($model, $key, $index, $grid) {

                /*if($model->estado == 3 ){
                    return ['style' => 'background-color:#A9C5EB;color:#23819C;font-weight:bold;'];
                }*/
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
                'type' => 'info', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Ventas pendientes',
                'before'=>false/*BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Quitar',
                                ["bulkdeletependientes"] ,
                                [
                                    "class"=>"btn btn-danger btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Eliminar',
                                    'data-confirm-message'=>'Está seguro de quitar este item?'
                                ]).Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Dividir',
                                ["bulkdividir", 'id' => '#crud-datatable5-pjax'] ,
                                [
                                    "class"=>"btn btn-primary btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Division',
                                    'data-confirm-message'=>'Está seguro de dividir esta venta?'
                                ]).Html::a('<i class="glyphicon glyphicon-ok"></i>&nbsp;Enviar a impagas',
                                ["bulkcargar2"] ,
                                [
                                    "class"=>"btn btn-success btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Carga de ventas',
                                    'data-confirm-message'=>'Está seguro de cargar las ventas?'
                                ]),
                        ]).'<div class="clearfix"></div>'*/,
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


<?php
$script = <<< JS

$('#id_nueva_venta').click(function(){
    var cantidad = $('#cant1').val();
    var index = 'index1';
    var estado_venta_desde = 'desde_pendientes';
    var estado_venta_destino = 2;
    var tipo_envio = 'nueva_venta';
    unificar(cantidad,index,estado_venta_desde,estado_venta_destino,tipo_envio);
}); 

$('#id_impagas').click(function(){
    var cantidad = $('#cant2').val();
    var index = 'index1';
    var estado_venta_desde = 'desde_pendientes';
    var estado_venta_destino = 0;
    var tipo_envio = 'impagas';
    unificar(cantidad,index,estado_venta_desde,estado_venta_destino,tipo_envio);
}); 

$('#id_quitar_venta_pendiente').click(function(){
    var cantidad = $('#cant0').val();
    var index = 'index1';
    var estado_venta_desde = 'desde_pendientes';
    var tipo_envio = 'impagas';
    quitar_venta(cantidad,index,estado_venta_desde,tipo_envio);
}); 




//Funcion para unificar ventas tanto en pendientes como en impagas
function unificar(cantidad,index,estado_venta_desde,estado_venta_destino,tipo_envio){
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
            data: {keylist:strvalue,cant:cantidad,index:index,estado_venta_desde:estado_venta_desde,estado_venta_destino:estado_venta_destino, tipo_envio:tipo_envio},
            success: function(data){}
        });
        $.pjax.reload({container: "#crud-datatable5-pjax"});
    }else{
        alert("Debe ingresar una cantidad para llevar a cabo esta operación. Gracias.");
    }
}



function quitar_venta(cantidad,index,estado_venta_desde,tipo_envio){
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
            url:  "index.php?r=ventas/quitar_venta",
            data: {keylist:strvalue,cant:cantidad,index:index,estado_venta_desde:estado_venta_desde,tipo_envio:tipo_envio},
            success: function(data){}
        });
        $.pjax.reload({container: "#crud-datatable5-pjax"});
    }else{
        alert("Debe ingresar una cantidad para llevar a cabo esta operación. Gracias.");
    }
}

JS;
$this->registerJs($script);
?>