<?php

/**
 * This is the model class for table "user_balance".
 *
 * The followings are the available columns in table 'user_balance':
 * @property string $uid
 * @property double $balance
 *
 * The followings are the available model relations:
 * @property User $u
 */
class UserBalance extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserBalance the static model class
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
		return 'user_balance';
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
			array('balance', 'numerical'),
			array('uid', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uid, balance', 'safe', 'on'=>'search'),
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
			'uid' => 'Uid',
			'balance' => 'Balance',
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

		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('balance',$this->balance);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}