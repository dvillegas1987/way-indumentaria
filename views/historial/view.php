<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Historial */
?>
<div class="historial-view">
 
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
        ],
    ]) ?>

</div>
