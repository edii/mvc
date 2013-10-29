<?php

class CDatabase extends CApplicationComponent {
    
    public static $db;

    // settings params
    var $_params = '';
    var $_return = true;
    var $_active_record = true;
    
    
    function __construct( $properties ) {
        $this->setProperties( $properties );
        $this->database();
    }
    
    public function setProperties(array $properties) {
        foreach ($properties as $property => $value) {
        	$method = 'set'. ucfirst($property);
            $this->{$method}($value);
        }
        return $this;
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
    
    
    private function database() {
		
                
                try {
                        $params = $this->getParams();
                        $return = $this->getReturn();
                        $active_record = $this->getActiveRecord();
                    
                        // echo PATH_LIBS.DS.'database'.DS.'DB.php'; die('fix');
                        require_once(PATH_LIBS.DS.'database'.DS.'DB.php');

                        if ($return === TRUE) {
                            return DB($params, $active_record);
                        }

                        // Load the DB class
                        self::$db = DB($params, $active_record);
                    
                       
                } catch(Exception $e) {
                    
                    
                    if(DEBUG) {
                            throw new \CDbException('CDatabase failed to open the DB connection: '.
                                    $e->getMessage(),(int)$e->getCode(),$e->errorInfo);
                    } else {
                            \init::log($e->getMessage(), \CLogger::LEVEL_ERROR,'exception.CDbException');
                            throw new \CDbException('CDatabase failed to open the DB connection.', (int)$e->getCode(), $e->errorInfo);
                    }
                    
                    /*
                    \init::log('Error in preparing SQL: '.$this->getText(), \CLogger::LEVEL_ERROR,'system.db.CDbCommand');
                    $errorInfo = $e instanceof PDOException ? $e->errorInfo : null;
                    throw new CDbException(\init::t('yii','CDbCommand failed to prepare the SQL statement: {error}',
                            array('{error}' => $e->getMessage())),(int)$e->getCode(), $errorInfo);
                    
                    */
                    
                }
                
              
	}
        
        
}