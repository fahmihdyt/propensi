<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Aktivitas2 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Aktivitas2s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aktivitas2-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal',
            'judul',
            'status',
            'foto',
            'keterangan:ntext',
            'status_approval_pm',
            'status_approval_supervi',
            'creator',
            'siteId',
        ],
    ]) ?>

</div>
