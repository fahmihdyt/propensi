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
    			<th>Number of Activity Working</th>
    			<th>Number of Activity Done</th>
    			<th>Performance Score<br>(ontime Done Job/total done Job)</th>	
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
    				<td><?= count($row->getAktivitaswork($row->nik)); ?></td>
    				<td><?= count($row->getAktivitasdone($row->nik)); ?></td>
    				<td><?php if(count($row->getAktivitasdone($row->nik))>0){
    					echo $row->getAktivitassukses($row->nik)/count($row->getAktivitasdone($row->nik))*100;
    					}else{
    						echo "not available";
    					}?></td>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>
    <br><br>
    

</div><br>

