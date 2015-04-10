<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Aktivitas2 */


//$this->params['breadcrumbs'][] = ['label' => 'Aktivitas2s', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<h3 style='padding-top:25px; margin-top:0px'>Create Activity</h3>
<hr>
<div class="aktivitas2-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
