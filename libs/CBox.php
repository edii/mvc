<?php
/**
 * CBox class file.
 *
 * @author Sergei Novickiy <edii87shadow@gmail.com>
 * @copyright Copyright &copy; 2013 
 */


class CBox extends \CApplicationComponent
{
        /**
	 * default themes base path
	 */
	const DEFAULT_BASEPATH = 'schemas'; //.DS._detected.DS
    
	private $_name;
	private $_basePath;
	private $_baseUrl;

        public $boxes=array();
        
        public $view = array();
        public $data = array();
        
        public $_boxesDefinition = array();
        
        public $themeClass = 'CBoxLayout';
        
	/**
	 * Constructor.
	 */
	public function __construct($name = false,$basePath = false,$baseUrl = false) {
		$this->_name     =   $name;
		$this->_baseUrl  =   $baseUrl;
		$this->_basePath =   $basePath;
                
                $this-> _loadWebDefinitions(); // load WebDefinitions
	}
        
        public function init() {
            
        } // init load Box

        /**
	 * Executes the widget.
	 * This method is called by {@link CBaseController::endWidget}.
	 */
	public function run()
	{
	}
        
        /**
	 * @param string $name name of the theme to be retrieved
	 * @return CTheme the theme retrieved. Null if the theme does not exist.
	 */
	public function getTheme($name) {
                
		$themePath = self::DEFAULT_BASEPATH.$this->getBasePath().DS._detected.DS.'layout';
		if(is_dir($themePath)) {
			$class = \init::import($this->themeClass, true);
			return new $class($name, $themePath);
		}
		else
			return null;
	}
        
        protected function _loadWebDefinitions() {
             $_definitions = \init::app()->getDefinition();
             if( isset($_definitions) and is_array($_definitions) ) {
                 if(isset($_definitions['boxesDefinition']) and is_array($_definitions['boxesDefinition']))
                    $this->setBoxesDefinition( $_definitions['boxesDefinition'] );
             }
        }
        
        /**
         * register variable, settings boxesDefinition
         * @return boxesDefinition ['name_controllers'][['aling']   => 'left', 
         *                                              ['name']    => 'index', 
         *                                              ['module']  => 'index', 
         *                                              ['layout']  => 'index']
         */
        public function getBoxesDefinition() {
            return $this-> _boxesDefinition;
        }
        protected function setBoxesDefinition( array $_boxesDefinition ) {
            $this-> _boxesDefinition = $_boxesDefinition;
            return $this-> _boxesDefinition;
        }
        
