<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"> 
 
  <!-- BEGIN HEAD --> 
  <head profile="http://gmpg.org/xfn/11"> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" /> 
    <title><?php echo Yii::app()->name ?></title> 
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->theme->baseUrl ?>/css/style.css" /> 
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/schemes.css" type="text/css" media="screen" /> 

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <!--[if lt IE 8]>
    <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
    <![endif]--> 
    <link rel="icon" type="image/png" href="<?php echo Yii::app()->theme->baseUrl?>/images/favicon.png" /> 
    <script type="text/javascript"> 
      search_string = 'search';
      menu_collapse = false;
      menu_speed = 250;
    </script> 
        <meta name='robots' content='noindex,nofollow' /> 
    <script type='text/javascript' src='<?php echo Yii::app()->theme->baseUrl ?>/js/l10n.js'></script> 
    <script type='text/javascript' src='<?php echo Yii::app()->theme->baseUrl ?>/js/jquery.js'></script> 
    <script type='text/javascript' src='<?php echo Yii::app()->theme->baseUrl ?>/js/common.js'></script> 
</head> 
  <!-- END HEAD --> 
 
  <!-- BEGIN BODY --> 
  <body class="home blog"> 
    <div id="wrapper"> 
 
      <!-- BEGIN LOGO --> <center>
      <a id="logo" href="" title="<?php echo Yii::app()->name ?>"> 
        <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/logo.png" alt="Simple Mobile" /> 
      </a> </center>
      <!-- END LOGO --> 
 
      <div class="hr"></div> 
 
      <!-- BEGIN HEADER --> 
            <img id="header" src="<?php echo Yii::app()->theme->baseUrl?>/images/header.jpg" alt="" /> 
            <!-- END HEADER --> 
 
      <div class="hr"></div> 
 
      <!-- BEGIN NAVIGATION & SEARCH --> 
      <div id="navigation"> 
        <a title="Navigate" id="navigate" class="button normal"> 
          <span class="before"></span> 
          Navigate <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/down.png" alt="" /> 
          <span class="after"></span> 
        </a> 
        <form id="searchform" action="" method="get"> 
          <div class="button normal search"> 
            <span class="before"></span> 
            <input id="s" type="text" name="s" value="search" /> 
            <input id="searchsubmit" type="submit" value="" /> 
            <span class="after"></span> 
          </div> 
        </form> 
      </div> 
      <!-- END NAVIGATION & SEARCH --> 
 
      <!-- BEGIN MENU --> 
    <div id="menu">
        <?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Dashboard', 'url'=>array('/site/index')),
				array('label'=>'Expense', 'url'=>array('expense/index')),
				array('label'=>'Deposit', 'url'=>array('deposit/index')), 
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
    </div>
      <!-- END MENU--> 
 
      <div class="hr bold"></div> 
 
        <div id="content">
            <?php echo $content ?> 
        </div>
