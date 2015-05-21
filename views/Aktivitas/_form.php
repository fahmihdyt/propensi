<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Site;
use app\models\Project;
use app\models\Barismilestone;
use yii\helpers\Url;
//use yii\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Aktivitas */
/* @var $form yii\widgets\ActiveForm */

//Set nilai siteId
/*$sites='';
foreach($site as $row){
	$sites.=$row['id'].",";
}
$sites=substr($sites, 0,strlen($sites)-1);*/
$data=ArrayHelper::map(Site::find()->asArray()->all(),'id','nama');
$query="(";
foreach($proyek as $row){
	$query.="proyek='$row[proyekId]'||";
}

$query=substr($query,0,strlen($query)-2);
$query.=')';

?>


<div class="aktivitas-form">
	
	<?php
		$site=new Site();
		if($model->isNewRecord){
			$project='';
		}
		else{
			$site=Site::findOne(['id'=>$model->siteId]);
			$project=Project::findOne(['id'=>$site->proyek]);
			$project=$project->nama;
		}		
	?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?> <!--Enctype untuk allow upload photo-->

	<?= $form->field($model, 'tanggal')->textInput(['class'=>'date form-control','placeholder'=>'Tanggal Aktivitas']) ?>
	
	<?= $form->field($model, 'judul')->textInput(['maxlength' => 100,'placeholder'=>'Nama Aktivitas']) ?>
	
	
	<?= $form->field($model, 'siteId')->dropDownList(
				ArrayHelper::map(Site::find()->where($query)->asArray()->all(),
			    'id',
			    function($model, $defaultValue) {
			        return 'Site '.$model['nama'].' - '.Site::getProject($model['proyek']);
			    }
			),
			['prompt'=>'-Choose a Category-',
            'onchange'=>'
             $.get( "'.Url::toRoute('aktivitas/lists').'", { id: $(this).val() } )
                            .done(function( data )
                   {
                              $( "select#tanggal" ).html( data );
                            });
                        ']); ?> 
	
	<?php 
	$dataPost=ArrayHelper::map(Barismilestone::find()->asArray()->all(), 'id', 'tanggal');
    echo $form->field($model, 'type')->dropDownList(
            ArrayHelper::map(Barismilestone::find()->asArray()->all(), 'id', 
            	function($model, $defaultValue) {
			        return Barismilestone::getKategoriNames($model['id']);
			    }),           
            ['prompt'=>'-Choose one-','id'=>'tanggal']
        ); ?>
    	
    <?= $form->field($model, 'status')->dropDownList([''=>'','Start'=>'start','On Process'=>'on Process','Done'=>'Done']) ?>

    <?= $form->field($model, 'foto')->fileInput()->hint('<i>foto-foto harus dizip/rar terlebih dahulu</i>') ?> <!--Form untuk upload photo-->

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 10,'require'=>'require']) ?>
      
     
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    	<?= Html::a('Cancel', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
