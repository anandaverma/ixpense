<?php

/**
 * This is the model class for table "deposit_type".
 *
 * The followings are the available columns in table 'deposit_type':
 * @property integer $deptypID
 * @property string $deptypname
 */
class DepositType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DepositType the static model class
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
		return 'deposit_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('deptypname', 'required'),
			array('deptypname', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('deptypID, deptypname', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'deptypID' => 'Deptyp',
			'deptypname' => 'Deptypname',
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

		$criteria->compare('deptypID',$this->deptypID);
		$criteria->compare('deptypname',$this->deptypname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}