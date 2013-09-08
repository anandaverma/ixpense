<?php

/**
 * This is the model class for table "expense".
 *
 * The followings are the available columns in table 'expense':
 * @property string $expid
 * @property string $uid
 * @property string $date
 * @property string $time
 * @property string $expense_category
 * @property string $expense_name
 * @property double $amount
 * @property string $expense_place 
 * @property string $note
 * @property string $expense_mode
 * The followings are the available model relations:
 * @property User $u
 */
class Expense extends CActiveRecord
{
	public $expsum;
	public $expamount;
	public $expcat;
	public $totuser;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Expense the static model class
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
		return 'expense';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, date, time, expense_category, expense_name, expense_mode, amount', 'required'),
			array('amount', 'numerical'),
			array('uid', 'length', 'max'=>20),
			array('expense_mode', 'length', 'max'=>20),
			array('expense_category', 'length', 'max'=>30),
			array('expense_name', 'length', 'max'=>40),
			array('expense_place', 'length', 'max'=>256),
			array('note, expense_place', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('expid, date, time, expense_category, expense_name, expense_mode,expense_place, amount', 'safe', 'on'=>'search'),
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
			'expid' => 'Expense ID',
			'uid' => 'User ID',
			'date' => 'Date of expense',
			'time' => 'Time of expense',
			'expense_category' => 'Expense Category',
			'expense_name' => 'Expense Name',
			'expense_mode' => 'Mode of Expense',
			'amount' => 'Amount (' . User::model()->findByPk(Yii::app()->user->id)->usercurrency .')',
			'expense_place' => 'Place of Expense',
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

		$criteria->compare('expid',$this->expid,true);
		$criteria->compare('uid',Yii::app()->user->id,false);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('expense_category',$this->expense_category,true);
		$criteria->compare('expense_name',$this->expense_name,true);
		$criteria->compare('expense_mode',$this->expense_mode,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('expense_place',$this->expense_place,true);
		
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
				$bal->balance = ($bal->balance - $this->amount);
				$bal->save(false);
			}
		}
		parent::afterSave();
	} 
	
}