<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\issue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="issue-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'judul')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'tanggal')->textInput(['class'=>'date form-control']) ?>

    <?= $form->field($model, 'jenis')->textInput(['maxlength' => 50]) ?>
    
    <?= $form->field($model, 'status')->textInput(['maxlength' => 30]) ?>
    
    <?= $form->field($model, 'siteId')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 10]) ?>

    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
