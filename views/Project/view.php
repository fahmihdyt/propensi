<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = 'View Project: '.$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$idClient = $model->klienId;
$model->klienId = $model->getClient($idClient);

?>
<div class="project-view">

	<div style="margin-top: 0px; padding-top: 10px;">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr></div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama',
            'tanggal_mulai',
            'klienId'
        ],
    ]) ?>
    
    <p>
        <a href="<?php echo Yii::$app->params['url']?>project/update?id=<?php echo $model->id ?>" class='btn btn-primary'> Edit </a>&nbsp;
		<a href="<?php echo Yii::$app->params['url']?>project/delete?id=<?php echo $model->id ?>" class='btn btn-danger' onClick="return confirm('Are you sure want to delete this project?')">Delete </a>&nbsp;
		<?= Html::a('OK', ['index'], ['class' => 'btn btn-default']) ?>
    </p>
    
</div>
