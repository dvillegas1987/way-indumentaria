<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Gasto */
?>
<div class="gasto-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idgatos',
            'descripcion:ntext',
            'importe',
            'categoria',
        ],
    ]) ?>

</div>
