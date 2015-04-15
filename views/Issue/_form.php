<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Site;

/* @var $this yii\web\View */
/* @var $model app\models\issue */
/* @var $form yii\widgets\ActiveForm */
$data=ArrayHelper::map(Site::find()->asArray()->all(),'id','nama');
?>

<div class="issue-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'judul')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'tanggal')->textInput(['class'=>'date form-control']) ?>

    <?= $form->field($model, 'jenis')->textInput(['maxlength' => 50]) ?>
    
    <?= $form->field($model, 'status')->textInput(['maxlength' => 30]) ?>
    
    <?= $form->field($model, 'siteId')->dropDownList($data,['id'=>'nama']) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 10]) ?>
	
	<!--<div style='display:none '>
    	<?= $form->field($model, 'creator')->textInput(['maxlength' => 200,'type'=>'hidden','value'=>Yii::$app->user->identity->nik]) ?>
 </div>  -->
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
