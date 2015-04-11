<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "klien".
 *
 * @property integer $id
 * @property string $nama
 * @property string $alamat
 * @property string $email
 * @property string $no_telp
 *
 * @property Picklien[] $pickliens
 * @property Proyek[] $proyeks
 */
class Klien extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'klien';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['alamat'], 'string'],
            [['nama'], 'string', 'max' => 100],
            [['email'], 'string', 'max'  => 50],
            [['no_telp'], 'string', 'max' => 30],
            ['email','email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'email' => 'Email',
            'no_telp' => 'No Telp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPickliens()
    {
        return $this->hasMany(Picklien::className(), ['klienId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyeks()
    {
        return $this->hasMany(Proyek::className(), ['klienId' => 'id']);
    }
}
