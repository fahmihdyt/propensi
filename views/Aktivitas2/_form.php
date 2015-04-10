<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Aktivitas2 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aktivitas2-form" >

    <?php $form = ActiveForm::begin(['layout'=>'horizontal']); ?>
	<div class="column-lg-1">
	<?= $form->field($model, 'judul')->textInput(['maxlength' => 100]) ?>
	</div>
    <?= $form->field($model, 'tanggal')->textInput(['class'=>'date form-control','type'=>'hidden']) ?>
    	
    <?= $form->field($model, 'status')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'foto')->textInput(['maxlength' => 200]) ?>
    
    <?= $form->field($model, 'siteId')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
 	
 	
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
