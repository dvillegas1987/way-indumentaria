<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Vendedor;
use app\models\Cliente;
use app\models\Producto;
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
        'attribute'=>'fecha_venta',
        'value' => function($model){
           $date = date_create($model->fecha_venta);
           $date = date_format($date,'d-m-Y');

           return $date;

        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fecha_antigua',
        'value' => function($model){
           $date = date_create($model->fecha_antigua);
           $date = date_format($date,'d-m-Y');

           return $date;

        },
    ],
    /*[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'idProducto',
        'value' => function($model){
            $codigo = $model->idProducto;
            $producto_count = Producto::find()->where(['id' => $codigo])->count();
            if($producto_count > 0){
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
    ],*/

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'idProducto',
        'value' => function($model){
            $codigo = $model->idProducto;
            if($codigo != ''){
                $producto = Producto::findOne($codigo);
                return $producto->codigo;
            }else{
                return '';   
            }

        },
        'filter' => true,
        /*'filterType'=>GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Producto::find()->orderBy(['id' => SORT_ASC])->all(),'id', 'descripcion'),

        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Buscar producto...'],*/
        'format'=>'raw'
    ],
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
        'filter' => false,
        /*'filter' => true,
        'filterType'=>GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Producto::find()->orderBy(['id' => SORT_ASC])->all(),'id', 'descripcion'),

        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Buscar producto...'],*/
        'format'=>'raw'
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
        'filterType'=>GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Vendedor::find()->orderBy(['id' => SORT_ASC])->all(),'id', function($model){
            return $model->apellido.', '.$model->nombre;}),

        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Buscar vendedor...'],
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'cliente',
        'value' => function($model){
            $codigo = $model->cliente;
            if($codigo != ''){
                $cliente = Cliente::findOne($codigo);
                return $cliente->apellido.', '.$cliente->nombre;
            }else{
                return '';   
            }

        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Cliente::find()->orderBy(['id' => SORT_ASC])->all(),'id', function($model){
            return $model->apellido.', '.$model->nombre;}),

        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Buscar cliente...'],
        'format'=>'raw'
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'cantidad',
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'importe',
        'pageSummary'=>true

    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'estado',
        'value' => function($model){
            $codigo = $model->estado;
            if($codigo == 0){
                return '<span align="center" class="badge" style="padding:5px;background-color:#B9264F" >Impagas</span>';
            }else{
                return '<span align="center" class="badge" style="padding:5px;background-color:#59955C">Pagas</span>';
            }   

        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter' => ["0"=>"Impagas","1"=>"Pagas"],

        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'estado...'],
        'format'=>'raw'
    ],

   

    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fecha_venta',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'importe_unitario',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'estado',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fecha_carga',
    // ],
    
    /*[
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
    ],*/

];   