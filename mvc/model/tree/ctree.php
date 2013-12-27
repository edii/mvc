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
    private $_type; // type panel
    
    // protected $_sections;
    
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
    public function getTree( $_level = 1 ) {
        
        $_fields = 'SectionID as s_id, SectionParentID as p_id, SectionAlias as s_alies, SectionType as s_type';
        $_where = " SectionID <> 0 AND SectionType = '".$this -> _type."'";
        $_order = ' ORDER BY TimeCreated';
        $_limit = '';
        
        $sections = self::$db -> query( "SELECT ".$_fields." FROM ".$this->_tableName." WHERE ".$_where.$_order.$_limit ) -> fetchAll();
        
        return $sections;
    }
    
    
    public function _getCreateTree( $_label = false, $_p_id = false ) {
        // array_unique - убрать из массива одинаковые значения!
        $_tree = array();
        
        $_pId = ($_p_id) ? $_p_id : 0;
        $_lavel = ($_label) ? $_label : $this->_level;
        
        $sql = self::$db -> select('section', 'sec', array('target' => 'main'))
                         -> fields('sec', array('SectionID', 
                                                'SectionParentID', 
                                                'SectionAlias',
                                                'SectionType'    
                                                ));
        $sql ->condition('SectionType', $this -> _type, '=') ->condition('SectionParentID', $_pId, '=');
        $_query_res = $sql -> execute()->fetchAll();
        
        echo "<pre>";
        var_dump( $_query_res );
        echo "</pre>";
        
        
//        if(is_array($_query_res) and count($_query_res) > 0) {
//            $_teration = 1;
//            foreach($_query_res as $k=>$value) :
//                 
//                $_teration ++;
//            endforeach;
//        }
        
        
        
    }
    
    public function update($attributes = NULL) {
    }
    
    
}
