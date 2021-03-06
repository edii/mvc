<?php
/**
 * CController class file.
 *
 * @author Sergei Novickiy <edii87shadow@gmail.com>
 * @copyright Copyright &copy; 2013 
 */
class CController extends \CBaseController
{
	/**
	 * Name of the hidden field storing persistent page states.
	 */
	const STATE_INPUT_NAME='PAGE_STATE';

	
	public $layout;
	/**
	 * @var string the name of the default action. Defaults to 'index'.
	 */
	public $defaultAction='index';

	private $_id;
	private $_action;
	private $_pageTitle;
	private $_cachingStack;
	private $_clips;
	private $_dynamicOutput;
	private $_pageStates;
	private $_module;

        
        public $_view_global = [];
        
	/**
	 * @param string $id id of this controller
	 * @param CWebModule $module the module that this controller belongs to.
	 */
	public function __construct($id,$module=null)
	{
		$this->_id      = $id;
		$this->_module  = $module;
		$this->attachBehaviors($this->behaviors());
                
                // $this->_runLayout(); // load layout
                
	}
       
	
	public function init() {
	}

	
	public function filters() {
		return array();
	}

	
	public function actions() {
		return array();
	}

	
	public function behaviors() {
		return array();
	}

	
	public function accessRules() {
		return array();
	}

	public function run($actionID) {
                
            
		if(($action=$this->createAction($actionID))!==null) {
			if(($parent=$this->getModule())===null)
				$parent=\init::app();
			if($parent->beforeControllerAction($this,$action))
			{
				$this->runActionWithFilters($action,$this->filters());
				$parent->afterControllerAction($this,$action);
                                
			}
		}
		else
			$this->missingAction($actionID);
	}

       // public function _runLayout() {
        //    if($this->layout) {
         //       \init::app()->setTheme( $this->layout );
          //  }
       // }
        
	/**
	 * Runs an action with the specified filters.
	 * A filter chain will be created based on the specified filters
	 * and the action will be executed then.
	 * @param CAction $action the action to be executed.
	 * @param array $filters list of filters to be applied to the action.
	 * @see filters
	 * @see createAction
	 * @see runAction
	 */
	public function runActionWithFilters($action,$filters)
	{
		if(empty($filters))
			$this->runAction($action);
		else
		{
			$priorAction=$this->_action;
			$this->_action=$action;
			CFilterChain::create($this,$action,$filters)->run();
			$this->_action=$priorAction;
		}
	}

	/**
	 * Runs the action after passing through all filters.
	 * This method is invoked by {@link runActionWithFilters} after all possible filters have been executed
	 * and the action starts to run.
	 * @param CAction $action action to run
	 */
	public function runAction($action)
	{
		$priorAction=$this->_action;
		$this->_action=$action;
		if($this->beforeAction($action))
		{
			if($action->runWithParams($this->getActionParams())===false)
				$this->invalidActionParams($action);
			else
				$this->afterAction($action);
		}
		$this->_action=$priorAction;
	}

	/**
	 * Returns the request parameters that will be used for action parameter binding.
	 * By default, this method will return $_GET. You may override this method if you
	 * want to use other request parameters (e.g. $_GET+$_POST).
	 * @return array the request parameters to be used for action parameter binding
	 * @since 1.1.7
	 */
	public function getActionParams()
	{
		return $_GET;
	}

	/**
	 * This method is invoked when the request parameters do not satisfy the requirement of the specified action.
	 * The default implementation will throw a 400 HTTP exception.
	 * @param CAction $action the action being executed
	 * @since 1.1.7
	 */
	public function invalidActionParams($action)
	{
		throw new CHttpException(400,\init::t('init','Your request is invalid.'));
	}

	/**
	 * Postprocesses the output generated by {@link render()}.
	 * This method is invoked at the end of {@link render()} and {@link renderText()}.
	 * If there are registered client scripts, this method will insert them into the output
	 * at appropriate places. If there are dynamic contents, they will also be inserted.
	 * This method may also save the persistent page states in hidden fields of
	 * stateful forms in the page.
	 * @param string $output the output generated by the current action
	 * @return string the output that has been processed.
	 */
	public function processOutput($output) {
		\init::app()->getClientScript()->render($output);
                
		// if using page caching, we should delay dynamic output replacement
		if($this->_dynamicOutput !== null && $this->isCachingStackEmpty())
		{
			$output = $this->processDynamicOutput($output);
			$this->_dynamicOutput=null;
		}

		if($this->_pageStates===null)
			$this->_pageStates=$this->loadPageStates();
		if(!empty($this->_pageStates))
			$this->savePageStates($this->_pageStates,$output);

		return $output;
	}

