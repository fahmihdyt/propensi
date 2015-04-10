<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Issue;

/* @var $this yii\web\View */
/* @var $searchModel app\models\issueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Issues';
$this->params['breadcrumbs'][] = $this->title;
$model=new Issue();
?>
<div class="issue-index">
	<!--Header Title-->
    <div style='margin-top:0px;padding-top:10px;'>
    	<h1><?= Html::encode($this->title) ?></h1>
    	<hr>
    </div>
    
    <!--Tombol Create New-->
    <p>
        <?= Html::a('Create Issue', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    
    <!--Table-->
    <table class='table table-striped'>
    	<thead>
    		<tr>
    			<th>Date</th>
    			<th>Title</th>
    			<th>Creator</th>
    			<th>Site Location</th>
    			<th>Status</th>
    			<th>Action</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php 
    		$i=1;
    		foreach($data as $row){?>
    		<tr>
    			<td><?= $row['tanggal'] ?></td>
    			<td><a href='<?php echo Yii::$app->params['url']?>issue/view?id=<?= $row['id'] ?>'><?= $row['judul'] ?></a></td>
    			<td><?= $model->findCreator($row['creator']) ?></td>
    			<td><?= $model->findLocation($row['siteId']) ?></td>
    			<td><?= $row['status'] ?></td>
    			<?php if($row['creator']==Yii::$app->user->identity->nik){ ?>
    			<td>
					<a href='<?=Yii::$app->params['url']?>issue/update?id=<?= $row['id']?>'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit </a>
				    <a href="<?=Yii::$app->params['url']?>issue/delete?id=<?= $row['id']?>" onClick="return confirm('are you sure want to delete this issue?')"><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Delete </a>
				</td><?php }else{echo "<td></td>";}?>
       		</tr>
    		<?php } ?>
    	</tbody>
    </table>

   

</div>
