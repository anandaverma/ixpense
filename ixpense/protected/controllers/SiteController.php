<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	 
	 
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{	
		Yii::app()->clientScript->registerMetaTag('Welcome to iXpense - A NEW APPROACH TO EXPENSE MANAGEMENT, iXpense is built on the idea that expense management can be more intuitive, efficient, easy and useful. And anybody can use it because it is free, easy to handle and feature rich.', 'description', null, array('lang' => 'en'));
		Yii::app()->clientScript->registerMetaTag('expense, deposit, budget, money, savings, rent, loan, borrowed, online expense manager, web based expense management, expense tracker, expense manager, money managing, online income manager, free online expense manager', 'keywords', null, array('lang' => 'en'));
		$dateTo;
		$dateFrom;
		//total expenses
		//Yii::trace($id);
		//Yii::trace($totexp->expsum);
		//Yii::trace($totexp->expsum);
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$rangemodel=new RangeForm;
		if(!Yii::app()->user->isGuest)
		{
		//validate
		if(isset($_POST['ajax']) && $_POST['ajax']==='range-form')
		{
			echo CActiveForm::validate($rangemodel);
			Yii::app()->end();
		}
		// collect user input data
		if(isset($_POST['RangeForm']))
		{
		$rangemodel->attributes=$_POST['RangeForm'];
		$dateTo =  $rangemodel->todate;
		$dateFrom = $rangemodel->fromdate;
		// if range is selected, showing summary between the range
		$totexp = Expense::model()->findBySql("SELECT ROUND(SUM(`amount`),2) as `expsum` FROM `expense` WHERE `uid` = " . Yii::app()->user->id ." AND `date` >= '". $dateFrom . "' AND `date` <= '" .$dateTo ."'");
		$totdep = Deposit::model()->findBySql("SELECT ROUND(SUM(`amount`),2) as `depsum` FROM `deposit` WHERE `uid` = " . Yii::app()->user->id ." AND `date` >= '". $dateFrom . "' AND `date` <= '" .$dateTo ."'");
		//$catexp = Expense::model()->findBySql("SELECT SUM( `amount` ) as `expamount`, `expense_category` as `expcat` FROM `expense` WHERE `uid` = " . Yii::app()->user->id . " GROUP BY `expense_category`");
		
		
		//categorywise expense piechart data
		if ($totexp->expsum===null) {
		$catexp = null;
		}
		else {
		$catexp = Yii::app()->db->createCommand()
		->select('expense_category as "name", round(sum(amount)*100/'.  $totexp->expsum .') as "y" ')
		->from('expense')
		->where('uid = ' . Yii::app()->user->id . " AND `date` >= '". $dateFrom . "' AND `date` <= '" .$dateTo ."'")
		->group('expense_category')
		->queryAll();
		}
		
		//modewise expense piechart data
		if ($totexp->expsum===null) {
		$modexp = null;
		}
		else {
		$modexp = Yii::app()->db->createCommand()
		->select('expense_mode as "name", round(sum(amount)*100/'.  $totexp->expsum .') as "y" ')
		->from('expense')
		->where('uid = ' . Yii::app()->user->id . " AND `date` >= '". $dateFrom . "' AND `date` <= '" .$dateTo ."'")
		->group('expense_mode')
		->queryAll();
		}
		
		//type wise deposit chart
		if ($totdep->depsum===null) {
		$deptype = null;
		}
		else {
		$deptype = Yii::app()->db->createCommand()
		->select('deposit_type as "name", round(sum(amount)*100/'.  $totdep->depsum .') as "y"')
		->from('deposit')
		->where('uid = ' . Yii::app()->user->id . " AND `date` >= '". $dateFrom . "' AND `date` <= '" .$dateTo ."'")
		->group('deposit_type')
		->queryAll();
		}
		
		//daily avg expense rate
		$dlyexprate = Yii::app()->db->createCommand()
		->select('round(sum(amount)/count(date),2) as davgexp')
		->from('expense')
		->where('uid = ' . Yii::app()->user->id . " AND `date` >= '". $dateFrom . "' AND `date` <= '" .$dateTo ."'")
		->group('date')
		->queryRow();
		//Yii::trace(print_r($dlyexprate[davgexp]));
		
		//daily avg deposit rate
		$dlydptrate = Yii::app()->db->createCommand()
		->select('round(sum(amount)/count(date),2) as davgdpt')
		->from('deposit')
		->where('uid = ' . Yii::app()->user->id . " AND `date` >= '". $dateFrom . "' AND `date` <= '" .$dateTo ."'")
		->group('date')
		->queryRow();
		
		//top expenses
		/*$criteria1=new CDbCriteria;
		$criteria1->compare('uid',Yii::app()->user->id,false);
		$criteria1->compare('date','>='.$dateFrom,false);
		$criteria1->compare('date','<='.$dateTo,false);
		$criteria1->order = 'amount DESC';
		$criteria1->offset = 0;
		$criteria1->limit = 10;*/
		$dataProvider1=new CActiveDataProvider('Expense', array(
		'criteria'=> array(
        'condition'=>'uid = '. Yii::app()->user->id . " AND `date` >= '". $dateFrom . "' AND `date` <= '" .$dateTo ."'",
        'order'=>'amount DESC',
		'offset'=>0,
		'limit'=>10,
			),
			/* 'pagination'=>array(
			'pageSize'=>5,
				), */
			'totalItemCount' => 10,
		));
		
		//recent expenses
		$dataProvider2=new CActiveDataProvider('Expense', array(
		'criteria'=>array(
        'condition'=>'uid = '. Yii::app()->user->id . " AND `date` >= '". $dateFrom . "' AND `date` <= '" .$dateTo ."'",
        'order'=>'date DESC, time DESC',
		'offset'=>0,
		'limit'=>10,
			),
			/* 'pagination'=>array(
			'pageSize'=>5,
				), */
			'totalItemCount' => 10,
		));
		
		//top deposit
		$dataProvider3=new CActiveDataProvider('Deposit', array(
		'criteria'=>array(
        'condition'=>'uid = '. Yii::app()->user->id . " AND `date` >= '". $dateFrom . "' AND `date` <= '" .$dateTo ."'",
        'order'=>'amount DESC',
		'offset'=>0,
		'limit'=>10,
			),
			/* 'pagination'=>array(
			'pageSize'=>5,
				), */
			'totalItemCount' => 10,
		));
		
		//recent deposit
		$dataProvider4=new CActiveDataProvider('deposit', array(
		'criteria'=>array(
        'condition'=>'uid = '. Yii::app()->user->id . " AND `date` >= '". $dateFrom . "' AND `date` <= '" .$dateTo ."'",
        'order'=>'date DESC, time DESC',
		'offset'=>0,
		'limit'=>10,
			),
			/* 'pagination'=>array(
			'pageSize'=>5,
				), */
			'totalItemCount' => 10,
		));
		
		//category wise expence
		$catwiseexp = Yii::app()->db->createCommand()
		->select('expense_category as "Category", round(sum(amount),2) as "Amount"')
		->from('expense')
		->where('uid = ' . Yii::app()->user->id . " AND `date` >= '". $dateFrom . "' AND `date` <= '" .$dateTo ."'")
		->group('expense_category')
		->queryAll();
		
		$dataProvider5=new CArrayDataProvider($catwiseexp, array(
		
		/* 'pagination'=>array(
			'pageSize'=>4,
		), */
	));
	
		//mod wise expence
		$modwiseexp = Yii::app()->db->createCommand()
		->select('expense_mode as "Mode", round(sum(amount),2) as "Amount"')
		->from('expense')
		->where('uid = ' . Yii::app()->user->id . " AND `date` >= '". $dateFrom . "' AND `date` <= '" .$dateTo ."'")
		->group('expense_mode')
		->queryAll();
		
		$dataProvider7=new CArrayDataProvider($modwiseexp, array(
		
		/* 'pagination'=>array(
			'pageSize'=>4,
		), */
	));
	
		//type wise deposit
		$typewisedep = Yii::app()->db->createCommand()
		->select('deposit_type as "Type", round(sum(amount),2) as "Amount"')
		->from('deposit')
		->where('uid = ' . Yii::app()->user->id . " AND `date` >= '". $dateFrom . "' AND `date` <= '" .$dateTo ."'")
		->group('deposit_type')
		->queryAll();
		
		$dataProvider6=new CArrayDataProvider($typewisedep, array(
		
		/* 'pagination'=>array(
			'pageSize'=>4,
		), */
	));
		//end of range specific query
		}
		else
		{
		// default if no range is selected showing full summary
		$totexp = Expense::model()->findBySql("SELECT ROUND(SUM(`amount`),2) as `expsum` FROM `expense` WHERE `uid` = " . Yii::app()->user->id);
		$totdep = Deposit::model()->findBySql("SELECT ROUND(SUM(`amount`),2) as `depsum` FROM `deposit` WHERE `uid` = " . Yii::app()->user->id);
		//$catexp = Expense::model()->findBySql("SELECT SUM( `amount` ) as `expamount`, `expense_category` as `expcat` FROM `expense` WHERE `uid` = " . Yii::app()->user->id . " GROUP BY `expense_category`");
		
		
		//categorywise expense piechart data
		if ($totexp->expsum===null) {
		$catexp = null;
		}
		else {
		$catexp = Yii::app()->db->createCommand()
		->select('expense_category as "name", round(sum(amount)*100/'.  $totexp->expsum .') as "y" ')
		->from('expense')
		->where('uid=:id', array(':id'=>Yii::app()->user->id))
		->group('expense_category')
		->queryAll();
		}
		
		//modewise expense piechart data
		if ($totexp->expsum===null) {
		$modexp = null;
		}
		else {
		$modexp = Yii::app()->db->createCommand()
		->select('expense_mode as "name", round(sum(amount)*100/'.  $totexp->expsum .') as "y" ')
		->from('expense')
		->where('uid=:id', array(':id'=>Yii::app()->user->id))
		->group('expense_mode')
		->queryAll();
		}
		
		//type wise deposit chart
		if ($totdep->depsum===null) {
		$deptype = null;
		}
		else {
		$deptype = Yii::app()->db->createCommand()
		->select('deposit_type as "name", round(sum(amount)*100/'.  $totdep->depsum .') as "y"')
		->from('deposit')
		->where('uid=:id', array(':id'=>Yii::app()->user->id))
		->group('deposit_type')
		->queryAll();
		}
		
		//daily avg expense rate
		$dlyexprate = Yii::app()->db->createCommand()
		->select('round(sum(amount)/count(date),2) as davgexp')
		->from('expense')
		->where('uid=:id', array(':id'=>Yii::app()->user->id))
		->group('date')
		->queryRow();
		//Yii::trace(print_r($dlyexprate[davgexp]));
		
		//daily avg deposit rate
		$dlydptrate = Yii::app()->db->createCommand()
		->select('round(sum(amount)/count(date),2) as davgdpt')
		->from('deposit')
		->where('uid=:id', array(':id'=>Yii::app()->user->id))
		->group('date')
		->queryRow();
		
		//top expenses
		$dataProvider1=new CActiveDataProvider('Expense', array(
		'criteria'=>array(
        'condition'=>'uid = '. Yii::app()->user->id,
        'order'=>'amount DESC',
        'offset'=>0,
	'limit'=>10,
			),
			'pagination'=>array(
			'pageSize'=>5,
				),
                        'totalItemCount' => 10,
		));
		
		//recent expenses
		$dataProvider2=new CActiveDataProvider('Expense', array(
		'criteria'=>array(
        'condition'=>'uid = '. Yii::app()->user->id,
        'order'=>'date DESC, time DESC',
        'offset'=>0,
        'limit'=>10,
			),
			'pagination'=>array(
			'pageSize'=>5,
				),
                        'totalItemCount' => 10,
		));
		
		//top deposit
		$dataProvider3=new CActiveDataProvider('Deposit', array(
		'criteria'=>array(
        'condition'=>'uid = '. Yii::app()->user->id,
        'order'=>'amount DESC',
        'offset'=>0,
        'limit'=>10,
			),
			'pagination'=>array(
			'pageSize'=>5,
				),
                        'totalItemCount' => 10,
		));
		
		//recent deposit
		$dataProvider4=new CActiveDataProvider('deposit', array(
		'criteria'=>array(
        'condition'=>'uid = '. Yii::app()->user->id,
        'order'=>'date DESC, time DESC',
        'offset'=>0,
	'limit'=>10,
			),
			'pagination'=>array(
			'pageSize'=>5,
				),
                        'totalItemCount' => 10,
		));
		
		//category wise expence
		$catwiseexp = Yii::app()->db->createCommand()
		->select('expense_category as "Category", round(sum(amount),2) as "Amount"')
		->from('expense')
		->where('uid=:id', array(':id'=>Yii::app()->user->id))
		->group('expense_category')
		->queryAll();
		
		$dataProvider5=new CArrayDataProvider($catwiseexp, array(
		
		'pagination'=>array(
			'pageSize'=>4,
		),
	));
	
		//mod wise expence
		$modwiseexp = Yii::app()->db->createCommand()
		->select('expense_mode as "Mode", round(sum(amount),2) as "Amount"')
		->from('expense')
		->where('uid=:id', array(':id'=>Yii::app()->user->id))
		->group('expense_mode')
		->queryAll();
		
		$dataProvider7=new CArrayDataProvider($modwiseexp, array(
		
		'pagination'=>array(
			'pageSize'=>4,
		),
	));
	
		//type wise deposit
		$typewisedep = Yii::app()->db->createCommand()
		->select('deposit_type as "Type", round(sum(amount),2) as "Amount"')
		->from('deposit')
		->where('uid=:id', array(':id'=>Yii::app()->user->id))
		->group('deposit_type')
		->queryAll();
		
		$dataProvider6=new CArrayDataProvider($typewisedep, array(
		
		'pagination'=>array(
			'pageSize'=>4,
		),
	));
		
		
		}
		
		$this->render('index', array('dateTo'=>$dateTo,'dateFrom'=>$dateFrom,'rangemodel'=>$rangemodel,'totexp'=>$totexp->expsum, 'totdep'=>$totdep->depsum, 'deptype'=>$deptype,'catexp'=>$catexp, 'modexp'=>$modexp, 'dataProvider7'=>$dataProvider7, 'dataProvider6'=>$dataProvider6,'dataProvider5'=>$dataProvider5,'dataProvider4'=>$dataProvider4, 'dataProvider3'=>$dataProvider3, 'dataProvider1'=>$dataProvider1, 'dataProvider2'=>$dataProvider2, 'dlyexprate'=>$dlyexprate[davgexp], 'dlydptrate'=>$dlydptrate[davgdpt]));
		}
		else
		{
		Yii::app()->request->redirect(Yii::app()->baseUrl . '/index.php/site/login');
		}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		Yii::app()->clientScript->registerMetaTag('Contact us for any query', 'description', null, array('lang' => 'en'));
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
                                //html mail
                                ini_set("SMTP", "localhost");
                                ini_set("smtp_port", "25");
                                ini_set("auth", false);
                                ini_set("username", "username");
                                ini_set("password", "password");

                                $to = Yii::app()->params['adminEmail'];

                                $subject = $model->subject;

                                $headers = "From: " . strip_tags($model->email) . "\r\n";
                                $headers .= "Reply-To: ". strip_tags($model->email) . "\r\n";
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
                                $message .= '<td align="right"><span style="font-family: "Lucida Grande", "Segoe UI", Arial, Verdana, "Lucida Sans Unicode", Tahoma, "Sans Serif"; font-size: 15px; color: #888;">Contact Report</span></td>';
                                $message .= '</tr></table></td>';
                                $message .= '</td><td width="10" bgcolor="#ffffff" rowspan="2"></td></tr>';
                                $message .= '<tr id="content"><td bgcolor="#f4f9ff" align="center"><table width="95%" cellpadding="30"><tr><td align="left">';
                                $message .= '<font face="Lucida Grande, Segoe UI, Arial, Verdana, Lucida Sans Unicode, Tahoma, Sans Serif">';
                                $message .= "Hi Admin" . "<br/><br/>";
                                $message .= $model->name . ", has contacted us for ". $model->subject . "<br/><br/>";
                                $message .= $model->body;
                                //$message .= '<ul><li><a href="http://www.ixpense.net">iXpense</a></li>';
                                //$message .= '</ul>';
                                $message .= '<br/>Thanks!<br/>- The iXpense Team<br/>';
                                $message .= '<br><a href="http://www.ixpense.net">www.ixpense.net</a></br>';
                                $message .= '</font></td></tr></table></td></tr>';
                                $message .= '<tr id="bottomshadow"><td height="10" width="10" bgcolor="#ffffff"></td><td height="10" bgcolor="#ffffff"> </td><td height="10" width="10" bgcolor="#ffffff"> </td></tr>';
                                $message .= '<tr id="copyright"><td></td><td align="right">';
                                $message .= '<img src="http://www.ixpense.net/images/favicon.ico" alt="" align="absmiddle"/><span style="font-family: "Lucida Grande", "Segoe UI", Arial, Verdana, "Lucida Sans Unicode", Tahoma, "Sans Serif"; font-size: 11px; color: #888;">&copy;&nbsp;2011&nbsp;iXpense</span>';
                                $message .= '</td><td></td></tr></table>';
                                $message .= '</body></html>';                                
                                
                                mail($to, $subject, $message, $headers);

                                //html mail ends
                                
                                 /*
                                //edited on 29-oct-2011 at 6:30PM
				//$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				//mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
                                //edited on 29-oct-2011 at 8:45PM
                                 include('Mail.php');
                                 $headers['From'] = $model->email;
                                 $headers['To'] = Yii::app()->params['adminEmail'];
                                 $headers['Subject'] = $model->subject;
                                 $params["host"] = "localhost";
                                 $params["port"] = "25";
                                 $params["auth"] = false;
                                 $params["username"] = "username";
                                 $params["password"] = "password";

                                 $body = $model->body;

                                 $mail_object =& Mail::factory('smtp', $params);
                                 $mail_object->send(Yii::app()->params['adminEmail'], $headers, $body);
                                //edited on 29-oct-2011 at 8:45PM
                                 */
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	
        /**
	 * Displays the Feedback page
	*/
	
		public function actionFeedback()
		{
                        Yii::app()->clientScript->registerMetaTag('Give your valuable feedback', 'description', null, array('lang' => 'en'));
			
                        $model=new FeedbackForm;

		if(isset($_POST['FeedbackForm']))
		{
			$model->attributes=$_POST['FeedbackForm'];
			if($model->validate())
			{
                                //edited on 26-nov-2011 at 11:30PM
				
                                //html mail
                                ini_set("SMTP", "localhost");
                                ini_set("smtp_port", "25");
                                ini_set("auth", false);
                                ini_set("username", "username");
                                ini_set("password", "password");

                                $to = Yii::app()->params['adminEmail'];

                                $subject = $model->feedbacktype;

                                $headers = "From: " . strip_tags($model->email) . "\r\n";
                                $headers .= "Reply-To: ". strip_tags($model->email) . "\r\n";
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
                                $message .= '<td align="right"><span style="font-family: "Lucida Grande", "Segoe UI", Arial, Verdana, "Lucida Sans Unicode", Tahoma, "Sans Serif"; font-size: 15px; color: #888;">User Feedback</span></td>';
                                $message .= '</tr></table></td>';
                                $message .= '</td><td width="10" bgcolor="#ffffff" rowspan="2"></td></tr>';
                                $message .= '<tr id="content"><td bgcolor="#f4f9ff" align="center"><table width="95%" cellpadding="30"><tr><td align="left">';
                                $message .= '<font face="Lucida Grande, Segoe UI, Arial, Verdana, Lucida Sans Unicode, Tahoma, Sans Serif">';
                                $message .= "Hi Admin" . "<br/><br/>";
                                $message .= $model->name . ", has given the following feedback for ". $model->feedbacktype . "<br/><br/>";
                                $message .= $model->comments;
                                //$message .= '<ul><li><a href="http://www.ixpense.net">iXpense</a></li>';
                                //$message .= '</ul>';
                                $message .= 'Thanks!<br/>- The iXpense Team<br/>';
                                $message .= '</font></td></tr></table></td></tr>';
                                $message .= '<tr id="bottomshadow"><td height="10" width="10" bgcolor="#ffffff"></td><td height="10" bgcolor="#ffffff"> </td><td height="10" width="10" bgcolor="#ffffff"> </td></tr>';
                                $message .= '<tr id="copyright"><td></td><td align="right">';
                                $message .= '<img src="http://www.ixpense.net/images/favicon.ico" alt="" align="absmiddle"/><span style="font-family: "Lucida Grande", "Segoe UI", Arial, Verdana, "Lucida Sans Unicode", Tahoma, "Sans Serif"; font-size: 11px; color: #888;">&copy;&nbsp;2011&nbsp;iXpense</span>';
                                $message .= '</td><td></td></tr></table>';
                                $message .= '</body></html>';                                
                                
                                mail($to, $subject, $message, $headers);

                                //html mail ends
                                
                             
                                //give success message
				Yii::app()->user->setFlash('feedback','Thank you for giving us your valuable feedback. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('feedback',array('model'=>$model));
	}	

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{	
                //edited on 29-oct-2011 - 6:30PM
		Yii::app()->clientScript->registerMetaTag('Welcome to iXpense - A NEW APPROACH TO EXPENSE MANAGEMENT, iXpense is built on the idea that expense management can be more intuitive, efficient, easy and useful. And anybody can use it because it is free, easy to handle and feature rich.', 'description', null, array('lang' => 'en'));
		Yii::app()->clientScript->registerMetaTag('expense, deposit, budget, money, savings, rent, loan, borrowed, online expense manager, web based expense management, expense tracker, expense manager, money managing, online income manager, free online expense manager', 'keywords', null, array('lang' => 'en'));
		

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				$this->redirect(Yii::app()->user->returnUrl);
				
			}
		}
		$totreguser = User::model()->findBySql("SELECT COUNT(*) as `totuser` FROM `user`");
		//print_r($totuser);
		// display the login form
		$this->render('login',array('model'=>$model,'totreguser'=>$totreguser->totuser));
	}
	/**
	*forgot password and username field
	*/
	public function actionForgot()
	{
		Yii::app()->clientScript->registerMetaTag('Enter your mail id to get new password', 'description', null, array('lang' => 'en'));
		$model = new ForgotForm;
		if(isset($_POST['ForgotForm']))
		{
			$model->attributes=$_POST['ForgotForm'];
			$usermail = $model->mailid;
			if($model->validate())
			{	
				$forgotuser = User::model()->findBySql("SELECT * FROM `user` WHERE `email` = '" . $usermail . "'");
				if ($forgotuser === null)
				{
				Yii::app()->user->setFlash('forgot','Sorry no such record found    ');
				$this->refresh();
				}
				else
				{
				$newpassword = $forgotuser->username . mt_rand(0,100000);
				$forgotuser->password = md5($newpassword);
				$forgotuser->save(false);
				//$headers="From: {Yii::app()->params['adminEmail']}\r\nReply-To: {Yii::app()->params['adminEmail']}";
				//mail($forgotuser->email,'iXpense login details username : ' . $forgotuser->username . ' password : ' . $newpassword,$headers);
				// pearmail
                                //edited on 29-oct-2011 at 8:45PM
                                 include('Mail.php');
                                 $headers['From'] = Yii::app()->params['adminEmail'];
                                 $headers['To'] = $forgotuser->email;
                                 $headers['Subject'] = 'iXpense - Forgot Password';
                                 $params["host"] = "localhost";
                                 $params["port"] = "25";
                                 $params["auth"] = false;
                                 $params["username"] = "username";
                                 $params["password"] = "password";

                                 $body = 'iXpense login details, username : ' . $forgotuser->username . ' password : ' . $newpassword;

                                 $mail_object =& Mail::factory('smtp', $params);
                                 $mail_object->send($forgotuser->email, $headers, $body);
                                //edited on 30-oct-2011 at 8:45PM
                                

                                //html mail
                                ini_set("SMTP", "localhost");
                                ini_set("smtp_port", "25");
                                ini_set("auth", false);
                                ini_set("username", "username");
                                ini_set("password", "password");

                                $to = $forgotuser->email;

                                $subject = 'iXpense - Password Recovery';

                                $headers = "From: " . strip_tags(Yii::app()->params['adminEmail']) . "\r\n";
                                $headers .= "Reply-To: ". strip_tags(Yii::app()->params['adminEmail']) . "\r\n";
                                //$headers .= "CC: rahul.vit09@gmail.com\r\n";
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
                                $message .= '<td align="right"><span style="font-family: "Lucida Grande", "Segoe UI", Arial, Verdana, "Lucida Sans Unicode", Tahoma, "Sans Serif"; font-size: 15px; color: #888;">Password Recovery</span></td>';
                                $message .= '</tr></table></td>';
                                $message .= '</td><td width="10" bgcolor="#ffffff" rowspan="2"></td></tr>';
                                $message .= '<tr id="content"><td bgcolor="#f4f9ff" align="center"><table width="95%" cellpadding="30"><tr><td align="left">';
                                $message .= '<font face="Lucida Grande, Segoe UI, Arial, Verdana, Lucida Sans Unicode, Tahoma, Sans Serif">';
                                $message .= "Hi ". $forgotuser->username . "<br/><br/>";
                                $message .= 'Find below your login details - (please change your password after login)<br/><br/>';
                                $message .= "<b>username :</b> " . $forgotuser->username . "<br/><b>password :</b> " . $newpassword . "<br/><br/>";
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

                                Yii::app()->user->setFlash('forgot','your username and new password has been sent to your mail id (change your password after login) -  ' . $forgotuser->email . "     ");
				
                                $this->refresh();
				}
			}
		}
		$this->render('forgot',array('model'=>$model));
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{	
		$u_id = Yii::app()->db->createCommand()
		->select('ipid')
		->from('user_ip')
		->where('uid=:id', array(':id'=>Yii::app()->user->id))
		->order('login_time DESC')
		->queryRow();
		
		UserIp::model()->updateByPk($u_id[ipid], array('logout_time'=>new CDbExpression('NOW()')));
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	
}