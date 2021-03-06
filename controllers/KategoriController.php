<?php

namespace app\controllers;

use Yii;
use app\models\Kategori;
use app\models\KategoriSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KategoriController implements the CRUD actions for Kategori model.
 */
class KategoriController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Kategori models.
     * @return mixed
     */
    public function actionIndex()
    {
    	if (\Yii::$app->user->isGuest) {
    		return $this->redirect(Yii::$app->params['default']);
    	}
		//supaya org non guest gabisa akses yg lain
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if($jabatan=='Project Manager' || $jabatan=='Supervisor' ||$jabatan=='Coordinator'){
			return $this->redirect(Yii::$app->params['default'].'index.php/home');
		}
				
        $searchModel = new KategoriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kategori model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	if (\Yii::$app->user->isGuest) {
    		return $this->redirect(Yii::$app->params['default']);
    	}
		//supaya org non guest gabisa akses yg lain
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if($jabatan=='Project Manager' || $jabatan=='Supervisor' ||$jabatan=='Coordinator'){
			return $this->redirect(Yii::$app->params['default'].'index.php/home');
		}
		
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
		
		
    }

    /**
     * Creates a new Kategori model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	if (\Yii::$app->user->isGuest) {
    		return $this->redirect(Yii::$app->params['default']);
    	}
		//supaya org non guest gabisa akses yg lain
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if(!($jabatan=='Project Manager' || $jabatan=='Supervisor')){
			return $this->redirect(Yii::$app->params['default'].'index.php/home');
		}
		
        $model = new Kategori();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->goBack();
			
			
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Kategori model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	if (\Yii::$app->user->isGuest) {
    		return $this->redirect(Yii::$app->params['default']);
    	}
		//supaya org non guest gabisa akses yg lain
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if($jabatan=='Coordinator'){
			return $this->redirect(Yii::$app->params['default'].'index.php/home');
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
     * Deletes an existing Kategori model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	
		if (\Yii::$app->user->isGuest) {
    		return $this->redirect(Yii::$app->params['default']);
    	}
		//supaya org non guest gabisa akses yg lain
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if($jabatan=='Coordinator'){
			return $this->redirect(Yii::$app->params['default'].'index.php/home');
		}
		
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Kategori model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kategori the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kategori::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

	public function actionCreates($id)
    {
    	if (\Yii::$app->user->isGuest) {
    		return $this->redirect(Yii::$app->params['default']);
    	}
		//supaya org non guest gabisa akses yg lain
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if(!($jabatan=='Project Manager' || $jabatan=='Supervisor')){
			return $this->redirect(Yii::$app->params['default'].'index.php/home');
		}
		
        $model = new Kategori();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->params['default']."index.php/barismilestone/create?id=$id");
			
			
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

}