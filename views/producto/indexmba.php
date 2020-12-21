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
&nbsp;
<div class="panel panel-default" style="margin-bottom: 5px;">
<div class="panel-heading">PANEL DE CONTROL - Descuentos y porcentajes</div>
<div class="panel-body">
<div class="row">
<div class="col-md-1" style="margin-right:160px;">
            <?php echo Html::button('<i class="glyphicon glyphicon-ok"></i>&nbsp; Reemplazar descuento', [ 'class' => 'btn btn-primary',

                'onclick' => '
                    var cantidad = $("#cant").val();
                        if(cantidad != ""){ 
                            var strvalue = "";
                            $("input[name=\'selection[]\']:checked").each(function() {
                           
                                   if(strvalue != ""){ 
                                        strvalue = strvalue + ","+this.value;
                                   }
                                    else{
                                        strvalue = this.value;
                                    }
                             
                                });

                                cantidad = $("#cant").val();
                                var id = null;
                                $.post({
                                    url:  "index.php?r=producto/reemplazar",
                                  
                                    data: {keylist:strvalue,cant:cantidad },
                                    success: function(data) {
                                       
                                  
                                    }


                               });
                               $.pjax.reload({container: "#crud-datatable-pjax"});
                                
                        }else{
                            alert("Debe ingresar una cantidad para llevar a cabo esta operación. Gracias.");
                        }        
                    ' 

                ]); ?>
        </div>
        <div class="col-md-1" style="margin-right:140px;">
            <?php echo Html::button('<i class="glyphicon glyphicon-ok"></i>&nbsp; Agregar descuento', [ 'class' => 'btn btn-primary',

                'onclick' => '
                    var cantidad = $("#cant").val();
                        if(cantidad != ""){ 
                            var strvalue = "";
                            $("input[name=\'selection[]\']:checked").each(function() {
                           
                                   if(strvalue != ""){ 
                                        strvalue = strvalue + ","+this.value;
                                   }
                                    else{
                                        strvalue = this.value;
                                    }
                             
                                });
                                cantidad = $("#cant").val();
                                var id = null;
                                $.post({
                                    url:  "index.php?r=producto/sumar",
                                  
                                    data: {keylist:strvalue,cant:cantidad },
                                    success: function(data) {
                                       
                                  
                                    }


                               });
                                
                                 $.pjax.reload({container: "#crud-datatable-pjax"});    
                        }else{
                            alert("Debe ingresar una cantidad para llevar a cabo esta operación. Gracias.");
                        }        
                    ' 

                ]); ?>
        </div>
        
        <div class="col-md-2">

            <input type="text" class="form-control" id="cant" placeholder="Ingrese descuento...">

        </div>

</div>


<div class="row">
<div class="col-md-1" style="margin-right:160px;">
            <?php echo Html::button('<i class="glyphicon glyphicon-ok"></i>&nbsp; Reemplazar porcentaje de costo', [ 'class' => 'btn btn-success',

                'onclick' => '
                    var cantidad = $("#idporcientocosto").val();
                        if(cantidad != ""){ 
                            var strvalue = "";
                            $("input[name=\'selection[]\']:checked").each(function() {
                           
                                   if(strvalue != ""){ 
                                        strvalue = strvalue + ","+this.value;
                                   }
                                    else{
                                        strvalue = this.value;
                                    }
                             
                                });
                                cantidad = $("#idporcientocosto").val();
                                var id = null;

                                $.post({
                                    url:  "index.php?r=producto/porcentaje1_costo",
                                  
                                    data: {keylist:strvalue,cant:cantidad },
                                    success: function(data) {
                                       
                                  
                                    }


                               });

                               $.pjax.reload({container: "#crud-datatable-pjax"});
                                
                        }else{
                            alert("Debe ingresar una cantidad para llevar a cabo esta operación. Gracias.");
                        }        
                    ' 

                ]); ?>
        </div>
        <div class="col-md-1" style="margin-right:140px;">
            <?php echo Html::button('<i class="glyphicon glyphicon-ok"></i>&nbsp; Agregar porcentaje de costo', [ 'class' => 'btn btn-success',

                'onclick' => '
                    var cantidad = $("#idporcientocosto").val();
                        if(cantidad != ""){ 
                            var strvalue = "";
                            $("input[name=\'selection[]\']:checked").each(function() {
                           
                                   if(strvalue != ""){ 
                                        strvalue = strvalue + ","+this.value;
                                   }
                                    else{
                                        strvalue = this.value;
                                    }
                             
                                });
                                cantidad = $("#idporcientocosto").val();
                                var id = null;
                                $.post({
                                    url:  "index.php?r=producto/porcentaje2_costo",
                                  
                                    data: {keylist:strvalue,cant:cantidad },
                                    success: function(data) {
                                       
                                  
                                    }


                               });
                                
                                 $.pjax.reload({container: "#crud-datatable-pjax"});    
                        }else{
                            alert("Debe ingresar una cantidad para llevar a cabo esta operación. Gracias.");
                        }        
                    ' 

                ]); ?>
        </div>
        
        <div class="col-md-2">

            <input type="text" class="form-control" id="idporcientocosto" placeholder="Ingrese porciento costo...">

        </div>

