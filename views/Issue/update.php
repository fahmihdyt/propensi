<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\issue */

$this->title = 'Update Issue: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Issues', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="issue-update">

    <h1 style='margin-top:0px; padding-top:15px'>Update Issue</h1>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
