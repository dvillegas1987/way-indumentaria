<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Gasto_categoria */
?>
<div class="gasto-categoria-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idcategoriagastos',
            'descripcion',
        ],
    ]) ?>

</div>
