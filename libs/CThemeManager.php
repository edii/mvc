<?php
/**
 * CThemeManager class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

class CThemeManager extends \CApplicationComponent
{
	/**
	 * default themes base path
	 */
	const DEFAULT_BASEPATH = 'schemas'; //.DS._detected.DS

	/**
	 * @var string the name of the theme class for representing a theme.
	 * Defaults to {@link CTheme}. This can also be a class name in dot syntax.
	 */
	public $themeClass = 'CTheme';

	private $_basePath=null;
	private $_baseUrl=null;


	/**
	 * @param string $name name of the theme to be retrieved
	 * @return CTheme the theme retrieved. Null if the theme does not exist.
	 */
	public function getTheme($name) {
                
		$themePath = $this->getBasePath().DS._detected.DS.'layout';
		if(is_dir($themePath)) {
			$class = \init::import($this->themeClass, true);
			return new $class($name, $themePath, $this->getBaseUrl().DS._detected.DS.'layout');
		}
		else
			return null;
	}

	/**
	 * @return array list of available theme names
	 */
	public function getThemeNames()
	{
		static $themes;
		if($themes===null)
		{
			$themes=array();
			$basePath=$this->getBasePath();
			$folder=@opendir($basePath);
			while(($file=@readdir($folder))!==false)
			{
				if($file!=='.' && $file!=='..' && $file!=='.svn' && $file!=='.gitignore' && is_dir($basePath.DIRECTORY_SEPARATOR.$file))
					$themes[]=$file;
			}
			closedir($folder);
			sort($themes);
		}
		return $themes;
	}

	/**
	 * @return string the base path for all themes. Defaults to "WebRootPath/themes".
	 */
	public function getBasePath()
	{
		if($this->_basePath===null)
			$this->setBasePath(dirname(\init::app()->getRequest()->getScriptFile()).DS.self::DEFAULT_BASEPATH);
		return $this->_basePath;
	}

	/**
	 * @param string $value the base path for all themes.
	 * @throws CException if the base path does not exist
	 */
	public function setBasePath($value)
	{
		$this->_basePath=realpath($value);
		if($this->_basePath===false || !is_dir($this->_basePath))
			throw new CException(\init::t('yii','Theme directory "{directory}" does not exist.',array('{directory}'=>$value)));
	}

	/**
	 * @return string the base URL for all themes. Defaults to "/WebRoot/themes".
	 */
	public function getBaseUrl()
	{
		if($this->_baseUrl===null)
			$this->_baseUrl=\init::app()->getBaseUrl().DS.self::DEFAULT_BASEPATH;
		return $this->_baseUrl;
	}

	/**
	 * @param string $value the base URL for all themes.
	 */
	public function setBaseUrl($value) {
		$this->_baseUrl=rtrim($value, DS);
	}
}