	/**
	 * Postprocesses the dynamic output.
	 * This method is internally used. Do not call this method directly.
	 * @param string $output output to be processed
	 * @return string the processed output
	 */
	public function processDynamicOutput($output) {
		if($this->_dynamicOutput) {
			$output=preg_replace_callback('/<###dynamic-(\d+)###>/',array($this,'replaceDynamicOutput'),$output);
		}
		return $output;
	}

	/**
	 * Replaces the dynamic content placeholders with actual content.
	 * This is a callback function used internally.
	 * @param array $matches matches
	 * @return string the replacement
	 * @see processOutput
	 */
	protected function replaceDynamicOutput($matches)
	{
		$content=$matches[0];
		if(isset($this->_dynamicOutput[$matches[1]]))
		{
			$content=$this->_dynamicOutput[$matches[1]];
			$this->_dynamicOutput[$matches[1]]=null;
		}
		return $content;
	}

	/**
	 * Creates the action instance based on the action name.
	 * The action can be either an inline action or an object.
	 * The latter is created by looking up the action map specified in {@link actions}.
	 * @param string $actionID ID of the action. If empty, the {@link defaultAction default action} will be used.
	 * @return CAction the action instance, null if the action does not exist.
	 * @see actions
	 */
	public function createAction( $actionID, $layout = true )
	{
               
		if($actionID==='')
			$actionID=$this->defaultAction;
		if(method_exists($this,'action'.$actionID) && strcasecmp($actionID,'s')) // we have actions method
			return new \CInlineAction($this,$actionID);
		else
		{
			$action=$this->createActionFromMap($this->actions(),$actionID,$actionID);
			if($action!==null and !method_exists($action,'run'))
				throw new CException(\init::t('init', 'Action class {class} must implement the "run" method.', array('{class}'=>get_class($action))));
			return $action;
		}
	}
        
        public function createBoxAction( $actionID, $layout = true )
	{
                $this->layout = false;
		if($actionID==='')
			$actionID=$this->defaultAction;
		if(method_exists($this,'action'.$actionID) && strcasecmp($actionID,'s')) // we have actions method
			return new \CInlineAction($this,$actionID);
		else
		{
			$action=$this->createActionFromMap($this->actions(),$actionID,$actionID);
			if($action!==null and !method_exists($action,'run'))
				throw new CException(\init::t('init', 'Action class {class} must implement the "run" method.', array('{class}'=>get_class($action))));
			return $action;
		}
	}
        
        

	/**
	 * Creates the action instance based on the action map.
	 * This method will check to see if the action ID appears in the given
	 * action map. If so, the corresponding configuration will be used to
	 * create the action instance.
	 * @param array $actionMap the action map
	 * @param string $actionID the action ID that has its prefix stripped off
	 * @param string $requestActionID the originally requested action ID
	 * @param array $config the action configuration that should be applied on top of the configuration specified in the map
	 * @return CAction the action instance, null if the action does not exist.
	 */
	protected function createActionFromMap($actionMap,$actionID,$requestActionID,$config=array())
	{
		if(($pos=strpos($actionID,'.'))===false && isset($actionMap[$actionID]))
		{
			$baseConfig=is_array($actionMap[$actionID]) ? $actionMap[$actionID] : array('class'=>$actionMap[$actionID]);
			return \init::createComponent(empty($config)?$baseConfig:array_merge($baseConfig,$config),$this,$requestActionID);
		}
		elseif($pos===false)
			return null;

		// the action is defined in a provider
		$prefix=substr($actionID,0,$pos+1);
		if(!isset($actionMap[$prefix]))
			return null;
		$actionID=(string)substr($actionID,$pos+1);

		$provider=$actionMap[$prefix];
		if(is_string($provider))
			$providerType=$provider;
		elseif(is_array($provider) && isset($provider['class']))
		{
			$providerType=$provider['class'];
			if(isset($provider[$actionID]))
			{
				if(is_string($provider[$actionID]))
					$config=array_merge(array('class'=>$provider[$actionID]),$config);
				else
					$config=array_merge($provider[$actionID],$config);
			}
		}
		else
			throw new CException(\init::t('init','Object configuration must be an array containing a "class" element.'));

		$class=\init::import($providerType,true);
		$map=call_user_func(array($class,'actions'));

		return $this->createActionFromMap($map,$actionID,$requestActionID,$config);
	}

