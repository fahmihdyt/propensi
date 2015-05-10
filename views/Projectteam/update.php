<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Projectteam */

$this->title = 'Update Projectteam: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Projectteams', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="projectteam-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
