<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aktivitas2".
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
 */
class Aktivitas2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aktivitas2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
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
}
