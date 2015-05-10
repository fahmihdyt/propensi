<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectteamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projectteams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectteam-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Projectteam', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'proyekId',
            'nik',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
