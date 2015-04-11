<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SiteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sites';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

	<div style="margin-top: 0px; padding-top: 10px;">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr></div>

    <p>
        <?= Html::a('Create New Site', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    
    <table class='table table-striped'>
    	<thead>
			<tr>
				<th>No.</th>
				<th>Site Name</th>
				<th>Nominal Point</th>
				<th>Antenna Type</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$i=1;
				foreach($data as $row){?>
					<tr>
						<td><?= $i++ ?></td>
						<td><a href="<?php echo Yii::$app->params['url']?>site/view?id=<?php echo $row->id ?>"><?= $row->nama ?></a></td>
						<td><?= $row->titik_nominal ?></td>
						<td><?= $row->tipe_antena ?></td>
						<td>
							<a href="<?php echo Yii::$app->params['url']?>site/update?id=<?php echo $row->id ?>">
								<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit
							</a>&nbsp;
						  	<a href="<?php echo Yii::$app->params['url']?>site/delete?id=<?php echo $row->id ?>" onClick="return confirm('Are you sure want to delete this site?')">
								<span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Delete
							</a>&nbsp;
						</td>
					</tr>
			<?php } ?>
		</tbody>
    </table>

</div>
