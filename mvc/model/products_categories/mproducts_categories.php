<?php

/*
 * model Input
 */

class Mproducts_categories extends \CDetectedModel { //extends \CDetectedModel 
    
    public static $db;
    public $_table_name = 'products_category';
    
    private $_mod_access = true; // true or false
    private $_type; // type panel

    
    public function init() {
        self::$db = \init::app() -> getDBConnector(); // connected DB
        if(!$this->_mod_access) throw new \CException(\init::t('init','Not access this controller!'));
        $this -> _type = \init::app() -> _getPanel();
        
        $this -> _pk = 'id';
        // $this -> _table_name = 'section';
    }
    
    public function attributeNames() {
        
    }
    
    /**
     * getCategoryID
     * @param type $_id
     * @return type array category
     */
    public function getCategoryID( $_id ) {
        $_category = false;
        if((int)$_id) {
            
            $sql = self::$db -> select( $this->_table_name , 'cat', array('target' => 'main'))
                         -> fields('cat', array('id',
                                                  'parentID', 'UserID', 'OwnerID', 'hidden',
                                                  'timeCreated', 'timeSaved', 'alias', 'logo',
                                                  'titleIcon', 'name', 'intro', 'description', 'position',
                                                  'metaTitle', 'metaDescription', 'metaKeywords', 'showProducts'
                                                  ));
            $sql ->condition('hidden', 0, '=') 
                 ->condition('id', (int)$_id, '='); 
            $_category = $sql -> execute()->fetchAssoc(); 
            
        } 
         
        return $_category;
    }
    
    /**
     * getCategoryParentID
     * @param type $_id
     * @return type array category
     */
    public function getCategoryParentID( $parent_id ) {
        $_categories = false;
            
        $sql = self::$db -> select( $this->_table_name , 'cat', array('target' => 'main'))
                     -> fields('cat', array('id',
                                              'parentID', 'UserID', 'OwnerID', 'hidden',
                                              'timeCreated', 'timeSaved', 'alias', 'logo',
                                              'titleIcon', 'name', 'intro', 'description', 'position',
                                              'metaTitle', 'metaDescription', 'metaKeywords', 'showProducts'
                                              ));
        $sql ->condition('hidden', 0, '=') 
             ->condition('parentID', (int)$parent_id, '='); 
        $_categories = $sql -> execute()->fetchAll(); 
            
         
        return $_categories;
    }
    
    /**
     * 
     * @param type array $categories
     */
    public function getCategories() {
        
        $sql = self::$db -> select( $this->_table_name , 'cats', array('target' => 'main'))
                         -> fields('cats', array('id',
                                                  'parentID', 'UserID', 'OwnerID', 'hidden',
                                                  'timeCreated', 'timeSaved', 'alias', 'logo',
                                                  'titleIcon', 'name', 'intro', 'description', 'position',
                                                  'metaTitle', 'metaDescription', 'metaKeywords', 'showProducts'));
        $sql ->condition('hidden', 0, '='); 
        $_categoies = $sql -> execute()->fetchAll(); 
        
        return $_categoies;
    }
    
    public function getCategoriesTree( $parentID, $level = 0 ) {
        $_tree = array();
        if(empty($parentID)) $parentID = false;
        $_categories = $this ->getCategoryParentID($parentID);
        if(is_array($_categories) and count($_categories) > 0) {
            foreach($_categories as $_category) :
                $_tree[ $_category['id'] ]['level'] = $level;
                $_tree[ $_category['id'] ] = $this -> getCategoriesTree( $_category['id'], $level ++ );
                
            endforeach;
        }
        return $_tree;
    }
    
    /**
     * 
     * @param type array $_products
     */
    public function getProductsCategory( $cat_id ) {
        if((int)$cat_id) {
            
            $_products = self::$db -> query("SELECT cat.id as cat_id, 
                                            cat.parentID as cat_pID, 
                                            cat.name as cat_name,
                                            products.*
                                       FROM {$this->_table_name} as cat 
                                       INNER JOIN products as p ON p.categoryID = cat.id
                                       WHERE cat.id = {$cat_id} AND cat.hidden = 0
                                       ", 
                                    array('target'=>'main'), // dbselect db 
                                    array()); // params
        }
        return (isset($_products) and is_array($_products)) ? $_products : NULL;
    }
    
    /**
     * 
     * @param type array $products_categories
     */
    public function getProductsCategories( Array $cat_in_id ) {
        if(count($cat_in_id) > 0) {
            
            $pcategories = self::$db -> query("SELECT cat.id as cat_id, 
                                            cat.parentID as cat_pID, 
                                            cat.name as cat_name,
                                            products.*
                                       FROM {$this->_table_name} as cat 
                                       INNER JOIN products as p ON p.categoryID = cat.id
                                       WHERE cat.id IN ( '". implode(',', $cat_in_id) ."' ) AND cat.hidden = 0
                                       ", 
                                    array('target'=>'main'), // dbselect db 
                                    array()); // params
        }
        return (isset($pcategories) and is_array($pcategories)) ? $pcategories : NULL;
    }
    
}