	/**
	 * Handles the request whose action is not recognized.
	 * This method is invoked when the controller cannot find the requested action.
	 * The default implementation simply throws an exception.
	 * @param string $actionID the missing action name
	 * @throws CHttpException whenever this method is invoked
	 */
	public function missingAction($actionID) {
		throw new \CHttpException(404,\init::t('init','The system is unable to find the requested action "{action}".',
			array('{action}'=>$actionID==''?$this->defaultAction:$actionID)));
	}

	/**
	 * @return CAction the action currently being executed, null if no active action.
	 */
	public function getAction() {
		return $this->_action;
	}

	/**
	 * @param CAction $value the action currently being executed.
	 */
	public function setAction($value) {
		$this->_action=$value;
	}

	/**
	 * @return string ID of the controller
	 */
	public function getId() {
		return $this->_id;
	}

	/**
	 * @return string the controller ID that is prefixed with the module ID (if any).
	 */
	public function getUniqueId() {
		return $this->_module ? $this->_module->getId().DS.$this->_id : $this->_id;
	}

	/**
	 * @return string the route (module ID, controller ID and action ID) of the current request.
	 * @since 1.1.0
	 */
	public function getRoute() {
		if(($action=$this->getAction())!==null)
			return $this->getUniqueId().'/'.$action->getId();
		else
			return $this->getUniqueId();
	}

	/**
	 * @return CWebModule the module that this controller belongs to. It returns null
	 * if the controller does not belong to any module
	 */
	public function getModule() {
		return $this->_module;
	}

	/**
	 * Returns the directory containing view files for this controller.
	 * The default implementation returns 'protected/views/ControllerID'.
	 * Child classes may override this method to use customized view path.
	 * If the controller belongs to a module, the default view path
	 * is the {@link CWebModule::getViewPath module view path} appended with the controller ID.
	 * @return string the directory containing the view files for this controller. Defaults to 'protected/views/ControllerID'.
	 */
	public function getViewPath() {
		if(($module=$this->getModule())===null)
			$module=\init::app();
		// return $module->getViewPath().DS.$this->getId().DS.'view';
                
               // return $module->getViewPath().DS.$this->getId().DS.'view';
                
                return \init::app()->getMvc().DS._detected.DS.$this->getId().DS.'view';
	}

	
	public function getViewFile($viewName) {
                // $theme=\init::app()->getTheme();
                // $viewFile = $theme->getViewFile($this, $viewName);
  
                
                //echo "viewName = ".$viewName;
                
		//if(($theme = \init::app()->getTheme()) != false && ($viewFile = $theme->getViewFile($this,$viewName)) !== false)
			//return $viewFile;
                
		$moduleViewPath=$basePath=\init::app()->getViewPath();
		if(($module=$this->getModule())!==null)
			$moduleViewPath=$module->getViewPath();
                
                
               // $_view_path = \init::app()->getMvc().DS._detected.DS; // $this->getMvc().DS._detected.DS.$id.DS.'controllers'.DS;

               // if(is_dir( $_view_path ))
                  //  \init::app()->setViewPath( $_view_path );
                
                
		return $this->resolveViewFile($viewName,$this->getViewPath(),$basePath,$moduleViewPath);
	}

	/**
	 * Looks for the layout view script based on the layout name.
	 *
	 */
	public function getLayoutFile($layoutName) {
               
            
                // echo "layout loader = ".$layoutName;
            
                
            
		if($layoutName===false)
			return false;
		if(($theme=\init::app()->getTheme())!= false && ($layoutFile=$theme->getLayoutFile($this,$layoutName))!==false)
			return $layoutFile;

		if(empty($layoutName))
		{
			$module=$this->getModule();
			while($module!==null)
			{
				if($module->layout===false)
					return false;
				if(!empty($module->layout))
					break;
				$module=$module->getParentModule();
			}
			if($module===null)
				$module=\init::app();
			$layoutName=$module->layout;
		}
		elseif(($module=$this->getModule())===null)
			$module=\init::app();

                
                 //echo "BLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA ".__CLASS__." BPath = ".\init::app()->getViewPath()." modelPath = ".$module->getLayoutPath(); 
                // echo $layoutName." "; die('layout');
                
                //echo $layoutName." m = ".$module->getLayoutPath()." view = ".\init::app()->getViewPath()." mp = ".$module->getViewPath();
                //die('stop');
                
		return $this->resolveViewFile($layoutName,$module->getLayoutPath(),\init::app()->getViewPath(),$module->getViewPath());
	}

