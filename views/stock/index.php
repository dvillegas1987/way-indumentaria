<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stocks';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="row">
<div class="col-md-1" style="margin-right:30px;">
            <?php echo Html::button('<i class="glyphicon glyphicon-ok"></i>&nbsp;Sumar stock', [ 'class' => 'btn btn-primary',

                'onclick' => '
                    var cantidad = $("#stock").val();
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
                        cantidad = $("#stock").val();
                        $.post({
                            url:  "index.php?r=stock/cargar",
                          
                            data: {keylist:strvalue,cant:cantidad },
                            success: function(data) {
                              
                        }


                       });
                        $.pjax.reload({container: "#crud-datatable-pjax"});
                    }else{
                        alert("Debe ingresar una cantidad para llevar a cabo esta operación. Gracias.");
                    }

                    ' 

                ]); ?>
        </div>
            <div class="col-md-2">

                <input type="text" class="form-control" id="stock" placeholder="Ingrese cantidad...">

            </div>
        </div>
<div class="row">
<div class="col-md-12">
&nbsp;
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                /*['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                    ['role'=>'modal-remote','title'=> 'Create new Stocks','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                    '{toggleData}'.
                    '{export}'
                ],*/
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'default', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Control de Stock',
                //'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Eliminar seleccionados',
                                ["bulkdelete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Eliminación',
                                    'data-confirm-message'=>'Está segurp de eliminar los items seleccionados?'
                                ]),
                        ]).                        
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
