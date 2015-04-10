<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Project;

/* @var $this yii\web\View */
/* @var $model app\models\Site */
/* @var $form yii\widgets\ActiveForm */

$data = ArrayHelper::map(Project::find()->asArray()->all(),'id', 'nama');
?>

<div class="site-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'titik_nominal')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'status_kepemilikan')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'tipe_antena')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'foto')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'status_kerja')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'proyek')->dropDownList($data, ['id' => 'proyek']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>