<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AkunSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akun-index">
	
	<div style="margin-top: 0px; padding-top: 10px;">
    <h1><?= Html::encode($this->title) ?></h1>
	<hr></div>
	
    <p>
        <?php 
        	$privilege = Yii::$app->user->identity->jabatan;
			$user = Yii::$app->user->identity->nik;
			if($privilege == "Administrator") { ?>
        <?= Html::a('Create New Account', ['create'], ['class' => 'btn btn-primary']) ?>
        <?php } ?>
    </p>

    <table class='table table-striped'>
    	<thead>
    		<tr>
    			<th>No.</th>
    			<th>Username</th>
    			<th>Name</th>
    			<th>Role</th>
    			<th>Action</th>		
    		</tr>
    	</thead>
    	
    	<tbody>
    		<?php 
    		$i=1;
			$privilege = Yii::$app->user->identity->jabatan;
			$user = Yii::$app->user->identity->nik;
			
    		foreach($data as $row){ ?>
    			<tr>
    				<td><?= $i++ ?></td>
    				<td>
    					<a href="<?php echo Yii::$app->params['url']?>akun/view?id=<?php echo $row->nik ?>"><?= $row->username ?></a>
    				</td>
    				<td><?= $row->nama ?></td>
    				<td><?= $row->jabatan ?></td>
    				<td>
    					<?php if($privilege == "Administrator" || $user == $row->nik){ ?>
    					<a href="<?php echo Yii::$app->params['url']?>akun/update?id=<?php echo $row->nik ?>">
    						<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit  
    					</a>&nbsp;
    					<?php } ?>
    					<?php if($privilege == "Administrator"){ ?>
    					<a href="<?php echo Yii::$app->params['url']?>akun/delete?id=<?php echo $row->nik ?>" onClick="return confirm('Are you sure you want to delete this account?')">
    						<span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Delete  
    					</a>
						<?php } ?>
					</td>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>
    

</div>
