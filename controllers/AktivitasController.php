<?php

namespace app\controllers;

use Yii;
use app\models\Aktivitas;
use app\models\AktivitasSearch;
use app\models\Site;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use app\models\Barismilestone;
use app\models\Projectteam;

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
    	//validasi: Hanya untuk yang sudah login
    	if (\Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->params['default']);
        }
		
        $searchModel = new AktivitasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$model=new Aktivitas();
		
		//Validasi : ketika kordinator -> hanya menampilkan miliknya
		if(Yii::$app->user->identity->jabatan == 'Coordinator'){
			//$data=$model->findAll(["creator" => Yii::$app->user->identity->nik]);
			$data=$model->find()->where(['creator'=>Yii::$app->user->identity->nik])->orderBy('id DESC')->all();
		}
		else{
			$data=$model->find()->orderBy('id DESC')->all();
		}
		
        return $this->render('index',[
            'data' => $data
        ]);
    }

    /**
     * Displays a single Aktivitas model.
	 * Hanya bisa dilihat oleh yang punyanya saja klo dia supervisor
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$model=$this->findModel($id);
		
		//validasi: Hanya untuk yang sudah login
    	if (\Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->params['default']);
        }
		
		//validasi: ketika coor, hanya mampu melihat yang dibuatnya saja
		if(Yii::$app->user->identity->jabatan=='Coordinator'){
			if($model['creator']!=Yii::$app->user->identity->nik){
				Yii::$app->getSession()->setFlash('warning','Forbidden to view!');
				return $this->redirect(['index']);
			}
		}	
		
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
		
		//Validasi : Hanya untuk yang sudah login
    	if (\Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->params['default']);
        }
		
		//validasi kalo belum diassign dimana
		
		
		//Validasi : hanya dapat dilakukan oleh PM, Supervisor, Admin (temp)
		if(!($jabatan=='Project Manager' || $jabatan=='Supervisor' || $jabatan='Administrator')){
			Yii::$app->getSession()->setFlash('danger','Forbidden to Create Project');
			return $this->redirect(['index']);
		}
			
        $model = new Aktivitas();
		$modelSite=Site::find()->all();
		$project=Projectteam::findAll(['nik'=>Yii::$app->user->identity->nik]);
		
		
		//validasi kalo belum diassign dimanamana
		if(count($project)==0){
			Yii::$app->getSession()->setFlash('danger','You`re not assigned in any project team');
			return $this->redirect(['index']);
		}
		
		 if ($model->load(Yii::$app->request->post()) && $model->validate()){
		 		 	 
			 //store File
		 	 $imageName = UploadedFile::getInstance($model, 'foto');
			 $model->creator=Yii::$app->user->identity->nik;	
			 			 			 
			 if(!isset($imageName)){
			 	if($model->save()){
			 		// return "masuk";	
			 		\Yii::$app->getSession()->setFlash('success', "Activity is successfully created");
            	    return $this->redirect(['index']);
			 	}
			 }else{
			 	 //get file extension
				$hasil=explode('.',$imageName);
				$ext=$hasil[count($hasil)-1];
				
				//validasi file : file format
				if(!($ext=='zip' || $ext=='zip' || $ext=='rar')){
					Yii::$app->getSession()->setFlash('danger','Foto - foto harus di zip terlebih dahulu');
					return $this->render('create',['model'=>$model,'site'=>$modelSite,'proyek'=>$project]);
					//return $this->redirect(['create']);
				}
				 
			 	$model->foto = $imageName->name;
			 	$path = 'upload/'.$model->foto;
			 
				//proses save dan upload
				if($model->save()){
	               	$imageName->saveAs($path);
					\Yii::$app->getSession()->setFlash('success', "Activity is successfully created");
            	   	return $this->redirect(['index']);
	            }else {
	            	return $this->render('create', [
	                'model' => $model,
	                'site'=>$modelSite,
	                'proyek'=>$project
	            ]);
	            }
			}
				
		 }else{
		 	return $this->render('create', [
                'model' => $model,
                'site'=>$modelSite,
                'proyek'=>$project
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
		
		//validasi : hanya untuk yang sudah login
    	if (\Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->params['default']);
        }
		
		//validasi : hanya dapat dilakukan oleh PM, Supervisor, Admin
		if(!($jabatan=='Project Manager' || $jabatan=='Supervisor' || $jabatan='Administrator')){
			Yii::$app->getSession()->setFlash('danger','Forbidden to Create Project');
			return $this->redirect(['index']);
		}
		
        $model = $this->findModel($id);
		$project=Projectteam::findAll(['nik'=>Yii::$app->user->identity->nik]);
		//$model->project='cobacoba';
		//validasi kalo belum diassign dimanamana
		if(count($project)==0){
			Yii::$app->getSession()->setFlash('danger','You`re not assigned in any project team`');
			return $this->redirect(['index']);
		}
		
		//set default foto file
		if(!is_null($model['foto'])){
			$foto=$model['foto'];
		}
		
		
		//Validasi : hanya dapat dilakukan ketika belum diapprove!
		if($model->status_approval_supervi=='1' || $model->status_approval_pm=='1'){
			Yii::$app->getSession()->setFlash('danger','Activity Has Been Approved!');	
			return $this->redirect(['index']);
		}
		
		//Validasi : hanya dapat dilakukan oleh pemilik aktivitas
		if($model['creator']!=Yii::$app->user->identity->nik){
			Yii::$app->getSession()->setFlash('danger','Forbidden to Update!');	
			return $this->redirect(['index']);
		}
		
		//mulai proses upload photo
		if ($model->load(Yii::$app->request->post())&&$model->validate()){
		 	
			 //store file
		 	 $imageName = UploadedFile::getInstance($model, 'foto');
			 $model->creator=Yii::$app->user->identity->nik;
			
			 if(!isset($imageName)){
			 	//set foto link before
			 	if(isset($foto)){
			 		$model->foto=$foto;
			 	}
			 	if($model->save()){			 		
			 		\Yii::$app->getSession()->setFlash('success', "Activity is successfully updated.");
            		return $this->redirect(['index']);
			 	}
			 }
			 else{
			 	
			 	//get file extension
				$hasil=explode('.',$imageName);
				$ext=$hasil[count($hasil)-1];
				
				//validasi file : file format
				if(!($ext=='rar' || $ext=='7z' || $ext=='zip')){
					Yii::$app->getSession()->setFlash('danger','Foto harus di zip terlebih dahulu!');
					return $this->render('update',['model'=>$model,'project'=>$project]);
					//return $this->redirect(['create']);
				}
				
				
			 	$model->foto = $imageName->name;
			 	$path = 'upload/'.$model->foto;
			 
				//proses save dan upload
				if($model->save()){
                	$imageName->saveAs($path);
					\Yii::$app->getSession()->setFlash('success', "Activity is successfully updated.");
                	return $this->redirect(['index']);
            	} else {
                // error in saving model
            	}
			 }		 
		 }
		 else{
		 	return $this->render('update', [
                'model' => $model,'project'=>$project,'project'=>$project]);
		 } //end proses upload photo
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
            return $this->redirect(Yii::$app->params['default']);
        }
		
		if(!($jabatan=='Project Manager' || $jabatan=='Supervisor' || $jabatan='Administrator')){
			Yii::$app->getSession()->setFlash('danger','Forbidden to Delete!');		
			return $this->redirect(['index']);
		}
		
		$model = $this->findModel($id);
				
		if($model->status_approval_supervi=='1' || $model->status_approval_pm=='1'){
			Yii::$app->getSession()->setFlash('danger','Activity Has Been Approved!');	
			return $this->redirect(Yii::$app->params['default'].'index.php/aktivitas');
		}	
		
		if($model['creator']!=Yii::$app->user->identity->nik){
			Yii::$app->getSession()->setFlash('danger','Forbidden to Delete!');	
			return $this->redirect(['index']);
		}
		
        $this->findModel($id)->delete();
		Yii::$app->getSession()->setFlash('success','Activity is succesfully Deleted');
        return $this->redirect(['index']);
    }
	
	/**
	 * Approval Method
	 * Untuk melakukan approval dengan diberikan notes di keterangan!
	 * Hanya bisa dilakukan oleh supervisor / project manager / admin
	 */
	 public function actionApprove($id){
	 	$jabatan=Yii::$app->user->identity->jabatan;
	 	if (\Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->params['default']);
        }
		
		if(!($jabatan=='Project Manager' || $jabatan=='Supervisor' || $jabatan='Administrator')){
			return $this->redirect(Yii::$app->params['default'].'index.php/aktivitas');
		}
						
		$model=$this->findModel($id);
		if(!(Yii::$app->user->identity->jabatan=='Supervisor' || Yii::$app->user->identity->jabatan=='Project Manager'))
		{
			Yii::$app->getSession()->setFlash('danger','Forbidden to Approve!');	
			return $this->redirect(['index']);
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
			return $this->redirect(Yii::$app->params['default'].'index.php/aktivitas');
		}

		if (\Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->params['default']);
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
		 		if($data['status']=='approve'){
		 			Yii::$app->getSession()->setFlash('success','Activity Sucessfully Approved!');
		 			$this->redirect(Yii::$app->params['default']."index.php/aktivitas/approve?id=$data[id]");}
		 		if($data['status']=='reject'){
		 			Yii::$app->getSession()->setFlash('success','Activity Sucessfully Rejected!');
					$this->redirect(Yii::$app->params['default']."index.php/aktivitas/approve?id=$data[id]");}
				}			
		 }
		 //return $model->approve($data)
				
		 //Approval PM
		 if($data['user']=='Project Manager'){
		 	if($data['statusApproval']!=1){
		 		//$this->redirect("/propensi/web/index.php/aktivitas/approve?id=$data[id]&status=failApprove");
		 		Yii::$app->getSession()->setFlash('danger','Activity Should be Approved by Supervisor before!');
				$this->redirect(Yii::$app->params['default']."index.php/aktivitas/approve?id=$data[id]");
			}
			else if($model->approve($data)=='1'){
				if($data['status']=='approve'){
		 			Yii::$app->getSession()->setFlash('success','Activity Sucessfully Approved!');
		 			$this->redirect(Yii::$app->params['default']."index.php/aktivitas/approve?id=$data[id]");}
		 		if($data['status']=='reject'){
					Yii::$app->getSession()->setFlash('success','Activity Succesfully Rejected!');
					$this->redirect(Yii::$app->params['default']."index.php/aktivitas/approve?id=$data[id]");}
				}	
			}
		 }
	  
	 public function actionLists($id)
    {
        $countPosts = Barismilestone::find()
                ->where(['siteId' => $id])
                ->count();
 
        $posts = Barismilestone::find()
                ->where(['siteId' => $id])
                ->orderBy('id DESC')
                ->all();
 
        if($countPosts>0){
        	echo "<option value=''></option>";
            foreach($posts as $post){
                echo "<option value='".$post->id."'>".$post->getKategoriName($post['kategoriId'])."</option>";
            }
        }
        else{
            echo "<option value=''>-</option>";
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
