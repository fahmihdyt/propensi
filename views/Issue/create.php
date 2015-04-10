<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\issue */

$this->title = 'Create Issue';
$this->params['breadcrumbs'][] = ['label' => 'Issues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="issue-create">

    <h1 style='padding-top:15px; margin-top:0px;'><?= Html::encode($this->title) ?></h1>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