	/**
	 * Finds a view file based on its name..
	 */
	public function resolveViewFile($viewName, $viewPath, $basePath, $moduleViewPath=null) {
            
		if(empty($viewName))
			return false;

		if($moduleViewPath===null)
			$moduleViewPath=$basePath;

		if(($renderer=\init::app()->getViewRenderer())!==null)
			$extension=$renderer->fileExtension;
		else
			$extension='.php';
                
		if($viewName[0]==='/') {
			if(strncmp($viewName,'//',2)===0)
				$viewFile=$basePath.$viewName;
			else
				$viewFile=$moduleViewPath.$viewName;
		}
		elseif(strpos($viewName,'.'))
			$viewFile=\init::getPathOfAlias($viewName);
		else
			$viewFile=$viewPath.DS.$viewName;

                // echo $viewFile.$extension; die('view'); // fix
                
		if(is_file($viewFile.$extension)) {
			return \init::app()->findLocalizedFile($viewFile.$extension);
                }        
		elseif($extension!=='.php' && is_file($viewFile.'.php')) 
			return \init::app()->findLocalizedFile($viewFile.'.php');
                else
			return false;
                
                
                
	}

	/**
	 * Returns the list of clips.
	 * A clip is a named piece of rendering result that can be
	 * inserted at different places.
	 * @return CMap the list of clips
	 * @see CClipWidget
	 */
	public function getClips()
	{
		if($this->_clips!==null)
			return $this->_clips;
		else
			return $this->_clips=new CMap;
	}

	/**
	 * Processes the request using another controller action.
	 * This is like {@link redirect}, but the user browser's URL remains unchanged.
	 * In most cases, you should call {@link redirect} instead of this method.
	 * @param string $route the route of the new controller action. This can be an action ID, or a complete route
	 * with module ID (optional in the current module), controller ID and action ID. If the former, the action is assumed
	 * to be located within the current controller.
	 * @param boolean $exit whether to end the application after this call. Defaults to true.
	 * @since 1.1.0
	 */
	public function forward($route,$exit=true)
	{
		if(strpos($route,'/')===false)
			$this->run($route);
		else {
			if($route[0]!=='/' && ($module=$this->getModule())!==null)
				$route=$module->getId().'/'.$route;
			\init::app()->runController($route);
		}
		if($exit)
			\init::app()->end();
	}

	/**
	 * Renders a view with a layout.
	 */
	public function render($view,$data=null,$return=false) {
                 
                
                // var_dump($this->layout); die('layout');
                //$this -> _view_global[$view] = $view;
            
		if($this->beforeRender($view)) {
                    
			$output=$this->renderPartial($view,$data,true);
			if(($layoutFile=$this->getLayoutFile($this->layout))!==false) {
                            $output=$this->renderFile($layoutFile,array('content'=>$output),true);
                        }        
                        
			$this->afterRender($view,$output);
			$output=$this->processOutput($output);

			if($return)
				return $output;
			else
				echo $output;
		}
                
                //return $this -> _view_global;
	}

	/**
	 * This method is invoked at the beginning of {@link render()}.
	 * You may override this method to do some preprocessing when rendering a view.
	 * @param string $view the view to be rendered
	 * @return boolean whether the view should be rendered.
	 * @since 1.1.5
	 */
	protected function beforeRender($view) {
		return true;
	}

	/**
	 * This method is invoked after the specified is rendered by calling {@link render()}.
	 * Note that this method is invoked BEFORE {@link processOutput()}.
	 * You may override this method to do some postprocessing for the view rendering.
	 * @param string $view the view that has been rendered
	 * @param string $output the rendering result of the view. Note that this parameter is passed
	 * as a reference. That means you can modify it within this method.
	 * @since 1.1.5
	 */
	protected function afterRender($view, $output) {
	}

