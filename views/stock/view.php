<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Stock */
?>
<div class="stock-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codigo',
            'producto',
            'cantidad',
        ],
    ]) ?>

</div>
