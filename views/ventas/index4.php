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




<div class="ventas-index">
&nbsp;
    <div id="ajaxCrudDatatable4">
        <?=GridView::widget([
            'id'=>'crud-datatable4',
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
                'heading' => '<i class="glyphicon glyphicon-list"></i> Regalos',
                'before'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Dividir',
                                ["bulkdividir"] ,
                                [
                                    "class"=>"btn btn-danger btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Division',
                                    'data-confirm-message'=>'Está seguro de dividir esta venta?'
                                ]).Html::a('<i class="glyphicon glyphicon-ok"></i>&nbsp; Finalizar venta',
                                ["bulkfinalizar"] ,
                                [
                                    "class"=>"btn btn-success btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Finalizar venta como paga',
                                    'data-confirm-message'=>'Está seguro de finalizar las ventas?'
                                ])./*Html::a('<i class="glyphicon glyphicon-ok"></i>&nbsp; Enviar a carga',
                                ["bulkenviaracarga", 'cant' => 2] ,
                                [
                                    "class"=>"btn btn-primary btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Envío a carga',
                                    'data-confirm-message'=>'Está seguro de enviar grilla cargas?'
                                ]).*/"<input type='hidden' name='cant'/>",
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


