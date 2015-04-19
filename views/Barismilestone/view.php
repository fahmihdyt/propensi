<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Barismilestone */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Barismilestones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barismilestone-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this deadline',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal',
            'kategoriId',
            'siteId',
        ],
    ]) ?>
		 <?= Html::a('Back', ['index'], ['class' => 'btn btn-success']) ?>
    
</div>
