<?php

namespace app\controllers;

use Yii;
use app\models\Site;
use app\models\SiteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * SiteController implements the CRUD actions for Site model.
 */
class SiteController extends Controller
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
     * Lists all Site models.
     * @return mixed
     */
    public function actionIndex()
    {
    	if(Yii::$app->user->isGuest){
    		return $this->redirect('/propensitmp/web');
    	}
		
        $searchModel = new SiteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		$data = Site::find()->all();
		
        return $this->render('index', ['data' => $data]);
    }

    /**
     * Displays a single Site model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      	if(Yii::$app->user->isGuest){
    		return $this->redirect('/propensitmp/web');
    	}
	    return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Site model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	if(Yii::$app->user->isGuest){
    		return $this->redirect('/propensitmp/web');
    	}
		
        $model = new Site();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Site model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	if(Yii::$app->user->isGuest){
    		return $this->redirect('/propensitmp/web');
    	}
		
        $model = $this->findModel($id);

		
		if ($model->load(Yii::$app->request->post())){
		 	
			 //store file
		 	 $imageName = UploadedFile::getInstance($model, 'foto');
			 //return $imageName;
			// return $imageName;
			//$model=new Site();
			 if(!isset($imageName)){
			 	if($model->save()){
			 		return $this->redirect(['view', 'id'=>$model->id]);
			 	}
				//return "foto gak kebaca";
			 }
			 else{
			 	$model->foto = $imageName->name;
				// return $imageName->name;
			 	$path = 'upload/'.$model->foto;
			 
				//proses save dan upload
				if($model->save()){
                	$imageName->saveAs($path);
                	return $this->redirect(['view', 'id'=>$model->id]);
            	} else {
                // error in saving model
            	}
			 }		 
		 }
		 else{
		 	return $this->render('update', [
                'model' => $model]);
		 } //end proses upload photo
    }

    /**
     * Deletes an existing Site model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Site model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Site the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Site::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
