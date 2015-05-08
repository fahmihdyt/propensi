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
		<?= Html::a('Download as DOCX', ['export','id'=>$_GET['id']], ['class' => 'btn btn-primary','onclick'=>"return confirm('Are you sure want to download?')"]) ?>
	</div>
	

	<!--------------------------- Content ----------------------------------->
	<div class='col-lg-12'>
		<hr>
		<h2 style='text-align: center'>Project <?= $project['nama'] ?></h2>
		
		<!-- Data Klien -->
		<h4><i><b>Client Detail</b></i></h4>
		<table>
			<tr>
				<td width='120'><label>Client Name</label></td>
				<td>: <?= $klien->nama ?></td>
			</tr>
			<tr>
				<td width='120'><label>Telephone</label></td>
				<td>: <?= $klien->no_telp?></td>
			</tr>
			<tr>
				<td width='120'><label>Email</label></td>
				<td>: <?= $klien->email?></td>
			</tr>
			<tr>
				<td colspan='2' width='120'><label>Address</label></td>								
			</tr>
			<tr>
				<td colspan='2'><?= $klien->alamat?></td>
								
			</tr>
			
			</table>
		<hr>	
		<!--Site Detail-->
		<h4><i><b>Site Detail</b></i></h4>	
		<?php
			
			/*-----------------Cetak Site------------------------*/
			if(count($site)>0){
			foreach($site as $row){
				echo "<h5><b>Site $row[nama] : $row[status_kerja]</b></h5>";
				$aktivitas=$row->getActivity($row['id']);
				
				/*-------------Cetak Aktivitas-----------------*/
				if(count($aktivitas)>0){
					echo "<table class=table>";
						echo "<thead>
								<th>Tanggal</th>
								<th>Activity</th>
								<th>PIC</th>
								<th>Deadline</th>
								<th>Status</th>
							  </thead>		
						";
					
						echo "<tbody>";	
							foreach($aktivitas as $rows){
								echo "<tr>";
									echo "<td width='120'>".$rows['tanggal']."</td>";
									echo "<td width='120'>".$rows['judul']."</td>";
									echo "<td width='120'>".$rows->findCreator($rows['creator'])."</td>";
									
									$deadline=$rows->getDeadline($rows['type']);
									echo "<td width='120'>".$deadline['tanggal']."</td>";
									echo "<td width='120'>".$rows['status']."</td>";
								echo "</tr>";
							}
						echo "</tbody>";	
					echo "</table>";
				}
				else{
					echo "<i>No Available Activity</i>";
				}
			} //end activity
		}//end site
		else{
			echo "<i>No Available Site</i>";
		}
		?>
	</div>
	
</div>
	

