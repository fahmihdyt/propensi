<?php

namespace app\controllers;

use Yii;
use app\models\Klien;
use app\models\KlienSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KlienController implements the CRUD actions for Klien model.
 */
 
 
class KlienController extends Controller
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
     * Lists all Klien models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$privilige= Yii::$app->user->identity->jabatan;
		
    	if (\Yii::$app->user->isGuest) {
    		return $this->redirect(Yii::$app->params['default']);
    	}
		//supaya org non guest gabisa akses yg lain
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if($jabatan=='Coordinator'){
			return $this->redirect(Yii::$app->params['default'].'index.php/home');
		}
		
        $searchModel = new KlienSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		$data = Klien::find() -> asArray()-> all();  
		//cari data all
		
		return $this->render('index', [
			//mau kirim data ke view, di view klien yg index.php
			//data yang dikirim adalah data yang didapat dari method find() diatas
			"data2"=> $data, 				
		
		]);
		
    }

    /**
     * Displays a single Klien model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	 $privilige= Yii::$app->user->identity->jabatan;
		 
    	if (\Yii::$app->user->isGuest) {
    		return $this->redirect(Yii::$app->params['default']);
    	}
		//supaya org non guest gabisa akses yg lain
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if($jabatan=='Coordinator'){
			return $this->redirect(Yii::$app->params['default'].'index.php/home');
		}
		
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Klien model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	 $privilige= Yii::$app->user->identity->jabatan;
    	if (\Yii::$app->user->isGuest && $privilege != 'Project Manager') {
    		return $this->redirect(Yii::$app->params['default']);
    	}
		//supaya org non guest gabisa akses yg lain
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if($jabatan=='Coordinator'){
			return $this->redirect(Yii::$app->params['default'].'index.php/home');
		}
		
		
        $model = new Klien();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	\Yii::$app->getSession()->setFlash('success', "Client is successfully created.");
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Klien model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	 $privilige= Yii::$app->user->identity->jabatan;
    	if (\Yii::$app->user->isGuest && $privilege != 'Project Manager') {
    		return $this->redirect(Yii::$app->params['default']);
    	}
		//supaya org non guest gabisa akses yg lain
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if($jabatan=='Coordinator'){
			return $this->redirect(Yii::$app->params['default'].'index.php/home');
		}
		
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('success', "Client is successfully updated.");
            return $this->redirect(['index']);
        }
		
		 else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


	public $layout = "main";
	
    /**
     * Deletes an existing Klien model. 
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	 $privilige= Yii::$app->user->identity->jabatan;
    	if (\Yii::$app->user->isGuest && $privilege != 'Project Manager') {
    		return $this->redirect(Yii::$app->params['default']);
    	}
		//supaya org non guest gabisa akses yg lain
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if($jabatan=='Coordinator'){
			return $this->redirect(Yii::$app->params['default'].'index.php/home');
		}
		
        $this->findModel($id)->delete();

		\Yii::$app->getSession()->setFlash('success', "Client is successfully deleted.");
        return $this->redirect(['index']);
		
		
		
    }

    /**
     * Finds the Klien model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Klien the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
    	 $privilige= Yii::$app->user->identity->jabatan;
    	if (\Yii::$app->user->isGuest) {
    		return $this->redirect(Yii::$app->params['default']);
    	}
		//supaya org non guest gabisa akses yg lain
		
        if (($model = Klien::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