	/**
	 * Renders a static text string.
	 * The string will be inserted in the current controller layout and returned back.
	 * @param string $text the static text string
	 * @param boolean $return whether the rendering result should be returned instead of being displayed to end users.
	 * @return string the rendering result. Null if the rendering result is not required.
	 * @see getLayoutFile
	 */
	public function renderText($text,$return=false) {
		if(($layoutFile=$this->getLayoutFile($this->layout))!==false)
			$text=$this->renderFile($layoutFile,array('content'=>$text),true);

		$text=$this->processOutput($text);

		if($return)
			return $text;
		else
			echo $text;
	}

	/**
	 * Renders a view.
	 */
	public function renderPartial($view, $data=null, $return=false, $processOutput=false)
	{
                //  echo "".$view; die('view');
		if(($viewFile=$this->getViewFile($view))!==false) {
                        
			$output = $this->renderFile($viewFile,$data,true);
                        
			if($processOutput)
				$output=$this->processOutput($output);
			//echo "".$view; die('view');
                        if($return)
				return $output;
			else
				echo $output;
		}
		else
			throw new \CException(\init::t('init','{controller} cannot find the requested view "{view}".',
				array('{controller}'=>get_class($this), '{view}'=>$view)));
	}

	/**
	 * Renders a named clip with the supplied parameters.
	 */
	public function renderClip($name,$params=array(),$return=false) {
		$text=isset($this->clips[$name]) ? strtr($this->clips[$name], $params) : '';

		if($return)
			return $text;
		else
			echo $text;
	}

	/**
	 * Renders dynamic content returned by the specified callback.
	 */
	public function renderDynamic($callback) {
		$n=count($this->_dynamicOutput);
		echo "<###dynamic-$n###>";
		$params=func_get_args();
		array_shift($params);
		$this->renderDynamicInternal($callback,$params);
	}

	/**
	 * This method is internally used.
	 * @param callback $callback a PHP callback which returns the needed dynamic content.
	 * @param array $params parameters passed to the PHP callback
	 * @see renderDynamic
	 */
	public function renderDynamicInternal($callback,$params) {
		$this->recordCachingAction('','renderDynamicInternal',array($callback,$params));
		if(is_string($callback) && method_exists($this,$callback))
			$callback=array($this,$callback);
		$this->_dynamicOutput[]=call_user_func_array($callback,$params);
	}

	/**
	 * Creates a relative URL for the specified action defined in this controller.
	 * @param string $route the URL route. This should be in the format of 'ControllerID/ActionID'.
	 * If the ControllerID is not present, the current controller ID will be prefixed to the route.
	 * If the route is empty, it is assumed to be the current action.
	 * If the controller belongs to a module, the {@link CWebModule::getId module ID}
	 * will be prefixed to the route. (If you do not want the module ID prefix, the route should start with a slash '/'.)
	 * @param array $params additional GET parameters (name=>value). Both the name and value will be URL-encoded.
	 * If the name is '#', the corresponding value will be treated as an anchor
	 * and will be appended at the end of the URL.
	 * @param string $ampersand the token separating name-value pairs in the URL.
	 * @return string the constructed URL
	 */
	public function createUrl($route,$params=array(),$ampersand='&')
	{
		if($route==='')
			$route=$this->getId().'/'.$this->getAction()->getId();
		elseif(strpos($route,'/')===false)
			$route=$this->getId().'/'.$route;
		if($route[0]!=='/' && ($module=$this->getModule())!==null)
			$route=$module->getId().'/'.$route;
		return \init::app()->createUrl(trim($route,'/'),$params,$ampersand);
	}

	/**
	 * Creates an absolute URL for the specified action defined in this controller.
	 * @param string $route the URL route. This should be in the format of 'ControllerID/ActionID'.
	 * If the ControllerPath is not present, the current controller ID will be prefixed to the route.
	 * If the route is empty, it is assumed to be the current action.
	 * @param array $params additional GET parameters (name=>value). Both the name and value will be URL-encoded.
	 * @param string $schema schema to use (e.g. http, https). If empty, the schema used for the current request will be used.
	 * @param string $ampersand the token separating name-value pairs in the URL.
	 * @return string the constructed URL
	 */
	public function createAbsoluteUrl($route,$params=array(),$schema='',$ampersand='&')
	{
		$url=$this->createUrl($route,$params,$ampersand);
		if(strpos($url,'http')===0)
			return $url;
		else
			return \init::app()->getRequest()->getHostInfo($schema).$url;
	}

