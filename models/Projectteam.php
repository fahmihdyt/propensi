<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projectteam".
 *
 * @property integer $id
 * @property integer $proyekId
 * @property string $nik
 *
 * @property Proyek $proyek
 * @property Akun $nik0
 */
class Projectteam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projectteam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['proyekId'], 'integer'],
            [['nik'], 'string', 'max' => 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'proyekId' => 'Proyek ID',
            'nik' => 'Nik',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyek()
    {
        return $this->hasOne(Proyek::className(), ['id' => 'proyekId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNik0()
    {
        return $this->hasOne(Akun::className(), ['nik' => 'nik']);
    }
	public function getEmployee($nik){
		$hasil= Yii::$app->db->createCommand("select nama from akun where nik='$nik'")->queryOne();
		return $hasil['nama'];
	}
	public function getRole($nik){
		$hasil= Yii::$app->db->createCommand("select jabatan from akun where nik='$nik'")->queryOne();
		return $hasil['jabatan'];
	}
}
