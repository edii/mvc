<?php

class HomeController extends \Controller
{
	public $layout = 'dashboard'; //'column1'

	private $_model;

	
	public function actionIndex() {
            
            
            echo "<hr /> session";
            // вид 1
            //\init::app() -> getSession() -> set_userdata(array('test' => 'params'));
            //$_session = \init::app() -> getSession() -> all_userdata();
            
            // вариант 2
            //$_sess = \init::app() -> getSession();
            //$_session = $_sess->setSession(array('test' => 'params'))-> all_userdata();
            
            // вариант 3
            $_session = \init::app() -> getSession() -> set_userdata(array('test' => 'params')) -> all_userdata();
            
            
            echo "<pre>";
            var_dump( $_session );
            echo "</pre>";
            
            $_data = \init::app() -> getRequest() -> getParam('data');
            
            if(is_array($_data) and count($_data) > 0) :
                echo "<pre>";
                var_dump( $_data );
                echo "</pre>";
                
                $_auth = \init::app() -> getModels('auth/users') -> getValidate();
                //var_dump($_auth);
                //$_auth ->getValidate();
                
                //die('stop');
            else:   
                $this -> redirect('home/login');
            endif;

            
            
            
            
            
            // $this->render('index', array(
	    //		'dataProvider'=>'Admin',
            // ));

	}
        
        /* controller Login */
        public function actionLogin() {
            $_data = \init::app() -> getRequest() -> getParam('data');
            echo "<pre>";
            var_dump( $_data );
            echo "</pre>";
            // die('stop');
            
            $this->layout( 'index' );
            $this->render('login');    
        }
        /* end */
        
        
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
