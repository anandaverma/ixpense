<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	 
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			)
			
		);
	}
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
	 //Yii::trace($_GET[id]);
	 //Yii::trace(Yii::app()->user->id);
	 //Yii::trace(Yii::app()->user->name);
	 
		return array(
			array('allow',  // allow all users to perform 'create' actions (registration)
				'actions'=>array('create','captcha'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'create' actions (registration)
				'actions'=>array('passwordreset'),
				'users'=>array('@'),
			),
			array('allow',  //allow respective user to delete, update, view his details
				'actions'=>array('delete','view','update',),
				'users'=>array(Yii::app()->user->name),
                'expression' => '(Yii::app()->user->id == ($_GET[\'id\']))',
			),
	                /* 
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','view','index','update'),
				'users'=>array('admin'),
			), */
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		Yii::app()->clientScript->registerMetaTag('Create your account and start using iXpense', 'description', null, array('lang' => 'en'));
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
			{
                                 /*pearmail
                                 ////edited on 30-oct-2011 at 8:45PM
                                 include('Mail.php');
                                 $headers['From'] = Yii::app()->params['adminEmail'];
                                 $headers['To'] = $model->email;
                                 $headers['Subject'] = 'Welcome to iXpense';
                                 $params["host"] = "localhost";
                                 $params["port"] = "25";
                                 $params["auth"] = false;
                                 $params["username"] = "username";
                                 $params["password"] = "password";

                                 $body = 'Welcome ' . $model->username . ' to iXpense, You account has been successfully created. Thank You';

                                 $mail_object =& Mail::factory('smtp', $params);
                                 $mail_object->send($model->email, $headers, $body);
                                //edited on 30-oct-2011 at 8:45PM
                                */
                                 
                                //html mail
                                ini_set("SMTP", "localhost");
                                ini_set("smtp_port", "25");
                                ini_set("auth", false);
                                ini_set("username", "username");
                                ini_set("password", "password");

                                $to = $model->email;

                                $subject = 'Welcome to iXpense';

                                $headers = "From: " . strip_tags(Yii::app()->params['adminEmail']) . "\r\n";
                                $headers .= "Reply-To: ". strip_tags(Yii::app()->params['adminEmail']) . "\r\n";
                                $headers .= "CC: rahul.vit09@gmail.com\r\n";
                                $headers .= "MIME-Version: 1.0\r\n";
                                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                                $message = '<html><body>';
                                $message .= '<table width="650" align="center" style="font-size: 14px;" cellpadding="0" cellspacing="0">';
                                $message .= '<tr id="topshadow">';
                                $message .= '<td height="10" width="10" bgcolor="#ffffff"></td>';
                                $message .= '<td height="10" bgcolor="#ffffff"> </td>';
                                $message .= '<td height="10" width="10" bgcolor="#ffffff"> </td></tr>';
                                $message .= '<tr id="header"><td width="10" bgcolor="#ffffff" rowspan="2"></td><td height="102" bgcolor="#e6fgfb" align="center"><table width="95%"><tr><td align="left">';
                                $message .= '<img src="http://www.ixpense.net/images/ixpense-logo-mail.png"/></td>';
                                $message .= '<td align="right"><span style="font-family: "Lucida Grande", "Segoe UI", Arial, Verdana, "Lucida Sans Unicode", Tahoma, "Sans Serif"; font-size: 15px; color: #888;">Welcome</span></td>';
                                $message .= '</tr></table></td>';
                                $message .= '</td><td width="10" bgcolor="#ffffff" rowspan="2"></td></tr>';
                                $message .= '<tr id="content"><td bgcolor="#f4f9ff" align="center"><table width="95%" cellpadding="30"><tr><td align="left">';
                                $message .= '<font face="Lucida Grande, Segoe UI, Arial, Verdana, Lucida Sans Unicode, Tahoma, Sans Serif">';
                                $message .= "Hi ". $model->username . "<br/><br/>";
                                $message .= 'A very warm welcome to <b>iXpense</b> - A new approach to expense management<br/>';
                                $message .= 'Thank you for registering with us, your account has been created successfully. Please feel free to contact us regarding any query, we will look forward to assist you.<br/><br/>';
                                $message .= '<a href="http://www.ixpense.net/index.php/site/login">click here</a> to login<br/><br/>';
                                //$message .= '</ul>';
                                $message .= 'Thanks!<br/>- The iXpense Team<br/>';
                                $message .= '<br><a href="http://www.ixpense.net">www.ixpense.net</a></br>';
                                $message .= '</font></td></tr></table></td></tr>';
                                $message .= '<tr id="bottomshadow"><td height="10" width="10" bgcolor="#ffffff"></td><td height="10" bgcolor="#ffffff"> </td><td height="10" width="10" bgcolor="#ffffff"> </td></tr>';
                                $message .= '<tr id="copyright"><td></td><td align="right">';
                                $message .= '<img src="http://www.ixpense.net/images/favicon.ico" alt="" align="absmiddle"/><span style="font-family: "Lucida Grande", "Segoe UI", Arial, Verdana, "Lucida Sans Unicode", Tahoma, "Sans Serif"; font-size: 11px; color: #888;">&copy;&nbsp;2011&nbsp;iXpense</span>';
                                $message .= '</td><td></td></tr></table>';
                                $message .= '</body></html>';                                
                                
                                mail($to, $subject, $message, $headers);

                                //html mail ends

                                Yii::app()->user->setFlash('registrationsuccess','Your account has been created successfully, please login with your username and password to continue.');
				$this->refresh();
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save(false))
                                {
				 /*
                                 //edited on 30-oct-2011 at 8:45PM
                                 include('Mail.php');
                                 $headers['From'] = Yii::app()->params['adminEmail'];
                                 $headers['To'] = $model->email;
                                 $headers['Subject'] = 'iXpense - User Profile Modified';
                                 $params["host"] = "localhost";
                                 $params["port"] = "25";
                                 $params["auth"] = false;
                                 $params["username"] = "username";
                                 $params["password"] = "password";

                                 $body = 'email : ' . $model->email . ' phone : ' . $model->phone . ' currency : ' .  $model->usercurrency;

                                 $mail_object =& Mail::factory('smtp', $params);
                                 $mail_object->send($model->email, $headers, $body);
                                 //edited on 30-oct-2011 at 8:45PM
                                 */
                                 //html mail
                                ini_set("SMTP", "localhost");
                                ini_set("smtp_port", "25");
                                ini_set("auth", false);
                                ini_set("username", "username");
                                ini_set("password", "password");

                                $to = $model->email;

                                $subject = 'iXpense - User Profile Modified';

                                $headers = "From: " . strip_tags(Yii::app()->params['adminEmail']) . "\r\n";
                                $headers .= "Reply-To: ". strip_tags(Yii::app()->params['adminEmail']) . "\r\n";
                                $headers .= "CC: rahul.vit09@gmail.com\r\n";
                                $headers .= "MIME-Version: 1.0\r\n";
                                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                                $message = '<html><body>';
                                $message .= '<table width="650" align="center" style="font-size: 14px;" cellpadding="0" cellspacing="0">';
                                $message .= '<tr id="topshadow">';
                                $message .= '<td height="10" width="10" bgcolor="#ffffff"></td>';
                                $message .= '<td height="10" bgcolor="#ffffff"> </td>';
                                $message .= '<td height="10" width="10" bgcolor="#ffffff"> </td></tr>';
                                $message .= '<tr id="header"><td width="10" bgcolor="#ffffff" rowspan="2"></td><td height="102" bgcolor="#e6fgfb" align="center"><table width="95%"><tr><td align="left">';
                                $message .= '<img src="http://www.ixpense.net/images/ixpense-logo-mail.png"/></td>';
                                $message .= '<td align="right"><span style="font-family: "Lucida Grande", "Segoe UI", Arial, Verdana, "Lucida Sans Unicode", Tahoma, "Sans Serif"; font-size: 15px; color: #888;">Profile Updates</span></td>';
                                $message .= '</tr></table></td>';
                                $message .= '</td><td width="10" bgcolor="#ffffff" rowspan="2"></td></tr>';
                                $message .= '<tr id="content"><td bgcolor="#f4f9ff" align="center"><table width="95%" cellpadding="30"><tr><td align="left">';
                                $message .= '<font face="Lucida Grande, Segoe UI, Arial, Verdana, Lucida Sans Unicode, Tahoma, Sans Serif">';
                                $message .= "Hi ". $model->username . "<br/><br/>";
                                $message .= "Find below your updated profile details - <br/>";
                                $message .= '<b>Email :</b> ' . $model->email . '<br/> <b>Phone :</b> ' . $model->phone . '<br/> <b>currency :</b> ' .  $model->usercurrency . '<br/><br/>';
                                $message .= '<a href="http://www.ixpense.net/index.php/site/login">click here</a> to login<br/><br/>';
                                //$message .= '</ul>';
                                $message .= 'Thanks!<br/>- The iXpense Team<br/>';
                                $message .= '<br><a href="http://www.ixpense.net">www.ixpense.net</a></br>';
                                $message .= '</font></td></tr></table></td></tr>';
                                $message .= '<tr id="bottomshadow"><td height="10" width="10" bgcolor="#ffffff"></td><td height="10" bgcolor="#ffffff"> </td><td height="10" width="10" bgcolor="#ffffff"> </td></tr>';
                                $message .= '<tr id="copyright"><td></td><td align="right">';
                                $message .= '<img src="http://www.ixpense.net/images/favicon.ico" alt="" align="absmiddle"/><span style="font-family: "Lucida Grande", "Segoe UI", Arial, Verdana, "Lucida Sans Unicode", Tahoma, "Sans Serif"; font-size: 11px; color: #888;">&copy;&nbsp;2011&nbsp;iXpense</span>';
                                $message .= '</td><td></td></tr></table>';
                                $message .= '</body></html>';                                
                                
                                mail($to, $subject, $message, $headers);

                                //html mail ends

                                 $this->redirect(array('view','id'=>$model->uid));
                                
                                }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				Yii::app()->user->logout();
				$this->redirect(Yii::app()->homeUrl);
				//$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{	Yii::app()->clientScript->registerMetaTag('Users', 'Welcome to iXpense', null, array('lang' => 'en'));
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	//password settings
	
	public function actionPasswordreset()
	{
		$model = new PasswordresetForm;
		if(isset($_POST['PasswordresetForm']))
		{
			$model->attributes=$_POST['PasswordresetForm'];
			$oldpass = $model->oldpassword;
			if($model->validate())
			{	
				$userpass = User::model()->findBySql("SELECT * FROM `user` WHERE `uid` = " . Yii::app()->user->id);
				if ($userpass->password === md5($oldpass))
				{
				$newpassword = $model->newpassword;
				$userpass->password = md5($newpassword);
				$userpass->save(false);
				//$headers="From: {Yii::app()->params['adminEmail']}\r\nReply-To: {Yii::app()->params['adminEmail']}";
				//mail($userpass->email,'iXpense - password changed ','username : ' . $userpass->username . ' new password : ' . $newpassword,$headers);				
				//edited on 29-oct-2011 at 8:45PM
                                 include('Mail.php');
                                 $headers['From'] = Yii::app()->params['adminEmail'];
                                 $headers['To'] = $userpass->email;
                                 $headers['Subject'] = 'iXpense - password changed';
                                 $params["host"] = "localhost";
                                 $params["port"] = "25";
                                 $params["auth"] = false;
                                 $params["username"] = "username";
                                 $params["password"] = "password";

                                 $body = 'username : ' . $userpass->username . ' new password : ' . $newpassword;

                                 $mail_object =& Mail::factory('smtp', $params);
                                 $mail_object->send($userpass->email, $headers, $body);
                                //edited on 29-oct-2011 at 8:45PM
                                
                                Yii::app()->user->setFlash('passwordreset','Password changed successfully please login again with your new password, Thank you');
				$this->refresh();
				}
				else
				{
                                //$headers="From: {Yii::app()->params['adminEmail']}\r\nReply-To: {Yii::app()->params['adminEmail']}";
				//mail($userpass->email,'iXpense - Wrong attempt to change password ','We found some illegal activity taken place in your account at ' . now(),$headers);
				
                                //edited on 29-oct-2011 at 8:45PM
                                 include('Mail.php');
                                 $headers['From'] = Yii::app()->params['adminEmail'];
                                 $headers['To'] = $userpass->email;
                                 $headers['Subject'] = 'iXpense - Wrong attempt to change password';
                                 $params["host"] = "localhost";
                                 $params["port"] = "25";
                                 $params["auth"] = false;
                                 $params["username"] = "username";
                                 $params["password"] = "password";
                                 $now = date("D F j, G:i:s T, Y");
                                 $body = 'We found some illegal activity taken place in your account at ' . $now;

                                 $mail_object =& Mail::factory('smtp', $params);
                                 $mail_object->send($userpass->email, $headers, $body);
                                //edited on 29-oct-2011 at 8:45PM

                                Yii::app()->user->setFlash('passwordreset','Wrong attempt to change password, incident reported and mailed to user');
				$this->refresh();	
				}
			}
		}
		$this->render('passwordreset',array('model'=>$model));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		$model->balance = UserBalance::model()->findByPk(Yii::app()->user->id)->balance;
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && ($_POST['ajax']==='user-form' || $_POST['ajax']==='usersetting-form'))
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
