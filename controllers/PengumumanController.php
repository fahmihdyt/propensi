<?php

namespace app\controllers;

use Yii;
use app\models\Pengumuman;
use app\models\PengumumanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PengumumanController implements the CRUD actions for Pengumuman model.
 */
class PengumumanController extends Controller
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
     * Lists all Pengumuman models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(\Yii::$app->user->isGuest) {
        	return $this->redirect('/propensi/web');
        }
		
		if(\Yii::$app->user->identity->jabatan !== "Administrator")	 {
			return $this->redirect('/propensi/web/index.php/home');	
		}
		
		$data = Pengumuman::find()->orderBy(['tanggal' => 'ASC'])->all();
		
        return $this->render('index', ['data' => $data]);
    }

    /**
     * Displays a single Pengumuman model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pengumuman model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(\Yii::$app->user->isGuest) {
        	return $this->redirect('/propensi/web');
        }
		
		if(\Yii::$app->user->identity->jabatan !== "Administrator")	 {
			return $this->redirect('/propensi/web/index.php/home');	
		}
		
        $model = new Pengumuman();
		$model->tanggal = date("Y-m-d");
		//$model->creator = Yii::$app->user->identity->nama;
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	\Yii::$app->getSession()->setFlash('success', "Announcement is successfully created.");
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pengumuman model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing Pengumuman model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(\Yii::$app->user->isGuest) {
        	return $this->redirect('/propensi/web');
        }
		
		if(\Yii::$app->user->identity->jabatan !== "Administrator"){
        	return $this->redirect('/propensi/web');
        }

        $this->findModel($id)->delete();
		\Yii::$app->getSession()->setFlash('success', "Account is successfully deleted.");
        return $this->redirect(['index']);
		
    }

    /**
     * Finds the Pengumuman model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pengumuman the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pengumuman::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
