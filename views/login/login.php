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

    <?= $form->field($model, 'username')->textInput(['id' => 'username', 'placeholder' => 'Username', 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'password')->passwordInput(['id' => 'password', 'placeholder' => 'Password']) ?>
    
        <div class="form-group">
        <div>
            <?= Html::submitButton('Login', ['class' => 'btn login-button', 'name' => 'login-button',]) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

  
</div>
</center>