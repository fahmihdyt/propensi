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
    
    <?php
				foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
					echo '<div class="alert alert-' . $key . '">' . $message . '<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
				}
			?>
    
    <table>
    	<tr>
    		<td width="130"><label>Project Name</label></td>
    		<td><label>: <?= $model['nama'] ?></label></td>
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
	            		<th>Starting Date</th>
	            		<th>Site Name</th>
	            		<th>Work Status</th>
	            	</thead>
	            	<?php foreach($site as $row){ ?>
	            	<tr>
	            		<td><?php echo $row['tanggal_mulai']; ?></td>
	            		<td><a href="<?php echo Yii::$app->params['url']."site/view?id=$row[id]"?>"><?php echo $row['nama']; ?></a></td>
	            		<td><?php echo $row['status_kerja']; ?></td>
	            		<td>
							<a href="<?php echo Yii::$app->params['url']?>site/update?id=<?php echo $row['id']?>">
								<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
							
							<a href="<?php echo Yii::$app->params['url']?>site/delete?id=<?php echo $row['id']?> " onClick="return confirm('Are you sure want to delete this site?')">
								<span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
						</td>          		
	            	</tr><?php } ?>
	            </table>
	            <a href="<?php echo Yii::$app->params['url']?>site/create?id=<?= $model->id?>" class='btn btn-primary' style='color:white; float:right;'>Create New Site</a>&nbsp;
		        
	        </div>
	        
	    </div>
	    
    </div>
    <?php if($jabatan == "Project Manager"){ ?>
    <div class='col-lg-5' style='margin-left:-15px; margin-top:5px;'>
	    <div class="panel panel-red" style='margin-top:10px;'>
	        <div class="panel-heading">
	            <strong>Employees</strong>
	        </div>
	        <div class="panel-body">
	        	<table class='table table-striped'>
	            	<thead>
	            		<th>Name</th>
	            		<th>Role</th>
	            	</thead>
	            	<?php foreach($prjteam as $row){ ?>
	            	<tr> 
	            		<td><?php echo $row->getEmployee($row->nik); ?></td>
	            		<td><?php echo $row->getRole($row->nik); ?></td>         		
	            				<td>
					<a href="<?php echo Yii::$app->params['url']?>projectteam/update?id=<?php echo $row['id']?>">
						<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
					
					<a href="<?php echo Yii::$app->params['url']?>projectteam/delete?id=<?php echo $row['id']?> " onClick="return confirm('Are you sure want to unassign this empolyee?')">
					<span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
					
				</td>
	            	
	            	</tr><?php } ?>
	            </table>
	            <a href="<?php echo Yii::$app->params['url']?>projectteam/create?id=<?= $model->id?>" class='btn btn-primary' style='color:white; float:right;'>Assign New Employee</a>&nbsp;
		        
	        </div>
	    </div>
    </div>
    <?php } ?>
       
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
