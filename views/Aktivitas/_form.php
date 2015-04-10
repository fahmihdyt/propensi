<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Site;

/* @var $this yii\web\View */
/* @var $model app\models\Aktivitas */
/* @var $form yii\widgets\ActiveForm */

//Set nilai siteId
/*$sites='';
foreach($site as $row){
	$sites.=$row['id'].",";
}
$sites=substr($sites, 0,strlen($sites)-1);*/
$data=ArrayHelper::map(Site::find()->asArray()->all(),'id','nama');
?>

<div class="aktivitas-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'judul')->textInput(['maxlength' => 100]) ?>
	
    <?= $form->field($model, 'tanggal')->textInput(['class'=>'date form-control']) ?>

    <?= $form->field($model, 'status')->dropDownList(['Start'=>'start','On Process'=>'on Process','Done'=>'Done']) ?>

    <?= $form->field($model, 'foto')->textInput(['maxlength' => 200]) ?>
    
    <?= $form->field($model, 'siteId')->dropDownList($data,['id'=>'nama']) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 10]) ?>
    
    <div style='display:none '>
    	<?= $form->field($model, 'creator')->textInput(['maxlength' => 200,'type'=>'hidden','value'=>Yii::$app->user->identity->nik]) ?>
    </div>  
         
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
