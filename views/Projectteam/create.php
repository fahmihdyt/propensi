<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Projectteam */

$this->title = 'Create Projectteam';
$this->params['breadcrumbs'][] = ['label' => 'Projectteams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectteam-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
