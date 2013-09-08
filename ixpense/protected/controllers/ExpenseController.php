<?php

class ExpenseController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	 
	/* public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			
		);
	} */
	 
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
		return array(
			array('allow',  // allow all users to perform 'create' actions (registration)
				'actions'=>array('create','index','admin'),
				'users'=>array('@'),
			),
			array('allow',  //allow respective user to delete, update, view his details
				'actions'=>array('delete','update','view'),
				'users'=>array(Yii::app()->user->name),
                'expression' => '(Yii::app()->user->id == Expense::model()->findByPk($_GET[\'id\'])->uid)',
			),
                        
                        //edited on 01-11-2001 at 7.00 PM
                        /*  array('allow', // allow admin user to perform 'admin' and 'delete' actions
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
		Yii::app()->clientScript->registerMetaTag('Create expense', 'description', null, array('lang' => 'en'));
		$model=new Expense;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Expense']))
		{
			$model->attributes=$_POST['Expense'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->expid));
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
		Yii::app()->clientScript->registerMetaTag('Update expense', 'description', null, array('lang' => 'en'));
		
		$model=$this->loadModel($id);
		$old_amount = $model->amount;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Expense']))
		{
			$model->attributes=$_POST['Expense'];
			if($model->save())
			{
				$new_amount=$model->amount;
				$diff = $new_amount - $old_amount;
				$bal = UserBalance::model()->findByPk(Yii::app()->user->id);
				if ($bal !== null)
				{
						$bal->balance = ($bal->balance - $diff);
						$bal->save(false);
				}
				$this->redirect(array('view','id'=>$model->expid));
				
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
			$model = $this->loadModel($id);
			$amt = $model->amount;
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
			// change the balance amount
			$bal = UserBalance::model()->findByPk(Yii::app()->user->id);
			//Yii::trace($amt->amount);
			if ($bal !== null)
				{
					$bal->balance = ($bal->balance + $amt);
					$bal->save(false);
				} 
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		Yii::app()->clientScript->registerMetaTag('Create, update and manage expenses', 'description', null, array('lang' => 'en'));
		
	    if(!Yii::app()->user->isGuest)
		{
		$criteria=new CDbCriteria;
                $criteria->order = 'date DESC, time DESC';
		$criteria->compare('uid',Yii::app()->user->id,false);
		$dataProvider=new CActiveDataProvider('Expense',array(
		'criteria'=>$criteria,
		'pagination'=>array('pageSize'=>5,),
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,));
		}
		else
		{
		Yii::app()->request->redirect(Yii::app()->baseUrl . '/index.php/site/login');
		}
		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Expense('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Expense']))
			$model->attributes=$_GET['Expense'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Expense::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='expense-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
