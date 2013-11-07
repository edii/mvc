<?php
/**
 * CWidgetFactory class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

class CWidgetFactory extends CApplicationComponent implements IWidgetFactory
{
	/**
	 * @var boolean whether to enable widget skinning. Defaults to false.
	 * @see skinnableWidgets
	 * @since 1.1.3
	 */
	public $enableSkin=false;
	/**
	 * @var array widget initial property values. Each array key-value pair
	 * represents the initial property values for a single widget class, with
	 * the array key being the widget class name, and array value being the initial
	 * property value array. For example,
	 * <pre>
	 * array(
	 *     'CLinkPager'=>array(
	 *         'maxButtonCount'=>5,
	 *         'cssFile'=>false,
	 *     ),
	 *     'CJuiDatePicker'=>array(
	 *         'language'=>'ru',
	 *     ),
	 * )
	 * </pre>
	 *
	 * Note that the initial values specified here may be overridden by
	 * the values given in {@link CBaseController::createWidget} calls.
	 * They may also be overridden by widget skins, if {@link enableSkin} is true.
	 * @since 1.1.3
	 */
	public $widgets=array();
	/**
	 * @var array list of widget class names that can be skinned.
	 * Because skinning widgets has performance impact, you may want to specify this property
	 * to limit skinning only to specific widgets. Any widgets that are not in this list
	 * will not be skinned. Defaults to null, meaning all widgets can be skinned.
	 * @since 1.1.3
	 */
	public $skinnableWidgets;
	/**
	 * @var string the directory containing all the skin files. Defaults to null,
	 * meaning using the "skins" directory under the current application's {@link CWebApplication::viewPath}.
	 */
	public $skinPath;

	private $_skins=array();  // class name, skin name, property name => value

	/**
	 * Initializes the application component.
	 * This method overrides the parent implementation by resolving the skin path.
	 */
	public function init()
	{
		parent::init();

		if($this->enableSkin && $this->skinPath===null)
			$this->skinPath=\init::app()->getViewPath().DIRECTORY_SEPARATOR.'skins';
	}

	/**
	 * Creates a new widget based on the given class name and initial properties.
	 * @param CBaseController $owner the owner of the new widget
	 * @param string $className the class name of the widget. This can also be a path alias (e.g. system.web.widgets.COutputCache)
	 * @param array $properties the initial property values (name=>value) of the widget.
	 * @return CWidget the newly created widget whose properties have been initialized with the given values.
	 */
	public function createWidget($owner,$className,$properties=array())
	{
		$className=\init::import($className,true);
		$widget=new $className($owner);

		if(isset($this->widgets[$className]))
			$properties=$properties===array() ? $this->widgets[$className] : CMap::mergeArray($this->widgets[$className],$properties);
		if($this->enableSkin)
		{
			if($this->skinnableWidgets===null || in_array($className,$this->skinnableWidgets))
			{
				$skinName=isset($properties['skin']) ? $properties['skin'] : 'default';
				if($skinName!==false && ($skin=$this->getSkin($className,$skinName))!==array())
					$properties=$properties===array() ? $skin : CMap::mergeArray($skin,$properties);
			}
		}
		foreach($properties as $name=>$value)
			$widget->$name=$value;
		return $widget;
	}

	/**
	 * Returns the skin for the specified widget class and skin name.
	 * @param string $className the widget class name
	 * @param string $skinName the widget skin name
	 * @return array the skin (name=>value) for the widget
	 */
	protected function getSkin($className,$skinName)
	{
		if(!isset($this->_skins[$className][$skinName]))
		{
			$skinFile=$this->skinPath.DIRECTORY_SEPARATOR.$className.'.php';
			if(is_file($skinFile))
				$this->_skins[$className]=require($skinFile);
			else
				$this->_skins[$className]=array();

			if(($theme=\init::app()->getTheme())!==null)
			{
				$skinFile=$theme->getSkinPath().DIRECTORY_SEPARATOR.$className.'.php';
				if(is_file($skinFile))
				{
					$skins=require($skinFile);
					foreach($skins as $name=>$skin)
						$this->_skins[$className][$name]=$skin;
				}
			}

			if(!isset($this->_skins[$className][$skinName]))
				$this->_skins[$className][$skinName]=array();
		}
		return $this->_skins[$className][$skinName];
	}
}