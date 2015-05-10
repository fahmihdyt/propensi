<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Akun;
use app\models\Project;

/* @var $this yii\web\View */
/* @var $model app\models\Projectteam */
/* @var $form yii\widgets\ActiveForm */

$jabatan = 'Administrator';
$data=ArrayHelper::map(Akun::find()->where('jabatan != :jabatan', [':jabatan' => $jabatan])->asArray()->all(),'nik','nama');
$data2=ArrayHelper::map(Project::find()->asArray()->all(),'id','nama');
?>

<div class="projectteam-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nik')->dropDownList($data, ['nik' => 'nik']) ?>
    
    <?php $id=$_GET['id'];    	?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
