<?php $this->pageTitle=Yii::app()->name; ?>

<!--<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>-->

<div id="wrapper"></div>
<table>
<tr><th bgcolor="#E3E4FA">Quick Summary <span class = "label success"><?php echo $dateTo === null? "" : "(From " . $dateFrom ." To " . $dateTo . ")";?></span></th>
    <th bgcolor="#E9CFEC">Specify Summary Range</th></tr>
<tr ><!-- Account summary-->

<td width = "50%">


<?php 
$qasummary = array('username'=>Yii::app()->user->name,'Balance_in_your_iwallet'=>UserBalance::model()->findByPk(Yii::app()->user->id)->balance . " " . User::model()->findByPk(Yii::app()->user->id)->usercurrency,);
$this->widget('ext.bootstrap.widgets.BootDetailView', array(
    'data'=>$qasummary,
    'attributes'=>array(
        'username',
		'Balance_in_your_iwallet',
		),
		));     
?>
<br />
<?php 
$qesummary = array('Total_expense'=>($totexp === null? 0: $totexp). " " . User::model()->findByPk(Yii::app()->user->id)->usercurrency, 'Average_expense_rate'=>($dlyexprate === null? 0: $dlyexprate) . " " . User::model()->findByPk(Yii::app()->user->id)->usercurrency);
$this->widget('ext.bootstrap.widgets.BootDetailView', array(
    'data'=>$qesummary,
    'attributes'=>array(
        'Total_expense',
		'Average_expense_rate',
		),
		));     
?>
<br />
<?php 
$qdsummary = array('Total_deposit'=>($totdep === null? 0: $totdep) . " " . User::model()->findByPk(Yii::app()->user->id)->usercurrency, 'Average_deposit_rate'=>($dlydptrate === null? 0: $dlydptrate). " " . User::model()->findByPk(Yii::app()->user->id)->usercurrency);
$this->widget('ext.bootstrap.widgets.BootDetailView', array(
    'data'=>$qdsummary,
    'attributes'=>array(
        'Total_deposit',
		'Average_deposit_rate',
		),
		));     
?>
</td>
<td width = "50%">
<div class="form">
<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
	'id'=>'range-form',
	'stacked'=>true, // should this be a stacked form?
    'errorMessageType'=>'inline', // how to display errors, inline or block?
	'enableClientValidation'=>true,
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
	) 
	)
);
?>
<div class="hero-unit">
		<h5>Select Dates</h5>
		<br />
		<span class = "label">from</span>
		<br />
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
		$this->widget('CJuiDateTimePicker',array(
        'model'=>$rangemodel, //Model object
        'attribute'=>'fromdate', //attribute name
        'mode'=>'date', //use "time","date" or "datetime" (default)
		'language' => 'en_us',
		'options'=>array('dateFormat' => 'yy-mm-dd','changeMonth' => 'true', 'changeYear' => 'true', 'constrainInput' => 'false',), // jquery plugin options
		)); ?>
		<?php echo $form->error($rangemodel,'fromdate'); ?>
		<br />
		<span class = "label">to</span>
		<br />
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
		$this->widget('CJuiDateTimePicker',array(
        'model'=>$rangemodel, //Model object
        'attribute'=>'todate', //attribute name
        'mode'=>'date', //use "time","date" or "datetime" (default)
		'language' => 'en_us',
		'options'=>array('dateFormat' => 'yy-mm-dd','changeMonth' => 'true', 'changeYear' => 'true', 'constrainInput' => 'false',), // jquery plugin options
		)); ?>
		<?php echo $form->error($rangemodel,'todate'); ?>
		<br />
	<?php echo BootHtml::submitButton('Generate Summary',array('class'=>'btn info medium')); ?>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
</td>
</tr> 
</table>
<table>
<tr><th bgcolor="#E3E4FA">Expense Summary <span class = "label success"><?php echo $dateTo === null? "" : "(From " . $dateFrom ." To " . $dateTo . ")";?></span></th>
 </tr>
