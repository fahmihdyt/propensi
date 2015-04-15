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
			<td><label>ID</label></td>
			<td>: <?php echo $model->id;?></td>
		</tr>
		<tr height='20'>
			<td width="190"><label>Project Name</label></td>
			<td>: <?php echo $model->nama;?></td>
		</tr>
		<tr height='20'>
			<td width="190"><label>Nominal Point</label></td>
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
			<td width="190"><label>Working Status</label></td>
			<td>: <?php echo $model->status_kerja;?></td>
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
	            <strong>Milestone Line</strong>
	        </div>
	        <div class="panel-body">
	        	<table class='table table-striped'>
	            	<thead>
	            		<th>Date</th>
	            		<th>Milestone Name</th>
	            	</thead>
	            	<?php foreach($barisms as $row){ ?>
	            	<tr>
	            		<td><?php echo $row['tanggal']; ?></td> 
	            		<td><a href="<?php echo Yii::$app->params['url']."barismilestone/view?id=$row[id]"?>"><?php echo $row->getKategoriName($row->kategoriId); ?></a></td>         		
	            				<td>
					<a href="<?php echo Yii::$app->params['url']?>barismilestone/update?id=<?php echo $row['id']?>">
						<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
					
					<a href="<?php echo Yii::$app->params['url']?>barismilestone/delete?id=<?php echo $row['id']?> " onClick="return confirm('Are you sure want to delete this project?')">
					<span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
					
				</td>
	            	
	            	</tr><?php } ?>
	            </table>
	            <a href="<?php echo Yii::$app->params['url']?>barismilestone/create" class='btn btn-primary' style='color:white; float:right;'>Create New Milestone</a>&nbsp;
		        
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
	            		<th>Creator</th>
	            	</thead>
	            	<?php foreach($activity as $row){ ?>
	            	<tr>
	            		<td><a href="<?php echo Yii::$app->params['url']."aktivitas/view?id=$row[id]"?>"><?php echo $row['judul']; ?></a></td>
	            		<td><?php echo $row->findCreator($row->creator); ?></td>       		
	            	</tr><?php } ?>
	            </table>
	            <a href="<?php echo Yii::$app->params['url']?>aktivitas/create" class='btn btn-primary' style='color:white; float:right;'>Create New Activity</a>&nbsp;
		        
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
	            		<th>Creator</th>
	            	</thead>
	            	<?php foreach($issue as $row){ ?>
	            	<tr>
	            		<td><a href="<?php echo Yii::$app->params['url']."issue/view?id=$row[id]"?>"><?php echo $row['judul']; ?></a></td>       		
	            		<td><?php echo $row->findCreator($row->creator); ?></td>
	            	</tr><?php } ?>
	            </table>
	            <a href="<?php echo Yii::$app->params['url']?>issue/create" class='btn btn-primary' style='color:white; float:right;'>Create New Issue</a>&nbsp;
		        
	        </div>
	    </div>
    </div>
    
    <div class='col-lg-12' style='margin-left:-15px;'>
    	<p>
    		<a href="<?php echo Yii::$app->params['url']?>site/update?id=<?php echo $model->id ?>" class='btn btn-primary'> Edit </a>&nbsp;
			<a href="<?php echo Yii::$app->params['url']?>site/delete?id=<?php echo $model->id ?>" class='btn btn-danger' onClick="return confirm('Are you sure want to delete this project?')">Delete </a>&nbsp;
			<?= Html::a('Back', ['index'], ['class' => 'btn btn-default']) ?>
    	</p>
   </div>
   </div>

</div>
