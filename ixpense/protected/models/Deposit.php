<?php

/**
 * This is the model class for table "deposit".
 *
 * The followings are the available columns in table 'deposit':
 * @property string $depid
 * @property string $uid
 * @property string $date
 * @property string $time
 * @property string $deposit_place 
 * @property string $deposit_type
 * @property double $amount
 * @property string $note
 *
 * The followings are the available model relations:
 * @property User $u
 */
class Deposit extends CActiveRecord
{
	public $depsum;
	//public $davgexp;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Deposit the static model class
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
		return 'deposit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, date, time, deposit_type, amount', 'required'),
			array('amount', 'numerical'),
			array('uid', 'length', 'max'=>20),
			array('deposit_type', 'length', 'max'=>30),
			array('deposit_place', 'length', 'max'=>256),
			array('note, deposit_place', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('depid, date, time, deposit_type, deposit_place, amount', 'safe', 'on'=>'search'),
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
			'depid' => 'Deposit ID',
			'uid' => 'User ID',
			'date' => 'Date of deposit',
			'time' => 'Time of deposit',
			'deposit_type' => 'Deposit Type',
			'amount' => 'Amount (' . User::model()->findByPk(Yii::app()->user->id)->usercurrency .')',
			'deposit_place' => 'Place of Deposit',
			'note' => 'Note',
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

		$criteria->compare('depid',$this->depid,true);
		$criteria->compare('uid',Yii::app()->user->id,false);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('deposit_type',$this->deposit_type,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('deposit_place',$this->deposit_place,true);
		
		//$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
			'pageSize'=>10,)
		));
	}
	protected function afterSave()
	{
		$bal = UserBalance::model()->findByPk(Yii::app()->user->id);
		if ($bal !== null)
		{	
			if ($this->isNewRecord)
			{
				$bal->balance = ($bal->balance + $this->amount);
				$bal->save(false);
			}
		}
		parent::afterSave();
	} 
}