<?php

namespace app\controllers;

use Yii;
use app\models\Barismilestone;
use app\models\BarismilestoneSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Site;
/**
 * BarismilestoneController implements the CRUD actions for Barismilestone model.
 */
class BarismilestoneController extends Controller
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
    	if (\Yii::$app->user->isGuest) {
    		return $this->redirect('/propensi/web');
    	}
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if($jabatan=='Project Manager' || $jabatan=='Supervisor' || $jabatan=='Coordinator'){
			return $this->redirect('/propensi/web/index.php/home');
		}
		//supaya org non guest gabisa akses yg lain
		
        $searchModel = new BarismilestoneSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		
		$data = Barismilestone::find() -> asArray()-> all();  
		//cari data all
		
		return $this->render('index', [
			//mau kirim data ke view, di view klien yg index.php
			//data yang dikirim adalah data yang didapat dari method find() diatas
			"data2"=> $data, 				
		
        ]);
    }

    /**
     * Displays a single Barismilestone model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	if (\Yii::$app->user->isGuest) {
    		return $this->redirect('/propensi/web');
    	}
		//supaya org non guest gabisa akses yg lain
		
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if($jabatan=='Project Manager' || $jabatan=='Supervisor' || $jabatan=='Coordinator'){
			return $this->redirect('/propensi/web/index.php/home');
		}
		
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Barismilestone model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
    	if (\Yii::$app->user->isGuest) {
    		return $this->redirect('/propensi/web');
    	}
		//supaya org non guest gabisa akses yg lain
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if($jabatan=='Coordinator'){
			return $this->redirect('/propensi/web/index.php/home');
		}
		
        $model = new Barismilestone();

        if ($model->load(Yii::$app->request->post())) {
        	
			//store project value
			 $model->siteId=$id;
			
			if($model->save()){
			 		 return $this->redirect("/propensi/web/index.php/site/view?id=$id");
			}
			else{
				return $this->render('create', [
                'model' => $model,
            ]);
			}
		}
           else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    
	}

    /**
     * Updates an existing Barismilestone model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	if (\Yii::$app->user->isGuest) {
    		return $this->redirect('/propensi/web');
    	}
		//supaya org non guest gabisa akses yg lain
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if($jabatan=='Coordinator'){
			return $this->redirect('/propensi/web/index.php/home');
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
     * Deletes an existing Barismilestone model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	if (\Yii::$app->user->isGuest) {
    		return $this->redirect('/propensi/web');
    	}
		//supaya org non guest gabisa akses yg lain
		$jabatan=Yii::$app->user->identity->jabatan;
		if($jabatan=='Coordinator'){
			return $this->redirect('/propensi/web/index.php/home');
		}
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Barismilestone model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Barismilestone the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
    	if (\Yii::$app->user->isGuest) {
    		return $this->redirect('/propensi/web');
    	}
		//supaya org non guest gabisa akses yg lain
		
        if (($model = Barismilestone::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
