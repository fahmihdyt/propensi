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
class performanceController extends Controller
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
		
	}
	
	public function actionDetailaktivitas($nik){
		$model=new Akun();
		$models=$model->find()->all();
		
		return "cekcek";
	}
	
  
}
