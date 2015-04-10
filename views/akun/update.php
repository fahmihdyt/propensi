<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Akun */

$this->title = 'Edit Account: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Akuns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->username]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akun-update">
	<div style="margin-top: 0px; padding-top: 10px;">
    <h1><?= Html::encode($this->title) ?></h1>
	<hr></div>
	
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
