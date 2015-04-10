<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Aktivitas */

$this->title = 'Create Aktivitas';
$this->params['breadcrumbs'][] = ['label' => 'Aktivitas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aktivitas-create">

	<h1 style='margin-top:0px; padding-top:15px;'>Create Activity</h1>
    <hr>
    

    <?= $this->render('_form', [
        'model' => $model,
        'site' => $site
    ]) ?>

</div>