<tr> <!-- Expense summary-->
<td width = "100%">
<b>Top 10 Expenses:</b>
<?php $this->widget('ext.bootstrap.widgets.grid.BootGridView', array(
	'id'=>'expense-grid1',
	'dataProvider'=>$dataProvider1,
	'enableSorting'=>false,
	'columns'=>array(
		'expid',
		//'uid',
		'date',
		'time',
		//'expense_place',
		'expense_category',
		'expense_name',
		'expense_mode',
		'amount',
		//'note',
		
	),
)); ?>
<b>Recent 10 Expenses:</b>
<?php $this->widget('ext.bootstrap.widgets.grid.BootGridView', array(
	'id'=>'expense-grid2',
	'dataProvider'=>$dataProvider2,
	'enableSorting'=>false,
	'columns'=>array(
		'expid',
		//'uid',
		'date',
		'time',
		//'expense_place',
		'expense_category',
		'expense_name',
		'expense_mode',
		'amount',
		//'note',
		
	),
)); ?>
</tr>
</table>
<table>
<tr><th bgcolor="#E3E4FA">Category Wise Expense Analysis <span class = "label success"><?php echo $dateTo === null? "" : "(From " . $dateFrom ." To " . $dateTo . ")";?></span></th>
<th bgcolor="#E9CFEC">Mode Wise Expense Analysis <span class = "label success"><?php echo $dateTo === null? "" : "(From " . $dateFrom ." To " . $dateTo . ")";?></span></th>
 </tr>
<tr>
<td width= "50%">
<b>Category wise total expense:</b>
<?php
//print_r($dataProvider5);
$this->widget('ext.bootstrap.widgets.grid.BootGridView', array(
	'id'=>'expense-grid5',
	'dataProvider'=>$dataProvider5,
	'enableSorting'=>false,
	/*'columns'=>array(
		'category',
		'Amount',
		//'note',
		
	),*/
));  ?>
<br />
<?php
//pie chart for categorywise expense
if ($catexp === null)
	{
	echo "nothing to display";
	}
else
	{
		$i=0;
	foreach($catexp as $key=>$value)
	{
	$d[] = array('name'=> $catexp[$i]['name'],'y'=>(double)$catexp[$i]['y']);
	$i=$i+1;
	}
	//$a = array('name'=> $catexp[0]['name'],'y'=>(int)$catexp[0]['y']);
    //$b = array('name'=> $catexp[1]['name'],'y'=>(int)$catexp[1]['y']);
	//$c = array($a,$b);
	//print_r($d);
	//echo "<br />";
	//echo ($d);
	
	$this->widget('ext.highcharts.HighchartsWidget',
    array('options'=>array(
		'id' => 'expensecategory',
		'credits' => array('enabled' => false),
        'chart'=>array(
            'plotBackgroundColor'=> null,
            'plotBorderWidth'=> null,
            'plotShadow'=> true,
        ),
        'title'=>array(
            'text'=> 'Category wise expense'
        ),
        'tooltip'=>array(
			 
             'formatter'=> 'js:function(){ return "<b>"+this.point.name+"</b>: "+this.y+"%"}'
        ),
        'plotOptions'=>array(
            'pie'=> array(
                'allowPointSelect'=>true,
                'cursor'=>'pointer',
                'dataLabels'=>array('enabled'=>true),
                'showInLegend'=>true
            )
        ),
        'series'=>array(
                array(
                    'type'=> 'pie',
                    'name'=>'Expense Analysis',
                    'data'=> $d,
					 
                ),
            )
        ))); 
	}?>
		<?php //print_r($d);
		
		?>

</td>
<td width= "50%">
<b>Mode wise total expense:</b>
<?php
//print_r($dataProvider7);
$this->widget('ext.bootstrap.widgets.grid.BootGridView', array(
	'id'=>'expense-grid7',
	'dataProvider'=>$dataProvider7,
	'enableSorting'=>false,
	/*'columns'=>array(
		'category',
		'total expense',
		//'note',
		
	),*/
));  ?>
<br />

<?php
//modewise expense

if ($modexp === null)
	{
	echo "nothing to display";
	}
else
	{
		$k=0;
	foreach($modexp as $key=>$value)
	{
	$l[] = array('name'=> $modexp[$k]['name'],'y'=>(double)$modexp[$k]['y']);
	$k=$k+1;
	}
	
	$this->widget('ext.highcharts.HighchartsWidget',
    array('options'=>array(
		'id' => 'expensecategory',
		'credits' => array('enabled' => false),
        'chart'=>array(
            'plotBackgroundColor'=> null,
            'plotBorderWidth'=> null,
            'plotShadow'=> true,
        ),
        'title'=>array(
            'text'=> 'Mode wise expense'
        ),
        'tooltip'=>array(
			 
             'formatter'=> 'js:function(){ return "<b>"+this.point.name+"</b>: "+this.y+"%"}'
        ),
        'plotOptions'=>array(
            'pie'=> array(
                'allowPointSelect'=>true,
                'cursor'=>'pointer',
                'dataLabels'=>array('enabled'=>true),
                'showInLegend'=>true
            )
        ),
        'series'=>array(
                array(
                    'type'=> 'pie',
                    'name'=>'Expense Analysis',
                    'data'=> $l,
					 
                ),
            )
        ))); 
	}?>
		<?php //print_r($d);
		
		?>

