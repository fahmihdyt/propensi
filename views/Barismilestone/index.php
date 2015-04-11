<?php

use yii\helpers\Html;
use yii\grid\GridView;
use\app\models\Barismilestone;

$model = new Barismilestone();

/* @var $this yii\web\View */
/* @var $searchModel app\models\BarismilestoneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Barismilestones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barismilestone-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Barismilestone', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>


	<table class="table table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Kategori</th>
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
					<a href="<?php echo Yii::$app->params['url']?>barismilestone/view?id=<?php echo $row['id']?>">
						<?= $row['tanggal'] ?>
					</a>
				</td>
				 																					
				<td><?= $model->getKategoriName($row['kategoriId'])?>
				 </td>
					<td>
					<a href="<?php echo Yii::$app->params['url']?>barismilestone/update?id=<?php echo $row['id']?>">
						<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>Edit
					</a>
					
					<a href="<?php echo Yii::$app->params['url']?>barismilestone/delete?id=<?php echo $row['id']?>">
					<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>Delete
					</a>
					
				</td>
			</tr>
			<?php } ?>
		</tbody>
		
	</table>

	
</div>
