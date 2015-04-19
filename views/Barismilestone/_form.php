<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Kategori;
use app\models\Site;

/* @var $this yii\web\View */
/* @var $model app\models\Barismilestone */
/* @var $form yii\widgets\ActiveForm */
$data=ArrayHelper::map(Kategori::find()->asArray()->all(),'id','nama');
$data2=ArrayHelper::map(Site::find()->asArray()->all(),'id','nama');
?>

<div class="barismilestone-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tanggal')->textInput(['class' => 'date form-control']) ?>
    <!-- form-class dari bootstrap date itu namanya-->

    <?= $form->field($model, 'kategoriId')->dropDownList($data, ['id' => 'id']) ?>  
      
    <div class = "addKategori"> kategori yang ada inginkan belum ada? <a href="http://localhost/propensi/web/index.php/kategori/create">click this</a> </div>
   
    <div class="form-group">
    	<?php $id=$_GET['id'];    	?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    	<?= Html::a('Cancel', "/propensi/web/index.php/site/view?id=$id", ['class' => 'btn btn-default']) ?>
    	
    </div>

    <?php ActiveForm::end(); ?>

</div>
