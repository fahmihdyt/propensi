<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Akun */

$this->title = 'Update Akun: ' . ' ' . $model->nik;
$this->params['breadcrumbs'][] = ['label' => 'Akuns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nik, 'url' => ['view', 'id' => $model->nik]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akun-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
