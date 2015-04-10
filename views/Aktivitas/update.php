<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aktivitas */

$this->title = 'Update Aktivitas: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Aktivitas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="aktivitas-update">

    <h1 style='margin-top:0px; padding-top:15px'>Update Activity</h1>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
