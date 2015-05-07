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
            'judul' => 'Judul',
            'isi' => 'Isi',
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
}
