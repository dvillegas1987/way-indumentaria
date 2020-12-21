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
    /*[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fecha_venta',
        'value' => function($model){
           $date = date_create($model->fecha_venta);
           $date = date_format($date,'d-m-Y');

           return $date;

        },
    ],*/
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
    
    
    /*[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'vendedor',
        'value' => function($model){
            $codigo = $model->vendedor;
            $vendedor_count = Vendedor::find()->where(['id' => $codigo])->count();
            if($vendedor_count > 0){
                $vendedor = Vendedor::findOne($codigo);
                return $vendedor->apellido.', '.$vendedor->nombre;
            }else{
                return '';   
            }

        },
        'filter' => false,
        'filterType'=>GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Vendedor::find()->orderBy(['id' => SORT_ASC])->all(),'id', function($model){
            return $model->apellido.', '.$model->nombre;}),

        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Buscar vendedor...'],
        'format'=>'raw'
    ],*/
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
        'filter' =>false,
        'pageSummary'=>true
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
        'format'=>'raw',
        'pageSummary'=>true
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
        'format'=>'raw',
        'pageSummary'=>true
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
        'attribute'=>'descuento_aplicado',
        'header' => 'Descuento aplicado',
        'value' => function($model){
            
                return $model->descuento_aplicado;   
            

        },
        'filter' =>false,
        'format'=>'raw'
    ],
   
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'caracter',
        'value' => function($model){

            $codigo = $model->idProducto;
            $stock = null;
            if($codigo != ''){
               $stock = Stock::find()->where(['codigo' => $codigo])->one();
            }


            $codigo_c = $model->caracter;
            if($codigo_c == 0){
                if($stock)
                {
                    if($model->cantidad > $stock->cantidad ){
                        return '<span align="center" class="badge" style="padding:5px;background-color:#A4A4A4">Convencional</span>';
                    }else{
                        return '<span align="center" class="badge" style="padding:5px;background-color:#59955C">Convencional</span>';
                    }
                }
              
                

            }else{
                if($model->cantidad > $stock->cantidad ){

                   return '<span align="center" class="badge" style="padding:5px;background-color:#A4A4A4">Regalo</span>';
                }else{
                    return '<span align="center" class="badge" style="padding:5px;background-color:#B9264F">Regalo</span>';
                }
                
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
        'attribute'=>'idProducto',
        'header' => 'Disponible',
        'value' => function($model){
            $codigo = $model->idProducto;
            if($codigo != ''){
                $stock = Stock::find()->where(['codigo' => $codigo])->one();
                if($stock)
                {
                    if($stock->cantidad > 0){
                        return $stock->cantidad;
                    }else{
                        $producto = Producto::find()->where(['id' => $codigo])->one();
                        return $producto->stock;
                    }
                }
               
                
            }else{
                return '';   
            }

        },
        'filter' =>false,
        'format'=>'raw'
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'impagas',
        'header' => 'V',
        'headerOptions' => ['style' => 'width:12%'],
        'value' => function($model,$key,$index){
           $id1 = $key.'i';$id2 = $key.'d';
           $cantidad = $model['cantidad'];
           return '<input type="number" style="width:30px;" id="'.$id1.'"  value=0 onchange=cambios_input("'.$id1.'","'.$id2.'","'.$key.'","'.$cantidad.'"); />';
           //return Html::textInput('', $model->impagas);
        },
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'devuelve',
        'header' => 'D',
        'headerOptions' => ['style' => 'width:12%'],
        'value' => function($model,$key){
            $id1 = $key.'d';$id2 = $key.'i';
            $cantidad = $model['cantidad'];
            return '<input type="number" style="width:30px;" id="'.$id1.'"  value=0 onchange=cambios_input("'.$id1.'","'.$id2.'","'.$key.'","'.$cantidad.'"); />';
          
        },
        'format'=>'raw'
    ]
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