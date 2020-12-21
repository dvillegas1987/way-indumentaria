<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */
?>
<div class="categoria-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codigo',
            'descripcion',
            'estado',
        ],
    ]) ?>

</div>
