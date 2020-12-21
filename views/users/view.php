<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\data\SqlDataProvider;
use app\models\Rol;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Perfil';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


  $this->registerJsFile(
        '@web/js/bootstrap.min.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
    );
?>
<?php 
	 $rol = Rol::find()->where(['codigo' => $model->role])->one();
	 $countRoles = Rol::find()->where(['codigo' => $model->role])->count();
	 $r='';
	 if($countRoles > 0 ){
	 	$r = substr($rol->descripcion,7);
	 }else{
	 	$r = 'Indefinido';
	 }
?>

<div class="row">
        <div class="col-lg-12">
            <div class = "panel panel-default">
               
               <div class = "panel-heading" style="padding-top:4px;padding-bottom:4px;" >
                  Mi perfil
               </div>
               
               <div class = "panel-body">
                     <p>
                        <?= Html::a('Editar datos', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <!--<?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Está seguro de realizar esta acción?',
                                'method' => 'post',
                            ],
                        ]) ?>-->
                        <?php if($model->role == 1): ?>
                            <?= Html::a('Editar otros usuarios', ['index'], ['class' => 'btn btn-primary']) ?>
                        <?php endif; ?>

                        <?= Html::a('Salir', ['users/index'], ['class' => 'btn btn-danger pull-right']) ?>
                    </p>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'username',
                            'email:email',
                            'password',
                            'nombre',
                            'apellido',
                            //'authKey',
                           //'accessToken',
                            //'activate',
                            //'verification_code',

                            [
                                'attribute' => 'role',
                                'format'=>'raw',
                                'value'=> $r
                            ],
                            [
                                'attribute' => 'adjunto_foto',
                                'format' => 'html',
                                'value' => Html::img($model->adjunto_foto, ['width'=>'80']),
                            ],

                        ],
                    ]) ?>
                </div>
            </div>
    </div>
</div>