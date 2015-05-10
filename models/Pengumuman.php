<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengumuman".
 *
 * @property integer $id
 * @property string $tanggal
 * @property string $judul
 * @property string $isi
 * @property string $creator
 *
 * @property Akun $creator0
 */
class Pengumuman extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pengumuman';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['judul', 'isi'], 'required'],
            [['isi'], 'string'],
            [['judul'], 'string', 'max' => 100],
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
            'judul' => 'Subject',
            'isi' => 'Content',
            'creator' => 'Creator',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator0()
    {
        return $this->hasOne(Akun::className(), ['nik' => 'creator']);
    }
	
	public function getAdmin()
	{
		$result = Yii::$app->db->createCommand('select nik,nama from akun where jabatan="Administrator"')->queryAll();
		return $result;
	}
	
	public function getCreator($nik)
	{
		$result = Yii::$app->db->createCommand("select nama from akun where nik=$nik")->queryOne();
		return $result['nama'];
	}
	
	public function beforeSave($insert)
	{
		$return = parent::beforeSave($insert);
		$this->creator = Yii::$app->user->identity->nik;		
		return $return;
	}
}
