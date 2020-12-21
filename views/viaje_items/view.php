<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Viaje_items */
?>
<div class="viaje-items-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codigo',
            'descripcion',
            'importe',
        ],
    ]) ?>

</div>
