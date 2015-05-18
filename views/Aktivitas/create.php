<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Aktivitas */
?>
<div class="aktivitas-create">

	<h1 style='margin-top:0px; padding-top:15px;'>Create Activity</h1>
    <hr>
    
    <!--Notifikasi-->
    <?php
		foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
			echo '<div class="alert alert-' . $key . '">' . $message . '<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
		}
	?>

    <?= $this->render('_form', [
        'model' => $model,
        'site' => $site,
        'proyek'=>$proyek,
    ]) ?>

</div>
