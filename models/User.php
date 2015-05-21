<?php

namespace app\models;

use Yii;
use \yii\web\IdentityInterface;

/**
 * This is the model class for table "akun".
 *
 * @property string $nik
 * @property string $nama
 * @property string $gender
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $alamat
 * @property integer $jabatan
 * @property string $no_telp
 *
 * @property Aktivitas[] $aktivitas
 * @property Jabatan $jabatan0
 * @property Issue[] $issues
 * @property Pengumuman[] $pengumumen
 * @property Projectteam[] $projectteams
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
	
	public $authKey='simanproPtJAL';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akun';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nik', 'username', 'password'], 'required'],
            ['password','validatePassword']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nik' => 'Nik',
            'username' => 'Username',
            'password' => 'Password',
            'jabatan'  => 'jabatan'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktivitas()
    {
        return $this->hasMany(Aktivitas::className(), ['creator' => 'nik']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJabatan0()
    {
        return $this->hasOne(Jabatan::className(), ['id' => 'jabatan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIssues()
    {
        return $this->hasMany(Issue::className(), ['creator' => 'nik']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengumumen()
    {
        return $this->hasMany(Pengumuman::className(), ['creator' => 'nik']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectteams()
    {
        return $this->hasMany(Projectteam::className(), ['nik' => 'nik']);
    }
	
	public function getId(){
		return $this->nik;
	}
	
	public static function findIdentity($id){
		return User::findOne(['nik'=>$id]);
	}
	
	public static function findByUsername($username)
    {
       		
		if($hasil=User::findOne(['username' => $username])){
			return $hasil;
		}
        return null;
    }
	
	public function validatePassword($passwords,$username)
    {
    	$passwords = md5($passwords);	
    	$password=User::findOne(['username' => $username, 'password' => $passwords]);
        if(count($password)==0){
        	return false;
        }
		else{
			return true;
		}
    }
	
	public function getAuthKey()
    {
    	return $this->authKey;
    }
	
	public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
	
}
