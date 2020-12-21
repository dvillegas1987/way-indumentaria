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
        'header' => 'Precio de compra',
        'attribute'=>'precio_costo',

    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'precio_descuento',
        'header' => 'Precio de costo',
        'width' => '30px',
        'value' => function($model){
        

            //$porciento = ( $model->precio_descuento * 100) / $model->precio_costo;

            /*$precio_compra = $model->precio_costo;
            $calculo = (((int)$model->porcentaje_costo * (int)$precio_compra)/100)+$precio_compra;
            $model->precio_descuento = $calculo;*/

            return $model->precio_descuento.' ('.number_format($model->porcentaje_costo,2,",",".").'%)';


        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'precio_unitario',
        'header' => 'Precio de venta',
        'width' => '30px',
        'value' => function($model){
            
            /*$precio_venta = $model->precio_unitario;
            $precio_compra = $model->precio_costo;

            $porciento = ( $precio_venta * 100) /$precio_compra;*/


            /*$precio_descuento = $model->precio_descuento;
            $calculo = (((int)$model->porcentaje_venta * (int)$precio_descuento)/100)+$precio_descuento;
            $model->precio_unitario = $calculo;*/

            return $model->precio_unitario.' ('.number_format($model->porcentaje_venta,2,",",".").'%)';


        },
    ],
   
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'stock',
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'descuento',
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
        'filter' => ArrayHelper::map(Categoria::find()->where(['categoria_origen' => 0,'categoria_sexo' => 1])->orderBy(['codigo' => SORT_ASC])->all(),'codigo', 'descripcion'),

        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Buscar categoría...'],
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'codigo_sexo',
        'header' => 'Sexo',
        'value' => function($model){
            $codigo = $model->categoria;
            if($codigo != ''){
                $categoria = Categoria::findOne($codigo);
                if ($categoria->categoria_sexo == 0) {
                    return 'Mujer';
                }else{
                   
                    return 'Hombre';
                    
                }
            }else{
                return '';   
            }

        },
        'filter' => false,
        /*'filterType'=>GridView::FILTER_SELECT2,
        'filter' => [0 => 'Mujer',1 => 'Hombre'] ,

        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Sexo...'],*/
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'codigo_origen',
        'header' => 'Origen',
        'value' => function($model){
            $codigo = $model->categoria;
            if($codigo != ''){
                $categoria = Categoria::findOne($codigo);
                if ($categoria->categoria_origen == 0) {
                    return 'Buenos Aires';
                }else{
                    if ($categoria->categoria_origen == 1) {
                        return 'Chile';
                    }else{
                        return 'Oulet';
                    }
                }
            }else{
                return '';   
            }

        },
        'filter' => false,
        /*'filterType'=>GridView::FILTER_SELECT2,
        'filter' => [0 => 'Buenos Aires',1 => 'Chile', 2 => 'Oulet'] ,

        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Origen...'],*/
        'format'=>'raw'
    ],


    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'estado',
        'value' => function($model){
            $codigo = $model->estado;
            if($codigo == 0){
                //return '<span align="center" class="badge" style="padding:5px;background-color:#59955C">Convencional</span>';
                return '<span align="center" class="badge" style="padding:5px;background-color:#B9264F">Inactivo</span>';
            }else{
                //return '<span align="center" class="badge" style="padding:5px;background-color:#B9264F">Regalo</span>';
                return 'Activo';
            }   

        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter' => ["0"=>"Inactivo","1"=>"Activo"],

        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Estado...'],
        'format'=>'raw'
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