<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Pengumuman;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Welcome to Sistem Manajemen Proyek PT JAL';
$this->params['breadcrumbs'][] = $this->title;
$data = Pengumuman::find()->all();

?>
<head>
	<link href="<?php echo Yii::$app->params['base']?>css/sb2-admin.css" rel="stylesheet">
</head>

<body>
<center>
	<div style="margin-top: 0px; padding-top: 10px;">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr></div><br>
</center>

<?php foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
		echo '<div class="alert alert-' . $key . '">' . $message . '<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
	  }
?>
	
<?php foreach ($data as $line) { ?>
	<div class="panel panel-red">
		<div class="panel-heading">
			<?= $line->judul; ?>
		</div>
		
		<div class="panel-body">
			<?= $line->isi; ?>
		</div>
		
		<div class="panel-footer">
			Posted by:&nbsp;<?= $line->getCreator($line->creator) ?>&nbsp;on&nbsp;<?= $line->tanggal ?>
		</div>
	</div>
<?php } ?>
</body>