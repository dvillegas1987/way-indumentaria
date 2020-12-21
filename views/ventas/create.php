<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ventas */

?>
<div class="ventas-create">
    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
    ]) ?>
</div>
