<?php
/**
 * BootPopover class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

Yii::import('ext.bootstrap.widgets.BootWidget');
class BootPopover extends BootWidget
{
	/**
	 * @property string the CSS selector to use for selecting the pop-over elements.
	 */
	public $selector = '.pop';
	
	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();
		$this->registerScriptFile('jquery.bootpopover.js');
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		$id = $this->getId();
		$options = !empty($this->options) ? CJavaScript::encode($this->options) : '';
		Yii::app()->getClientScript()->registerScript(__CLASS__.'#'.$id,"jQuery('{$this->selector}').bootpopover($options);");
	}
}
