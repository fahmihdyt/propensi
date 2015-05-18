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
	

    <table class='table table-striped'>
    	<thead>
    		<tr>
    			<th>No.</th>
    			<th>Name</th>
    			<th>Role</th>
    			<th>Number of Aktivity worked</th>
    			<th>Number of Aktivity pending</th>	
    			<th>Number of Aktivity done</th>	
    		</tr>
    	</thead>
    	
    	<tbody>
    		<?php 
    		$i=1;
			$privilege = Yii::$app->user->identity->jabatan;
			$user = Yii::$app->user->identity->nik;

    		foreach($akun as $row){ ?>
    			<tr>
    				<td><?= $i++ ?></td>
    				<td><?= $row->nama ?></td>
    				<td><?= $row->jabatan ?></td>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>
    <br><br>
    

</div><br>
