<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\helpers\ArrayHelper;
//use app\models\Jabatan;

/* @var $this yii\web\View */
/* @var $model app\models\Akun */
/* @var $form yii\widgets\ActiveForm */

//$data = ArrayHelper::map(Jabatan::find()->asArray()->all(),'id','jabatan');
$privilege = Yii::$app->user->identity->jabatan;
?>

<div class="akun-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if($privilege == "Administrator") { ?>
    <?= $form->field($model, 'nik')->textInput(['maxlength' => 12, 'autocomplete' => 'off', 'placeholder' => 'Nomor Induk Pegawai']) ?>
	<?php } ?>
	
    <?= $form->field($model, 'nama')->textInput(['maxlength' => 30, 'autocomplete' => 'off', 'placeholder' => 'Nama Lengkap']) ?>

    <?= $form->field($model, 'gender')->dropDownList(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 50, 'autocomplete' => 'off', 'placeholder' => 'E-mail']) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 30, 'autocomplete' => 'off', 'placeholder' => 'Username']) ?>
	
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 32, 'placeholder' => 'Password']) ?>
    
    <?= $form->field($model, 'repeatPassword')->passwordInput(['maxlength' => 32, 'placeholder' => 'Re-enter Password']) ?>
	
	<?php if($privilege == "Administrator") { ?>
    <?= $form->field($model, 'jabatan')->dropDownList(['Administrator' => 'Administrator', 'Project Manager' => 'Project Manager', 'Supervisor' => 'Supervisor', 'Coordinator' => 'Coordinator']) ?>
	<?php } ?>
	
	<?= $form->field($model, 'alamat')->textInput(['maxlength' => 200, 'autocomplete' => 'off', 'placeholder' => 'Alamat']) ?>
	
    <?= $form->field($model, 'no_telp')->textInput(['maxlength' => 30, 'autocomplete' => 'off', 'placeholder' => 'Nomor Telepon']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
