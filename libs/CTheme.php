<?php
/**
 * CTheme class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */


class CTheme extends \CComponent {
    
	private $_name;
	private $_basePath;
	private $_baseUrl;

	/**
	 * Constructor.
	 * @param string $name name of the theme
	 * @param string $basePath base theme path
	 * @param string $baseUrl base theme URL
	 */
	public function __construct($name,$basePath,$baseUrl) {
		$this->_name     =   $name;
		$this->_baseUrl  =   $baseUrl;
		$this->_basePath =   $basePath;
	}

	/**
	 * @return string theme name
	 */
	public function getName() {
		return $this->_name;
	}

	/**
	 * @return string the relative URL to the theme folder (without ending slash)
	 */
	public function getBaseUrl() {
		return $this->_baseUrl;
	}

	/**
	 * @return string the file path to the theme folder
	 */
	public function getBasePath() {
		return $this->_basePath;
	}

	/**
	 * @return string the path for controller views. Defaults to 'ThemeRoot/views'.
	 */
	public function getViewPath() {
		// return $this->_basePath.DS.'views';
            
            
            return $this->_basePath.DS;
	}

	/**
	 * @return string the path for system views. Defaults to 'ThemeRoot/views/system'.
	 */
	public function getSystemViewPath() {
            
            // echo " ".$this->getViewPath().DS.'system';
		// return $this->getViewPath().DS.'system';
            return $this->getViewPath().DS.'system';
	}

	/**
	 * @return string the path for widget skins. Defaults to 'ThemeRoot/views/skins'.
	 * @since 1.1
	 */
	public function getSkinPath() {
		return $this->getViewPath().DS.'skins';
	}

	/**
	 * Finds the view file for the specified controller's view.
	 * @param CController $controller the controller
	 * @param string $viewName the view name
	 * @return string the view file path. False if the file does not exist.
	 */
	public function getViewFile($controller,$viewName) {
		$moduleViewPath=$this->getViewPath();
		if(($module=$controller->getModule())!==null)
			$moduleViewPath.= DS.$module->getId();
		return $controller->resolveViewFile($viewName,$this->getViewPath().DS.$controller->getUniqueId(),$this->getViewPath(),$moduleViewPath);
	}

	/**
	 * Finds the layout file for the specified controller's layout.
	 * @param CController $controller the controller
	 * @param string $layoutName the layout name
	 * @return string the layout file path. False if the file does not exist.
	 */
	public function getLayoutFile($controller,$layoutName) {
            
                  
            
		$moduleViewPath=$basePath=$this->getViewPath();
		$module=$controller->getModule();
                
                //echo $layoutName; die('ssss');
                
		if(empty($layoutName)) {
			while($module!==null) {
				if($module->layout===false)
					return false;
				if(!empty($module->layout))
					break;
				$module=$module->getParentModule();
			}
			if($module===null)
				$layoutName = \init::app()->layout;
			else {
				$layoutName = $module->layout;
				$moduleViewPath .= DS.$module->getId();
			}
		}
		elseif($module!==null)
			$moduleViewPath.= DS.$module->getId();

                // echo $layoutName." ".$moduleViewPath."  ".$basePath." ".$moduleViewPath; die('loadLayout');
                
		return $controller->resolveViewFile($layoutName,$moduleViewPath,$basePath,$moduleViewPath); //.'/layouts'
	}
}
