<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Viaje */

$this->title = 'Create Viaje';
$this->params['breadcrumbs'][] = ['label' => 'Viajes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="viaje-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
