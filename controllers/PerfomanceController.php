<?php

namespace app\controllers;

use Yii;
use app\models\Project;
use app\models\Aktivitas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Akun;
use app\models\Klien;
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\PhpWord;
use app\models\Barismilestone;




/**
 * BarismilestoneController implements the CRUD actions for Barismilestone model.
 */
class perfomanceController extends Controller
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
    	//validasi: Hanya untuk yang sudah login
    	if (\Yii::$app->user->isGuest || Yii::$app->user->identity->jabatan!='Project Manager') {
            return $this->redirect('/propensi/web');
        }
		
		$model=new Akun();
		$models=$model->find()->all();
		    			
		return $this->render('index',['akun'=>$models]);
		
		$model=$this->findModel($id);
    	$akun=Akun::findAll(['proyek' =>$id]);
		$aktivitas=Aktivitas::findOne(['id'=>$model['klienId']]);

		
		$prjteam=Projectteam::findAll(['proyekId' => $id]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'prjteam' => $prjteam,
            'site' => $site,
            'klien'=> $klien
        ]);
		
		
		
    }
	
  
}
