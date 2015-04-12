<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Klien;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */

$data = ArrayHelper::map(Klien::find()->asArray()->all(),'id', 'nama');
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tanggal_mulai')->textInput(['class'=>'date form-control']) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'klienId')->dropDownList($data, ['id' => 'klienId']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