</div>



<!-- *********************************************************************************************** -->


<div class="row">
<div class="col-md-1" style="margin-right:160px;">
            <?php echo Html::button('<i class="glyphicon glyphicon-ok"></i>&nbsp; Reemplazar porcentaje de venta', [ 'class' => 'btn btn-warning',

                'onclick' => '
                    var cantidad = $("#idporcientoventa").val();
                        if(cantidad != ""){ 
                            var strvalue = "";
                            $("input[name=\'selection[]\']:checked").each(function() {
                           
                                   if(strvalue != ""){ 
                                        strvalue = strvalue + ","+this.value;
                                   }
                                    else{
                                        strvalue = this.value;
                                    }
                             
                                });
                                cantidad = $("#idporcientoventa").val();
                                var id = null;
                                $.post({
                                    url:  "index.php?r=producto/porcentaje1_venta",
                                  
                                    data: {keylist:strvalue,cant:cantidad },
                                    success: function(data) {
                                       
                                  
                                    }


                               });
                               $.pjax.reload({container: "#crud-datatable-pjax"});
                                
                        }else{
                            alert("Debe ingresar una cantidad para llevar a cabo esta operación. Gracias.");
                        }        
                    ' 

                ]); ?>
        </div>
        <div class="col-md-1" style="margin-right:140px;">
            <?php echo Html::button('<i class="glyphicon glyphicon-ok"></i>&nbsp; Agregar porcentaje venta', [ 'class' => 'btn btn-warning',

                'onclick' => '
                    var cantidad = $("#idporcientoventa").val();
                        if(cantidad != ""){ 
                            var strvalue = "";
                            $("input[name=\'selection[]\']:checked").each(function() {
                           
                                   if(strvalue != ""){ 
                                        strvalue = strvalue + ","+this.value;
                                   }
                                    else{
                                        strvalue = this.value;
                                    }
                             
                                });
                                cantidad = $("#idporcientoventa").val();
                                var id = null;
                                $.post({
                                    url:  "index.php?r=producto/porcentaje2_venta",
                                  
                                    data: {keylist:strvalue,cant:cantidad },
                                    success: function(data) {
                                       
                                  
                                    }


                                });
                                
                                $.pjax.reload({container: "#crud-datatable-pjax"});    

                        }else{
                            alert("Debe ingresar una cantidad para llevar a cabo esta operación. Gracias.");
                        }        
                    ' 

                ]); ?>
        </div>
        
        <div class="col-md-2">

            <input type="text" class="form-control" id="idporcientoventa" placeholder="Ingrese porciento venta...">

        </div>

</div>
</div>
</div>

<div class="producto-index">
&nbsp;
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns_mujer_ba.php'),
            'rowOptions' => function ($model, $key, $index, $grid) {

                if($model['estado'] == 0 ){
                    return ['style' => 'background-color:rgba(255, 115, 115, 0.55);color:#B9264F;font-weight:bold;'];
                }

              
              
            },
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create','origen' => 0, 'sexo' => 0],
                    ['role'=>'modal-remote','title'=> 'Create new Productos','class'=>'btn btn-default']).
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
                'heading' => '<i class="glyphicon glyphicon-list"></i> Grilla productos <b>: '.$descripcion.'</b>',
                
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
   'size'=>'modal-lg',
    "footer"=>"",// always need it for jquery plugin
    'options' => [
       
        'tabindex' => false
    ],
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => false] ,
])?>
<?php Modal::end(); ?>
