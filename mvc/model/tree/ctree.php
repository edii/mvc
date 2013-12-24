<?php

/*
 * model Input
 */

class Ctree extends \CDetectedModel { //extends \CDetectedModel 
    
    public static $db;
    private $_tableName = 'section';
    
    private $_mod_page = false; // admin or front
    private $_mod_access = true; // true or false
    
    private $_level = 1;
    
    public function init() {
        self::$db = \init::app() -> getDBConnector(); // connected DB
        if(!$this->_mod_access) throw new \CException(\init::t('init','Not access this controller!'));
    }
    
    public function attributeNames() {
        
    }
    
    /**
     * 
     * @param type $attributes
     */
    public function getTree( $_level = 1 ) {
        $_fields = 'SectionID as s_id, SectionParentID as p_id, SectionAlias as s_alies, SectionType as s_type';
        $_where = " SectionID <> 0 AND SectionType = 'admin'";
        $_order = ' ORDER BY TimeCreated';
        $_limit = '';
        
        $_section = self::$db -> query( "SELECT ".$_fields." FROM ".$this->_tableName." WHERE ".$_where.$_order.$_limit ) -> fetchAll();
        return $_section;
    }
    
    
    public function update($attributes = NULL) {
    }
    
    
}
