<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Aktivitas */

$this->title = $model->judul;
?>
<div class="aktivitas-view">
	<!--Mapping Site-->
		
	<!--Detail Header-->
    <h1 style='margin-top:0px; padding-top:25px;'>View Activity : <?= Html::encode($this->title) ?></h1>
    <hr>
    
    <!--Detail Body-->
	<table style='font-size:14px;'>
		<tr height='20'>
			<td><label>Date</label></td>
			<td>: <?php echo $model->tanggal;?></td>
		</tr>
		<tr height='20'>
			<td width="190"><label>Activity</label></td>
			<td>: <?php echo $model->judul;?></td>
		</tr>
		<tr height='20'>
			<td width="100"><label>Creator</label></td>
			<td>: <?= $model->findCreator($model->creator) ?></td>
		</tr>	
		<tr height='20'>
			<td><label>Location</label></td>
			<td>: <?php echo $model->findLocation($model->siteId);?></td>
		</tr>	
		<tr height='20'>
			<td><label>Status</label></td>
			<td>: <?php echo $model->status;?></td>
		</tr>
		
		<tr height='20'>
			<td><label>Approval Supervisor</label></td>
			<td>: <?php if($model['status_approval_supervi']==1){
						echo 'Approved ';
					}
					else if($model['status_approval_supervi']==0 && !is_null($model['status_approval_supervi'])){
						echo 'Rejected';
					}
					else{
						echo '';
					}?></td>
		</tr>
		<tr height='20'>
			<td><label>Approval PM</label></td>
			<td>: <?php if($model['status_approval_pm']==1){
						echo 'Approved';
					}
					else if($model['status_approval_pm']==0 && !is_null($model['status_approval_pm'])){
						echo 'Rejected';
					}
					else{
						echo '';
					}?></td>
		</tr>
		<tr height='20'>
			<td colspan='1'><label>Photo</label></td>
			<td>: </td>
		</tr>
		<tr>
			<?php if($model['foto']!=''){?>
			<td colspan='2'><img src='<?php echo Yii::$app->params['upload'].$model->foto;?>' width='300' height='300' style='border:1px solid black;'></td>
			<?php }else{ echo "<td></td>";} ?>		
		</tr>
		<tr height='40'>
			<td><label>Notes</label></td>
			<td>: </td>
		</tr>		
	</table>
		<div id='keterangan' style='border:1px solid black; padding:5px; border-radius:5px; margin-bottom:10px;'>
			<?php echo $model->keterangan?>
		</div>
		
		 <?php if($model['creator']==Yii::$app->user->identity->nik && !($model['status_approval_pm']==1 || $model['status_approval_supervi']==1)){ ?>
		 	<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		 <?php } ?>
		 <?= Html::a('Back', ['index'], ['class' => 'btn btn-default']) ?>
    	<br><br>

    

</div>
<!--
			'id',
            'tanggal',
            'judul',
            'status',
            'foto',
            'keterangan:ntext',
            'status_approval_pm',
            'status_approval_supervi',
            'creator',
            'siteId',-->