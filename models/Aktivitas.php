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
            [['judul', 'status', 'keterangan'], 'required'],
            [['keterangan'], 'string'],
            [['siteId'], 'integer'],
            [['judul'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 30],
            [['foto'], 'string', 'max' => 200],
            [['status_approval_pm', 'status_approval_supervi'], 'string', 'max' => 10],
            [['creator'], 'string', 'max' => 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal' => 'Tanggal',
            'judul' => 'Judul',
            'status' => 'Status',
            'foto' => 'Foto',
            'keterangan' => 'Keterangan',
            'status_approval_pm' => 'Status Approval Pm',
            'status_approval_supervi' => 'Status Approval Supervi',
            'creator' => 'Creator',
            'siteId' => 'Site ID',
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
	



}
