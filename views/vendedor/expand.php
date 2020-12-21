<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/*$codigo = $model->idllamada;
$derivaciones = Llamada_derivacion::find()->where(['idllamada' => $codigo])->all();
$contador = 0;*/



?>


<div class="row">
        <div class="col-sm-3">
            <div class="panel panel-default" align="center">
              <div class="panel-heading" align="left">Foto vendedor</div>
              <div class="panel-body" align="left"><img src="<?php echo $model->adjunto; ?>"></div>
            </div>
        </div>
        <div class="col-sm-3">
            <table class="table table-bordered table-condensed table-hover small kv-table">
                <tbody><tr class="default">
                    <th colspan="3" class="text-center text-default">Datos Garante</th>
                </tr>
                <!--<tr class="active">
                    <th class="text-center">#</th>
                    <th>Nombre</th>
                    <th>apellido</th>
                </tr>-->
                <tr>
                    
                    <td class="text-center">1</td><th>Nombre</th><td><?= $model->nom_garante;  ?></td>
                </tr>
                <tr>
                    
                    <td class="text-center">2</td><th>Apellido</th><td><?= $model->ape_garante;  ?></td>
                </tr>
                <tr>
                    
                    <td class="text-center">3</td><th>Dni</th><td><?= $model->dni_garante;  ?></td>
                </tr>
                <tr>
                    
                    <td class="text-center">4</td><th>Teléfono</th><td><?= $model->telefono_garante;  ?></td>
                </tr>
                <tr>
                    
                    <td class="text-center">5</td><th>Domicilio</th><td><?= $model->domicilio_garante;  ?></td>
                </tr>
                <tr>
                    
                    <td class="text-center">6</td><th>Email</th><td><?= $model->email_garante;  ?></td>
                </tr>
            
            </tbody></table>
        </div>
        
</div>