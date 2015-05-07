<?php

namespace app\controllers;

use Yii;
use app\models\Project;
use app\models\Aktivitas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Site;
/**
 * BarismilestoneController implements the CRUD actions for Barismilestone model.
 */
class ReportController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get'],
                ],
            ],
        ];
    }

    /**
     * Lists all Barismilestone models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$model=new Project();
		$models=$model->find()->all();
		
		return $this->render('index',['project'=>$models]);
    }
	
	public function actionFilter(){
		$id=$_GET['id'];
		
		$site=Site::findAll(['proyek'=>$id]);
		return $this->render('index',['project'=>$models]);
		
	}
	
	

   

   
}
