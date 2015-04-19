<?php

namespace app\controllers;

use Yii;
use app\models\issue;
use app\models\issueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IssueController implements the CRUD actions for issue model.
 */
class IssueController extends Controller
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
     * Lists all issue models.
     * @return mixed
     */
    public function actionIndex()
    {
    	if (\Yii::$app->user->isGuest) {
            return $this->redirect('/propensiTemp/web');
        }
		
        $data=new Issue();
		$hasil=$data->getAll();
        return $this->render('index', [
            'data' => $hasil,
        ]);
    }

    /**
     * Displays a single issue model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	if (\Yii::$app->user->isGuest) {
            return $this->redirect('/propensiTemp/web');
        }
		
    	$model=$this->findModel($id);
		return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new issue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	if (\Yii::$app->user->isGuest) {
            return $this->redirect('/propensiTemp/web');
        }
		
        $model = new issue();

        if ($model->load(Yii::$app->request->post())) {
        	$model->creator=Yii::$app->user->identity->nik;
        	if($model->save()){
        		Yii::$app->getSession()->setFlash('success','Issue Sucessfully Created!');
        		return $this->redirect(['index']);
        	}
			else{
				return $this->render('create', [
               		'model' => $model,
            	]);
			}            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing issue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	if (\Yii::$app->user->isGuest) {
            return $this->redirect('/propensiTemp/web');
        }
		
        $model = $this->findModel($id);

		if($model['creator']!=Yii::$app->user->identity->nik){
			Yii::$app->getSession()->setFlash('danger','Forbidden to Update!');	
			return $this->redirect(['index']);
		}

        if ($model->load(Yii::$app->request->post())) {
        	$model->creator=Yii::$app->user->identity->nik;
        	if($model->save()){
        		 Yii::$app->getSession()->setFlash('success','Issue Sucessfully Updated!');
        		 return $this->redirect(['index']);
        	}
			else{
				 return $this->render('update', [
                'model' => $model,
            ]);
			}
           
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing issue model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	if (\Yii::$app->user->isGuest) {
            return $this->redirect('/propensiTemp/web');
        }
		
		$model=$this->findModel($id);
		
		if($model['creator']!=Yii::$app->user->identity->nik){
			Yii::$app->getSession()->setFlash('danger','Forbidden to Delete!');	
			return $this->redirect(['index']);
		}
		
        $this->findModel($id)->delete();
		Yii::$app->getSession()->setFlash('success','Issue Successfully Deleted!');	
        return $this->redirect(['index']);
    }

    /**
     * Finds the issue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return issue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
    	if (\Yii::$app->user->isGuest) {
            return $this->redirect('/propensiTemp/web');
        }

        if (($model = issue::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
