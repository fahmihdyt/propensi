<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Klien */

$this->title = 'View Client: '.$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Kliens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="klien-view">

    <div style="margin-top: 0px; padding-top: 25px;">
    	<h1><?= Html::encode($this->title) ?></h1>
    <hr>
    </div>

	<table>
    	<tr>
    		<td width="130"><label>Client Name</label></td>
    		<td><label>: <?= $model['nama'] ?></label></td>
    	</tr>
    	<tr>
    		<td><label>Address</label></td>
    		<td><label>: <?= $model['alamat'] ?></label></td>
    	</tr>
    	<tr>
    		<td><label>E-mail</label></td>
    		<td><label>: <?= $model['email']?></label></td>	
    	</tr>
    		<td><label>Telephone</label></td>
    		<td><label>: <?= $model['no_telp'] ?></label></td>
    	</tr>
    </table>		    	

   <div class='col-lg-12' style='margin-left:-15px;'>
    	<p>
    		<a href="<?php echo Yii::$app->params['url']?>klien/update?id=<?php echo $model->id ?>" class='btn btn-primary'> Edit </a>&nbsp;
			<a href="<?php echo Yii::$app->params['url']?>klien/delete?id=<?php echo $model->id ?>" class='btn btn-danger' onClick="return confirm('Are you sure want to delete this client?')">Delete </a>&nbsp;
			<?= Html::a('Back', ['index'], ['class' => 'btn btn-default']) ?>
    	</p>
   </div>
</div>
