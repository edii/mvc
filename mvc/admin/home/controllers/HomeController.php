<?php

class HomeController extends \Controller
{
	public $layout = 'dashboard'; //'column1'

	private $_model;

        /**
         * construct
         */
        public function init() {
            //echo "<pre>";
            //var_dump($_SESSION);
           // echo "</pre>";
           // die('stop');
        }
        
        /**
         * load index admin
         */
	public function actionIndex() {
            
            $_sess = \init::app() -> getSession() -> all_userdata();
            $login = \init::app() -> getSession() -> userdata('login');
            $password = \init::app() -> getSession() -> userdata('password');
            // $_sess2 = \init::app() -> getRequest() -> getCookies();
            echo "<pre>";
            var_dump($_sess, $login, $password);
            echo "</pre>";
            die('stop');
            
           // echo "<hr /> session";
            // вид 1
            //\init::app() -> getSession() -> set_userdata(array('test' => 'params'));
            //$_session = \init::app() -> getSession() -> all_userdata();
            
            // вариант 2
            //$_sess = \init::app() -> getSession();
            //$_session = $_sess->setSession(array('test' => 'params'))-> all_userdata();
            
            // вариант 3
           // $_session = \init::app() -> getSession() -> set_userdata(array('test' => 'params')) -> all_userdata();
            
            
           // echo "<pre>";
           // var_dump( $_session );
           // echo "</pre>";
            
           // \init::app() -> 
            
            $_data = \init::app() -> getRequest() -> getParam('data');
            
            if(is_array($_data) and count($_data) > 0) :
                
                if(empty($_data['username'])) $this -> redirect('login', array('error' => true));
                if(empty($_data['password'])) $this -> redirect('login', array('error' => true));
                
                $_auth = \init::app() 
                            -> getModels('auth/users') 
                            -> getValidate( $_data['username'], $_data['password'] ) 
                            -> setSession();
                if($_auth) {
                    
                   // echo "<pre>";
                   // var_dump( $_auth );
                   // echo "</pre>";
                    
                    $this->render('index', array(
                        'validate' => true,
                        '_session' => $_auth
                    ));     
                } else {
                    $this -> redirect('/'._request_uri.'/home/login');
                }
            else:   
                $this -> redirect('/'._request_uri.'/home/login');
            endif;


	}
        
        /* 
         * controller Login 
         */
        public function actionLogin() {
            $this->layout( 'index' );
            $this->render('login');    
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
