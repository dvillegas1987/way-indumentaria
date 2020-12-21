<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vendedor */
?>
<div class="vendedor-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'apellido',
            'dni',
            'domicilio',
            'email:email',
            'localidad',
            //'garante',
            'adjunto:ntext',
        ],
    ]) ?>

</div>