	/**
	 * @return string the page title. Defaults to the controller name and the action name.
	 */
	public function getPageTitle()
	{
		if($this->_pageTitle!==null)
			return $this->_pageTitle;
		else
		{
			$name=ucfirst(basename($this->getId()));
			if($this->getAction()!==null && strcasecmp($this->getAction()->getId(),$this->defaultAction))
				return $this->_pageTitle=\init::app()->name.' - '.ucfirst($this->getAction()->getId()).' '.$name;
			else
				return $this->_pageTitle=\init::app()->name.' - '.$name;
		}
	}

	/**
	 * @param string $value the page title.
	 */
	public function setPageTitle($value)
	{
		$this->_pageTitle=$value;
	}

	/**
	 * Redirects the browser to the specified URL or route (controller/action).
	 * @param mixed $url the URL to be redirected to. If the parameter is an array,
	 * the first element must be a route to a controller action and the rest
	 * are GET parameters in name-value pairs.
	 * @param boolean $terminate whether to terminate the current application after calling this method. Defaults to true.
	 * @param integer $statusCode the HTTP status code. Defaults to 302. See {@link http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html}
	 * for details about HTTP status code.
	 */
	public function redirect($url,$terminate=true,$statusCode=302) {
		if(is_array($url)) {
			$route=isset($url[0]) ? $url[0] : '';
			$url=$this->createUrl($route,array_splice($url,1));
		}
		\init::app()->getRequest()->redirect($url,$terminate,$statusCode);
	}

	/**
	 * Refreshes the current page.
	 * The effect of this method call is the same as user pressing the
	 * refresh button on the browser (without post data).
	 * @param boolean $terminate whether to terminate the current application after calling this method
	 * @param string $anchor the anchor that should be appended to the redirection URL.
	 * Defaults to empty. Make sure the anchor starts with '#' if you want to specify it.
	 */
	public function refresh($terminate=true,$anchor='') {
		$this->redirect(\init::app()->getRequest()->getUrl().$anchor,$terminate);
	}

	/**
	 * Records a method call when an output cache is in effect.
	 * When the content is served from the output cache, the recorded
	 * method will be re-invoked.
	 * @param string $context a property name of the controller. It refers to an object
	 * whose method is being called. If empty it means the controller itself.
	 * @param string $method the method name
	 * @param array $params parameters passed to the method
	 * @see COutputCache
	 */
	public function recordCachingAction($context,$method,$params) {
		if($this->_cachingStack) // record only when there is an active output cache
		{
			foreach($this->_cachingStack as $cache)
				$cache->recordAction($context,$method,$params);
		}
	}

	/**
	 * @param boolean $createIfNull whether to create a stack if it does not exist yet. Defaults to true.
	 * @return CStack stack of {@link COutputCache} objects
	 */
	public function getCachingStack($createIfNull=true) {
		if(!$this->_cachingStack)
			$this->_cachingStack=new CStack;
		return $this->_cachingStack;
	}

	/**
	 * Returns whether the caching stack is empty.
	 * @return boolean whether the caching stack is empty. If not empty, it means currently there are
	 * some output cache in effect. Note, the return result of this method may change when it is
	 * called in different output regions, depending on the partition of output caches.
	 */
	public function isCachingStackEmpty()
	{
		return $this->_cachingStack===null || !$this->_cachingStack->getCount();
	}

	/**
	 * This method is invoked right before an action is to be executed (after all possible filters.)
	 * You may override this method to do last-minute preparation for the action.
	 * @param CAction $action the action to be executed.
	 * @return boolean whether the action should be executed.
	 */
	protected function beforeAction($action)
	{
		return true;
	}

	/**
	 * This method is invoked right after an action is executed.
	 * You may override this method to do some postprocessing for the action.
	 * @param CAction $action the action just executed.
	 */
	protected function afterAction($action)
	{
	}

	/**
	 * The filter method for 'postOnly' filter.
	 * This filter throws an exception (CHttpException with code 400) if the applied action is receiving a non-POST request.
	 * @param CFilterChain $filterChain the filter chain that the filter is on.
	 * @throws CHttpException if the current request is not a POST request
	 */
	public function filterPostOnly($filterChain)
	{
		if(\init::app()->getRequest()->getIsPostRequest())
			$filterChain->run();
		else
			throw new CHttpException(400,\init::t('init','Your request is invalid.'));
	}

