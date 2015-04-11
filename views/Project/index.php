<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

	<div style="margin-top: 0px; padding-top: 10px;">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr></div>

    <p>
        <?= Html::a('Create New Project', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
	
	<table class='table table-striped'>
		<thead>
			<tr>
				<th>No.</th>
				<th>Project Name</th>
				<th>Starting Date</th>
				<th>Client</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$i=1;
				foreach($data as $row){?>
					<tr>
						<td><?= $i++ ?></td>
						<td><a href="<?php echo Yii::$app->params['url']?>project/view?id=<?php echo $row->id ?>"><?= $row->nama ?></a></td>
						<td><?= $row->tanggal_mulai ?></td>
						<td><?= $row->getClient($row->klienId) ?></td>
						<td>
							<a href="<?php echo Yii::$app->params['url']?>project/update?id=<?php echo $row->id ?>">
								<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit
							</a>&nbsp;
						  	<a href="<?php echo Yii::$app->params['url']?>project/delete?id=<?php echo $row->id ?>" onClick="return confirm('Are you sure want to delete this project?')">
								<span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Delete
							</a>&nbsp;
						</td>
					</tr>
				<?php } ?>
			
		</tbody>
	</table>

</div>
