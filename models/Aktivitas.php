<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aktivitas".
 *
 * @property integer $id
 * @property string $tanggal
 * @property string $judul
 * @property string $status
 * @property string $foto
 * @property string $keterangan
 * @property string $status_approval_pm
 * @property string $status_approval_supervi
 * @property string $creator
 * @property integer $siteId
 *
 * @property Akun $creator0
 * @property Site $site
 */
class Aktivitas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aktivitas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['judul', 'status', 'keterangan','tanggal'], 'required'],
            [['keterangan'], 'string'],
            [['siteId'], 'integer'],
            [['judul'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 30],
            [['foto'], 'file'],
            [['status_approval_pm', 'status_approval_supervi'], 'string', 'max' => 10],
            [['creator'], 'string', 'max' => 12],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal' => 'Date',
            'judul' => 'Activity',
            'status' => 'Status',
            'foto' => 'Photo',
            'keterangan' => 'Notes',
            'status_approval_pm' => 'Status Approval Pm',
            'status_approval_supervi' => 'Status Approval Supervi',
            'creator' => 'Creator',
            'siteId' => 'Site',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator0()
    {
        return $this->hasOne(Akun::className(), ['nik' => 'creator']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'siteId']);
    }
	
	public function getAll(){
		return Yii::$app->db->createCommand('select * from aktivitas')->queryAll();
	}

	public function getNameCreator(){
		return Yii::$app->db->createCommand("select * from akun where nik='".$this->creator."'")->queryOne();
	}
	
	public function findCreator($nik){
		$hasil= Yii::$app->db->createCommand("select * from akun where nik='$nik'")->queryOne();
		return $hasil['nama'];
	}

	public function findLocation($siteId){
		$hasil= Yii::$app->db->createCommand("select * from site where id='$siteId'")->queryOne();
		return $hasil['nama'];
	}

	public function getAllCoor($nik){
		return Yii::$app->db->createCommand("select * from aktivitas where creator='$nik'")->queryAll();
	}
	
	/*
	 * Method for set approval by supervisor true!
	 * @param $id
	 */
	 public function approve($data){
	 	if($data['status']=='approve')
			$statusNote='Approval';
		else
			$statusNote='Reject';
		
	 	$newKeterangan=$data['keterangan'].
		 "<p>
		 	<strong>".$statusNote." Notes:<br></strong>
		 	".date('d/m/Y')." - ".$data['username']." :".$data['notes']."
		 	<br >
		  </p>";
		  
		  if($data['status']=='approve'){
		  	$status=1;
		  }
		  else{
		  	$status=0;
		  }
		  
		  if($data['user']=='Supervisor'){
		  	$sql="update aktivitas set keterangan='$newKeterangan',status_approval_supervi=$status where id=$data[id]";
		  }
		  else if($data['user']=='Project Manager'){
		  	$sql="update aktivitas set keterangan='$newKeterangan',status_approval_pm='$status' where id=$data[id]";
		  }
		  
		 //return $sql;
		 $hasil=Yii::$app->db->createCommand($sql)->execute();
		 return $hasil;
		 
	 	
	 }
	



}
