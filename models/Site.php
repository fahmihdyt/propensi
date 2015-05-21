<?php

namespace app\models;

use Yii;
use app\models\Aktivitas;

/**
 * This is the model class for table "site".
 *
 * @property integer $id
 * @property string $tanggal_mulai
 * @property string $siteID
 * @property string $nama
 * @property string $alamat
 * @property string $titik_nominal
 * @property string $status_kepemilikan
 * @property string $tipe_antena
 * @property string $keterangan
 * @property string $foto
 * @property string $status_kerja
 * @property integer $proyek
 *
 * @property Aktivitas[] $aktivitas
 * @property Barismilestone[] $barismilestones
 * @property Issue[] $issues
 * @property Proyek $proyek0
 * @property Titikkandidat[] $titikkandidats
 */
class Site extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['nama'],'required'],
            [['tanggal_mulai'], 'safe'],
            [['keterangan'], 'string'],
            [['proyek'], 'integer'],
            [['siteID'], 'string', 'max' => 30],
            [['nama', 'status_kerja'], 'string', 'max' => 100],
            [['alamat'], 'string', 'max' => 255],
            [['titik_nominal'], 'string', 'max' => 10],
            [['status_kepemilikan'], 'string', 'max' => 50],
            [['tipe_antena'], 'string', 'max' => 20],
            [['foto'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal_mulai' => 'Start Date',
            'siteID' => 'Site ID',
            'nama' => 'Name',
            'alamat' => 'Address',
            'titik_nominal' => 'Final Point',
            'status_kepemilikan' => 'Ownership',
            'tipe_antena' => 'Antenna Type',
            'keterangan' => 'Notes',
            'foto' => 'Photo',
            'status_kerja' => 'Status',
            'proyek' => 'Proyek',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktivitas()
    {
        return $this->hasMany(Aktivitas::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBarismilestones()
    {
        return $this->hasMany(Barismilestone::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIssues()
    {
        return $this->hasMany(Issue::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyek0()
    {
        return $this->hasOne(Proyek::className(), ['id' => 'proyek']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTitikkandidats()
    {
        return $this->hasMany(Titikkandidat::className(), ['siteId' => 'id']);
    }
	
	public function getProject($idproject){
		$result = Yii::$app->db->createCommand("select nama from proyek where id=$idproject")->queryOne();
		return $result['nama'];
	}
	
	public function getActivity($id){
		$model=new Aktivitas();
		$aktivitas=$model->findAll(['siteID'=>$id]);
		return $aktivitas;
	}
}
