<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */
?>
<div class="producto-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'codigo',
            'descripcion',
            'precio_costo',
            'precio_unitario',
            'precio_descuento',
            'categoria',
            'stock',
            'estado',
            'descuento',
        ],
    ]) ?>

</div>
