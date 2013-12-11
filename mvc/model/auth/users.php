<?php

/*
 * model Input
 */

class Users extends \CDetectedModel { //extends \CDetectedModel
    
    public static $db;

    private static $_tabelName = ['user'];
    
    public $_users = false;
    
    private $_login;
    private $_password;
    
    public function init() {
        $_db =  new CDatabase( 'main', NULL);
        self::$db = $_db->getConnection();
        
       // $this -> _users = 
    }
    
    public function attributeNames() {
        
    }
    
    /**
     * input ( create fields )
     */
    public function getValidate($login = false, $password = false) {
        
        if($login and $password) {
            $this->_login = stripcslashes(htmlspecialchars(trim($login)));
            $this->_password = md5(stripcslashes(htmlspecialchars(trim($password))));
            
            if(!$_session = $this -> getSessionValidate( $this->_login, $this->_password )) :
            
                $_query = self::$db -> query("SELECT UserID as id, UserName as login, Email as email, Password as password FROM user WHERE (UserName = '".$this->_login."' OR Email = '".$this->_login."') AND Password = '".$this->_password."' ", array('target'=>'main'), array())-> fetchAll();          
                if(is_array($_query) and count($_query) > 0):
                    $this->_users = array_shift($_query);
                endif;
            
            else:
                $this->_users = $_session;
            endif;
        } else {
            if($_session = $this -> getSessionValidate()) :
               $this->_users = $_session;  
            endif; 
        }
        
        return $this;
        
    }
    
    public function setSession() {
        
        if(is_array($this->_users) or is_object($this->_users)) {
            $_session = \init::app() -> getSession() -> set_userdata($this->_users) -> all_userdata();
            return $_session;
        } else {
            return false;
        }
    }
    
    public function getSession() {
        return (is_array($this->_users) and count($this->_users) > 0) ? $this->_users : false;
    }
    
    protected function getSessionValidate($login = false, $password = false) {
        $_session = \init::app() -> getSession() -> all_userdata();
        if($login and $password) {
            $_login = \init::app() -> getSession() -> userdata('login');
            $_password = \init::app() -> getSession() -> userdata('password');
            
            if($login == $_login and $password == $_password) {
                return $_session;
            } else {
               return false; 
            }
            
        } else if(is_array($_session) and count($_session) > 0) {
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
