<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Klien */

$this->title = 'Create Klien';
$this->params['breadcrumbs'][] = ['label' => 'Kliens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="klien-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
