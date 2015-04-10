<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Aktivitas2Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aktivitas2s';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aktivitas2-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Aktivitas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'judul',
            'tanggal',
           
            'status',
            //'foto',
            //'keterangan:ntext',
            // 'status_approval_pm',
            // 'status_approval_supervi',
            'creator',
            // 'siteId',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
