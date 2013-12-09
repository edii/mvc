<?php

/*
 * model Input
 */

class Users extends \CDetectedModel { //extends \CDetectedModel
    
    public static $db;

    private static $_tabelName = ['user'];
    
    public function init() {
        $_db =  new CDatabase( 'main', NULL);
        self::$db = $_db->getConnection();
    }
    
    public function attributeNames() {
        
    }
    
    /**
     * input ( create fields )
     */
    public function getValidate() {
        $_query = self::$db -> query("SELECT * FROM section", array('target'=>'main'), array())-> fetchAll();
        return $_query; 
    }
    
    public function update($attributes = NULL) {
    }
    
    /**
     * 
     * save (input or update)
     * 
     */
    //public function save($runValidation = true, $attributes = NULL) {
     //   echo('load model input save');
        // die('stop');
    //}
    
    
}
