<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "site".
 *
 * @property integer $id
 * @property string $nama
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
            [['keterangan'], 'string'],
            [['proyek'], 'integer'],
            ['nama','required'],
            [['nama', 'status_kerja'], 'string', 'max' => 100],
            [['titik_nominal'], 'string', 'max' => 10],
            [['status_kepemilikan'], 'string', 'max' => 50],
            [['tipe_antena'], 'string', 'max' => 20],
            ['foto', 'file','extensions' => ['png','jpg']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Site Name',
            'titik_nominal' => 'Final Coordinate',
            'status_kepemilikan' => 'Ownership Status',
            'tipe_antena' => 'Antenna Type',
            'keterangan' => 'Description',
            'foto' => 'Photo',
            'status_kerja' => 'Status',
            'proyek' => 'Project',
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
	
	public function getAktivitas($id){
		$aktivitas=Aktivitas::findAll(['siteID'=>$id]);
		return $aktivitas;
	}
}
