<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Akun */

$this->title = 'View Account: '.$model->username;
$this->params['breadcrumbs'][] = ['label' => 'Akuns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="akun-view">
	<div style="margin-top: 0px; padding-top: 10px;">
    <h1><?= Html::encode($this->title) ?></h1>
	<hr></div>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nik',
            'nama',
            'gender',
            'email:email',
            'username',
            'alamat',
            'jabatan',
            'no_telp',
        ],
    ]) ?>
    
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->nik], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->nik], [
            'class' => 'btn btn-primary',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Ok', ['index'], ['class' => 'btn btn-default']) ?>
    </p>

</div>
