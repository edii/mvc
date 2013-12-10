<?php

/*
 * model Input
 */

class Users extends \CDetectedModel { //extends \CDetectedModel
    
    public static $db;

    private static $_tabelName = ['user'];
    
    public $_users = false;
    
    public function init() {
        $_db =  new CDatabase( 'main', NULL);
        self::$db = $_db->getConnection();
    }
    
    public function attributeNames() {
        
    }
    
    /**
     * input ( create fields )
     */
    public function getValidate($login = false, $password) {
        
        if($login and $password) {
            $login = stripcslashes(htmlspecialchars(trim($login)));
            $password = md5(stripcslashes(htmlspecialchars(trim($password))));
            
            $_query = self::$db -> query("SELECT UserName as login, Email as email, Password as password FROM user WHERE (UserName = '".$login."' OR Email = '".$login."') AND Password = '".$password."' ", array('target'=>'main'), array())-> fetchAll();          
            if(is_array($_query) and count($_query) > 0):
                $this->_users = array_shift($_query);
                return $this;
            else:
                return false;
            endif;
            
            return true;
        } else {
           return false; 
        }
        
    }
    
    public function setSession() {
        
        if(is_array($this->_users) or is_object($this->_users)) {
            $_session = \init::app() -> getSession() -> set_userdata($this->_users) -> all_userdata();
            return $_session;
        } else {
            return false;
        }
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
