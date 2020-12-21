<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Estado_civil;
use app\models\Persona;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

$this->title = $id;
$this->params['breadcrumbs'][] = $this->title;


$persona = Persona::find()->where(['idPersona' => $this->title])->one();
?>

<div class="row">
    <div class="col-md-12 col-xs-12">
        <div  class="x_panel">
            <div class="x_title">
              <h2>Observación - <?= $persona->Nombre.', '.$persona->Apellido ?></h2>
              <p>                                                        
                    <?= Html::a('<i class="glyphicon glyphicon-chevron-left"></i> Regresar', ['persona/index'], ['class' => 'btn btn-primary pull-right']); ?>
       
               </p> 
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              	
              	<?= $persona->Observaciones; ?>
                
            </div>
        </div>
    </div>
</div>