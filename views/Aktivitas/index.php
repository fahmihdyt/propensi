<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Aktivitas;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AktivitasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aktivitas';
$this->params['breadcrumbs'][] = $this->title;
$model=new Aktivitas();
?>
<div class="aktivitas-index">
	<div style='margin-top:0px;padding-top:10px;'>
    	<h1><?= Html::encode($this->title) ?></h1>
    	<hr>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Aktivitas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

	<!--Proses Export Tabel-->
	<table class='table table-striped'>
		<thead style=''>
			<tr>
				<th rowspan='2'>No.</th>
				<th rowspan='2'>Date</th>
				<th rowspan='2'>Activity</th>
				<th rowspan='2'>Site</th>
				<th rowspan='2'>Creator</th>
				<th colspan='2' style='text-align:center'>Approval</th>
				<th rowspan='2'>Action</th>
			</tr>
			<tr>
				<th>Supervisor</th>
				<th>PM</th>
			</tr>
		</thead>
		<tbody
			<?php
				$i=1;
				foreach($data as $row){
					echo "<tr>";
					echo "<td>".$i++."</td>";
					echo "<td>".$row['tanggal']."</td>";
					echo "<td><a href='".Yii::$app->params['url']."aktivitas/view?id=$row[id]'>".$row['judul']."</a></td>";
					echo "<td>".$model->findLocation($row['siteId'])."</td>";
					echo "<td>".$model->findCreator($row['creator'])."</td>";
					echo "<td>".$row['status_approval_supervi']."</td>";
					echo "<td>".$row['status_approval_pm']."</td>";
					echo "<td>
						  <a href='".Yii::$app->params['url']."aktivitas/update?id=$row[id]'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit </a>
						  <a href='".Yii::$app->params['url']."aktivitas/delete?id=$row[id]'?><?php><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Delete </a>".
						  "</td>";
					echo "</tr>";
				}
			?>			
		</tbody>
	</table>
	
</div>
