<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" type="image/x-icon" />
	

	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/cupertino/jquery-ui.css" rel="stylesheet" />
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/demo.css" rel="stylesheet" />

	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<!-- 3eIRprzpRAZuk9JhJb34ft227Qc -->
	<?php echo Yii::app()->bootstrap->registerBootstrap(); ?>
        <!-- edited on 29-oct-2011 at 7:50PM -->
        <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26655516-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
        
	</head>

	
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="container" >

	<div id="header">
		<div id="logo"><center><a href = "<?php echo Yii::app()->createURL('/site/index');?> "><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ixpense-logo.png" ></a></center></div>
	</div><!-- header -->
<div id="mainmenu">
	
		<?php  $this->widget('zii.widgets.CMenu',array(
			
			'items'=>array(
				array('label'=>'Dashboard', 'url'=>array('/site/index')),
				array('label'=>'Expense', 'url'=>array('expense/index')),
				array('label'=>'Deposit', 'url'=>array('deposit/index')), 
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Profile', 'url'=>array('/user/view/' . Yii::app()->user->id), 'visible'=>!Yii::app()->user->isGuest),
			),
		));  ?>
		
		</div><!-- mainmenu -->
	<!--<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?> --> <!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>


	<footer> 
                <center><p><a href = "<?php echo Yii::app()->createURL('/site/page', array('view' => 'about'))?>">About Us</a> | <a href  = "<?php echo Yii::app()->createURL('/site/feedback')?>">Feedback</a> | <a href = "<?php echo Yii::app()->createURL('/site/page', array('view' => 'faqs'))?>">FAQs</a> | <a href = "<?php echo Yii::app()->createURL('/site/page', array('view' => 'help'))?>">Help</a> | <a href = "<?php echo Yii::app()->createURL('/site/page', array('view' => 'privacy'))?>">Privacy</a> | <a href = "<?php echo Yii::app()->createURL('/site/page', array('view' => 'terms'))?>">Terms</a>
                </center></p>
		<p><center>Copyright &copy; <?php echo date('Y'); ?> iXpense<br/>
		All Rights Reserved.</p></center><br/>
		<?php //echo Yii::powered(); ?>
	</footer><!-- footer -->

</div><!-- page -->

</body>
</html>