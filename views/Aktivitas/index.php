<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Aktivitas;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AktivitasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Activity';
$this->params['breadcrumbs'][] = $this->title;
$model=new Aktivitas();
?>
<div class="aktivitas-index">
	<div style='margin-top:0px;padding-top:10px;'>
    	<h1><?= Html::encode($this->title) ?></h1>
    	<hr>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
	<?php 
	$jabatan=Yii::$app->user->identity->jabatan;
	if( $jabatan == 'Supervisor' || $jabatan== 'Coordinator' || $jabatan=='Administrator'){?>		
    <p>
        <?= Html::a('Create New Activity', ['create'], ['class' => 'btn btn-primary']) ?>
    </p><?php } ?>

	<!--Proses Export Tabel-->
	<table class='table table-striped'>
		<thead style=''>
			<tr>
				<th rowspan='2'>Date</th>
				<th rowspan='2'>Activity</th>
				<th rowspan='2'>Site</th>
				<th rowspan='2'>Creator</th>
				<th colspan='2' style='text-align:center'>Approval</th>
				<th rowspan='2'>Action</th>
			</tr>
			<tr>
				<th>Supervisor</th>
				<th>PM</th>
			</tr>
		</thead>
		<tbody
			<?php
				$i=1;
				foreach($data as $row){
					echo "<tr>";
					echo "<td>".$row['tanggal']."</td>";
					echo "<td><a href='".Yii::$app->params['url']."aktivitas/view?id=$row[id]'>".$row['judul']."</a></td>";
					echo "<td>".$model->findLocation($row['siteId'])."</td>";
					echo "<td>".$model->findCreator($row['creator'])."</td>";
					
					//Status Approval by Supervisor
					if($row['status_approval_supervi']==1){
						echo '<td> Approved </td>';
					}
					else if($row['status_approval_supervi']==0 && !is_null($row['status_approval_supervi'])){
						echo '<td> Rejected </td>';
					}
					else{
						echo '<td></td>';
					}

					//Status Approval by project manager
					if($row['status_approval_pm']==1){
						echo '<td> Approved </td>';
					}
					else if($row['status_approval_pm']==0 && !is_null($row['status_approval_pm'])){
						echo '<td> Rejected </td>';
					}
					else{
						echo '<td></td>';
					}

					//Action									
					echo "<td>";
					
					//Edit & Delete hanya untuk miliknya dan jika belum di approve!
					if($row['creator']== Yii::$app->user->identity->nik && !($row['status_approval_pm']==1 || $row['status_approval_supervi']==1))
					{ ?>
						<a href='<?=Yii::$app->params['url']?>aktivitas/update?id=<?=$row['id']?>'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit </a>
						<a href='<?=Yii::$app->params['url']?>aktivitas/delete?id=<?=$row['id']?>' onClick="return confirm('are you sure want to delete this activity?')"><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Delete </a>
					
					
					<?php }
					//Approval for Supervisor
					if(Yii::$app->user->identity->jabatan == 'Supervisor' || Yii::$app->user->identity->jabatan =='Project Manager'){
						echo "<a href='".Yii::$app->params['url']."aktivitas/approve?id=$row[id]'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>Approve</a>"; 
					}
										
					echo "</td>";
					echo "</tr>";
				}
			?>			
		</tbody>
	</table>
	
	<?php
		foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
			echo '<div class="alert alert-' . $key . '">' . $message . '<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
		}
	?>
	
</div>


