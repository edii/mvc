<?php

class CDatabase {
    
    public static $db;

    // settings params
    var $_params = '';
    var $_return = true;
    var $_active_record = true;
    
    function __construct( $properties ) {
        $this->setProperties( $properties );
        
        $this->database();
    }
    
    // params
    protected function getParams() {
        return $this->_params; 
    }
    
    public function setParams( $params ) {
        $this->_params = $params;
        // return $this->_params;
    }
    
    public function setProperties(array $properties) {
        foreach ($properties as $property => $value) {
        	$method = 'set'. ucfirst($property);
            $this->{$method}($value);
        }
        return $this;
    }
    
    // return
    protected function getReturn() {
        return $this->_return; 
    }
    
    protected function setReturn( $return ) {
        $this->_return = $return;
        // return $this->_return;
    }
    
     // return
    protected function getActiveRecord() {
        return $this->_return; 
    }
    
    protected function setActiveRecord( $active_record ) {
        $this->_active_record = $active_record;
        // return $this->_active_record;
    }
    
    private function database() {
		
                $params = $this->getParams();
                $return = $this->getReturn();
                $active_record = $this->getActiveRecord();
                
                $_array = [
                   'params' => $params,
                   'return' => $return,
                   'active_record' => $active_record 
                ];
        
                self::$db = $_array;
                
                return $this;
                 
                /*
		require_once(PATH_LIBS.DS.'database'.DS.'DB.php');

		if ($return === TRUE) {
			return DB($params, $active_record);
		}

		// Initialize the db variable.  Needed to prevent
		// reference errors with some configurations
		self::$db = '';

		// Load the DB class
		self::$db = DB($params, $active_record);
                */
	}
}