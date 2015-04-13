<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Kategori */

$this->title = 'Create Kategori';
$this->params['breadcrumbs'][] = ['label' => 'Kategoris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-create">

  	<div style="margin-top: 0px; padding-top: 10px;">
    <h1><?= Html::encode($this->title) ?></h1>
	<hr></div>
	
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
