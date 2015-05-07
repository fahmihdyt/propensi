public function getProject($idproject){
		$result = Yii::$app->db->createCommand("select nama from proyek where id=$idproject")->queryOne();
		return $result['nama'];
	}
	
	public function getActivity($id){
		$model=new Aktivitas();
		$aktivitas=$model->findAll(['siteID'=>$id]);
		//$aktivitas=Aktivitas::findAll(['siteID'=>$id]);
		return $aktivitas;
	}