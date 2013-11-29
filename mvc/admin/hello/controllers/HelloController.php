<?php

class HelloController extends \Controller
{
	public $layout = 'column1'; //'column1'

	private $_model;

	
	public function actionIndex() {
            
            //echo "BLAAAAAAAAAAAAAAAA MAKS!";
            
            $this->layout( 'column2' ); //'column2'
            
            //\init::app()->setTheme( 'column1' );
             
            //$themes = \init::app()->getTheme();
            
            //$layout = \init::app() -> getLayoutPath();
            
            //echo "<hr /> controller";
            //echo "<pre>";
            //var_dump($themes);
            //echo "</pre>";
            
            //\init::app()->setTheme( 'column2' );
            
            $this->render('index', array(
			'dataProvider'=>'Admin',
		));

	}
        
        public function actionDB() {
            
            echo "BLAAAAAAAAAAAAAAAA MAKS! DB";
            

	}
        
        public function actionTest() {
            // $this->layout( false );
            
            // \init::app()->setTheme( false );
            
            echo "load test params!";
           
        }
}
