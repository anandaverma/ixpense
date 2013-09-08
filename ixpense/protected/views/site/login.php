<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div>
 <div style="float: left; width: 55%">
 <div style="margin-left:40px">
 
 <span style="color:#4CC417;"><font size="3.5pt">Welcome to iXpense</font>   </span><span class="label notice">a new approach to expense management</span>
 
 <ul class="unstyled">
 <br />
 <li>iXpense is built on the idea that expense management can be more intuitive, efficient, easy and useful. And anybody can use it. Because iXpense is:</li>
 <br />
 <ul><li>Free and always will be</li>
 <li>Access from anywhere and anytime</li>
 <li>Easy to handle and feature rich</li>
 <li>No need to learn accounting softwares for managing your regular expenses</li>
 <li>Keeps track of your income and expenses</li>
 <li>One click summary with graphs, charts and more......</li>
 </ul>
 </ul>
 <!--
 <div>
 <ul class="media-grid">
  <li>
    <a href="">
      <img class="thumbnail" src= "<?php echo Yii::app()->request->baseUrl; ?>/images/currency_dollar_green.png" alt="">
	</a></li>
  <li>
    <a href="">
      <img class="thumbnail" src= "<?php echo Yii::app()->request->baseUrl; ?>/images/currency_euro_blue.png" alt="">
	</a></li>
	
  <li>
    <a href="">
      <img class="thumbnail" src= "<?php echo Yii::app()->request->baseUrl; ?>/images/currency_pound.png" alt="">
	</a></li>
	
  <li>
    <a href="">
      <img class="thumbnail" src= "<?php echo Yii::app()->request->baseUrl; ?>/images/currency_yuan_yellow.png" alt="">
	</a></li>
	
	<li>
    <a href="">
      <img class="thumbnail" src= "<?php echo Yii::app()->request->baseUrl; ?>/images/money_pig.png" alt="">
	</a></li>
	</ul>
	</div>
	 -->
 <hr />
 <ul class = "unstyled">
 <li>Coming soon:</li>
 <br />
 <ul class="media-grid">
 
  <li><a href="">
      <center><img class="thumbnail" src= "<?php echo Yii::app()->request->baseUrl; ?>/images/comingsoon.png" alt="">
  </center><br />iXpense for android</a></li>
  <li><a href="">
      <center><img class="thumbnail" src= "<?php echo Yii::app()->request->baseUrl; ?>/images/mobile_web.png" alt="">
  </center><br />iXpense mobile web</a></li>
  <li><a href="">
      <center><img class="thumbnail" src= "<?php echo Yii::app()->request->baseUrl; ?>/images/budget_planner.png" alt="">
  </center><br />Budget planner</a></li>
  </ul></ul>
	  <hr />
 <ul class = "unstyled">
 <li>Follow us:</li>
 <br />
 <ul class="media-grid">
  <li> <!-- edited on 29-oct-2011 at 6:30PM-->
    <a target = "blank" href="http://www.facebook.com/pages/iXpense/179945238756496">
      <img class="thumbnail" src= "<?php echo Yii::app()->request->baseUrl; ?>/images/facebook_find.png" alt="">
	</a></li>
	<li>
    <a target = "blank" href="http://twitter.com/#!/ixpense">
      <img class="thumbnail" src= "<?php echo Yii::app()->request->baseUrl; ?>/images/twitter_find.png" alt="">
	</a></li></ul>
 </ul>
<div class="fb-like" data-href="www.ixpense.net" data-send="true" data-width="450" data-show-faces="false"></div> 
<br />
<!-- Place this tag where you want the +1 button to render -->
<g:plusone annotation="inline"></g:plusone>

<!-- Place this render call where appropriate -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

</div> 
 
<br />

  </div>
  <div style="float: right; width: 45%;">

<div class="form">
<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
	'id'=>'login-form',
	'stacked'=>true, // should this be a stacked form?
    'errorMessageType'=>'inline', // how to display errors, inline or block?
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
));
 


?>

	
<div class="hero-unit">

<h3> <img src= "<?php echo Yii::app()->request->baseUrl; ?>/images/login.png" alt=""> Login </h3>
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		
	</div>

	<?php echo $form->checkBoxBlock($model,'rememberMe'); ?>
	<?php echo BootHtml::submitButton('Login',array('class'=>'btn primary small')); ?>
	<?php echo BootHtml::link("Forgot username or password?",array('site/forgot')) ?>
	</div>
		
		<!-- edited on 29-oct-2011 at 6:37PM -->
		<?php echo "or new User? " . BootHtml::link("Register",array('user/create'), array('class'=>'btn danger medium')) ?>

		<?php $this->endWidget(); ?>

<p class="note"><span  class="label success"><?php echo ($totreguser + 1000) ?></span> users are using iXpense for managing their expenses.</p>
</div><!-- form -->
</div></div>

