<?php

/**
 * This is the model class for table "user_ip".
 *
 * The followings are the available columns in table 'user_ip':
 * @property string $ipid
 * @property string $ip_address
 * @property string $uid
 * @property string $login_time
 * @property string $logout_time
 *
 * The followings are the available model relations:
 * @property User $u
 */
class UserIp extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserIp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_ip';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid', 'required'),
			array('ip_address, uid', 'length', 'max'=>20),
			array('login_time, logout_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ipid, ip_address, uid, login_time, logout_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'u' => array(self::BELONGS_TO, 'User', 'uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ipid' => 'Ipid',
			'ip_address' => 'Ip Address',
			'uid' => 'Uid',
			'login_time' => 'Login Time',
			'logout_time' => 'Logout Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ipid',$this->ipid,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('login_time',$this->login_time,true);
		$criteria->compare('logout_time',$this->logout_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}