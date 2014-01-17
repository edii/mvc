<?php

/*
 * model Input
 */

class Mowner extends \CDetectedModel { //extends \CDetectedModel 
    
    public static $db;
    private $_tableName = 'owner';
    
    private $_mod_page = false; // admin or front
    private $_mod_access = true; // true or false
    private $_type; // type panel
    
   
    
    public function init() {
        self::$db = \init::app() -> getDBConnector(); // connected DB
        if(!$this->_mod_access) throw new \CException(\init::t('init','Not access this controller!'));
        $this -> _type = \init::app() -> _getPanel();
    }
    
    public function attributeNames() {
        
    }
    
    /**
     * 
     * @param type $attributes
     */
    public function getOwners() {
        
        $sql = self::$db -> select( $this->_tableName , 'owner', array('target' => 'main'))
                         -> fields('owner', array('OwnerID',
                                                  'TimeCreated',
                                                  'OwnerCode',
                                                  'hidden',
                                                  'OwnerType',  
                                                  'OwnerDomain',
                                                  'OwnerName',
                                                  'OwnerIsDefault',
                                                  'OwnerImage'));
        $sql ->condition('hidden', 0, '='); 
        $_owners = $sql -> execute()->fetchAll(); 
        
        /*
         * 'TimeCreated',
                                                  'OwnerCode',
                                                  'hidden',
                                                  'OwnerType',  
                                                  'OwnerDomain',
                                                  'OwnerName',
                                                  'OwnerIsDefault',
                                                  'OwnerImage'
         */
        
        // var_dump( $_owners );
        
        return $_owners;
    }
    
    
    public function update($attributes = NULL) {
    }
    
    //public function save($attributes = NULL) {
    //}
}
