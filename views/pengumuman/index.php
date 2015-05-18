<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PengumumanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Announcement';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengumuman-index">
	
	<div style="margin-top: 0px; padding-top: 10px;">
    <h1><?= Html::encode($this->title) ?></h1>
	<hr></div>
   
    <p>
        <?= Html::a('Create New Announcement', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <table class='table table-striped tables'>
    	<thead>
    		<tr>
    			<th>No.</th>
    			<th>Title</th>
    			<th>Creator</th>
    			<th>Timestamp</th>
    			<th>Action</th>		
    		</tr>
    	</thead>
    	
    	<tbody>
    		<?php 
    		$i=1;
			//$privilege = Yii::$app->user->identity->jabatan;
			//$user = Yii::$app->user->identity->nik;
			
    		foreach($data as $row){ ?>
    			<tr>
    				<td><?= $i++ ?></td>
    				<td><a href="<?php echo Yii::$app->params['url']?>pengumuman/view?id=<?php echo $row->id ?>"><?= $row->judul ?></a></td>
    				<td><?= $row->getCreator($row->creator) ?></td>
    				<td><?= $row->tanggal ?></td>
    				<td>
    					<a href="<?php echo Yii::$app->params['url']?>pengumuman/update?id=<?php echo $row->id ?>">
    						<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit  
    					</a>&nbsp;
    					<a href="<?php echo Yii::$app->params['url']?>pengumuman/delete?id=<?php echo $row->id ?>" onClick="return confirm('Are you sure you want to delete this announcement?')">
    						<span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Delete
    					</a>
					</td>
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
