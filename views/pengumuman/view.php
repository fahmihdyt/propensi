<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pengumuman */

$this->title = 'View Announcement: '.$model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Pengumuman', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//$jabatan=Yii::$app->user->identity->jabatan;
?>
<div class="pengumuman-view">

	<div style="margin-top: 0px; padding-top: 25px;">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr></div>
    
    <table>
    	<tr>
    		<td><label>Date Posted</label></td>
    		<td><label>: <?= $model->tanggal ?></label></td>	
    	</tr>
    	<tr>
    		<td><label>Creator</label></td>
    		<td><label>: <?= $model->getCreator($model->creator) ?></label></td>	
    	</tr>
    	<tr>
    		<td><label>Content</label></td>
    		<td><label>: </label></td>
    	</tr>
    </table>
    <div id='isi' style='border:1px solid #e0574d; padding:5px; border-radius:5px; margin-bottom:10px;'>
			<?php echo $model->isi?>
	</div>
	
	<?php if(Yii::$app->user->identity->jabatan == "Administrator"){ ?>
		<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Delete', ['delete','id'=>$model->id], ['class' => 'btn btn-primary','onClick'=>"return confirm('Are you sure want to delete this Activity?')"]) ?> 
	<?php } ?>
		 <?= Html::a('Back', ['index'], ['class' => 'btn btn-default']) ?>
		  
    	<br><br>
</div>