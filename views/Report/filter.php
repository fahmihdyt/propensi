<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Project;

//$data=ArrayHelper::map(Project::find()->asArray()->all(),'id','nama'); ?>

<h1 style='margin-top: 0px;padding-top: 25px'>Project Report</h1>

<div class='row'>
	<!------------------------ Dropdown Pemilihan Project -------------------->
	<!-- Dropdown -->
	<div class='col-lg-4'>
		<form method='get' action='<?= Yii::$app->params['url']?>report/filter'>
			<select name='id' class='form-control'>
				<?php foreach($projectList as $row){?>
					<?php if($row['id']==$_GET['id']){
						echo "<option value='$row[id]' selected>$row[nama]</option>";
					}else {
						echo "<option value='$row[id]'>$row[nama]</option>";
					} }
				?>
			</select>				
	</div>
	<!-- Tombol -->
	<div class='col-lg-4' style='margin-left: -20px'>
		<button type='submit' class='btn btn-primary'>Report</button>
		</form>	
		<?= Html::a('Download as DOCX', ['#'], ['class' => 'btn btn-primary']) ?>
	</div>
	

	<!--------------------------- Content ----------------------------------->
	<div class='col-lg-12'>
		<hr>
		<h2 style='text-align: center'>Project <?= $project['nama'] ?></h2>
		<?php
			foreach($site as $row){
				echo "<h5><b>Project $row[nama]</b></h5>";
				$aktivitas=$row->getActivity($row['id']);
				foreach($aktivitas as $rows){
					echo $rows['id'];
				}
				
			}
		?>
	</div>
	
</div>
	

