<?php

namespace app\controllers;

use Yii;
use app\models\Projectteam;
use app\models\ProjectteamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectteamController implements the CRUD actions for Projectteam model.
 */
class ProjectteamController extends Controller
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
     * Lists all Projectteam models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$jabatan=Yii::$app->user->identity->jabatan;
		if(!($jabatan=='Project Manager')){
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}
		
        $searchModel = new ProjectteamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Projectteam model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$jabatan=Yii::$app->user->identity->jabatan;
		if(!($jabatan=='Project Manager')){
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}
		
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Projectteam model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
    	$jabatan=Yii::$app->user->identity->jabatan;
		if(!($jabatan=='Project Manager')){
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}
		
        $model = new Projectteam();

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }*/
        if ($model->load(Yii::$app->request->post())) {
        	
			//store project value
			 $model->proyekId=$id;
			
			if($model->save()){
			 		 return $this->redirect("/propensi/web/index.php/project/view?id=$id");
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
     * Updates an existing Projectteam model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	$jabatan=Yii::$app->user->identity->jabatan;
		if(!($jabatan=='Project Manager')){
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}
		
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $id=$model->proyekId;
			return $this->redirect("/propensi/web/index.php/project/view?id=$id");
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Projectteam model.
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
		
    	$model = $this->findModel($id);
        $id2=$model->proyekId;    	
			
        $this->findModel($id)->delete();

        return $this->redirect("/propensi/web/index.php/project/view?id=$id2");
    }

    /**
     * Finds the Projectteam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projectteam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projectteam::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
