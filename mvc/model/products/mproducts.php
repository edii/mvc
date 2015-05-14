<?php

/*
 * model Input
 */

class Mproducts extends \CDetectedModel { //extends \CDetectedModel 
    
    public static $db;
    public $_table_name = 'products';
    
    private $_mod_access = true; // true or false
    private $_type; // type panel

    
    public function init() {
        self::$db = \init::app() -> getDBConnector(); // connected DB
        if(!$this->_mod_access) throw new \CException(\init::t('init','Not access this controller!'));
        $this -> _type = \init::app() -> _getPanel();
        
        $this -> _pk = 'id';
    }
    
    public function attributeNames() {
        
    }
    
    /**
     * getPdoductID
     * @param type $_id
     * @return type array product
     */
    public function getProductID( $_id ) {
        $_product = false;
        if((int)$_id) {
            $sql = self::$db -> select( $this->_table_name , 'p', array('target' => 'main'))
                         -> fields('p', array('id',
                                              'alias',
                                              'UserID', 'OwnerID', 'hidden', 'timeCreated', 'timeSaved',
                                              'categoryID', 'extraCategoryID', 'name', 'code', 'price',
                                              'description', 'metaTitle', 'metaDescription', 'metaKeywords',
                                              'icon'));
            $sql ->condition('hidden', 0, '=') 
                 ->condition('id', (int)$_id, '='); 
            $_product = $sql -> execute()->fetchAssoc(); 
            
        } 
         
        return $_product;
    }
    
    /**
     * 
     * @param type array $products
     */
    public function getProducts() {
        
        $sql = self::$db -> select( $this->_table_name , 'p', array('target' => 'main'))
                         -> fields('p', array('id',
                                              'alias',
                                              'UserID', 'OwnerID', 'hidden', 'timeCreated', 'timeSaved',
                                              'categoryID', 'extraCategoryID', 'name', 'code', 'price',
                                              'description', 'metaTitle', 'metaDescription', 'metaKeywords',
                                              'icon'));
        $sql ->condition('hidden', 0, '='); 
        $_products = $sql -> execute()->fetchAll(); 
        
        return $_products;
    }
    
}