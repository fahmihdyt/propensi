<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Project;

// $data=ArrayHelper::map(Project::find()->asArray()->all(),'id','nama'); ?>

<h1 style='margin-top: 0px;padding-top: 25px'>Project Report</h1>
<hr>

<div class='row'>
	<!------------------------ Dropdown Pemilihan Project -------------------->
	<!-- Dropdown -->
	<div class='col-lg-4'>
		<form method='get' action='<?= Yii::$app->params['url']?>report/filter'>
			<select name='id' class='form-control'>
				<?php foreach($project as $row){?>
					<option value='<?= $row['id'] ?>'><?= $row['nama'] ?></option>
				<?php } ?>
			</select>				
	</div>
	<!-- Tombol -->
	<div class='col-lg-4' style='margin-left: -20px'>
		<button type='submit' class='btn btn-primary'>Report</button>
		</form>	
		
	</div>
</div>
	

