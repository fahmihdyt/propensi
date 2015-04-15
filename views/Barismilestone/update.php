<?php

use yii\helpers\Html;
use app\models\Barismilestone;

/* @var $this yii\web\View */
/* @var $model app\models\Barismilestone */
$this->title = 'Update Barismilestone: ' . ' ' . $model->getKategoriName($model->kategoriId) ;
$this->params['breadcrumbs'][] = ['label' => 'Barismilestones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="barismilestone-update">

	<div style="margin-top: 0px; padding-top: 10px;">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr></div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