        /**
	 * Creates a new widget based on the given class name and initial properties.
	 * @param CBaseController $owner the owner of the new widget
	 * @param string $className the class name of the widget. This can also be a path alias (e.g. system.web.widgets.COutputCache)
	 * @param array $properties the initial property values (name=>value) of the widget.
	 * @return CWidget the newly created widget whose properties have been initialized with the given values.
	 */
	public function createBox($owner,$className,$properties=array())
	{
		$className=\init::import($className,true);
		$box = new $className($owner);

		if(isset($this->boxes[$className]))
			$properties=$properties===array() ? $this->boxes[$className] : CMap::mergeArray($this->boxes[$className],$properties);

               // load scins
                
		foreach($properties as $name=>$value)
			$box->$name=$value;
		return $box;
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

	
        //show box by id or by alias
        public function getBox($boxID,$mode='') {
            //echo $boxID.'///'.$mode;
            //print_r($mode);
            //echo 'getbox: '.$boxID.'<br>';
            global $CORE, $SERVER_SOAP, $boxesSidePositionsCounter;
            $boxes = $CORE->getBoxesDefinition();
            //print_r($website);
            //print_r($boxes);
            $box = $boxes[$boxID];
    
            $arguments = $box['arguments'];
            $pageboxarguments =  $mode['boxparams'];
            if(!empty($pageboxarguments)) { $arguments =  $arguments.'/'.$pageboxarguments; }
                //print_r($mode);
                $params = $mode['params'];
                if(!empty($arguments)) {
                    $CORE->getArguments($arguments,'torestore');
                }
                $input = $CORE->getInput();
	
                $config = $CORE->getConfig();
                $setting = $config;
                $user = $CORE->getUser();
                $clientType = $config['ClientType'];
                //print_r($setting);
                $module = $box['module'];
                $customFolder = 'custom/'.$config['OwnerID'];    
    
                if(empty($templateType)) { $templateType = $input['ResourceTemplate'];}
        
                $layout = $config['Layout'];
                 //echo '$layout='.$layout;
                $template = $box['template'];
    
                $boxContent =  $mode['boxcontent'];
                $boxSide =  $mode['boxside'];
                setSetting('BoxSide',$mode['boxside']);

                $box['boxindex'] = $mode['boxindex'];
                setSetting('BoxIndex',$mode['boxindex']);

                $boxesSidePositionsCounter[$boxSide] = $boxesSidePositionsCounter[$boxSide]+1;

                $box['boxsideposition'] = $boxesSidePositionsCounter[$boxSide];
                $box['boxside'] = $boxSide;
                $box['boxcontent'] = $mode['boxcontent'];  
                $box['boxtitle'] = $mode['boxtitle'];
                $box['boxshowtitle'] = $mode['boxshowtitle']; 
                $box['boxtemplate'] = $mode['boxtemplate'];
                $box['boxparams'] = $mode['boxparams'];
                $box['boxstyle'] = $mode['boxstyle'];
    
                $moduleFile = $config['RootPath'].'modules/'.$module.'/module.php';
	
                if(is_file($moduleFile)) {   
                    include_once($moduleFile);
                    $method = $box['method'];
                    //$methodString = "\$moduleObject = new \$class(); if(function_exists(\$moduleObject->\$method())) {\$moduleObject->\$method();}";
                    if(!empty($method)) {
                        if(function_exists($method)) {$out = $method();}
                    }
		
                    $input = $CORE->getInput();
                    $templateType = $input['TemplateType'];
                    //get template lib
                    $templateLibFile = $config['RootPath'].$customFolder.'/templates/'.$clientType.'/'.$module.'/lib.tpl.php';
                    if(is_file($templateLibFile)) {
                        include_once($templateLibFile);
                    } else {
                        $templateLibFile = $config['RootPath'].'templates/'.$clientType.'/'.$module.'/lib.tpl.php';
                        if(is_file($templateLibFile)) {
                            include_once($templateLibFile);
                        }
                    }
        		
                    //echo $config['RootPath'].'templates/'.$clientType.'/'.$module.'/layouts/'.$layout.'/'.$templateType.'/'.$template.'.tpl.php';
                    if(!empty($templateType)) {
			$templateFile = $config['RootPath'].$customFolder.'/templates/'.$clientType.'/'.$module.'/'.$templateType.'/'.$template.'.tpl.php';
                        if(is_file($templateFile)) {
                            include($templateFile);
                        } else {
                            $templateFile = $config['RootPath'].$customFolder.'/templates/'.$clientType.'/'.$module.'/'.$template.'.tpl.php';
                            if(is_file($templateFile)) {
                                include($templateFile);
                            } else {
                                $templateFile = $config['RootPath'].'templates/'.$clientType.'/'.$module.'/layouts/'.$layout.'/'.$templateType.'/'.$template.'.tpl.php';
                                if(is_file($templateFile)) {
                                    include($templateFile);
                                } else { 
                                    $templateFile = $config['RootPath'].'templates/'.$clientType.'/'.$module.'/layouts/'.$layout.'/'.$template.'.tpl.php'; 
                                    if(is_file($templateFile)) {
                                        include($templateFile);
                                    } else {
                                        $templateFile = $config['RootPath'].'templates/'.$clientType.'/'.$module.'/'.$templateType.'/'.$template.'.tpl.php'; 
                                        if(is_file($templateFile)) {
                                            include($templateFile);
                                        } else {
                                            $templateFile = $config['RootPath'].'templates/'.$clientType.'/'.$module.'/'.$template.'.tpl.php';
                                            if(is_file($templateFile)) {
                                                include($templateFile);
                                            }
                                        }                             
                                    }                     
                                }   
                            }  
                        }             
                    } else {
                        $templateFile = $config['RootPath'].$customFolder.'/templates/'.$clientType.'/'.$module.'/'.$template.'.tpl.php';
                        if(is_file($templateFile)) {
                            include($templateFile);
                        } else {
                            $templateFile = $config['RootPath'].'templates/'.$clientType.'/'.$module.'/layouts/'.$layout.'/'.$template.'.tpl.php';
                            //echo 'ddddd:'.$templateFile; 
                            if(is_file($templateFile)) {
                                include($templateFile);
                            } else {
                                $templateFile = $config['RootPath'].'templates/'.$clientType.'/'.$module.'/'.$template.'.tpl.php';
                                if(is_file($templateFile)) {
                                    include($templateFile);
                                }                    
                            }
                        }
                    }
		
                }
                if(!empty($arguments)) {
                    $CORE->restoreArguments();
                }
    
                return $out;	
            }

        //show boxe by sides
        public function getBoxes($boxesSide,$mode='') {
            global $CORE, $SERVER_SOAP, $currentBoxParams;
            $website = $CORE->getWebsiteDefinition();

            $input = $CORE->getInput();
            $sectionID = $input['SID'];
            $boxes = $website[$sectionID][$boxesSide];

            if(is_array($boxes)) {
                    foreach($boxes as $id=>$box) {
                            $boxID =  $box['boxid'];
                            //echo $boxID.' side:'.$boxesSide.'<br>'; 
                            $params['boxtitle'] = $box['boxtitle'];
                            $params['boxshowtitle'] = $box['boxshowtitle']; 
                            $boxContent = $box['boxcontent'];
                            if(!empty($boxContent)) {
                                $boxContent = str_replace("&quot;",'"',$boxContent);
                                $boxContent = stripslashes($boxContent);
                            }
                            $params['boxcontent'] = $boxContent; 
                            $params['boxtemplate'] = $box['boxtemplate']; 
                            $params['boxparams'] = $box['boxparams']; 
                            $params['boxstyle'] = $box['boxstyle'];
                            $params['boxside'] = $boxesSide;
                            $params['boxindex'] = $box['boxindex'];
                            $currentBoxParams = $params;
                            getBox($boxID,$params);
                            $currentBoxParams = '';
                    }
            }
    }

        public function boxHeader($data='',$mode='') {
                global $CORE, $currentBoxParams;
                //$boxes = $CORE->getBoxesDefinition();

                $boxparams = $currentBoxParams;

                $input = $CORE->getInput();
                $config = $CORE->getConfig();
                $setting = $config;
                $user = $CORE->getUser();
                $clientType = $config['ClientType'];
                $windowMode = $input['windowMode'];
                if(!empty($input['windowMode'])) {
                        $templateFile = $config['RootPath'].'templates/'.$clientType.'/layouts/'.$config['Layout']."/".$windowMode."/boxHeader.tpl.php";
                } else {
                        $templateFile = $config['RootPath'].'templates/'.$clientType.'/layouts/'.$config['Layout'].'/boxHeader.tpl.php';
                }	
                $out=$data;
                //print_r($setting);
                if(!empty($boxparams['boxtitle'])) { 
                        $out['title'] = $boxparams['boxtitle']; 
                } else { 
                        if(preg_match('#\.#is',$out['title'])) { 
                                $out['title'] = lang($out['title']); 
                        } 
                }


                $tabs = $data['tabs'];
                if(!empty($tabs) && !is_array($tabs)) {
                        $tabLink=$input['tabLink'];
                        $DS = new DataSource('main');
                        $tabsRS = $DS->query("SELECT * FROM TabLink WHERE TabLinkAlias='$tabs' ORDER BY TabLinkPosition");
                        $out['DB']['tabs'] = $tabsRS;
                        $out['tabs'] = $tabsRS;
                        //print_r($out['DB']['tabs']);
                        if($tabLink==1) {
                                $CORE->setSessionVar('tabLink',$tabsRS[0]['TabLinkID']);
                                $tabLink = $tabsRS[0]['TabLinkID'];
                        } elseif(!empty($tabLink)) {
                                $CORE->setSessionVar('tabLink',$tabLink);
                        }
                }
                if(is_file($templateFile)) {
                        include($templateFile);
                }
        }

        public function boxFooter($data='',$mode='') {
                global $CORE;
                $boxes = $CORE->getBoxesDefinition();
                $input = $CORE->getInput();
                $config = $CORE->getConfig();
                $setting = $config;
                $user = $CORE->getUser();
                $clientType = $config['ClientType'];
                $windowMode = $input['windowMode'];
                if(!empty($input['windowMode'])) {
                        $templateFile = $config['RootPath'].'templates/'.$clientType.'/layouts/'.$config['Layout']."/$windowMode/boxFooter.tpl.php";
                } else {
                        $templateFile = $config['RootPath'].'templates/'.$clientType.'/layouts/'.$config['Layout'].'/boxFooter.tpl.php';
                }		
                $out=$data;
                if(is_file($templateFile)) {
                        include($templateFile);
                }	

        }
        
}