	/**
	 * The filter method for 'ajaxOnly' filter.
	 * This filter throws an exception (CHttpException with code 400) if the applied action is receiving a non-AJAX request.
	 * @param CFilterChain $filterChain the filter chain that the filter is on.
	 * @throws CHttpException if the current request is not an AJAX request.
	 */
	public function filterAjaxOnly($filterChain)
	{
		if(\init::app()->getRequest()->getIsAjaxRequest())
			$filterChain->run();
		else
			throw new CHttpException(400,\init::t('init','Your request is invalid.'));
	}

	/**
	 * The filter method for 'accessControl' filter.
	 * This filter is a wrapper of {@link CAccessControlFilter}.
	 * To use this filter, you must override {@link accessRules} method.
	 * @param CFilterChain $filterChain the filter chain that the filter is on.
	 */
	public function filterAccessControl($filterChain)
	{
		$filter=new CAccessControlFilter;
		$filter->setRules($this->accessRules());
		$filter->filter($filterChain);
	}

	/**
	 * Returns a persistent page state value.
	 * A page state is a variable that is persistent across POST requests of the same page.
	 * In order to use persistent page states, the form(s) must be stateful
	 * which are generated using {@link CHtml::statefulForm}.
	 * @param string $name the state name
	 * @param mixed $defaultValue the value to be returned if the named state is not found
	 * @return mixed the page state value
	 * @see setPageState
	 * @see CHtml::statefulForm
	 */
	public function getPageState($name,$defaultValue=null)
	{
		if($this->_pageStates===null)
			$this->_pageStates=$this->loadPageStates();
		return isset($this->_pageStates[$name])?$this->_pageStates[$name]:$defaultValue;
	}

	/**
	 * Saves a persistent page state value.
	 * A page state is a variable that is persistent across POST requests of the same page.
	 * In order to use persistent page states, the form(s) must be stateful
	 * which are generated using {@link CHtml::statefulForm}.
	 * @param string $name the state name
	 * @param mixed $value the page state value
	 * @param mixed $defaultValue the default page state value. If this is the same as
	 * the given value, the state will be removed from persistent storage.
	 * @see getPageState
	 * @see CHtml::statefulForm
	 */
	public function setPageState($name,$value,$defaultValue=null)
	{
		if($this->_pageStates===null)
			$this->_pageStates=$this->loadPageStates();
		if($value===$defaultValue)
			unset($this->_pageStates[$name]);
		else
			$this->_pageStates[$name]=$value;

		$params=func_get_args();
		$this->recordCachingAction('','setPageState',$params);
	}

	/**
	 * Removes all page states.
	 */
	public function clearPageStates()
	{
		$this->_pageStates=array();
	}

	/**
	 * Loads page states from a hidden input.
	 * @return array the loaded page states
	 */
	protected function loadPageStates()
	{
		if(!empty($_POST[self::STATE_INPUT_NAME]))
		{
			if(($data=base64_decode($_POST[self::STATE_INPUT_NAME]))!==false)
			{
				if(extension_loaded('zlib'))
					$data=@gzuncompress($data);
				if(($data=\init::app()->getSecurityManager()->validateData($data))!==false)
					return unserialize($data);
			}
		}
		return array();
	}

	/**
	 * Saves page states as a base64 string.
	 * @param array $states the states to be saved.
	 * @param string $output the output to be modified. Note, this is passed by reference.
	 */
	protected function savePageStates($states, $output)
	{
		$data=\init::app()->getSecurityManager()->hashData(serialize($states));
		if(extension_loaded('zlib'))
			$data=gzcompress($data);
		$value=base64_encode($data);
		$output=str_replace(CHtml::pageStateField(''),CHtml::pageStateField($value),$output);
	}
        
        /**
         * layout;
         * in $layout
         * return object connected layout
         */
        public function layout( $layout ) { 
            if(!$layout == 'default') : 
                 \init::app()->setTheme( $this->layout );
            elseif(is_string( $layout )) :
                \init::app()->setTheme( $layout );
            else:
                \init::app()->setTheme( '' );
            endif;
        }
        
        
        
}
