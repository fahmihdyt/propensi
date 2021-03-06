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
        	return $this->redirect(Yii::$app->params['default']);
        }
		
		if(\Yii::$app->user->identity->jabatan !== "Administrator")	 {
			return $this->redirect(Yii::$app->params['default'].'index.php/home');	
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
        	return $this->redirect(Yii::$app->params['default']);
        }
		
		if(\Yii::$app->user->identity->jabatan !== "Administrator")	 {
			return $this->redirect(Yii::$app->params['default'].'index.php/home');	
		}
		
        $model = new Pengumuman();
		
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
        if(\Yii::$app->user->isGuest) {
        	return $this->redirect(Yii::$app->params['default']);
        }
		
		if(\Yii::$app->user->identity->jabatan !== "Administrator")	 {
			\Yii::$app->getSession()->setFlash('warning', "You have no privilege to update an announcement.");
			return $this->redirect(Yii::$app->params['default'].'index.php/home');	
		}
		
        //$model = $this->findModel($id);
		$model=Pengumuman::findOne(['id'=>$id]);
		$model->tanggal=null;
		if(\Yii::$app->user->identity->nik == $model->creator) {

			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				\Yii::$app->getSession()->setFlash('success', "Announcement is successfully updated.");
            	return $this->redirect(['view', 'id' => $model->id]);
        	} else {
            	return $this->render('update', [
                	'model' => $model,
            	]);
        	}
		// }
		// else{
			// \Yii::$app->getSession()->setFlash('danger', "You have no privilege to update this announcement.");
			// return $this->redirect('/propensi/web/index.php/pengumuman');	
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
        	return $this->redirect(Yii::$app->params['default']);
        }
		
		if(\Yii::$app->user->identity->jabatan !== "Administrator"){
        	return $this->redirect(Yii::$app->params['default'].'home');
        }

        $this->findModel($id)->delete();
		\Yii::$app->getSession()->setFlash('success', "Announcement is successfully deleted.");
        return $this->redirect(['index']);
		
    }
	
	// public function actionHome()
	// {
		// $data = Pengumuman::find()->orderBy(['tanggal' => 'ASC'])->all();
// 		
        // return $this->render('/propensi/web/home', ['data' => $data]);
	// }

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
