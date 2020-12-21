<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ventas */
?>
<div class="ventas-view">
 
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
        ],
    ]) ?>

</div>
