<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "\n<div class=\"input-box\">{input}</div>",
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['placeholder' => 'Username']) ?>

    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>
    
        <div class="form-group">
        <div class="col-lg-12">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button', 'style' => 'width:100%;']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

  
</div>
</center>