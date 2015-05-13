<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyek".
 *
 * @property integer $id
 * @property string $tanggal_mulai
 * @property string $nama
 * @property integer $klienId
 *
 * @property Projectteam[] $projectteams
 * @property Klien $klien
 * @property Site[] $sites
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyek';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['nama', 'required'],
            ['klienId', 'required'],        
            [['klienId'], 'integer'],
            [['nama'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',         
            'nama' => 'Project Name',
            'klienId' => 'Client',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectteams()
    {
        return $this->hasMany(Projectteam::className(), ['proyekId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKlien()
    {
        return $this->hasOne(Klien::className(), ['id' => 'klienId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSites()
    {
        return $this->hasMany(Site::className(), ['proyek' => 'id']);
    }
	
	public function getClient($idclient){
		$result = Yii::$app->db->createCommand("select nama from klien where id=$idclient")->queryOne();
		return $result['nama'];
	}
	
	public static function getProjectName($id){
		$result=Yii::$app->db->createCommand("select nama from proyek where id=$id")->queryOne();
		return $result['nama'];
		
	}
	
}
