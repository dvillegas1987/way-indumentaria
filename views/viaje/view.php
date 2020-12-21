<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Viaje;
/* @var $this yii\web\View */
/* @var $model app\models\Viaje */

$this->title = $model->idviaje;
$this->params['breadcrumbs'][] = ['label' => 'Viajes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section style="padding-top: 20px;">
<div class="row">
    <div class="col-lg-6 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">PRESUPUESTO ESTIMATIVO DE VIAJE</div>
            <div class="panel-body">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->idviaje], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idviaje], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idviaje',
            'pasajes',
            'hospedaje',
            'comestibles',
        ],
    ]) ?>
    <?php 

        $viaje = Viaje::find()->one();
        $total = (int)$viaje->pasajes + (int)$viaje->hospedaje + (int)$viaje->comestibles;
    ?>

    <table class="table table-striped table-bordered detail-view"><tbody>
        <tr ><th >TOTAL GASTO</th><td><?= $total; ?></td></tr></tbody></table>
 </div>
        </div>
    </div>
</div>
</section>
