<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pengumuman */

$this->title = 'Create Announcement';
$this->params['breadcrumbs'][] = ['label' => 'Pengumumen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengumuman-create">

    <div style="margin-top: 0px; padding-top: 10px;">
    <h1><?= Html::encode($this->title) ?></h1>
	<hr></div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
