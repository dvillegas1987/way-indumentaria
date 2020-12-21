<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="categoria-index">
&nbsp;
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'rowOptions' => function ($model, $key, $index, $grid) {

                if($model['estado'] == 0 ){
                    return ['style' => 'background-color:rgba(255, 115, 115, 0.55);color:#B9264F;font-weight:bold;'];
                }

              
              
            },
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create','sexo' => $sexo, 'origen' => $origen],
                    ['role'=>'modal-remote','title'=> 'Create new Categorias','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'default', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Grilla categorias <b>: '.$descripcion.'</b>',
                'before'=> BulkButtonWidget::widget([
                            'buttons'=>'<div class="btn-group">'.Html::a('<i class="glyphicon glyphicon-share"></i>&nbsp; Migrar a hombre',
                                ["sexomasculino"] ,
                                [
                                    "class"=>"btn btn-info btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Categoría por sexo',
                                    'data-confirm-message'=>'Esta seguro de enviar a categoria Masculino?'
                                ]).Html::a('<i class="glyphicon glyphicon-share"></i>&nbsp; Migrar a mujer',
                                ["sexofemenino"] ,
                                [
                                    "class"=>"btn btn-warning btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Categoría por sexo',
                                    'data-confirm-message'=>'Esta seguro de enviar a categoria Femenino?'
                                ]).'</div><span><i class="glyphicon glyphicon-option-vertical"></i></span><div class="btn-group">'.Html::a('<i class="glyphicon glyphicon-share"></i>&nbsp; Chile',
                                ["chile"] ,
                                [
                                    "class"=>"btn btn-success btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Categoría por origen',
                                    'data-confirm-message'=>'Esta seguro de enviar a categoria Buenos Aires?'
                                ]).Html::a('<i class="glyphicon glyphicon-share"></i>&nbsp; Buenos Aires',
                                ["buenosaires"] ,
                                [
                                    "class"=>"btn btn-danger btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Categoría por origen',
                                    'data-confirm-message'=>'Esta seguro de enviar a categoria Buenos Aires?'
                                ]).Html::a('<i class="glyphicon glyphicon-share"></i>&nbsp; Oulet',
                                ["oulet"] ,
                                [
                                    "class"=>"btn btn-primary btn-md",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Categoría por origen',
                                    'data-confirm-message'=>'Esta seguro de enviar a categoria Oulet?'
                                ]).'</div>',
                        ]),
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Eliminar item/s',
                                ["bulkdelete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Eliminación',
                                    'data-confirm-message'=>'Está seguro de eliminar este elemento?'
                                ]),
                        ]).                        
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
