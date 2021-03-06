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
        	return $this->redirect(Yii::$app->params['default']);
        }
		
		$data = Akun::find()->orderBy(['jabatan' => 'ASC', 'nama' => 'ASC'])->all();
		
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
        	return $this->redirect(Yii::$app->params['default']);
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
        	return $this->redirect(Yii::$app->params['default']);
        }
		
		if(\Yii::$app->user->identity->jabatan !== "Administrator")	 {
			\Yii::$app->getSession()->setFlash('danger', "You have no privilege to create a new account.");
			return $this->redirect(Yii::$app->params['default'].'index.php/akun');	
		}
		
        $model = new Akun();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	\Yii::$app->getSession()->setFlash('success', "Account is successfully created.");
            return $this->redirect(['index']);
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
        	return $this->redirect(Yii::$app->params['default']);
        }
		
		$model = $this->findModel($id);
		
		if(\Yii::$app->user->identity->nik == $model->nik || \Yii::$app->user->identity->jabatan == "Administrator" )	 {
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
            	\Yii::$app->getSession()->setFlash('success', "Account is successfully updated.");
            	return $this->redirect(['index']);
        	} else {
            	return $this->render('update', [
                	'model' => $model,
            	]);
        	}	
		} else {
			\Yii::$app->getSession()->setFlash('danger', "You have no privilege to update this account.");
			return $this->redirect(Yii::$app->params['default'].'index.php/akun');	
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
        	return $this->redirect(Yii::$app->params['default']);
        }
		
		if(\Yii::$app->user->identity->jabatan !== "Administrator"){
        	\Yii::$app->getSession()->setFlash('danger', "You have no privilege to delete this account.");
        	return $this->redirect(['index']);
        }

		if(\Yii::$app->user->identity->nik !== $id){
        	$this->findModel($id)->delete();
			\Yii::$app->getSession()->setFlash('success', "Account is successfully deleted.");
        	return $this->redirect(['index']);
		}
		
		else{
			\Yii::$app->getSession()->setFlash('danger', "Account can't be deleted.");
			return $this->redirect(['index']);
		}
    }
	
	// public function actionChangepassword($id)
 	// {      
    	// $model = $this->findModel($id);
    	// $model->setScenario('changePassword');
//  
        // $model->password = ($model->newPassword);
//  
        // if($model->load(Yii::$app->request->post()) && $model->save())
        	// return $this->redirect(['index']);
       	// else
        	// return $this->render('changepassword', ['model' => $model]);
 // }

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