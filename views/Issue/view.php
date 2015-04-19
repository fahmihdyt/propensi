<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\issue */

$this->title = $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Issues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="issue-view">
    <!--Mapping Site-->
		
	<!--Detail Header-->
    <h1 style='margin-top:0px; padding-top:15px;'>View Issue : <?= Html::encode($this->title) ?></h1>
    <hr>
    
    <!--Notifikasi-->
    <?php
		foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
			echo '<div class="alert alert-' . $key . '">' . $message . '<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
		}
	?>
    
    <!--Detail Body-->
	<table style='font-size:14px;'>
		<tr height='20'>
			<td><label>Date</label></td>
			<td>: <?php echo $model->tanggal;?></td>
		</tr>
		<tr height='20'>
			<td width="190"><label>Issue</label></td>
			<td>: <?php echo $model->judul;?></td>
		</tr>
		<tr height='20'>
			<td><label>Type</label></td>
			<td>: <?php echo $model->jenis;?></td>
		</tr>
		<tr height='20'>
			<td><label>Status</label></td>
			<td>: <?php echo $model->status;?></td>
		</tr>
		<tr height='20'>
			<td width="100"><label>Creator</label></td>
			<td>: <?php echo $model->findCreator($model->creator);?></td>
		</tr>	
		<tr height='20'>
			<td><label>Location</label></td>
			<td>: <?php echo $model->findLocation($model->siteId);?></td>
		</tr>			
		<tr height='20'>
			<td><label>Notes</label></td>
			<td>:</td>
		</tr>		
	</table>
		<div id='keterangan' style='border:1px solid black; padding:5px; border-radius:5px; margin-bottom:5px;'>
			<?php echo $model->keterangan?>
		</div>
		 <?php
		 	if($model['creator']==Yii::$app->user->identity->nik){ ?>
		 		<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		 		<?= Html::a('Delete', ['delete','id'=>$model->id], ['class' => 'btn btn-primary','onClick'=>"return confirm('Are you sure want to delete this Issue?')"]) ?> 
		  	<?php }
		 ?>
		 <?= Html::a('Back', ['index'], ['class' => 'btn btn-default']) ?><br><br>

   

</div>

<!--
	 'id',
            'tanggal',
            'judul',
            'jenis',
            'keterangan:ntext',
            'status',
            'creator',
            'siteId',
	-->
