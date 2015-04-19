<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KlienSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Client'; //judul di tampilannya! must be english
$this->params['breadcrumbs'][] = $this->title;

$privilige= Yii::$app->user->identity->jabatan;

?>
<div class="klien-index">

	<div style="margin-top: 0px; padding-top: 10px;">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr></div>
       	
    <p>
        <?= Html::a('Create New Client', ['create'], ['class' => 'btn btn-primary']) ?>
        <!-- membuat button-->
    </p>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>No.</th>
				<th>Name</th>
				<th>E-mail</th>
				<th>Phone Number</th>	
			
			</tr>
		</thead>
		<tbody>
			<?php $i= 1; foreach($data2 as $row){?>
					<!--looping sepanjang banyaknya data-->
			<tr>
				<td>
					<?= $i++ ?>
					<!--prrint data-->
				</td>
				
				<td>
					<a href="<?php echo Yii::$app->params['url']?>klien/view?id=<?php echo $row['id']?>">
						<?= $row['nama'] ?>
					</a>
				</td>
				
				<td><?= $row['email']?> </td>
				<td><?= $row['no_telp']?> </td>
				
				<?php if($privilege = "Project Manager"){ ?>
				<td>
					<a href="<?php echo Yii::$app->params['url']?>klien/update?id=<?php echo $row['id']?>">
						<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>Edit
					</a>
					
					<a href="<?php echo Yii::$app->params['url']?>klien/delete?id=<?php echo $row['id']?>" onClick="return confirm('Are you sure want to delete this project?')">
					<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>Delete
					</a>
					
				</td>
				<?php }?>
			</tr>
			<?php } ?>
		</tbody>
		
	</table>
    <br><br>
    
    <?php
		foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
			echo '<div class="alert alert-' . $key . '">' . $message . '<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
		}
	?>
    
</div>
