<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="producto-index">
&nbsp;
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns2.php'),
            'rowOptions' => function ($model, $key, $index, $grid) {

                if($model['estado'] == 0 ){
                    return ['style' => 'background-color:rgba(255, 115, 115, 0.55);color:#B9264F;font-weight:bold;'];
                }

              
              
            },
            'toolbar'=> [
                ['content'=>false
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'default', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Control de stock',
                //'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Eliminar item/s',
                                ["bulkdelete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Eliminación',
                                    'data-confirm-message'=>'Esta seguro de eleminar estos elementos?'
                                ]),
                        ]).                        
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
   'size'=>'modal-sm',
    "footer"=>"",// always need it for jquery plugin
    'options' => [
       
        'tabindex' => false
    ],
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => false] ,
])?>
<?php Modal::end(); ?>
