<?php

namespace app\controllers;

use Yii;
use app\models\Aktivitas;
use app\models\AktivitasSearch;
use app\models\Site;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AktivitasController implements the CRUD actions for Aktivitas model.
 */
class AktivitasController extends Controller
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

	/*Bertanya sebelum menghapus*/
	
	public $layout="main";
	
    /**
     * Lists all Aktivitas models.
     * @return mixed
     */
    public function actionIndex()
    {
    	if (\Yii::$app->user->isGuest) {
            return $this->redirect('/propensi/web');
        }
		
        $searchModel = new AktivitasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$model=new Aktivitas();
		if(Yii::$app->user->identity->jabatan == 'Coordinator'){
			$data=$model->getAllCoor(Yii::$app->user->identity->nik);
		}
		else{
			$data=$model->getAll();
		}
		
        return $this->render('index', [
            'data' => $data
        ]);
    }

    /**
     * Displays a single Aktivitas model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	if (\Yii::$app->user->isGuest) {
            return $this->redirect('/propensi/web');
        }
		$model=$this->findModel($id);
		$name=$model->getNameCreator();
        return $this->render('view', [
            'model' => $model,
            'name'=>$name
        ]);
    }
	
	/**
     * Creates a new Aktivitas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
	 * Hanya untuk supervisor / coordinator / administrator(temp)
     * @return mixed
     */
    public function actionCreate()
    {
    	$jabatan=Yii::$app->user->identity->jabatan;
    	if (\Yii::$app->user->isGuest) {
            return $this->redirect('/propensi/web');
        }
		
		if(!($jabatan=='Project Manager' || $jabatan=='Supervisor' || $jabatan='Administrator')){
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}
			
        $model = new Aktivitas();
		$modelSite=Site::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'site'=>$modelSite,
            ]);
        }
    }

    /**
     * Updates an existing Aktivitas model.
     * If update is successful, the browser will be redirected to the 'view' page.
	 ** Hanya untuk supervisor / coordinator / administrator(temp)
	 * Hanya ketika aktivitas belum di approve
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	$jabatan=Yii::$app->user->identity->jabatan;
		
    	if (\Yii::$app->user->isGuest) {
            return $this->redirect('/propensi/web');
        }
		
		if(!($jabatan=='Project Manager' || $jabatan=='Supervisor' || $jabatan='Administrator')){
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}
		
        $model = $this->findModel($id);
		
		if($model->status_approval_supervi=='1' || $model->status_approval_pm=='1'){
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Aktivitas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
	 * Hanya untuk supervisor / coordinator / administrator(temp)
	 * Hanya ketika belum diapprove 
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	$jabatan=Yii::$app->user->identity->jabatan;
    	if (\Yii::$app->user->isGuest) {
            return $this->redirect('/propensi/web');
        }
		
		if(!($jabatan=='Project Manager' || $jabatan=='Supervisor' || $jabatan='Administrator')){
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}
		
		$model = $this->findModel($id);
		
		if($model->status_approval_supervi=='1' || $model->status_approval_pm=='1'){
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}	
		
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	/**
	 * Approval Method
	 * Untuk melakukan approval dengan diberikan notes di keterangan!
	 * Hanya bisa dilakukan oleh supervisor / project manager / admin
	 */
	 public function actionApprove($id){
	 	if (\Yii::$app->user->isGuest) {
            return $this->redirect('/propensi/web');
        }
		
		if(!($jabatan=='Project Manager' || $jabatan=='Supervisor' || $jabatan='Administrator')){
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}
						
		$model=$this->findModel($id);
		if(!Yii::$app->user->identity->jabatan=='Supervisor' || !Yii::$app->user->identity->jabatan=='Project Manager')
		{
			return $this->redirect('/propensi/web');
		}	
		
		return $this->render('approve',['data'=>$model]);
	 }	
	 
	 /**
	  * Approval Process Method
	  * Hanya untuk Supervisor dan Project Manager
	  */
	  public function actionApproveprocess(){
			
	  	$jabatan=Yii::$app->user->identity->jabatan;
		
		if(!($jabatan=='Supervisor' || $jabatan='Project Manager')){
			return $this->redirect('/propensi/web/index.php/aktivitas');
		}

		if (\Yii::$app->user->isGuest) {
            return $this->redirect('/propensi/web');
        }		
		
	  	 $data=array();	
	  	 $data['id']=$_GET['id'];
	  	 $data['user']=$_GET['user'];
		 $data['status']=$_GET['statusApproval'];
		 $data['notes']=$_GET['notes'];
		 $data['keterangan']=$_GET['keterangan'];
		 $data['username']=$_GET['username'];
		 $data['statusApproval']=$_GET['approveSP'];
		 
		 $model=new Aktivitas();
		 
		 //Approval Supervisor
		 if($data['user']=='Supervisor'){
		 	if($model->approve($data)=='1'){
		 		if($data['status']=='approve')
		 			$this->redirect("/propensi/web/index.php/aktivitas/approve?id=$data[id]&status=suksesApprove");
		 		if($data['status']=='reject')
					$this->redirect("/propensi/web/index.php/aktivitas/approve?id=$data[id]&status=suksesReject");
				}			
		 }
		 //return $model->approve($data)
				
		 //Approval PM
		 if($data['user']=='Project Manager'){
		 	if($data['statusApproval']!=1){
		 		$this->redirect("/propensi/web/index.php/aktivitas/approve?id=$data[id]&status=failApprove");
		 	}
			else if($model->approve($data)=='1'){
				if($data['status']=='approve')
		 			$this->redirect("/propensi/web/index.php/aktivitas/approve?id=$data[id]&status=suksesApprove");
		 		if($data['status']=='reject')
					$this->redirect("/propensi/web/index.php/aktivitas/approve?id=$data[id]&status=suksesReject");
				}	
			}
		 }
	  

    /**
     * Finds the Aktivitas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aktivitas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
   protected function findModel($id)
    {
    	if (\Yii::$app->user->isGuest) {
            return $this->redirect('/propensi/web');
        }
        if (($model = Aktivitas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
