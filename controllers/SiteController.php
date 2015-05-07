<?php

namespace app\controllers;

use Yii;
use app\models\Site;
use app\models\SiteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\Aktivitas;
use app\models\Issue;
use app\models\Barismilestone;
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
                    'delete' => ['get'],
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
    		return $this->redirect('/propensi/web');
    	}
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if(!($jabatan=='Project Manager' || $jabatan=='Supervisor')){
			return $this->redirect('/propensi/web/index.php/aktivitas');
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
    		return $this->redirect('/propensi/web');
    	}
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if(!($jabatan=='Project Manager' || $jabatan=='Supervisor')){
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}
		
		$barisms=Barismilestone::findAll(['siteId' => $id]);
    	$activity=Aktivitas::findAll(['siteId' => $id]);
		$issue=Issue::findAll(['siteId' => $id]);
	    return $this->render('view', [
            'model' => $this->findModel($id),
            'barisms' => $barisms,
            'activity' => $activity,
            'issue' => $issue
        ]);
    }

    /**
     * Creates a new Site model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
    	//return $id;
    	if(Yii::$app->user->isGuest){
    		return $this->redirect('/propensi/web');
    	}
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if(!($jabatan=='Project Manager' || $jabatan=='Supervisor')){
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}
		
        $model = new Site();

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
		 	 
			 //store project value
			 $model->proyek=$id;
			 
			 //store File
		 	 $imageName = UploadedFile::getInstance($model, 'foto');
							 			 
			 if(!isset($imageName)){
			 	if($model->save()){
			 		Yii::$app->getSession()->setFlash('success','Project has been Created');
			 		return $this->redirect("/propensi/web/index.php/project/view?id=$id");
			 	}
			 }
			 else{
			 	 //get file extension
				$hasil=explode('.',$imageName);
				$ext=$hasil[count($hasil)-1];
				 
			 	$model->foto = $imageName->name;
			 	$path = 'upload/'.$model->foto;
			 
				//proses save dan upload
				if($model->validate())	{			
			 	if($model->save() ){
			 		Yii::$app->getSession()->setFlash('success','Site has been Created');
                	$imageName->saveAs($path);
                	return $this->redirect("/propensi/web/index.php/project/view?id=$id");
            	} 
            	else {
            		return 'gagal';
            	}
				}}
			 	 
		 }
		 else{
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
		
		$jabatan=Yii::$app->user->identity->jabatan;
		if(!($jabatan=='Project Manager' || $jabatan=='Supervisor')){
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}
		
        $model = $this->findModel($id);

		
		if ($model->load(Yii::$app->request->post()) && $model->validate()){
		 	
			 //store file
		 	 $imageName = UploadedFile::getInstance($model, 'foto');
			 //return $imageName;
			// return $imageName;
			//$model=new Site();
			 if(!isset($imageName)){
			 	if($model->save()){
			 		Yii::$app->getSession()->setFlash('success','Site has been Updated');
			 		//return $this->redirect(['view', 'id'=>$model->id]);
			 		return $this->redirect("/propensi/web/index.php/project/view?id=$model[proyek]");
			 	}
				//return "foto gak kebaca";
			 }
			 else{
			 	$model->foto = $imageName->name;
				// return $imageName->name;
			 	$path = 'upload/'.$model->foto;
			 
				//proses save dan upload
				if($model->save()){
					Yii::$app->getSession()->setFlash('success','Site has been Updated');
                	$imageName->saveAs($path);
                	//return $this->redirect(['view', 'id'=>$model->id]);
					return $this->redirect("/propensi/web/index.php/project/view?id=$model[proyek]");
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
    	$jabatan=Yii::$app->user->identity->jabatan;
		if(!($jabatan=='Project Manager' || $jabatan=='Supervisor')){
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}
		$model=$this->findModel($id);
        $this->findModel($id)->delete();
		Yii::$app->getSession()->setFlash('success','Site has been Deleted');
        //return $this->redirect(['index']);
        return $this->redirect("/propensi/web/index.php/project/view?id=$model[proyek]");
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
