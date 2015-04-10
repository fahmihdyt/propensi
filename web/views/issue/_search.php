<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\issueSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="issue-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'judul') ?>

    <?= $form->field($model, 'jenis') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'creator') ?>

    <?php // echo $form->field($model, 'siteId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
