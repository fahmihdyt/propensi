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
    		return $this->redirect('/propensi/web');
    	}
		//supaya org non guest gabisa akses yg lain
		
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
    		return $this->redirect('/propensi/web');
    	}
		//supaya org non guest gabisa akses yg lain
		
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
    		return $this->redirect('/propensi/web');
    	}
		//supaya org non guest gabisa akses yg lain
		
        $model = new Klien();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
    		return $this->redirect('/propensi/web');
    	}
		//supaya org non guest gabisa akses yg lain
		
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
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
    		return $this->redirect('/propensi/web');
    	}
		//supaya org non guest gabisa akses yg lain
		
        $this->findModel($id)->delete();

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
    		return $this->redirect('/propensi/web');
    	}
		//supaya org non guest gabisa akses yg lain
		
        if (($model = Klien::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
