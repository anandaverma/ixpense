<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $uid
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $phone
 * @property string $usercurrency
 * The followings are the available model relations:
 * @property Deposit[] $deposits
 * @property Expense[] $expenses
 */
class User extends CActiveRecord
{
	public $password2;
	public $verifyCode;
	public $balance;
	public $totuser;
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, password2, email, balance, usercurrency', 'required'),
			array('balance, phone', 'numerical'),
                        array('phone', 'length', 'max'=>10, 'min'=>10),
			array('password,password2', 'length', 'max'=>32, 'min'=>6),
			array('username, phone', 'length', 'max'=>20),
			array('usercurrency', 'length', 'max'=>3),
			array('password', 'length', 'max'=>32),
			array('email', 'length', 'max'=>100),
			array('email','email'),
			array('email','unique'),
			array('username','unique'),
                        array('username', 'match', 'pattern'=>'/^([A-Za-z][A-Za-z0-9._]*)+$/'),
			array('password', 'compare', 'compareAttribute'=>'password2'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uid, username, password, email, phone', 'safe', 'on'=>'search'),
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
			'deposits' => array(self::HAS_MANY, 'Deposit', 'uid'),
			'expenses' => array(self::HAS_MANY, 'Expense', 'uid'),
			'user_balance' => array(self::HAS_ONE, 'UserBalance', 'uid'),
			'user_ip' => array(self::HAS_MANY, 'UserIp', 'uid'),
			/*'expsum' => array(self::STAT, 'Expense', 'uid',
                'select'=> 'SUM(amount)',
				'condition'=>'uid=28')*/
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uid' => 'Uid',
			'username' => 'Username',
			'password' => 'Password',
			'password2'=>'Re-Type Password',
			'email' => 'Email',
			'phone' => 'Phone',
			'balance' => 'Balance in your iWallet',
			'usercurrency' => 'Currency',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
        //$criteria->compare('balance',$this->balance);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	//encrypting the password
	public function beforeSave()
        {	
			if ($this->isNewRecord)
			{
            $pass = md5($this->password);
			$this->password = $pass;
			$this->last_login_time = new CDbExpression('NOW()');
			$this->last_login_ip = $_SERVER['REMOTE_ADDR'];
			}
			//$this->activation_code = md5($this->uid . mt_rand() . mt_rand());
			return true;
        }
	
	protected function afterSave()
	{
		//Add balance to user_balance table
		if ($this->isNewRecord)
		{
		$bal = new UserBalance;
		$bal->uid = $this->uid;
		$bal->balance = $this->balance;
		$bal->save(false);
		}
		
		//Add deposit to deposit table for balance amount
		
		if ($this->isNewRecord)
		{
			$depmodel = new Deposit;
			$depmodel->uid = $this->uid;
			$depmodel->date = date('Y-m-d');
			$depmodel->time = new CDbExpression('NOW()');
			$depmodel->deposit_type = 'Cash';
			$depmodel->amount = $this->balance;
			$depmodel->note = 'Opening balance';
			$depmodel->save(false);
		}
		parent::afterSave();
	} 
}