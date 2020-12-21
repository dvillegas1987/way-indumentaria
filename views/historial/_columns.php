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
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'folio',
    ],
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
    /*[
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
    ],*/

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'cantidad',
        'filter' =>false,
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Precio costo ($)',
        'attribute'=>'idProducto',
        'value' => function($model){
            $codigo = $model->idProducto;
            if($codigo != ''){
                $producto = Producto::findOne($codigo);
                return $producto->precio_descuento;
            }else{
                return '';   
            }

        },
        'filter' =>false,
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'idProducto',
        'header' => 'Precio venta ($)',
        'value' => function($model){
            $codigo = $model->idProducto;
            if($codigo != ''){
                $producto = Producto::findOne($codigo);
                return $producto->precio_unitario;
            }else{
                return '';   
            }

        },
        'filter' =>false,
        'format'=>'raw'
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'importe',
        'header' => 'Importe ($)',
        'value' => function($model){
            $codigo = $model->importe;
            if($codigo != ''){
                
                return $codigo;
            }else{
                return '';   
            }

        },
        'filter' =>false,
        'pageSummary'=>true

    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'idProducto',
        'header' => 'Descuento',
        'value' => function($model){
            $codigo = $model->idProducto;
            if($codigo != ''){
                $producto = Producto::findOne($codigo);
                return $producto->descuento.' Off';
            }else{
                return '';   
            }

        },
        'filter' =>false,
        'format'=>'raw'
    ],
   
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'caracter',
        'value' => function($model){
            $codigo = $model->caracter;
            if($codigo == 0){
                return '<span align="center" class="badge" style="padding:5px;background-color:#59955C">Convencional</span>';
            }else{
                return '<span align="center" class="badge" style="padding:5px;background-color:#B9264F">Regalo</span>';
            }   

        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter' => ["0"=>"Convencional","1"=>"Regalo"],

        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Caracter de venta...'],
        'format'=>'raw'
    ],

     [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'detalle',
        'value' => function($model){
              return '<b style="color:#2E9AFE;">'.$model->detalle.'</b>';
        },
        'format'=>'raw',
        'width'=>'5%',
        'filter' =>false,
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'movimiento',
        'value' => function($model){
           $date = date_create($model->movimiento);
           $date = date_format($date,'d-m-Y H:i:s');

           return $date;

        },
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


    [
            'class'=>'kartik\grid\ActionColumn',
            'template' => '{pdf} {update}  {view} {delete}',
            'width'=>'12%',
            'buttons' => [
                'pdf' => function ($url, $model) {
            

                    return Html::a('<button class="btn btn-default btn-xs"><i class="fa fa-fw fa-file-pdf-o"></i></button>', ['historial/pdfall2','id' => $model->id] , [
                                            //'class'=>'btn btn-primary', 
                                            'target'=>'_blank', 
                                            'data-toggle'=>'tooltip',
                                            'data-pjax'=>"0" ,
                                            //'style' => 'padding:0px',
                                            'title' => Yii::t('app', 'View'),
                                ]);
                },

                'view' => function ($url, $model) {
            

                    return Html::a('<button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></button>', $url, [
                            'title' => Yii::t('app', 'Ver datos'),
                    'role'=>'modal-remote']);
                },

                'update' => function ($url, $model) {
               

                    return Html::a('<button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-pencil"></i></button>', $url, [
                            'title' => Yii::t('app', 'Actualizar'),
                    'role'=>'modal-remote']);
                       
                   
                },
     
   

                'delete' => function ($url, $model) {

       
              
                        return Html::a('<button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-trash"></i></button>', $url, [
                                   'role'=>'modal-remote','title'=>'Eliminar persona', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Eliminación',
                          'data-confirm-message'=>'¿Está seguro de eliminar este elemento?', 
                        ]);
                   
                },


            
            ],


        ],


];   