<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Klien */

$this->title = 'Update Klien: ' . ' ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Kliens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="klien-update">

	<div style="margin-top: 0px; padding-top: 10px;">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr></div>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
