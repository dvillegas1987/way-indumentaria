<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Regalo */
?>
<div class="regalo-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'idProducto',
            'cantidad',
            'importe',
            'vendedor',
            'cliente',
            'fecha_venta',
            'importe_unitario',
            'estado',
            'fecha_carga',
            'tipo_venta',
            'caracter',
            'carga_venta',
            'forma_pago',
            'descuento_aplicado',
            'folio',
            'fecha_antigua',
            'regalo',
        ],
    ]) ?>

</div>
