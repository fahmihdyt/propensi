<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Aktivitas2Search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aktivitas2-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'judul') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'foto') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'status_approval_pm') ?>

    <?php // echo $form->field($model, 'status_approval_supervi') ?>

    <?php // echo $form->field($model, 'creator') ?>

    <?php // echo $form->field($model, 'siteId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
