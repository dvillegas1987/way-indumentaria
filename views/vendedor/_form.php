<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Vendedor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendedor-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'dni')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'domicilio')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'localidad')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?php echo  $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>
            <?php // $form->field($model, 'garante')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


     
    

    


    <div class="col-lg-12">

        <?php
                if($model->adjunto == null) {
           
                   echo $form->field($model, 'a1',[ 'enableClientValidation' => true, 'enableAjaxValidation' => false])->widget(FileInput::classname(), [
                        //'id' => 'file_input1',
                        //'name' => 'i1',
                        'options' => ['accept'=>'/*'],
                        'language' => 'es',
                        'pluginOptions' => [
                            //'showPreview' => false,
                            //'allowedFileExtensions'=>['jpg', 'gif', 'png', 'bmp'],
                            'showCaption' => true,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'mainClass' => 'input-group-sm',
                            'uploadUrl' => Url::to(['/vendedor/create']),
                            //'maxFileSize' => 250,
                            /*'initialPreview'=>[
                                Html::img($model->Foto,['class'=>'file-preview-image']),
                            ],*/
                            'initialCaption'=> $model->adjunto,
                             //'minFileCount' => 1,
                            // 'validateInitialCount' => true,
                            // 'uploadUrl' => Url::to(['cliente/upload']),
                        ],
                    ])->label('Adjunto');

                   }else {
                    echo $form->field($model, 'a1',['enableClientValidation' => true, 'enableAjaxValidation' => false])->widget(FileInput::classname(), [
                        'id' => 'file_input1',
                        'name' => 'i1',
                        'options' => ['accept'=>'/*'],
                        'pluginOptions' => [
                            // 'minFileCount' => 1,
                            //'allowedFileExtensions'=>['jpg', 'gif', 'png', 'bmp'],
                            'showCaption' => true,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'mainClass' => 'input-group-sm',
                            'uploadUrl' => Url::to(['/vendedor/update']),
                            //'maxFileSize' => 250,
                            'initialPreview'=>[
                                Html::img( $model->adjunto,['class'=>'file-preview-image','style' => 'width:100%']),
                            ],
                            'overwriteInitial'=> true,
                            'autoReplace' => true,
                            'initialCaption'=> $model->adjunto,
                        ]
                    ])->label('Adjunto');
                }
                
            ?>


    </div> 

    

    <div class="row">DATOS DE GARANTE</div>
    <div class="row">
       
        <div class="col-lg-6">
            <?= $form->field($model, 'nom_garante')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'ape_garante')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'email_garante')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'dni_garante')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'domicilio_garante')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'telefono_garante')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    

    

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
