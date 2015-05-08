<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "issue".
 *
 * @property integer $id
 * @property string $tanggal
 * @property string $judul
 * @property string $jenis
 * @property string $keterangan
 * @property string $status
 * @property string $creator
 * @property integer $siteId
 *
 * @property Akun $creator0
 * @property Site $site
 */
class Issue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'issue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggal', 'judul','keterangan','siteId'], 'required'],
            [['tanggal'], 'safe'],
            [['keterangan'], 'string'],
            [['siteId'], 'integer'],
            [['judul'], 'string', 'max' => 100],
            [['jenis'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 30],
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
            'tanggal' => 'Date',
            'judul' => 'Issue',
            'jenis' => 'Type',
            'keterangan' => 'Notes',
            'status' => 'Status',
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
		return Yii::$app->db->createCommand('select * from issue')->queryAll();
	}

	public function findCreator($nik){
		$hasil=Yii::$app->db->createCommand("select * from akun where nik='$nik'")->queryOne();
		return $hasil['nama'];
	}
	
	public function findLocation($siteId){
		$hasil=Yii::$app->db->createCommand("select * from site where id='$siteId'")->queryOne();
		return $hasil['nama'];
	}
}
