<?php

namespace app\controllers;

use Yii;
use app\models\Akun;
use app\models\AkunSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Sort;

/**
 * AkunController implements the CRUD actions for Akun model.
 */
class AkunController extends Controller
{
    //public $privilege = Yii::$app->user->identity->jabatan;
		
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
     * Lists all Akun models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(\Yii::$app->user->isGuest) {
        	return $this->redirect('/propensi/web');
        }
		
		$data = Akun::find()->orderBy(['jabatan' => 'ASC', 'username' => 'ASC'])->all();
		
        return $this->render('index', ['data' => $data]);
    }

    /**
     * Displays a single Akun model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(\Yii::$app->user->isGuest) {
        	return $this->redirect('/propensi/web');
        }
			
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Akun model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        	
        if(\Yii::$app->user->isGuest) {
        	return $this->redirect('/propensi/web');
        }
		
		if(\Yii::$app->user->identity->jabatan !== "Administrator")	 {
			return $this->redirect('/propensi/web/index.php/akun');	
		}
		
        $model = new Akun();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->nik]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Akun model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(\Yii::$app->user->isGuest) {
        	return $this->redirect('/propensi/web');
        }
		
		$model = $this->findModel($id);
		
		if(\Yii::$app->user->identity->nik == $model->nik || \Yii::$app->user->identity->jabatan == "Administrator" )	 {
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
            	return $this->redirect(['view', 'id' => $model->nik]);
        	} else {
            	return $this->render('update', [
                	'model' => $model,
            	]);
        	}	
		} else {
			return $this->redirect('/propensi/web/index.php/akun');	
		}
		
	
        
    }

    /**
     * Deletes an existing Akun model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
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

		if(\Yii::$app->user->identity->nik !== $id){
        	$this->findModel($id)->delete();
        	return $this->redirect(['index']);
		}
		
		else{
			return $this->redirect(['index']);
		}
    }

    /**
     * Finds the Akun model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Akun the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
	    if (($model = Akun::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
