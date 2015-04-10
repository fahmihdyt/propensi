<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SiteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="site-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'titik_nominal') ?>

    <?= $form->field($model, 'status_kepemilikan') ?>

    <?= $form->field($model, 'tipe_antena') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <?php // echo $form->field($model, 'status_kerja') ?>

    <?php // echo $form->field($model, 'proyek') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
