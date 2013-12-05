<?php

class HelloController extends \Controller
{
	public $layout = 'column1'; //'column1'

	private $_model;

	
	public function actionIndex() {
            
            $this->layout( 'column2' ); //'column2'
            
            echo "<hr /> session";
            $_session = \init::app() -> getSession();
            echo "<pre>";
            var_dump( $_session );
            echo "</pre>";
            
            
            
            
            $this->render('index', array(
			'dataProvider'=>'Admin',
            ));

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
