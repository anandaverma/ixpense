<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	 private $_id;
	 
	 public function __construct($username, $password)
    {
        parent::__construct($username, $password); 		 
    }
	 
	 
	 
	public function authenticate()
	{
	$record = User::model()->find('username=:username', 
		array(
		':username'=>$this->username, 
		));
		if($record===null)
		{
            //Yii::trace('a');
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else if($record->password!==md5($this->password))
        { 
			//Yii::trace('b');
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
		else
        {
            $this->_id=$record->uid;
			$this->errorCode=self::ERROR_NONE;
			//Yii::trace('c');
		}
		
		return !$this->errorCode;
	}
	public function getId()
    {
        return $this->_id;
    }
}