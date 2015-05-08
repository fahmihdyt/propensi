<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Project;

/* @var $this yii\web\View */
/* @var $model app\models\Site */
/* @var $form yii\widgets\ActiveForm */

$data = ArrayHelper::map(Project::find()->asArray()->all(),'id', 'nama');
?>

<div class="site-form">

   <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?= $form->field($model, 'siteID')->textInput(['maxlength' => 100]) ?>
    
    <?= $form->field($model, 'tanggal_mulai')->textInput(['maxlength' => 100,'class'=>'date form-control']) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => 100]) ?>
    
    <?= $form->field($model, 'status_kerja')->dropDownList(['survey'=>'Survey','rehunting'=>'Rehunting','rfc'=>'RFC','sitac on going'=>'SITAC on Going','cme on going'=>'CME on Going','rfi'=>'RFI','drop'=>'Drop'],['prompt'=>'-Choose a Site-']) ?>
	    
    <?= $form->field($model, 'alamat')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'titik_nominal')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'status_kepemilikan')->dropDownList(['pemda'=>'Pemda', 'private'=>'Private', 'kawasan'=>'Kawasan','developer'=>'Developer']) ?>

    <?= $form->field($model, 'tipe_antena')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'foto')->fileinput() ?>

   <!--<?php if(isset($_GET['id'])){
		echo $form->field($model, 'proyek')->textInput(['value'=>Project::getProjectName($_GET['id']),'readonly'=>'readonly']);
	}else{
		echo $form->field($model, 'proyek')->dropDownList($data, ['id' => 'proyek']);
	} ?>-->
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
        
        <?php $id=$_GET['id'];    	?>
        <?= Html::a('Cancel', $model->isNewRecord ? "/propensi/web/index.php/project/view?id=$id":"/propensi/web/index.php/site/view?id=$id", ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
