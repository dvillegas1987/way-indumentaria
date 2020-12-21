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
        'attribute'=>'codigo',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'descripcion',
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
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'categoria_origen',
        'value' => function($model){
            $codigo = $model->categoria_origen;
            if($codigo == 0){
                //return '<span align="center" class="badge" style="padding:5px;background-color:#59955C">Convencional</span>';
                return '<span align="center" class="badge" style="padding:5px;background-color:#d9534f">Buenos Aires</span>';
            }else{
                if($codigo == 1){
                    return '<span align="center" class="badge" style="padding:5px;background-color:#5cb85c">Chile</span>';
                }else{
                    return '<span align="center" class="badge" style="padding:5px;background-color:#337ab7">Oulet</span>';
                }
             
            }   

        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter' => ["0"=>"Buenos Aires","1"=>"Chile","2" => "Oulet"],

        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Estado...'],
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'categoria_sexo',
        'value' => function($model){
            $codigo = $model->categoria_sexo;
            if($codigo == 0){
                //return '<span align="center" class="badge" style="padding:5px;background-color:#59955C">Convencional</span>';
                return '<span align="center" class="badge" style="padding:5px;background-color:#f0ad4e">Mujer</span>';
            }else{
                return '<span align="center" class="badge" style="padding:5px;background-color:#5bc0de;">Hombre</span>';
            }   

        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter' => ["0"=>"Mujer","1"=>"Hombre"],

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