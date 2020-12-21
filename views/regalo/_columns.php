<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Vendedor;
use app\models\Cliente;
use app\models\Producto;
use app\models\Stock;
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
        'attribute'=>'idProducto',
        'value' => function($model){
            $codigo = $model->idProducto;
            if($codigo != ''){
                $producto = Producto::findOne($codigo);
                return $producto->descripcion;
            }else{
                return '';   
            }

        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Producto::find()->orderBy(['id' => SORT_ASC])->all(),'id', 'descripcion'),

        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Buscar producto...'],
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'cantidad',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'importe',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'vendedor',
        'value' => function($model){
            $codigo = $model->vendedor;
            if($codigo != ''){
                $vendedor = Vendedor::findOne($codigo);
                return $vendedor->apellido.', '.$vendedor->nombre;
            }else{
                return '';   
            }

        },
        'filter' => false,
        /*'filterType'=>GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Vendedor::find()->orderBy(['id' => SORT_ASC])->all(),'id', function($model){
            return $model->apellido.', '.$model->nombre;}),

        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Buscar vendedor...'],*/
        'format'=>'raw'
    ],
    /*[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'cliente',
    ],*/
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fecha_venta',
    ],
   /*[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'importe_unitario',
    ],*/
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'estado',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fecha_carga',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'tipo_venta',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'caracter',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'carga_venta',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'forma_pago',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'descuento_aplicado',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'folio',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fecha_antigua',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'regalo',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   