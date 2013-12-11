<?php

class HomeController extends \Controller
{
	public $layout = 'dashboard'; //'column1'

	private $_model;

        private $_auth = false;
        private $_validate = false;
        
        /**
         * construct
         */
        public function init() {
            $this ->_auth = \init::app() 
                            -> getModels('auth/users') 
                            -> getValidate()
                            -> getSession();
            
            if($this ->_auth) :
                $this->_validate = true; 
            endif;
            
        }
        
        /**
         * load index admin
         */
	public function actionIndex() {
            
            
           // echo "<hr /> session";
            // вид 1
            //\init::app() -> getSession() -> set_userdata(array('test' => 'params'));
            //$_session = \init::app() -> getSession() -> all_userdata();
            
            // вариант 2
            //$_sess = \init::app() -> getSession();
            //$_session = $_sess->setSession(array('test' => 'params'))-> all_userdata();
            
            // вариант 3
           // $_session = \init::app() -> getSession() -> set_userdata(array('test' => 'params')) -> all_userdata();
            
            
            
            $_data = \init::app() -> getRequest() -> getParam('data');
            
            if(is_array($_data) and count($_data) > 0 and !$this -> _auth) :
                
                if(empty($_data['username'])) $this -> redirect('/'._request_uri.'/home/login', array('error' => true));
                if(empty($_data['password'])) $this -> redirect('/'._request_uri.'/home/login', array('error' => true));
                
                $this-> _auth = \init::app() 
                            -> getModels('auth/users') 
                            -> getValidate( $_data['username'], $_data['password'] ) 
                            -> setSession();
                if($this-> _auth) {
                    $this->_validate = true;
                } else {
                    $this -> redirect('/'._request_uri.'/home/login');
                }
            else:   
                if(!$this -> _auth and (!isset($_data) or empty($_data)) ) :
                    $this -> redirect('/'._request_uri.'/home/login');
                endif;
            endif;

            
            $this->render('index', array(
                        'validate' => $this->_validate,
                        '_session' => $this-> _auth
                    )); 

	}
        
        /* 
         * controller Login 
         */
        public function actionLogin() {
            if(!$this -> _auth) :
                $this->layout( 'index' );
                $this->render('login');
            else:
                $this -> redirect('/'._request_uri.'/');
            endif;
        }
        
        /* 
         * controller Logout 
         */
        public function actionLogout() {
            $this->layout( 'index' );
            $this->render('login');    
        }
        
        public function actionDB() {
            $this->layout( 'column1' );
            
            echo "DB";
            
            $this->render('db', array(
			'dataProvider'=>'Admin',
            ));
            

	}
        
        public function actionTest() {
            $this->layout( false );
            
            echo "load test params!";
            
            $this->render('test', array(
			'dataProvider'=>'Admin',
            ));
           
        }
}
