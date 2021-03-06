<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Akun */

$this->title = 'View Account: '.$model->nama;
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
    
    <?php 
    	$privilege = Yii::$app->user->identity->jabatan;
		$user = Yii::$app->user->identity->nik;
    ?>
    <p>
        <?php if($privilege == "Administrator" || $user == $model->nik) { ?>
        <?= Html::a('Update', ['update', 'id' => $model->nik], ['class' => 'btn btn-primary']) ?>
        <?php } ?>
        
        <?php if($privilege == "Administrator") { ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->nik], [
            'class' => 'btn btn-primary',
            'onClick' => 'return confirm("Are you sure you want to delete this account?")',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',

            ],
        ]) ?>
        <?php } ?>
        
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-default']) ?>
    </p>
    
</div>