</td>
</tr>
</table>
<table>
<tr><th bgcolor="#E3E4FA">Deposit Summary <span class = "label success"><?php echo $dateTo === null? "" : "(From " . $dateFrom ." To " . $dateTo . ")";?></span></th>
    <th bgcolor="#E9CFEC">Type Wise Deposit Analysis <span class = "label success"><?php echo $dateTo === null? "" : "(From " . $dateFrom ." To " . $dateTo . ")";?></span></th></tr>
<tr> <!-- Deposit summary-->
<td width = "50%">
<b>Top 10 Deposit:</b>
<?php $this->widget('ext.bootstrap.widgets.grid.BootGridView', array(
	'id'=>'expense-grid3',
	'dataProvider'=>$dataProvider3,
	'enableSorting'=>false,
	'columns'=>array(
		'depid',
		//'uid',
		'date',
		'time',
		'deposit_type',
		'amount',
		/*
		'note',
		*/
		
	),
)); ?>
<b>Recent 10 Deposit:</b>
<?php $this->widget('ext.bootstrap.widgets.grid.BootGridView', array(
	'id'=>'expense-grid4',
	'dataProvider'=>$dataProvider4,
	'enableSorting'=>false,
	'columns'=>array(
		'depid',
		//'uid',
		'date',
		'time',
		'deposit_type',
		'amount',
		/*
		'note',
		*/
		
	),
)); ?>


</td>
<td width = "50%">
<b>Type wise total deposit:</b>
<?php
//print_r($dataProvider5);
$this->widget('ext.bootstrap.widgets.grid.BootGridView', array(
	'id'=>'expense-grid6',
	'dataProvider'=>$dataProvider6,
	'enableSorting'=>false,
	/*'columns'=>array(
		'category',
		'total expense',
		//'note',
		
	),*/
));  ?>
<br />
<?php 


if ($deptype === null)
	{
	echo "nothing to display";
	}
else
	{
	$j=0;
	foreach($deptype as $key=>$value)
	{
	$e[] = array('name'=> $deptype[$j]['name'],'y'=>(double)$deptype[$j]['y']);
	$j=$j+1;
	}
	$this->widget('ext.highcharts.HighchartsWidget',
    array('options'=>array(
		'credits' => array('enabled' => false),
		'id' => 'deposittype',
        'chart'=>array(
            'plotBackgroundColor'=> null,
            'plotBorderWidth'=> null,
            'plotShadow'=> true,
        ),
        'title'=>array(
            'text'=> 'Type wise deposit'
        ),
        'tooltip'=>array(
             'formatter'=> 'js:function(){ return "<b>"+this.point.name+"</b>: "+this.y+"%"}'
        ),
        'plotOptions'=>array(
            'pie'=> array(
                'allowPointSelect'=>true,
                'cursor'=>'pointer',
                'dataLabels'=>array('enabled'=>true),
                'showInLegend'=>true
            )
        ),
        'series'=>array(
                array(
                    'type'=> 'pie',
                    'name'=>'deposit type',
                    'data'=> $e,
                ),
            )
        )));
	}
	
	?>
	<?php // print_r($deptype);
		
		?>
		
		
</td>
</tr>
</table>
<a href="#wrapper" title="Back to top" class="top">Back to top</a> 






<?php /* 
$b = new EWebBrowser();
 
echo '__toString<br>';
echo $b;
 
echo '<p></p>';
echo '<h3>Testing properties now</h3>';
echo 'user agent: '.$b->userAgent.'<br>';
echo 'platform: '.$b->platform.'<br>';
echo 'version: '.$b->version .'<br>';
echo 'browser: '.$b->browser.'<br>';
echo 'is Chrome? '.($b->browser == EWebBrowser::BROWSER_CHROME?'YES':'NO');

*/?>