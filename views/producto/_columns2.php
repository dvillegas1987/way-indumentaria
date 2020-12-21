<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Vendedor;
use app\models\Cliente;
use app\models\Producto;
use app\models\Categoria;
use yii\helpers\Html;
use kartik\grid\GridView;
return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'codigo',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'descripcion',
    ],

   
   
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'stock',
    ],
   

     [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'categoria',
        'value' => function($model){
            $codigo = $model->categoria;
            if($codigo != ''){
                $categoria = Categoria::findOne($codigo);
                return $categoria->descripcion;
            }else{
                return '';   
            }

        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Categoria::find()->orderBy(['codigo' => SORT_ASC])->all(),'codigo', 'descripcion'),

        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Buscar categoría...'],
        'format'=>'raw'
    ],

   
    [
            'class'=>'kartik\grid\ActionColumn',
            'template' => ' {update} ',
            'width'=>'5%',
            'buttons' => [

       

                'update' => function ($url, $model) {

                    $url_p = Url::to(['/producto/update2', 'id' => $model->id ]);   

                    return Html::a('<button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-pencil"></i></button>', $url_p, [
                            'title' => Yii::t('app', 'Actualizar stock'),
                    'role'=>'modal-remote']);
                       
                   
                },
     


            
            ],


        ],


];   