<?php /* 
<!-- BEGIN POST --> 
<div id="post-18" class="post"> 
  <a href="http://themes.kubasto.com/simplemobile/2010/06/styles-presentation/#comments" title="31 Comments" class="comments">31</a> 
  <div class="meta">June 20, 2010 | <a href="http://themes.kubasto.com/simplemobile/category/presentation/" title="View all posts in Presentation" rel="category tag">Presentation</a></div> 
  <h2 class="title"><a href="http://themes.kubasto.com/simplemobile/2010/06/styles-presentation/" rel="bookmark" title="Styles presentation">Styles presentation</a></h2> 
  </div> 
<!-- END POST --> 
 
<div class="hr"></div> 
 
 
<!-- BEGIN POST --> 
<div id="post-13" class="post"> 
  <a href="http://themes.kubasto.com/simplemobile/2010/06/black-blue-color-scheme/#comments" title="10 Comments" class="comments">10</a> 
  <div class="meta">June 13, 2010 | <a href="http://themes.kubasto.com/simplemobile/category/presentation/" title="View all posts in Presentation" rel="category tag">Presentation</a></div> 
  <h2 class="title"><a href="http://themes.kubasto.com/simplemobile/2010/06/black-blue-color-scheme/" rel="bookmark" title="Black-blue color scheme">Black-blue color scheme</a></h2> 
  </div> 
<!-- END POST --> 
 
<div class="hr"></div> 
 
 
<!-- BEGIN POST --> 
<div id="post-12" class="post"> 
  <a href="http://themes.kubasto.com/simplemobile/2010/06/black-green-color-scheme/#comments" title="4 Comments" class="comments">4</a> 
  <div class="meta">June 13, 2010 | <a href="http://themes.kubasto.com/simplemobile/category/presentation/" title="View all posts in Presentation" rel="category tag">Presentation</a></div> 
  <h2 class="title"><a href="http://themes.kubasto.com/simplemobile/2010/06/black-green-color-scheme/" rel="bookmark" title="Black-green color scheme">Black-green color scheme</a></h2> 
  </div> 
<!-- END POST --> 
 
<div class="hr"></div> 
 
 
<!-- BEGIN POST --> 
<div id="post-11" class="post"> 
  <a href="http://themes.kubasto.com/simplemobile/2010/06/black-orange-color-scheme/#comments" title="3 Comments" class="comments">3</a> 
  <div class="meta">June 13, 2010 | <a href="http://themes.kubasto.com/simplemobile/category/presentation/" title="View all posts in Presentation" rel="category tag">Presentation</a></div> 
  <h2 class="title"><a href="http://themes.kubasto.com/simplemobile/2010/06/black-orange-color-scheme/" rel="bookmark" title="Black-orange color scheme">Black-orange color scheme</a></h2> 
  </div> 
<!-- END POST --> 
 
<div class="hr"></div> 
 
 
<!-- BEGIN POST --> 
<div id="post-10" class="post"> 
  <a href="http://themes.kubasto.com/simplemobile/2010/06/black-red-color-scheme/#comments" title="5 Comments" class="comments">5</a> 
  <div class="meta">June 13, 2010 | <a href="http://themes.kubasto.com/simplemobile/category/presentation/" title="View all posts in Presentation" rel="category tag">Presentation</a></div> 
  <h2 class="title"><a href="http://themes.kubasto.com/simplemobile/2010/06/black-red-color-scheme/" rel="bookmark" title="Black-red color scheme">Black-red color scheme</a></h2> 
  </div> 
<!-- END POST --> 
 
<div class="hr"></div> 
 
 
<!-- BEGIN POST --> 
<div id="post-9" class="post"> 
  <a href="http://themes.kubasto.com/simplemobile/2010/06/white-blue-color-scheme/#comments" title="5 Comments" class="comments">5</a> 
  <div class="meta">June 13, 2010 | <a href="http://themes.kubasto.com/simplemobile/category/presentation/" title="View all posts in Presentation" rel="category tag">Presentation</a></div> 
  <h2 class="title"><a href="http://themes.kubasto.com/simplemobile/2010/06/white-blue-color-scheme/" rel="bookmark" title="White-blue color scheme">White-blue color scheme</a></h2> 
  </div> 
<!-- END POST --> 
 
<div class="hr"></div> 
 
 
<!-- BEGIN POST --> 
<div id="post-8" class="post"> 
  <a href="http://themes.kubasto.com/simplemobile/2010/06/white-green-color-scheme/#comments" title="4 Comments" class="comments">4</a> 
  <div class="meta">June 13, 2010 | <a href="http://themes.kubasto.com/simplemobile/category/presentation/" title="View all posts in Presentation" rel="category tag">Presentation</a></div> 
  <h2 class="title"><a href="http://themes.kubasto.com/simplemobile/2010/06/white-green-color-scheme/" rel="bookmark" title="White-green color scheme">White-green color scheme</a></h2> 
  </div> 
<!-- END POST --> 
 
<div class="hr"></div> 
 
 
<!-- BEGIN POST --> 
<div id="post-6" class="post"> 
  <a href="http://themes.kubasto.com/simplemobile/2010/06/white-orange-color-scheme/#comments" title="3 Comments" class="comments">3</a> 
  <div class="meta">June 13, 2010 | <a href="http://themes.kubasto.com/simplemobile/category/presentation/" title="View all posts in Presentation" rel="category tag">Presentation</a></div> 
  <h2 class="title"><a href="http://themes.kubasto.com/simplemobile/2010/06/white-orange-color-scheme/" rel="bookmark" title="White-orange color scheme">White-orange color scheme</a></h2> 
  </div> 
<!-- END POST --> 
 
<div class="hr"></div> 
 
 
<!-- BEGIN POST --> 
<div id="post-5" class="post"> 
  <a href="http://themes.kubasto.com/simplemobile/2010/06/white-red-color-scheme/#comments" title="4 Comments" class="comments">4</a> 
  <div class="meta">June 13, 2010 | <a href="http://themes.kubasto.com/simplemobile/category/presentation/" title="View all posts in Presentation" rel="category tag">Presentation</a></div> 
  <h2 class="title"><a href="http://themes.kubasto.com/simplemobile/2010/06/white-red-color-scheme/" rel="bookmark" title="White-red color scheme">White-red color scheme</a></h2> 
  </div> 
<!-- END POST --> 
 
<div class="hr"></div> 
 
 
<!-- BEGIN POSTS PAGINATION --> 
<div class="index-pagination center"> 
  <div class="button left disabled"><span class="before"></span><span class="after"></span></div><div class="button-separator"></div> 
  <div class="button middle"><span class="before"></span><strong>1</strong> <small>of</small> 1<span class="after"></span></div><div class="button-separator"></div> 
  <div class="button right disabled"><span class="before"></span><span class="after"></span></div></div> 
<!-- END POSTS PAGINATION --> 
 
 
<div class="hr bold"></div> 
 
 
<!-- BEGIN TWITTER --> 
 
<div id="twitter"> 
  <a href="http://twitter.com/twitter/" title="Follow me!"> 
    <img src="http://themes.kubasto.com/simplemobile/wp-content/themes/simplemobile/images/twitter.png" alt="Twitter" class="logo" /> 
  </a> 
    <!-- BEGIN TWEET --> 
  <div class="tweet"> 
    <div class="date"> 
      <a href="http://twitter.com/twitter/statuses/111879501008470016"> 
        6 days ago      </a> 
    </div> 
    <p> 
      Did you know every NFL team is on Twitter? Find & follow them, along with some of your favorite players <a href="http://t.co/CaU8PnN">http://t.co/CaU8PnN</a> #NFLkickoff    </p> 
  </div> 
  <!-- END TWEET --> 
    <!-- BEGIN TWEET --> 
  <div class="tweet"> 
    <div class="date"> 
      <a href="http://twitter.com/twitter/statuses/111851648619524096"> 
        6 days ago      </a> 
    </div> 
    <p> 
      It's World Literacy Day, and if you can't read you can't Tweet!  #RTforLiteracy to support @<a href="http://twitter.com/RoomtoRead/">RoomtoRead</a> in their efforts. <a href="http://t.co/KgZV9Cv">http://t.co/KgZV9Cv</a>    </p> 
  </div> 
  <!-- END TWEET --> 
    <!-- BEGIN TWEET --> 
  <div class="tweet"> 
    <div class="date"> 
      <a href="http://twitter.com/twitter/statuses/111842657415856128"> 
        6 days ago      </a> 
    </div> 
    <p> 
      One hundred million voices <a href="http://t.co/uPnX5Um">http://t.co/uPnX5Um</a>    </p> 
  </div> 
  <!-- END TWEET --> 
  </div> 
 
 
<div class="hr bold"></div> 
 
<!-- END TWITTER --> 
 
<!-- BEGIN FLICKR --> 
 
<div id="flickr"> 
    <img src="http://themes.kubasto.com/simplemobile/wp-content/themes/simplemobile/images/flickr.png" alt="Flickr" class="logo" /> 
      <!--  BEGIN PHOTO --> 
  <div class="photo first top"> 
    <a href="http://www.flickr.com/photos/52617155@N08/6138110741" title="Grant Friedman"> 
      <img src="http://farm7.static.flickr.com/6164/6138110741_aa2ef65c4b_s.jpg" alt="Grant Friedman" width="75" height="75" /> 
    </a> 
  </div> 
  <!-- END PHOTO --> 
    <!--  BEGIN PHOTO --> 
  <div class="photo top"> 
    <a href="http://www.flickr.com/photos/52617155@N08/6138110581" title="David Appleyard's Zen office space"> 
      <img src="http://farm7.static.flickr.com/6168/6138110581_02f0bd1eb9_s.jpg" alt="David Appleyard's Zen office space" width="75" height="75" /> 
    </a> 
  </div> 
  <!-- END PHOTO --> 
    <!--  BEGIN PHOTO --> 
  <div class="photo top"> 
    <a href="http://www.flickr.com/photos/52617155@N08/6128788642" title="Travis King"> 
      <img src="http://farm7.static.flickr.com/6088/6128788642_61190607c2_s.jpg" alt="Travis King" width="75" height="75" /> 
    </a> 
  </div> 
  <!-- END PHOTO --> 
    <!--  BEGIN PHOTO --> 
  <div class="photo first"> 
    <a href="http://www.flickr.com/photos/52617155@N08/6125092993" title="Lance Snider"> 
      <img src="http://farm7.static.flickr.com/6186/6125092993_ba73b33e4d_s.jpg" alt="Lance Snider" width="75" height="75" /> 
    </a> 
  </div> 
  <!-- END PHOTO --> 
    <!--  BEGIN PHOTO --> 
  <div class="photo"> 
    <a href="http://www.flickr.com/photos/52617155@N08/6122900654" title="Carmen's desk"> 
      <img src="http://farm7.static.flickr.com/6068/6122900654_7d44dc411b_s.jpg" alt="Carmen's desk" width="75" height="75" /> 
    </a> 
  </div> 
  <!-- END PHOTO --> 
    <!--  BEGIN PHOTO --> 
  <div class="photo"> 
    <a href="http://www.flickr.com/photos/52617155@N08/6122357939" title="Carmen and the sock puppets"> 
      <img src="http://farm7.static.flickr.com/6064/6122357939_a502c5e85a_s.jpg" alt="Carmen and the sock puppets" width="75" height="75" /> 
    </a> 
  </div> 
  <!-- END PHOTO --> 
    <div class="clear"></div> 
</div> 
 
<div class="hr bold"></div> 
 
<!-- END FLICKR --> 
 
		<div id="recent-posts-3" class="widget widget_recent_entries">		<h2 class="title">Recent Posts</h2>		<ul> 
				<li><a href="http://themes.kubasto.com/simplemobile/2010/06/styles-presentation/" title="Styles presentation">Styles presentation</a></li> 
				<li><a href="http://themes.kubasto.com/simplemobile/2010/06/black-blue-color-scheme/" title="Black-blue color scheme">Black-blue color scheme</a></li> 
				<li><a href="http://themes.kubasto.com/simplemobile/2010/06/black-green-color-scheme/" title="Black-green color scheme">Black-green color scheme</a></li> 
				<li><a href="http://themes.kubasto.com/simplemobile/2010/06/black-orange-color-scheme/" title="Black-orange color scheme">Black-orange color scheme</a></li> 
				<li><a href="http://themes.kubasto.com/simplemobile/2010/06/black-red-color-scheme/" title="Black-red color scheme">Black-red color scheme</a></li> 
				</ul> 
		</div><div class="hr bold"></div> 
 
    <!-- BEGIN SOCIAL MEDIA --> 
    <ul id="social-media"> 
      <li> 
        <a href="http://themes.kubasto.com/simplemobile/feed/" title="RSS"> 
          <img src="http://themes.kubasto.com/simplemobile/wp-content/themes/simplemobile/images/socialmedia/rss.png" alt="" /> 
        </a> 
      </li> 
            <li> 
        <a href="http://twitter.com/twitter" title="Follow me!"> 
          <img src="http://themes.kubasto.com/simplemobile/wp-content/themes/simplemobile/images/socialmedia/twitter.png" alt="" /> 
        </a> 
      </li> 
            <li> 
        <a href="http://wordpress.org" title="Blog Tool and Publishing Platform"> 
          <img src="http://themes.kubasto.com/simplemobile/wp-content/themes/simplemobile/images/socialmedia/wordpress.png" alt="" /> 
        </a> 
      </li> 
            <li> 
        <a href="mailto:themes@kubasto.com" title="E-mail"> 
          <img src="http://themes.kubasto.com/simplemobile/wp-content/themes/simplemobile/images/socialmedia/email.png" alt="" /> 
        </a> 
      </li> 
            <li> 
        <a href="http://youtube.com" title="Youtube"> 
          <img src="http://themes.kubasto.com/simplemobile/wp-content/themes/simplemobile/images/socialmedia/youtube.png" alt="" /> 
        </a> 
      </li> 
          </ul> 
    <!-- END SOCIAL MEDIA --> 
*/ ?> 
    <div class="hr bold"></div> 
 
    <!-- BEGIN FOOTER --> 
    <div id="footer"> 
 
      <span class="copyright">&copy; <?php echo date('Y'); ?> Fantastic Five <br />All Rights Reserved</span>	  
      <a href="#wrapper" title="Back to top" class="top"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/top.png" alt="" /></a> 
      <!-- <a href="mailto:themes@kubasto.com">themes@kubasto.com</a> -->
    </div> 
    <!-- END FOOTER --> 
 
  </div><!-- end div #wrapper --> 
 
  
  </body> 
  <!-- END BODY --> 
 
</html>
