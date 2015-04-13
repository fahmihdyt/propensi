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
    		return $this->redirect('/propensi/web');
    	}
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if(!($jabatan=='Project Manager' || $jabatan=='Supervisor')){
			return $this->redirect('/propensi/web/index.php/aktivitas');
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
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}
		
    	$model=$this->findModel($id);
    	$site=Site::findAll(['proyek' =>$id]);
		$klien=Klien::findOne(['id'=>$model['klienId']]);
		
    	if(Yii::$app->user->isGuest){
    		return $this->redirect('/propensi/web');
    	}
        return $this->render('view', [
            'model' => $model,
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
    		return $this->redirect('/propensi/web');
    	}

		$jabatan=Yii::$app->user->identity->jabatan;
		if(!($jabatan=='Project Manager')){
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}
		
        $model = new Project();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
    		return $this->redirect('/propensi/web');
    	}
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if(!($jabatan=='Project Manager')){
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}
		
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}
		
        $this->findModel($id)->delete();

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
