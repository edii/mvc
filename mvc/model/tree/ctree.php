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
        
        $_fields = 'SectionID, SectionParentID, SectionAlias, SectionType';
        $_where = " SectionParentID = 0 AND SectionID <> 0 AND SectionType = '".$this -> _type."'";
        $_order = ' ORDER BY TimeCreated';
        $_limit = '';
        
        $sections = self::$db -> query( "SELECT ".$_fields." FROM ".$this->_tableName." WHERE ".$_where.$_order.$_limit ) -> fetchAll();
        
        if(is_array($sections) and count($sections) > 0) :
            foreach($sections as $key=>$_sec):
                $this->_tree[$key] = $this->_getCreateTree($_sec);
            endforeach;
        endif;
        
        return $this->_tree;
    }
    
    
    public function _getCreateTree( $currentID, $ctree='' ) {
        // var_dump( $currentID ); die('stop');
	
	if(empty($cPath)) {
		$path[] = $currentID;
	} else {
		$path = $ctree;
	}
	
	if($currentID -> SectionParentID >0) {
		// $parent = $DS->query("SELECT CategoryID, CategoryCode, CategoryName, CategoryParentID FROM Category WHERE OwnerID = '".$OwnerID."' AND CategoryID = '".$currentID[0]['CategoryParentID']."'");
		
                $sql = self::$db -> select('section', 'sec', array('target' => 'main'))
                         -> fields('sec', array('SectionID', 
                                                'SectionParentID', 
                                                'SectionAlias',
                                                'SectionType'    
                                                ));
                $sql ->condition('SectionType', $this -> _type, '=') 
                        ->condition('SectionID', $currentID-> SectionParentID, '=')
                        ->condition('OwnerID', $this->_owner_code, '=')
                        ->condition('hidden', 0, '=');

                $parent = $sql -> execute()->fetchAll();
            
		if( $parent -> SectionParentID > 0 ) {
			$path[] = $parent;
			return $this->_getCreateTree($parent, $path);
		} elseif( $parent -> SectionParentID == 0 ) {
			$path[] = $parent;
			return $path;
		}
	} else {
		return $path;
	}
        
    }
    
    public function update($attributes = NULL) {
    }
    
    
}
