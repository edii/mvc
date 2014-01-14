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
    
    private $_owner_code = 'root';
    private $_tree = array();
    // protected $_sections;
    
    public function init() {
        self::$db = \init::app() -> getDBConnector(); // connected DB
        if(!$this->_mod_access) throw new \CException(\init::t('init','Not access this controller!'));
        $this -> _type = \init::app() -> _getPanel();
        $this->_owner_code = \init::app() -> getOwner() -> getOwnerCode();
    }
    
    public function attributeNames() {
        
    }
    
    /**
     * 
     * @param type $attributes
     */
    public function getTree() {
        
        $_fields = 'SectionID, SectionParentID, SectionAlias, SectionUrl, SectionType, SectionName';
        $_where = " SectionParentID = 0 AND SectionID <> 0 "; //AND SectionType = '".$this -> _type."'
        $_order = ' ORDER BY TimeCreated';
        $_limit = '';
        
        $sections = self::$db -> query( "SELECT ".$_fields." FROM ".$this->_tableName." WHERE ".$_where.$_order.$_limit ) -> fetchAll();// fetchAssoc() fetchAll();
        
        if(is_array($sections) and count($sections) > 0) :
            foreach($sections as $key=>$_section):
                $this->_tree[$_section -> SectionID] = (array)$_section;
                $this->_tree[$_section -> SectionID]['childs'] = $this->_getCreateTree((array)$_section, 0);
            endforeach;
        endif;
        
        
        
        return $this->_tree;
    }
    
    
    
    public function _getCreateTree( $section, $level ) {
        
        $tree = NULL;
	if(!is_array($section)) return false;
	
	if($section['SectionID'] > 0) {
		
                $sql = self::$db -> select('section', 'sec', array('target' => 'main'))
                         -> fields('sec', array('SectionID', 
                                                'SectionParentID', 
                                                'SectionAlias',
                                                'SectionUrl',
                                                'SectionType',
                                                'SectionName'
                                                ));
                $sql ->condition('SectionParentID', $section['SectionID'], '=')
                        ->condition('OwnerID', $this->_owner_code, '=')
                        ->condition('hidden', 0, '='); //->condition('SectionType', $this -> _type, '=')

                $_childs = $sql -> execute()->fetchAll(); //fetchAll()
            
                
                
                if(is_array($_childs) and count($_childs) > 0) {
                    
                    foreach($_childs as $key => $_val):
                        $_subcat = (array)$_val;
                        $tree[$key] = $_subcat; //[$_subcat['SectionID']]
                        if($_subcat['SectionParentID'] != 0)
                            $tree[$key]['childs'] = $this->_getCreateTree($_subcat, $level + 1); //[$_subcat['SectionID']]
                        
                    endforeach;
                    
                } 
                
                return $tree;
                
		
	} 
        
    }
    
    public function update($attributes = NULL) {
    }
    
    
}
