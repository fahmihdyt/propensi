<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Site */

$this->title = 'Create Site';
$this->params['breadcrumbs'][] = ['label' => 'Sites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-create">

	<div style="margin-top: 0px; padding-top: 10px;">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <!--Notifikasi-->
    <?php
		foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
			echo '<div class="alert alert-' . $key . '">' . $message . '<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
		}
	?>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
