<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Site */

$this->title = 'View Site: '.$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Sites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$idProject = $model->proyek;
$model->proyek = $model->getProject($idProject);

?>
<div class="site-view">

	<div style="margin-top: 0px; padding-top: 10px;">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr></div>
    
    <!--Detail Body-->
	<table style='font-size:14px;'>
		<tr height='20'>
			<td><label>Site ID</label></td>
			<td>: <?php echo $model->siteID;?></td>
		</tr>
		<tr height='20'>
			<td><label>Start Date</label></td>
			<td>: <?php echo $model->tanggal_mulai;?></td>
		</tr>
		<tr height='20'>
			<td><label>Status</label></td>
			<td>: <?php echo $model->status_kerja;?></td>
		</tr>
		<tr height='20'>
			<td width="190"><label>Site Name</label></td>
			<td>: <?php echo $model->nama;?></td>
		</tr>
		<tr height='20'>
			<td width="190"><label>Site Address</label></td>
			<td>: <?php echo $model->alamat;?></td>
		</tr>
		<tr height='20'>
			<td width="190"><label>Final Coordinate</label></td>
			<td>: <?php echo $model->titik_nominal;?></td>
		</tr>
		<tr height='20'>
			<td width="190"><label>Ownership Status</label></td>
			<td>: <?php echo $model->status_kepemilikan;?></td>
		</tr>
		<tr height='20'>
			<td width="190"><label>Antenna Type</label></td>
			<td>: <?php echo $model->tipe_antena;?></td>
		</tr>
		<tr height='20'>
			<td width="190"><label>Project</label></td>
			<td>: <?php echo $model->proyek;?></td>
		</tr>
		
		<tr height='20'>
			<td ><label>Photo</label></td>
			<td>: 
			<?php if($model['foto']!=''){?>
			<a href='<?php echo Yii::$app->params['upload'].$model->foto;?>'>download</a></td>
			<?php }else{ echo "</td>";} ?>	
		</tr>
		<tr height='20'>
			<td width="190" colspan='2'><label>Description</label></td>
			
		</tr>
		<tr>
			<td colspan='2'><?php echo $model->keterangan;?></td>
		</tr>
	</table>
	
	<div class='row'>
	<div class='col-lg-4' style='margin-left:-15px; margin-top:5px;'>
	    <div class="panel panel-red" style='margin-top:10px;'>
	        <div class="panel-heading">
	            <strong>Deadline</strong>
	        </div>
	        <div class="panel-body">
	        	<table class='table table-striped'>
	            	<thead>
	            		<th>Date</th>
	            		<th>Deadline Name</th>
	            	</thead>
	            	<?php foreach($barisms as $row){ ?>
	            	<tr>
	            		<td><?php echo $row['tanggal']; ?></td> 
	            		<td><?php echo $row->getKategoriName($row->kategoriId); ?></td>         		
	            				<td>
					<a href="<?php echo Yii::$app->params['url']?>barismilestone/update?id=<?php echo $row['id']?>">
						<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
					
					<a href="<?php echo Yii::$app->params['url']?>barismilestone/delete?id=<?php echo $row['id']?> " onClick="return confirm('Are you sure want to delete this deadline')">
					<span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
					
				</td>
	            	
	            	</tr><?php } ?>
	            </table>
	            <a href="<?php echo Yii::$app->params['url']?>barismilestone/create?id=<?= $model->id?>" class='btn btn-primary' style='color:white; float:right;'>Create New Deadline</a>&nbsp;
		        
	        </div>
	    </div>
    </div>
    <div class='col-lg-4' style='margin-left:-15px; margin-top:5px;'>
	    <div class="panel panel-red" style='margin-top:10px;'>
	        <div class="panel-heading">
	            <strong>Activity</strong>
	        </div>
	        <div class="panel-body">
	        	<table class='table table-striped'>
	            	<thead>
	            		<th>Activity Name</th>
	            		<th>PIC</th>
	            	</thead>
	            	<?php foreach($activity as $row){ ?>
	            	<tr>
	            		<td><a href="<?php echo Yii::$app->params['url']."aktivitas/view?id=$row[id]"?>"><?php echo $row['judul']; ?></a></td>
	            		<td><?php echo $row->findCreator($row->creator); ?></td>       		
	            	</tr><?php } ?>
	            </table>
	           
	        </div>
	    </div>
    </div>
    <div class='col-lg-4' style='margin-left:-15px; margin-top:5px;'>
	    <div class="panel panel-red" style='margin-top:10px;'>
	        <div class="panel-heading">
	            <strong>Issue</strong>
	        </div>
	        <div class="panel-body">
	        	<table class='table table-striped'>
	            	<thead>
	            		<th>Title</th>
	            		<th>PIC</th>
	            	</thead>
	            	<?php foreach($issue as $row){ ?>
	            	<tr>
	            		<td><a href="<?php echo Yii::$app->params['url']."issue/view?id=$row[id]"?>"><?php echo $row['judul']; ?></a></td>       		
	            		<td><?php echo $row->findCreator($row->creator); ?></td>
	            	</tr><?php } ?>
	            </table>
	            
	        </div>
	    </div>
    </div>
    
    <div class='col-lg-12' style='margin-left:-15px;'>
    	<p>
    		<a href="<?php echo Yii::$app->params['url']?>site/update?id=<?php echo $model->id ?>" class='btn btn-primary'> Edit </a>&nbsp;
			<a href="<?php echo Yii::$app->params['url']?>site/delete?id=<?php echo $model->id ?>" class='btn btn-danger' onClick="return confirm('Are you sure want to delete this project?')">Delete </a>&nbsp;
			<a href="<?php echo Yii::$app->params['url']?>project/view?id=<?php echo $idProject ?>" class='btn btn-default'>Back </a>&nbsp;
		</p>
   </div>
   </div>

</div>
