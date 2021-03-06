<?php

namespace app\controllers;

use Yii;
use app\models\Project;
use app\models\ProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Site;
use app\models\Klien;
use app\models\Projectteam;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
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
     * Lists all Project models.
     * @return mixed
     */
     
    public function actionIndex()
    {
    	if(Yii::$app->user->isGuest){
    		return $this->redirect(Yii::$app->params['default']);
    	}
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if(!($jabatan=='Project Manager' || $jabatan=='Supervisor')){
			return $this->redirect(Yii::$app->params['default'].'index.php/aktivitas');
		}
		
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$data = Project::find()->all();
		
        return $this->render('index', ['data' => $data]);
    }

    /**
     * Displays a single Project model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$jabatan=Yii::$app->user->identity->jabatan;
    	if(!($jabatan=='Project Manager' || $jabatan=='Supervisor')){
			return $this->redirect(Yii::$app->params['default'].'index.php/aktivitas');
		}
		
    	$model=$this->findModel($id);
    	$site=Site::findAll(['proyek' =>$id]);
		$klien=Klien::findOne(['id'=>$model['klienId']]);
		
    	if(Yii::$app->user->isGuest){
    		return $this->redirect(Yii::$app->params['default']);
    	}
		
		$prjteam=Projectteam::findAll(['proyekId' => $id]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'prjteam' => $prjteam,
            'site' => $site,
            'klien'=> $klien
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	if(Yii::$app->user->isGuest){
    		return $this->redirect(Yii::$app->params['default']);
    	}

		$jabatan=Yii::$app->user->identity->jabatan;
		if(!($jabatan=='Project Manager')){
			return $this->redirect(Yii::$app->params['default'].'index.php/aktivitas');
		}
		
        $model = new Project();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	Yii::$app->getSession()->setFlash('success','Project has been created');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	if(Yii::$app->user->isGuest){
    		return $this->redirect(Yii::$app->params['default']);
    	}
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if(!($jabatan=='Project Manager')){
			return $this->redirect(Yii::$app->params['default'].'index.php/aktivitas');
		}
		
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	Yii::$app->getSession()->setFlash('success','Project has been Updated');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	$jabatan=Yii::$app->user->identity->jabatan;
    	if(!($jabatan=='Project Manager')){
			return $this->redirect(Yii::$app->params['default'].'index.php/aktivitas');
		}
		
        $this->findModel($id)->delete();
		Yii::$app->getSession()->setFlash('success','Project has been Deleted');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
