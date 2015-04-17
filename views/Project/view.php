<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = 'View Project: '.$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$jabatan=Yii::$app->user->identity->jabatan;
?>
<div class="project-view">

	<div style="margin-top: 0px; padding-top: 25px;">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr></div>
    
    <table>
    	<tr>
    		<td width="130"><label>Project Name</label></td>
    		<td><label>: <?= $model['nama'] ?></label></td>
    	</tr>
    	<tr>
    		<td><label>Date Started</label></td>
    		<td><label>: <?= $model['tanggal_mulai'] ?></label></td>
    	</tr>
    	<tr>
    		<td><label>Client Name</label></td>
    		<td><label>: <?= $klien['nama']?></label></td>	
    	</tr>
    	<tr>
    		<td><label>Client Address</label></td>
    		<td><label>: <?= $klien['alamat']?></label></td>
    	</tr>
    	<tr>
    		<td><label>Client Telephone</label></td>
    		<td><label>: <?= $klien['no_telp'] ?></label></td>
    	</tr>
    		    	
    </table>
    <div class='row'>
    <div class='col-lg-7' style='margin-left:-15px; margin-top:5px;'>
	    <div class="panel panel-red" style='margin-top:10px;'>
	        <div class="panel-heading">
	            <strong>Site on Project</strong>
	        </div>
	        <div class="panel-body">
	        	<table class='table table-striped'>
	            	<thead>
	            		<th>Site Name</th>
	            		<th>Final Coordinate</th>
	            		<th>Work Status</th>
	            	</thead>
	            	<?php foreach($site as $row){ ?>
	            	<tr>
	            		<td><a href="<?php echo Yii::$app->params['url']."site/view?id=$row[id]"?>"><?php echo $row['nama']; ?></a></td>
	            		<td><?php echo $row['titik_nominal']; ?></td>
	            		<td><?php echo $row['status_kerja']; ?></td>            		
	            	</tr><?php } ?>
	            </table>
	            <a href="<?php echo Yii::$app->params['url']?>site/create" class='btn btn-primary' style='color:white; float:right;'>Create New Site</a>&nbsp;
		        
	        </div>
	    </div>
    </div>
       
   <div class='col-lg-12' style='margin-left:-15px;'>
    	<p>
    		<?php if($jabatan == "Project Manager"){ ?>
	    		<a href="<?php echo Yii::$app->params['url']?>project/update?id=<?php echo $model->id ?>" class='btn btn-primary'> Edit </a>&nbsp;
				<a href="<?php echo Yii::$app->params['url']?>project/delete?id=<?php echo $model->id ?>" class='btn btn-danger' onClick="return confirm('Are you sure want to delete this project?')">Delete </a>&nbsp;
			<?php } ?>
			<?= Html::a('Back', ['index'], ['class' => 'btn btn-default']) ?>
    	</p>
   </div>
   </div>
    
</div>
