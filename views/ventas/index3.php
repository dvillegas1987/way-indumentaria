<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

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
<div class="row">
        <div class="col-lg-2 col-md-2 col-xs-2" style="margin-right:0px;">
            <?php echo Html::button('<i class="glyphicon glyphicon-ok"></i>&nbsp;Enviar a nueva venta', [ 'class' => 'btn btn-primary',

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
                                $.post({
                                    url:  "index.php?r=ventas/probar",
                                  
                                    data: {keylist:strvalue,cant:cantidad,index:"index3" },
                                    success: function(data) {
                                 
                                  
                                }

                               });
                                $.pjax.reload({container: "#crud-datatable-pagas-pjax"});
                        }else{
                            alert("Debe ingresar una cantidad para llevar a cabo esta operación. Gracias.");
                        }        
                    ' 

                ]); ?>
        </div>
        <div class="col-lg-2 col-md-2 col-xs-2">
            <?php echo Html::button('<i class="glyphicon glyphicon-ok"></i>&nbsp;Devolver a stock', [ 'class' => 'btn btn-primary',

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
                        $.post({
                            url:  "index.php?r=ventas/devolver",
                          
                            data: {keylist2:strvalue,cant2:cantidad ,index:"index3"},
                            success: function(data) {
                              if(data == 1){
                                alert("no hay stock");
                              }
                        }


                       });
                        $.pjax.reload({container: "#crud-datatable-pagas-pjax"});
                    }else{
                        alert("Debe ingresar una cantidad para llevar a cabo esta operación. Gracias.");
                    }

                    ' 

                ]); ?>
        </div>
        <div class="col-lg-2 col-md-2 col-xs-2">

            <input type="text" class="form-control" id="cant" placeholder="Ingrese cantidad...">

        </div>

</div>
<div class="ventas-index">
&nbsp;
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable-pagas',
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
                'type' => 'success', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Ventas pagas',
                'before'=>BulkButtonWidget::widget([
                            /*'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Quitar',
                                ["bulkdelete"] ,
                                [
                                    "class"=>"btn btn-danger btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Eliminar',
                                    'data-confirm-message'=>'Está seguro de quitar este item?'
                                ]).Html::a('<i class="glyphicon glyphicon-ok"></i>&nbsp; Finalizar venta',
                                ["bulkfinalizar"] ,
                                [
                                    "class"=>"btn btn-success btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Finalizar venta como paga',
                                    'data-confirm-message'=>'Está seguro de finalizar las ventas?'
                                ]),*/
                        ]).'<div class="clearfix"></div>',
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
