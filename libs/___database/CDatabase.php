<?php

class CDatabase extends CApplicationComponent {
    
    public static $db = array();

    // settings params
    var $_params = '';
    var $_return = true;
    var $_active_record = true;
    
    var $_configs;
    var $_connection;
    
    private $_definitions = array();
    
    public $_databaseDefinition;
    public $_boxesDefinition;
    
    function __construct( $params, $return = true, $active_record = true ) {
        $this->setParams($params);
        $this->setReturn($return);
        $this->setActiveRecord($active_record);
        
        // set _configs
        $this->_getDb();
        /*$this->setProperties( $properties );*/
        $this->_getDefinitions(); // load definitions from controller
        $this->database();
    }
    
    
    
    protected function _getDb() {
        $this->_configs = \init::app()->getDb();
        
        if(!$this->_configs or !is_array($this->_configs)) {
              
            throw new CDbException(\init::t('init','not create configs: {error}',
                           array('{error}' => get_class($this))));
        } else {
           if(!array_key_exists('main', $this->_configs)) {
                throw new CDbException(\init::t('init','Create configs settings db[main] => ["localhost" = > , and other]: {error}',
                           array('{error}' => get_class($this))));
            }   
        }
        return $this->_configs;
    }
    
    protected function _getDefinitions() {
        $this->_definitions = \init::app()->getDefinition();
        if(!is_array($this->_definitions) or empty($this->_definitions) or !isset($this->_definitions)) {
            return null;
        }
        
        if(is_array($this->_definitions)) {
            if(isset($this->_definitions['databaseDefinition']) and is_array($this->_definitions['databaseDefinition']))
                $this->setDatabaseDefinition( $this->_definitions['databaseDefinition'] );
            if(isset($this->_definitions['boxesDefinition']) and is_array($this->_definitions['boxesDefinition']))
                $this->setBoxesDefinition( $this->_definitions['boxesDefinition'] );
        }
        
        return $this->_definitions;
        
    }
    
    public function setProperties(array $properties) {
        foreach ($properties as $property => $value) {
        	$method = 'set'. ucfirst($property);
            $this->{$method}($value);
        }
        return $this;
    }
    
    /**
     * register variable, settings database 
     * @return databaseDefinition ['t'][['tabel_name'] => '', ['key'] => '']
     */
    protected function getDatabaseDefinition() {
        return $this-> _databaseDefinition;
    }
    protected function setDatabaseDefinition( array $_databaseDefinition ) {
        $this-> _databaseDefinition = $_databaseDefinition;
        return $this-> _databaseDefinition;
    }
    
    /**
     * register variable, settings boxesDefinition
     * @return boxesDefinition ['name_controllers'][['aling']   => 'left', 
     *                                              ['name']    => 'index', 
     *                                              ['module']  => 'index', 
     *                                              ['layout']  => 'index']
     */
    protected function getBoxesDefinition() {
        return $this-> _boxesDefinition;
    }
    protected function setBoxesDefinition( array $_boxesDefinition ) {
        $this-> _boxesDefinition = $_boxesDefinition;
        return $this-> _boxesDefinition;
    }
    
    
    
    // params
    protected function getParams() {
        return $this->_params; 
    }
    
    public function setParams( $params ) {
        $this->_params = $params;
    }
    
    
    // return
    protected function getReturn() {
        return $this->_return; 
    }
    
    protected function setReturn( $return ) {
        $this->_return = $return;
    }
    
     // return
    protected function getActiveRecord() {
        return $this->_return; 
    }
    
    protected function setActiveRecord( $active_record ) {
        $this->_active_record = $active_record;
    }
    
    
    public function getConnection() {
        $_p = $this->getParams();
        if(empty($_p)) $_p = 'main';
        return $this->_connection = self::$db[$_p];
         
    }
    
    private function database() {
         
                try {
                        
                        $active_record = $this->getActiveRecord();
                    
                        require_once(PATH_LIBS.DS.'database'.DS.'DB.php');
                        
                        $_dbDefinition = $this->getDatabaseDefinition();
                        
                        if(!is_array($this->_configs)) return null;
                        
                        foreach($this->_configs as $key => $val) {
                            $_params = (array)$val;
                            self::$db[$key] = DB($_params, $active_record);
                        }
                        
                        
                       // echo "<pre>";
                       // var_dump( self::$db );
                       // echo "</pre>";
                        
                        /*
                        echo "<pre>";
                        var_dump( $_dbDefinition );
                        echo "</pre>";
                        
                        //$params = $this->getParams();
                        //$return = $this->getReturn();
                        //$active_record = $this->getActiveRecord();
                    
                        // echo PATH_LIBS.DS.'database'.DS.'DB.php'; die('fix');
                        

                        if ($return === TRUE) {
                            return DB($params, $active_record);
                        }

                        // Load the DB class
                        self::$db = DB($params, $active_record);
                        */
                        
                    
                       
                } catch(Exception $e) {
                    
                    
                    if(DEBUG) {
                            throw new \CDbException('CDatabase failed to open the DB connection: '.
                                    $e->getMessage(),(int)$e->getCode(),$e->errorInfo);
                    } else {
                            \init::log($e->getMessage(), \CLogger::LEVEL_ERROR,'exception.CDbException');
                            throw new \CDbException('CDatabase failed to open the DB connection.', (int)$e->getCode(), $e->errorInfo);
                    }
                    
                    
                   // \init::log('Error in preparing SQL: '.$this->getText(), \CLogger::LEVEL_ERROR,'system.db.CDbCommand');
                   // $errorInfo = $e instanceof PDOException ? $e->errorInfo : null;
                   // throw new CDbException(\init::t('yii','CDbCommand failed to prepare the SQL statement: {error}',
                   //         array('{error}' => $e->getMessage())),(int)$e->getCode(), $errorInfo);
                    
                    
                    
                }

                
              
	}
        
        
}